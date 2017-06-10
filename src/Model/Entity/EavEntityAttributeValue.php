<?php
namespace Eav\Model\Entity;

use Cake\ORM\Entity;

/**
 * EavEntityAttributeValue Entity
 *
 * @property int $id
 * @property string $model
 * @property int $foreignKey
 * @property int $eav_attribute_id
 * @property int $eav_attribute_set_id
 * @property string $value
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Eav\Model\Entity\EavAttribute $eav_attribute
 * @property \Eav\Model\Entity\EavAttributeSet $eav_attribute_set
 */
class EavEntityAttributeValue extends Entity
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

    public function getValue()
    {
        return $this->get('value');
    }
}
