<?php $this->Breadcrumbs->add(__('Eav Entity Attribute Values'), ['action' => 'index']); ?>
<?php $this->Breadcrumbs->add(__('New {0}', __('Eav Entity Attribute Value'))); ?>
<?php $this->Toolbar->addLink(
    __('List {0}', __('Eav Entity Attribute Values')),
    ['action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?php $this->Toolbar->startGroup('More'); ?>
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
<div class="form">
    <h2 class="ui header">
        <?= __('Add {0}', __('Eav Entity Attribute Value')) ?>
    </h2>
    <?= $this->Form->create($eavEntityAttributeValue, ['class' => 'no-ajax']); ?>
        <div class="ui form">
        <?php
                echo $this->Form->input('model');
                echo $this->Form->input('foreignKey');
                    echo $this->Form->input('eav_attribute_id', ['options' => $eavAttributes]);
                    echo $this->Form->input('eav_attribute_set_id', ['options' => $eavAttributeSets, 'empty' => true]);
                echo $this->Form->input('value');
        ?>
        </div>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>