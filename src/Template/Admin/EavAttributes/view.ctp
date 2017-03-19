<?php $this->Breadcrumbs->add(__('Eav Attributes'), ['action' => 'index']); ?>
<?php $this->Breadcrumbs->add($eavAttribute->title); ?>
<?= $this->Toolbar->addLink(
    __('Edit {0}', __('Eav Attribute')),
    ['action' => 'edit', $eavAttribute->id],
    ['data-icon' => 'edit']
) ?>
<?= $this->Toolbar->addLink(
    __('Delete {0}', __('Eav Attribute')),
    ['action' => 'delete', $eavAttribute->id],
    ['data-icon' => 'trash', 'confirm' => __('Are you sure you want to delete # {0}?', $eavAttribute->id)]) ?>

<?= $this->Toolbar->addLink(
    __('List {0}', __('Eav Attributes')),
    ['action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?= $this->Toolbar->addLink(
    __('New {0}', __('Eav Attribute')),
    ['action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?= $this->Toolbar->startGroup(__('More')); ?>
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
<?= $this->Toolbar->endGroup(); ?>
<div class="eavAttributes view">
    <h2 class="ui header">
        <?= h($eavAttribute->title) ?>
    </h2>

    <?php
    echo $this->cell('Backend.EntityView', [ $eavAttribute ], [
        'title' => $eavAttribute->title,
        'model' => 'Eav.EavAttributes',
    ]);
    ?>

<!--
    <table class="ui attached celled striped table">


        <tr>
            <td><?= __('Code') ?></td>
            <td><?= h($eavAttribute->code) ?></td>
        </tr>
        <tr>
            <td><?= __('Title') ?></td>
            <td><?= h($eavAttribute->title) ?></td>
        </tr>
        <tr>
            <td><?= __('Type') ?></td>
            <td><?= h($eavAttribute->type) ?></td>
        </tr>
        <tr>
            <td><?= __('Scope') ?></td>
            <td><?= h($eavAttribute->scope) ?></td>
        </tr>
        <tr>
            <td><?= __('Plugin') ?></td>
            <td><?= h($eavAttribute->plugin) ?></td>
        </tr>


        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($eavAttribute->id) ?></td>
        </tr>

        <tr class="boolean">
            <td><?= __('Is System') ?></td>
            <td><?= $eavAttribute->is_system ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr class="boolean">
            <td><?= __('Is Required') ?></td>
            <td><?= $eavAttribute->is_required ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr class="boolean">
            <td><?= __('Is Searchable') ?></td>
            <td><?= $eavAttribute->is_searchable ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr class="boolean">
            <td><?= __('Is Filterable') ?></td>
            <td><?= $eavAttribute->is_filterable ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr class="boolean">
            <td><?= __('Is Protected') ?></td>
            <td><?= $eavAttribute->is_protected ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr class="boolean">
            <td><?= __('Is Visible') ?></td>
            <td><?= $eavAttribute->is_visible ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
-->
<div class="related">
    <div class="ui basic segment">
    <h4 class="ui header"><?= __('Related {0}', __('EavAttributeSetsAttributes')) ?></h4>
    <?php if (!empty($eavAttribute->eav_attribute_sets_attributes)): ?>
    <table class="ui table">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Eav Attribute Set Id') ?></th>
            <th><?= __('Eav Attribute Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($eavAttribute->eav_attribute_sets_attributes as $eavAttributeSetsAttributes): ?>
        <tr>
            <td><?= h($eavAttributeSetsAttributes->id) ?></td>
            <td><?= h($eavAttributeSetsAttributes->eav_attribute_set_id) ?></td>
            <td><?= h($eavAttributeSetsAttributes->eav_attribute_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'EavAttributeSetsAttributes', 'action' => 'view', $eavAttributeSetsAttributes->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'EavAttributeSetsAttributes', 'action' => 'edit', $eavAttributeSetsAttributes->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'EavAttributeSetsAttributes', 'action' => 'delete', $eavAttributeSetsAttributes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eavAttributeSetsAttributes->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related">
    <div class="ui basic segment">
    <h4 class="ui header"><?= __('Related {0}', __('EavEntityAttributeValues')) ?></h4>
    <?php if (!empty($eavAttribute->eav_entity_attribute_values)): ?>
    <table class="ui table">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Model') ?></th>
            <th><?= __('ForeignKey') ?></th>
            <th><?= __('Eav Attribute Id') ?></th>
            <th><?= __('Eav Attribute Set Id') ?></th>
            <th><?= __('Value') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($eavAttribute->eav_entity_attribute_values as $eavEntityAttributeValues): ?>
        <tr>
            <td><?= h($eavEntityAttributeValues->id) ?></td>
            <td><?= h($eavEntityAttributeValues->model) ?></td>
            <td><?= h($eavEntityAttributeValues->foreignKey) ?></td>
            <td><?= h($eavEntityAttributeValues->eav_attribute_id) ?></td>
            <td><?= h($eavEntityAttributeValues->eav_attribute_set_id) ?></td>
            <td><?= h($eavEntityAttributeValues->value) ?></td>
            <td><?= h($eavEntityAttributeValues->created) ?></td>
            <td><?= h($eavEntityAttributeValues->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'EavEntityAttributeValues', 'action' => 'view', $eavEntityAttributeValues->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'EavEntityAttributeValues', 'action' => 'edit', $eavEntityAttributeValues->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'EavEntityAttributeValues', 'action' => 'delete', $eavEntityAttributeValues->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eavEntityAttributeValues->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>



