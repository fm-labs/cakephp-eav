<?php $this->Breadcrumbs->add(__('Eav Attribute Sets Attributes'), ['action' => 'index']); ?>
<?php $this->Breadcrumbs->add($eavAttributeSetsAttribute->id); ?>
<?php $this->Toolbar->addLink(
    __('Edit {0}', __('Eav Attribute Sets Attribute')),
    ['action' => 'edit', $eavAttributeSetsAttribute->id],
    ['data-icon' => 'edit']
) ?>
<?php $this->Toolbar->addLink(
    __('Delete {0}', __('Eav Attribute Sets Attribute')),
    ['action' => 'delete', $eavAttributeSetsAttribute->id],
    ['data-icon' => 'trash', 'confirm' => __('Are you sure you want to delete # {0}?', $eavAttributeSetsAttribute->id)]) ?>

<?php $this->Toolbar->addLink(
    __('List {0}', __('Eav Attribute Sets Attributes')),
    ['action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->addLink(
    __('New {0}', __('Eav Attribute Sets Attribute')),
    ['action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?php $this->Toolbar->startGroup(__('More')); ?>
<?php $this->Toolbar->addLink(
    __('List {0}', __('Eav Attribute Sets')),
    ['controller' => 'EavAttributeSets', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->addLink(
    __('New {0}', __('Eav Attribute Set')),
    ['controller' => 'EavAttributeSets', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?php $this->Toolbar->addLink(
    __('List {0}', __('Eav Attributes')),
    ['controller' => 'EavAttributes', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->addLink(
    __('New {0}', __('Eav Attribute')),
    ['controller' => 'EavAttributes', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?php $this->Toolbar->endGroup(); ?>
<div class="eavAttributeSetsAttributes view">
    <h2 class="ui header">
        <?= h($eavAttributeSetsAttribute->id) ?>
    </h2>

    <?php
    echo $this->cell('Backend.EntityView', [ $eavAttributeSetsAttribute ], [
        'title' => $eavAttributeSetsAttribute->title,
        'model' => 'Eav.EavAttributeSetsAttributes',
    ]);
    ?>

<!--
    <table class="ui attached celled striped table">


        <tr>
            <td><?= __('Eav Attribute Set') ?></td>
            <td><?= $eavAttributeSetsAttribute->has('eav_attribute_set') ? $this->Html->link($eavAttributeSetsAttribute->eav_attribute_set->title, ['controller' => 'EavAttributeSets', 'action' => 'view', $eavAttributeSetsAttribute->eav_attribute_set->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Eav Attribute') ?></td>
            <td><?= $eavAttributeSetsAttribute->has('eav_attribute') ? $this->Html->link($eavAttributeSetsAttribute->eav_attribute->title, ['controller' => 'EavAttributes', 'action' => 'view', $eavAttributeSetsAttribute->eav_attribute->id]) : '' ?></td>
        </tr>


        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($eavAttributeSetsAttribute->id) ?></td>
        </tr>

    </table>
</div>
-->



