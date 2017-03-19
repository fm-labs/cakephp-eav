<?php $this->Breadcrumbs->add(__('Eav Attribute Sets Attributes')); ?>

<?php $this->Toolbar->addLink(__('New {0}', __('Eav Attribute Sets Attribute')), ['action' => 'add'], ['data-icon' => 'plus']); ?>
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
<div class="eavAttributeSetsAttributes index">

    <?php $fields = [
    'id','eav_attribute_set_id','eav_attribute_id',    ] ?>
    <?= $this->cell('Backend.DataTable', [[
        'paginate' => true,
        'model' => 'Eav.EavAttributeSetsAttributes',
        'data' => $eavAttributeSetsAttributes,
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

