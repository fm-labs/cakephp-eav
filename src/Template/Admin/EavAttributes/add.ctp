<?php $this->Breadcrumbs->add(__('Eav Attributes'), ['action' => 'index']); ?>
<?php $this->Breadcrumbs->add(__('New {0}', __('Eav Attribute'))); ?>
<?= $this->Toolbar->addLink(
    __('List {0}', __('Eav Attributes')),
    ['action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->startGroup('More'); ?>
<?= $this->Toolbar->addLink(
    __('List {0}', __('Eav Attribute Sets Attributes')),
    ['controller' => 'EavAttributeSetsAttributes', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>

<?= $this->Toolbar->addLink(
    __('New {0}', __('Eav Attribute Sets Attribute')),
    ['controller' => 'EavAttributeSetsAttributes', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?= $this->Toolbar->addLink(
    __('List {0}', __('Eav Entity Attribute Values')),
    ['controller' => 'EavEntityAttributeValues', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>

<?= $this->Toolbar->addLink(
    __('New {0}', __('Eav Entity Attribute Value')),
    ['controller' => 'EavEntityAttributeValues', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?php $this->Toolbar->endGroup(); ?>
<div class="form">
    <h2 class="ui header">
        <?= __('Add {0}', __('Eav Attribute')) ?>
    </h2>
    <?= $this->Form->create($eavAttribute, ['class' => 'no-ajax']); ?>
        <div class="ui form">
        <?php
                echo $this->Form->input('code');
                echo $this->Form->input('title');
                echo $this->Form->input('type');
                echo $this->Form->input('scope');
                echo $this->Form->input('plugin');
                echo $this->Form->input('is_system');
                echo $this->Form->input('is_required');
                echo $this->Form->input('is_searchable');
                echo $this->Form->input('is_filterable');
                echo $this->Form->input('is_protected');
                echo $this->Form->input('is_visible');
        ?>
        </div>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>