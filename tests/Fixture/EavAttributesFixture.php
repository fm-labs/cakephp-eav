<?php
namespace Eav\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EavAttributesFixture
 *
 */
class EavAttributesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $import = ['model' => 'Eav.EavAttributes'];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'code' => 'test_default',
            'title' => 'Default Attribute',
            'type' => 'text',
            'scope' => '',
            'plugin' => '',
            'is_system' => 0,
            'is_required' => 0,
            'is_searchable' => 0,
            'is_filterable' => 0,
            'is_protected' => 0,
            'is_visible' => 0
        ],
        [
            'id' => 2,
            'code' => 'test_required',
            'title' => 'Required Attribute',
            'type' => 'text',
            'scope' => '',
            'plugin' => '',
            'is_system' => 0,
            'is_required' => 1,
            'is_searchable' => 0,
            'is_filterable' => 0,
            'is_protected' => 0,
            'is_visible' => 0
        ],
    ];
}
