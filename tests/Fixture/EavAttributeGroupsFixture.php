<?php
namespace Eav\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EavAttributeGroupsFixture
 *
 */
class EavAttributeGroupsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $import = ['model' => 'Eav.EavAttributeGroups'];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'code' => 'test_group_1',
            'title' => 'Test Group 1',
            'is_system' => false,
        ],
    ];
}
