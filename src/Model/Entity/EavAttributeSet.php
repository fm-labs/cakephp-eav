<?php
namespace Eav\Model\Entity;

use Cake\ORM\Entity;

/**
 * EavAttributeSet Entity
 *
 * @property int $id
 * @property string $code
 * @property string $title
 * @property bool $is_system
 *
 * @property \Eav\Model\Entity\EavAttributeSetsAttribute[] $eav_attribute_sets_attributes
 * @property \Eav\Model\Entity\EavEntityAttributeValue[] $eav_entity_attribute_values
 * @property \Eav\Model\Entity\ShopCategory[] $shop_categories
 * @property \Eav\Model\Entity\ShopProduct[] $shop_products
 */
class EavAttributeSet extends Entity
{

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
}
