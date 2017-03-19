<?php
namespace Eav\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EavAttributeSetsFixture
 *
 */
class EavAttributeSetsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $import = ['model' => 'Eav.EavAttributeSets'];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'code' => 'test_set_1',
            'title' => 'Test Set 1',
            'is_system' => false,
        ],
    ];
}
