<?php
namespace Eav\Model\Entity;

use Cake\ORM\Entity;

/**
 * EavAttributeSetsAttribute Entity
 *
 * @property int $id
 * @property int $eav_attribute_set_id
 * @property int $eav_attribute_id
 *
 * @property \Eav\Model\Entity\EavAttributeSet $eav_attribute_set
 * @property \Eav\Model\Entity\EavAttribute $eav_attribute
 */
class EavAttributeSetsAttribute extends Entity
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
