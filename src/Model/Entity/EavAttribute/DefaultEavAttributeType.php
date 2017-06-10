<?php
/**
 * Created by PhpStorm.
 * User: flow
 * Date: 1/18/17
 * Time: 2:01 PM
 */

namespace Eav\Model\Entity\EavAttribute;

use Banana\Model\EntityTypeInterface;
use Cake\Datasource\EntityInterface;
use Eav\Model\Entity\EavAttribute;

class DefaultEavAttributeType implements EavAttributeTypeInterface
{
    /**
     * @var EavAttribute
     */
    protected $_attr;

    public function setEntity(EntityInterface $entity)
    {
        $this->_attr = $entity;
    }

    /**
     * Get the parsed attribute value
     *
     * @return mixed
     */
    public function getDbType()
    {
        return 'text';
    }

    /**
     * Get FormHelper compatible input type
     *
     * @return string
     */
    public function getFormInputType()
    {
        return 'text';
    }
}
