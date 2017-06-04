<?php
namespace Eav\Model\Entity;

use Banana\Model\EntityTypeHandlerInterface;
use Banana\Model\EntityTypeHandlerTrait;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Entity;
use Eav\Model\Entity\EavAttribute\EavAttributeTypeInterface;

/**
 * EavAttribute Entity
 *
 * @property int $id
 * @property string $code
 * @property string $title
 * @property string $type
 * @property string $scope
 * @property string $plugin
 * @property bool $is_system
 * @property bool $is_required
 * @property bool $is_searchable
 * @property bool $is_filterable
 * @property bool $is_protected
 * @property bool $is_visible
 *
 * @property \Eav\Model\Entity\EavAttributeSetsAttribute[] $eav_attribute_sets_attributes
 * @property \Eav\Model\Entity\EavEntityAttributeValue[] $eav_entity_attribute_values
 */
class EavAttribute extends Entity implements EntityTypeHandlerInterface
{

    use EntityTypeHandlerTrait {
        //EntityTypeHandlerTrait::handler as typeHandler;
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];


    /**
     * @return EavAttributeTypeInterface
     * @throws \Exception
     */
    public function handler()
    {
        return $this->typeHandler();
    }

    protected function _getHandlerNamespace()
    {
        return 'EavAttributeType';
    }

    public function formatValue(EntityInterface $entity, $field)
    {
        return $this->handler()->formatValue($entity, $field);
    }

}
