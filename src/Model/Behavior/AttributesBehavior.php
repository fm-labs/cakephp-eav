<?php

namespace Eav\Model\Behavior;


use ArrayObject;
use Cake\Collection\Collection;
use Cake\Collection\Iterator\MapReduce;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\ORM\Behavior;
use Cake\ORM\Exception\RolledbackTransactionException;
use Cake\ORM\Query;
use Cake\ORM\ResultSet;
use Cake\ORM\RulesChecker;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * Class AttributesBehavior
 *
 * @package Eav\Model\Behavior
 */
class AttributesBehavior extends Behavior
{
    /**
     * @var array
     */
    protected $_defaultConfig = [
        'implementedFinders' => [
            'attributes' => 'findAttributes',
        ],
        'implementedMethods' => [
            'getAttributes' => 'getAttributes',
            'getAttributesValues' => 'getAttributesValues',
            'getAttributesAvailable' => 'getAttributesAvailable',
            'getAttributeAvailable' => 'getAttributeAvailable',
            'validateAttributes' => 'validateAttributes'
        ],
    ];

    protected $_attrs;
    protected $_attrsAvailable;

    /**
     * @param array $config Behavior config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->_table->hasMany('EavEntityAttributeValues', [
            'className' => 'Eav.EavEntityAttributeValues',
            'foreignKey' => 'foreignKey',
            'conditions' => ['EavEntityAttributeValues.model' => $this->_modelName()]
        ]);

        $this->_table->belongsTo('EavAttributeSets', [
            'className' => 'Eav.EavAttributeSets',
            'foreignKey' => 'eav_attribute_set_id'
        ]);
    }


    /**
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findAttributes(Query $query, array $options = [])
    {
        $query->contain(['EavAttributeSets', 'EavEntityAttributeValues' => ['EavAttributes']]);
        return $query;
    }


    /**
     * 'beforeFind' callback
     *
     * Applies a MapReduce to the query, which resolves entity attributes
     * after the find operation.
     *
     * @param Event $event
     * @param Query $query
     * @param array $options
     * @param $primary
     */
    public function beforeFind(Event $event, Query $query, $options, $primary)
    {
        $mapper = function ($row, $key, MapReduce $mapReduce) {

            if ($row instanceof EntityInterface) {

                // append attribute values to result row / entity
                foreach ($this->getAttributesValues($row) as $attrVal) {

                    $fieldName = $attrVal->eav_attribute->code;
                    $fieldData = $attrVal->getValue();

                    if ($row instanceof EntityInterface) {
                        $row->set($fieldName, $fieldData);
                        $row->dirty($fieldName, false);
                    } else {
                        $row[$fieldName] = $fieldData;
                    }
                }

                // set available attributes which have not any values to NULL
                foreach ($this->getAttributesAvailable($row) as $attr) {
                    $fieldName = $attr->code;
                    if (isset($row[$fieldName])) {
                        continue;
                    }

                    if ($row instanceof EntityInterface) {
                        $row->set($fieldName, null);
                        $row->dirty($fieldName, false);
                    } else {
                        $row[$fieldName] = null;
                    }
                }
            }


            $mapReduce->emitIntermediate($row, $key);
        };

        $reducer = function ($bucket, $name, MapReduce $mapReduce) {
            $mapReduce->emit($bucket[0], $name);
        };

        $query->mapReduce($mapper, $reducer);
    }



    /**
     * @param EntityInterface $entity
     * @return \Cake\Datasource\ResultSetInterface
     * @TODO Caching
     */
    public function getAttributesValues(EntityInterface $entity)
    {
        return $this->_table->EavEntityAttributeValues->find()
            ->contain(['EavAttributes'])
            ->where(['EavEntityAttributeValues.model' => $this->_modelName(), 'EavEntityAttributeValues.foreignKey' => $entity->get('id') ])
            ->all();
    }

    public function getAttributeValue(EntityInterface $entity, $code)
    {
        foreach ($this->getAttributesValues($entity) as $attrVal) {
            if ($attrVal->eav_attribute->code == $code) {
                return $attrVal;
            }
        }
        return null;
    }

    /**
     * @param EntityInterface $entity
     * @return \Cake\Collection\CollectionInterface
     */
    public function getAttributes(EntityInterface $entity)
    {
        if (!$this->_attrs) {
            $attributes = $this->getAttributesValues($entity);
            $this->_attrs = $attributes->combine('eav_attribute.code', 'value');
        }
        return $this->_attrs;
    }

    public function getAttribute(EntityInterface $entity, $code)
    {
        foreach ($this->getAttributes($entity) as $attr) {
            if ($attr->code == $code) {
                return $attr;
            }
        }
        return null;
    }

    /**
     * @return Collection
     */
    public function getAttributesAvailable(EntityInterface $entity)
    {
        if (!$this->_attrsAvailable || $entity->dirty('eav_attribute_set_id')) {
            $attrSetId = $entity->get('eav_attribute_set_id');
            if (!$attrSetId) {
                //debug("AttributesBehavior: Can not get available attributes: Attribute Set ID missing");
                return new Collection([]);
            }

            $attrSet = $this->_table->EavAttributeSets
                ->find()
                ->where(['id' => $attrSetId])
                ->contain('EavAttributes')
                ->first();

            $this->_attrsAvailable = new Collection($attrSet->get('eav_attributes'));
        }
        return $this->_attrsAvailable;
    }

    public function getAttributeAvailable(EntityInterface $entity, $code)
    {
        $this->getAttributesAvailable($entity);
        if (!$this->_attrsAvailable) {
            return false;
        }

        foreach ($this->_attrsAvailable as $attr) {
            if ($attr->code == $code) {
                return $attr;
            }
        }
        return null;
    }

    /**
     * Insert or update attributes for given entity in an atomic transaction.
     * If a query fails the transaction will not break immediatly, so that the other attributes
     * get validated/rule-checked as well.
     *
     *
     * @param EntityInterface $entity
     * @param array $attrs
     * @return mixed
     */
    public function saveAttributes(EntityInterface $entity, $atomic = true)
    {
        $eavCol = $this->_buildAttributesValues($entity);

        $dbSetter = function() use (&$entity, &$eavCol, $atomic) {

            $return = null;
            foreach ($eavCol as $eav) {
                if (!$this->_table->EavEntityAttributeValues->save($eav)) {
                    //debug("Failed saving attrVal for attr " . $eav->eav_attribute->code);
                    //debug($eav->errors());
                    $entity->errors($eav->eav_attribute->code, $eav->errors());
                    $return = false;
                }
            }
            return $return;
        };

        if ($atomic === true) {
            $success = $this->_table->connection()->transactional($dbSetter);
        } else {
            $success = $dbSetter();
        }


        // reset memory cached items
        if ($success) {
            $this->_attrs = null;
            $this->_attrsAvailable = null;
        }
        return $success;
    }

    /**
     * @param EntityInterface $entity
     * @param array $attrs List of attribute code-value pairs
     * @return Collection Collection of EntityAttributeValue entities
     */
    protected function _buildAttributesValues(EntityInterface $entity)
    {
        $eavEntites = [];
        foreach ($this->getAttributesAvailable($entity) as $attr) {
            // skip unknown attribute codes
            $code = $attr->code;
            $val = $entity->get($code);

            // only process dirty entity properties
            if (!$entity->dirty($code)) {
                continue;
            }

            // check if a matching attribute value exists
            $attrVal = $this->getAttributeValue($entity, $code);

            // if yes, check if the value has changed
            //if ($attrVal && $attrVal->value == $val) {
            //    debug("Attribute $code not changed");
            //    continue;
            //}
            // if not, create new attribute value
            if (!$attrVal) {
                $attrVal = $this->_table->EavEntityAttributeValues->newEntity([], ['associated' => 'EavAttributes']);
            }

            $data = [
                'eav_attribute_id' => $attr->id,
                'model' => $this->_modelName(),
                'foreignKey' => $entity->id,
                'value' => $val,
            ];
            $attrVal = $this->_table->EavEntityAttributeValues->patchEntity($attrVal, $data, ['validate' => true]);
            $attrVal->eav_attribute = $attr;

            $eavEntites[$code] = $attrVal;
        }

        return new Collection($eavEntites);
    }

    public function validateAttributes(EntityInterface $entity)
    {
        //debug("AttributesBehavior::validateAttributes");
        $errors = [];
        $eavCol = $this->_buildAttributesValues($entity);
        foreach ($eavCol as $eav) {
            if ($eav->errors()) {
                $errors[$eav->eav_attribute->code] = $eav->errors();
            }
        }
        return $errors;
    }

    /*
    public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary)
    {
        debug("AttributesBehavior::beforeFind");
    }
    */

    public function buildValidator(Event $event, Validator $validator, $name)
    {
        //debug("AttributesBehavior::buildValidator");
    }

    public function buildRules(Event $event, RulesChecker $rules)
    {
        //debug("AttributesBehavior::buildRules");
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if ($eavErrors = $this->validateAttributes($entity)) {
            foreach ($eavErrors as $attrCode => $errors) {
                $entity->errors($attrCode, $errors);
            }
            return false;
        }
    }

    public function afterSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->saveAttributes($entity);
    }

    /**
     * Return model alias including plugin prefix with dot notation.
     * Compatible with TableRegistry::get()
     *
     * Example: Plugin Blog has a model table named PostsTable
     *   The function would return 'Blog.Posts'
     *
     * @return null|string Model alias with plugin prefix (e.g. 'Blog.Posts')
     */
    protected function _modelName()
    {
        $plugin = null;
        $tableName = $this->_table->alias();
        list($namespace,) = namespaceSplit(get_class($this->_table));
        if ($namespace && (($pos = strpos($namespace, '\\')) !== false)) {
            $plugin = substr($namespace, 0, $pos);
            if ($plugin == 'App' || $plugin == 'Cake') {
                return $tableName;
            }
        }
        return join('.', [$plugin, $tableName]);
    }
}