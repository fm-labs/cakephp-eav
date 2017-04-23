<?php $this->Breadcrumbs->add(__('Eav Entity Attribute Values'), ['action' => 'index']); ?>
<?php $this->Breadcrumbs->add($eavEntityAttributeValue->id); ?>
<?php $this->Toolbar->addLink(
    __('Edit {0}', __('Eav Entity Attribute Value')),
    ['action' => 'edit', $eavEntityAttributeValue->id],
    ['data-icon' => 'edit']
) ?>
<?php $this->Toolbar->addLink(
    __('Delete {0}', __('Eav Entity Attribute Value')),
    ['action' => 'delete', $eavEntityAttributeValue->id],
    ['data-icon' => 'trash', 'confirm' => __('Are you sure you want to delete # {0}?', $eavEntityAttributeValue->id)]) ?>

<?php $this->Toolbar->addLink(
    __('List {0}', __('Eav Entity Attribute Values')),
    ['action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->addLink(
    __('New {0}', __('Eav Entity Attribute Value')),
    ['action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?php $this->Toolbar->startGroup(__('More')); ?>
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
<?php $this->Toolbar->endGroup(); ?>
<div class="eavEntityAttributeValues view">
    <h2 class="ui header">
        <?= h($eavEntityAttributeValue->id) ?>
    </h2>

    <?php
    echo $this->cell('Backend.EntityView', [ $eavEntityAttributeValue ], [
        'title' => $eavEntityAttributeValue->title,
        'model' => 'Eav.EavEntityAttributeValues',
    ]);
    ?>

<!--
    <table class="ui attached celled striped table">


        <tr>
            <td><?= __('Model') ?></td>
            <td><?= h($eavEntityAttributeValue->model) ?></td>
        </tr>
        <tr>
            <td><?= __('Eav Attribute') ?></td>
            <td><?= $eavEntityAttributeValue->has('eav_attribute') ? $this->Html->link($eavEntityAttributeValue->eav_attribute->title, ['controller' => 'EavAttributes', 'action' => 'view', $eavEntityAttributeValue->eav_attribute->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Eav Attribute Set') ?></td>
            <td><?= $eavEntityAttributeValue->has('eav_attribute_set') ? $this->Html->link($eavEntityAttributeValue->eav_attribute_set->title, ['controller' => 'EavAttributeSets', 'action' => 'view', $eavEntityAttributeValue->eav_attribute_set->id]) : '' ?></td>
        </tr>


        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($eavEntityAttributeValue->id) ?></td>
        </tr>
        <tr>
            <td><?= __('ForeignKey') ?></td>
            <td><?= $this->Number->format($eavEntityAttributeValue->foreignKey) ?></td>
        </tr>


        <tr class="date">
            <td><?= __('Created') ?></td>
            <td><?= h($eavEntityAttributeValue->created) ?></td>
        </tr>
        <tr class="date">
            <td><?= __('Modified') ?></td>
            <td><?= h($eavEntityAttributeValue->modified) ?></td>
        </tr>

        <tr class="text">
            <td><?= __('Value') ?></td>
            <td><?= $this->Text->autoParagraph(h($eavEntityAttributeValue->value)); ?></td>
        </tr>
    </table>
</div>
-->



