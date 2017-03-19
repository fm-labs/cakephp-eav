<?php $this->Breadcrumbs->add(__('Eav Entity Attribute Values')); ?>

<?php $this->Toolbar->addLink(__('New {0}', __('Eav Entity Attribute Value')), ['action' => 'add'], ['data-icon' => 'plus']); ?>
<?= $this->Toolbar->addLink(
    __('List {0}', __('Eav Attributes')),
    ['controller' => 'EavAttributes', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?= $this->Toolbar->addLink(
    __('New {0}', __('Eav Attribute')),
    ['controller' => 'EavAttributes', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?= $this->Toolbar->addLink(
    __('List {0}', __('Eav Attribute Sets')),
    ['controller' => 'EavAttributeSets', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?= $this->Toolbar->addLink(
    __('New {0}', __('Eav Attribute Set')),
    ['controller' => 'EavAttributeSets', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<div class="eavEntityAttributeValues index">

    <?php $fields = [
    'id','model','foreignKey','eav_attribute_id','eav_attribute_set_id','value','created','modified',    ] ?>
    <?= $this->cell('Backend.DataTable', [[
        'paginate' => true,
        'model' => 'Eav.EavEntityAttributeValues',
        'data' => $eavEntityAttributeValues,
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

