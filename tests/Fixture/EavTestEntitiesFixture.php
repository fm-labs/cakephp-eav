<?php
namespace Eav\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EavAttributesFixture
 *
 */
class EavTestEntitiesFixture extends TestFixture
{

    public $table = "eav_test_entities";

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'eav_attribute_set_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'title' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
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
            'title' => 'Test 1'
        ],
        [
            'id' => 2,
            'eav_attribute_set_id' => 1,
            'title' => 'Test 2'
        ],
        [
            'id' => 3,
            'eav_attribute_set_id' => 1,
            'title' => 'Test 3'
        ],
    ];
}
