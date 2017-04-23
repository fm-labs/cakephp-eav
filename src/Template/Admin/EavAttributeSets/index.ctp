<?php $this->Breadcrumbs->add(__('Eav Attribute Sets')); ?>

<?php $this->Toolbar->addLink(__('New {0}', __('Eav Attribute Set')), ['action' => 'add'], ['data-icon' => 'plus']); ?>
<?php $this->Toolbar->addLink(
    __('List {0}', __('Eav Attribute Sets Attributes')),
    ['controller' => 'EavAttributeSetsAttributes', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->addLink(
    __('New {0}', __('Eav Attribute Sets Attribute')),
    ['controller' => 'EavAttributeSetsAttributes', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?php $this->Toolbar->addLink(
    __('List {0}', __('Eav Entity Attribute Values')),
    ['controller' => 'EavEntityAttributeValues', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->addLink(
    __('New {0}', __('Eav Entity Attribute Value')),
    ['controller' => 'EavEntityAttributeValues', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?php $this->Toolbar->addLink(
    __('List {0}', __('Shop Categories')),
    ['controller' => 'ShopCategories', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->addLink(
    __('New {0}', __('Shop Category')),
    ['controller' => 'ShopCategories', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?php $this->Toolbar->addLink(
    __('List {0}', __('Shop Products')),
    ['controller' => 'ShopProducts', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->addLink(
    __('New {0}', __('Shop Product')),
    ['controller' => 'ShopProducts', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<div class="eavAttributeSets index">

    <?php $fields = [
    'id','code','title','is_system',    ] ?>
    <?= $this->cell('Backend.DataTable', [[
        'paginate' => true,
        'model' => 'Eav.EavAttributeSets',
        'data' => $eavAttributeSets,
        'fields' => $fields,
        'debug' => true,
        'rowActions' => [
            [__d('shop','View'), ['action' => 'view', ':id'], ['class' => 'view']],
            [__d('shop','Edit'), ['action' => 'edit', ':id'], ['class' => 'edit']],
            [__d('shop','Delete'), ['action' => 'delete', ':id'], ['class' => 'delete', 'confirm' => __d('shop','Are you sure you want to delete # {0}?', ':id')]]
        ]
    ]]);
    ?>

</div>

