<?php $this->Breadcrumbs->add(__('Eav Attribute Sets Attributes'), ['action' => 'index']); ?>
<?php $this->Breadcrumbs->add(__('Edit {0}', __('Eav Attribute Sets Attribute'))); ?>
<?= $this->Toolbar->addPostLink(
    __('Delete'),
    ['action' => 'delete', $eavAttributeSetsAttribute->id],
    ['data-icon' => 'trash', 'confirm' => __('Are you sure you want to delete # {0}?', $eavAttributeSetsAttribute->id)]
)
?>
<?= $this->Toolbar->addLink(
    __('List {0}', __('Eav Attribute Sets Attributes')),
    ['action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->startGroup('More'); ?>
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
<?php $this->Toolbar->endGroup(); ?>
<div class="form">
    <h2 class="ui header">
        <?= __('Edit {0}', __('Eav Attribute Sets Attribute')) ?>
    </h2>
    <?= $this->Form->create($eavAttributeSetsAttribute, ['class' => 'no-ajax']); ?>
        <div class="ui form">
        <?php
                    echo $this->Form->input('eav_attribute_set_id', ['options' => $eavAttributeSets]);
                    echo $this->Form->input('eav_attribute_id', ['options' => $eavAttributes]);
        ?>
        </div>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>