<?php
namespace Eav\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Validation\Validator;

/**
 * EavAttributes Model
 *
 * @property \Cake\ORM\Association\HasMany $EavAttributeSetsAttributes
 * @property \Cake\ORM\Association\HasMany $EavEntityAttributeValues
 * @property \Cake\ORM\Association\BelongsToMany $EavAttributeSets
 *
 * @method \Eav\Model\Entity\EavAttribute get($primaryKey, $options = [])
 * @method \Eav\Model\Entity\EavAttribute newEntity($data = null, array $options = [])
 * @method \Eav\Model\Entity\EavAttribute[] newEntities(array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttribute|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Eav\Model\Entity\EavAttribute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttribute[] patchEntities($entities, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttribute findOrCreate($search, callable $callback = null, $options = [])
 */
class EavAttributesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('eav_attributes');
        $this->displayField('title');
        $this->primaryKey('id');

        /*
        $this->hasMany('EavAttributeSetsAttributes', [
            'foreignKey' => 'eav_attribute_id',
            'className' => 'Eav.EavAttributeSetsAttributes'
        ]);
        */
        $this->hasMany('EavEntityAttributeValues', [
            'foreignKey' => 'eav_attribute_id',
            'className' => 'Eav.EavEntityAttributeValues'
        ]);
        $this->belongsToMany('EavAttributeSets', [
            'foreignKey' => 'eav_attribute_id',
            'through' => 'Eav.EavAttributeSetsAttributes',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->allowEmpty('scope');

        $validator
            ->allowEmpty('plugin');

        $validator
            ->boolean('is_system')
            ->requirePresence('is_system', 'create')
            ->notEmpty('is_system');

        $validator
            ->boolean('is_required')
            ->requirePresence('is_required', 'create')
            ->notEmpty('is_required');

        $validator
            ->boolean('is_searchable')
            ->requirePresence('is_searchable', 'create')
            ->notEmpty('is_searchable');

        $validator
            ->boolean('is_filterable')
            ->requirePresence('is_filterable', 'create')
            ->notEmpty('is_filterable');

        $validator
            ->boolean('is_protected')
            ->requirePresence('is_protected', 'create')
            ->notEmpty('is_protected');

        $validator
            ->boolean('is_visible')
            ->requirePresence('is_visible', 'create')
            ->notEmpty('is_visible');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['code']));

        return $rules;
    }

    public function register($modelName, $setCode, $attributes = [])
    {
        $set = TableRegistry::get('Eav.EavAttributeSets')->find()
            ->where(['model' => $modelName, 'code' => $setCode])
            ->first();

        if (!$set) {
            throw new \Exception('Attribute set with code \'' . $setCode . '\' not found');
        }

        $defaultConfig = ['model' => $modelName,
            'is_system' => 0, 'is_searchable' => 0, 'is_filterable' => 0, 'is_protected' => 0,
            'is_visible' => 0];

        foreach ($attributes as $attribute => $config) {

            $attr = $this->find()
                ->where(['model' => $modelName, 'code' => $attribute])
                ->first();

            if (!$attr) {
                $config = $defaultConfig + $config + ['code' => $attribute];

                $attr = $this->newEntity();
                $attr = $this->patchEntity($attr, $config);
                if (!$this->save($attr)) {
                    throw new \Exception('Failed to register attribute with code ' . $attribute);
                }

                if (!$this->EavAttributeSets->link($attr, [$set])) {
                    throw new \Exception('Failed to link attribute ' . $attribute . ' to set ' . $setCode);
                }
            }

        }

        return true;
    }
}
