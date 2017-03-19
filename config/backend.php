<?php return [

    'Eav.Backend.Menu' => [
        'title' => 'Eav',
        'url' => ['plugin' => 'Eav', 'controller' => 'EavEntityAttributeValues', 'action' => 'index'],

        'children' => [
            'eav_attributes' => [
                'title' => 'Attributes',
                'url' => ['plugin' => 'Eav', 'controller' => 'EavAttributes', 'action' => 'index'],
            ],
            'eav_attribute_sets' => [
                'title' => 'Attribute Sets',
                'url' => ['plugin' => 'Eav', 'controller' => 'EavAttributeSets', 'action' => 'index'],
            ],
            'eav_entity_attribute_values' => [
                'title' => 'Entity Attribute Values',
                'url' => ['plugin' => 'Eav', 'controller' => 'EavEntityAttributeValues', 'action' => 'index'],
            ],
        ]
    ],
];