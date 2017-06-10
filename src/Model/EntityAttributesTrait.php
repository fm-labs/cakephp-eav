<?php
namespace Eav\Model;

use Eav\Exception\InvalidAttributeException;
use Eav\Model\Behavior\AttributesBehavior;
use Cake\ORM\Exception\MissingBehaviorException;
use Cake\ORM\TableRegistry;

/**
 * Class EntityAttributesTrait
 * @package Banana\Model\Entity
 *
 * @property string $_registryAlias
 * @property array $_properties
 */
trait EntityAttributesTrait
{

    /**
     * @var null|array Attributes key-value pair cache
     */
    protected $_attributes = null;

    /**
     * @var null|array Attributes values cache
     */
    protected $_attributesValues = null;

    /**
     * @var null|array Attributes available cache
     */
    protected $_attributesAvailable = null;

    /**
     * @return AttributesBehavior
     */
    protected function _tableInstance()
    {
        $Table = TableRegistry::get($this->_registryAlias);
        if (!$Table) {
            throw new \RuntimeException('Table ' . $this->_registryAlias . ' not found');
        }

        if (!$Table->behaviors()->has('Attributes')) {
            throw new MissingBehaviorException(['behaviour' => 'Eav.Attributes', 'class' => 'AttributesBehavior']);
        }

        return $Table;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        if ($this->_attributes === null) {
            //@TODO Inject attributes_values property from behavior instead of lazy loading from table
            $this->_attributes = $this->_tableInstance()->getAttributes($this)->toArray();
        }

        return $this->_attributes;
    }

    /**
     * @return array
     */
    public function getAttributesValues()
    {
        if ($this->_attributesValues === null) {
            //@TODO Inject attributes_values property from behavior instead of lazy loading from table
            $this->_attributesValues = $this->_tableInstance()->getAttributesValues($this)->toArray();
        }

        return $this->_attributesValues;
    }

    /**
     * @return array
     */
    public function getAttributesAvailable()
    {
        if ($this->_attributesAvailable === null) {
            //@TODO Inject attributes_values property from behavior instead of lazy loading from table
            $this->_attributesAvailable = ($this->_tableInstance()->getAttributesAvailable($this))
                ? $this->_tableInstance()->getAttributesAvailable($this)->toArray()
                : null;
        }

        return $this->_attributesAvailable;
    }
}
