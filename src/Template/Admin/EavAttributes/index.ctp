<?php $this->Breadcrumbs->add(__('Eav Attributes')); ?>

<?php $this->Toolbar->addLink(__('New {0}', __('Eav Attribute')), ['action' => 'add'], ['data-icon' => 'plus']); ?>
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
<div class="eavAttributes index">

    <?php $fields = [
    'id','code','title','type','scope','plugin','is_system','is_required','is_searchable','is_filterable','is_protected','is_visible',    ] ?>
    <?= $this->cell('Backend.DataTable', [[
        'paginate' => true,
        'model' => 'Eav.EavAttributes',
        'data' => $eavAttributes,
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

