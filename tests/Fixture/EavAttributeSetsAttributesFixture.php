<?php
namespace Eav\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EavAttributeSetsAttributesFixture
 *
 */
class EavAttributeSetsAttributesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $import = ['model' => 'Eav.EavAttributeSetsAttributes'];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'eav_attribute_set_id' => 1,
            'eav_attribute_id' => 1
        ],
        [
            'id' => 2,
            'eav_attribute_set_id' => 1,
            'eav_attribute_id' => 2
        ],
    ];
}
