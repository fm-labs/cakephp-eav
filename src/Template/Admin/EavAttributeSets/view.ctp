<?php $this->Breadcrumbs->add(__('Eav Attribute Sets'), ['action' => 'index']); ?>
<?php $this->Breadcrumbs->add($eavAttributeSet->title); ?>
<?= $this->Toolbar->addLink(
    __('Edit {0}', __('Eav Attribute Set')),
    ['action' => 'edit', $eavAttributeSet->id],
    ['data-icon' => 'edit']
) ?>
<?= $this->Toolbar->addLink(
    __('Delete {0}', __('Eav Attribute Set')),
    ['action' => 'delete', $eavAttributeSet->id],
    ['data-icon' => 'trash', 'confirm' => __('Are you sure you want to delete # {0}?', $eavAttributeSet->id)]) ?>

<?= $this->Toolbar->addLink(
    __('List {0}', __('Eav Attribute Sets')),
    ['action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?= $this->Toolbar->addLink(
    __('New {0}', __('Eav Attribute Set')),
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
<?= $this->Toolbar->addLink(
    __('List {0}', __('Shop Categories')),
    ['controller' => 'ShopCategories', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?= $this->Toolbar->addLink(
    __('New {0}', __('Shop Category')),
    ['controller' => 'ShopCategories', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?= $this->Toolbar->addLink(
    __('List {0}', __('Shop Products')),
    ['controller' => 'ShopProducts', 'action' => 'index'],
    ['data-icon' => 'list']
) ?>
<?= $this->Toolbar->addLink(
    __('New {0}', __('Shop Product')),
    ['controller' => 'ShopProducts', 'action' => 'add'],
    ['data-icon' => 'plus']
) ?>
<?= $this->Toolbar->endGroup(); ?>
<div class="eavAttributeSets view">
    <h2 class="ui header">
        <?= h($eavAttributeSet->title) ?>
    </h2>

    <?php
    echo $this->cell('Backend.EntityView', [ $eavAttributeSet ], [
        'title' => $eavAttributeSet->title,
        'model' => 'Eav.EavAttributeSets',
    ]);
    ?>

<!--
    <table class="ui attached celled striped table">


        <tr>
            <td><?= __('Code') ?></td>
            <td><?= h($eavAttributeSet->code) ?></td>
        </tr>
        <tr>
            <td><?= __('Title') ?></td>
            <td><?= h($eavAttributeSet->title) ?></td>
        </tr>


        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($eavAttributeSet->id) ?></td>
        </tr>

        <tr class="boolean">
            <td><?= __('Is System') ?></td>
            <td><?= $eavAttributeSet->is_system ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
-->
<div class="related">
    <div class="ui basic segment">
    <h4 class="ui header"><?= __('Related {0}', __('EavAttributeSetsAttributes')) ?></h4>
    <?php if (!empty($eavAttributeSet->eav_attribute_sets_attributes)): ?>
    <table class="ui table">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Eav Attribute Set Id') ?></th>
            <th><?= __('Eav Attribute Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($eavAttributeSet->eav_attribute_sets_attributes as $eavAttributeSetsAttributes): ?>
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
    <?php if (!empty($eavAttributeSet->eav_entity_attribute_values)): ?>
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
        <?php foreach ($eavAttributeSet->eav_entity_attribute_values as $eavEntityAttributeValues): ?>
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
<div class="related">
    <div class="ui basic segment">
    <h4 class="ui header"><?= __('Related {0}', __('ShopCategories')) ?></h4>
    <?php if (!empty($eavAttributeSet->shop_categories)): ?>
    <table class="ui table">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Lft') ?></th>
            <th><?= __('Rght') ?></th>
            <th><?= __('Parent Id') ?></th>
            <th><?= __('Level') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Slug') ?></th>
            <th><?= __('Eav Attribute Set Id') ?></th>
            <th><?= __('Teaser Html') ?></th>
            <th><?= __('Desc Html') ?></th>
            <th><?= __('Preview Image File') ?></th>
            <th><?= __('Featured Image File') ?></th>
            <th><?= __('Image Files') ?></th>
            <th><?= __('Teaser Template') ?></th>
            <th><?= __('View Template') ?></th>
            <th><?= __('Is Published') ?></th>
            <th><?= __('Is Alias') ?></th>
            <th><?= __('Alias Id') ?></th>
            <th><?= __('Custom1') ?></th>
            <th><?= __('Custom2') ?></th>
            <th><?= __('Custom3') ?></th>
            <th><?= __('Custom4') ?></th>
            <th><?= __('Custom5') ?></th>
            <th><?= __('Custom Text1') ?></th>
            <th><?= __('Custom Text2') ?></th>
            <th><?= __('Custom Text3') ?></th>
            <th><?= __('Custom Text4') ?></th>
            <th><?= __('Custom Text5') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($eavAttributeSet->shop_categories as $shopCategories): ?>
        <tr>
            <td><?= h($shopCategories->id) ?></td>
            <td><?= h($shopCategories->lft) ?></td>
            <td><?= h($shopCategories->rght) ?></td>
            <td><?= h($shopCategories->parent_id) ?></td>
            <td><?= h($shopCategories->level) ?></td>
            <td><?= h($shopCategories->name) ?></td>
            <td><?= h($shopCategories->slug) ?></td>
            <td><?= h($shopCategories->eav_attribute_set_id) ?></td>
            <td><?= h($shopCategories->teaser_html) ?></td>
            <td><?= h($shopCategories->desc_html) ?></td>
            <td><?= h($shopCategories->preview_image_file) ?></td>
            <td><?= h($shopCategories->featured_image_file) ?></td>
            <td><?= h($shopCategories->image_files) ?></td>
            <td><?= h($shopCategories->teaser_template) ?></td>
            <td><?= h($shopCategories->view_template) ?></td>
            <td><?= h($shopCategories->is_published) ?></td>
            <td><?= h($shopCategories->is_alias) ?></td>
            <td><?= h($shopCategories->alias_id) ?></td>
            <td><?= h($shopCategories->custom1) ?></td>
            <td><?= h($shopCategories->custom2) ?></td>
            <td><?= h($shopCategories->custom3) ?></td>
            <td><?= h($shopCategories->custom4) ?></td>
            <td><?= h($shopCategories->custom5) ?></td>
            <td><?= h($shopCategories->custom_text1) ?></td>
            <td><?= h($shopCategories->custom_text2) ?></td>
            <td><?= h($shopCategories->custom_text3) ?></td>
            <td><?= h($shopCategories->custom_text4) ?></td>
            <td><?= h($shopCategories->custom_text5) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'ShopCategories', 'action' => 'view', $shopCategories->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'ShopCategories', 'action' => 'edit', $shopCategories->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ShopCategories', 'action' => 'delete', $shopCategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shopCategories->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related">
    <div class="ui basic segment">
    <h4 class="ui header"><?= __('Related {0}', __('ShopProducts')) ?></h4>
    <?php if (!empty($eavAttributeSet->shop_products)): ?>
    <table class="ui table">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Parent Id') ?></th>
            <th><?= __('Type') ?></th>
            <th><?= __('Eav Attribute Set Id') ?></th>
            <th><?= __('Shop Category Id') ?></th>
            <th><?= __('Sku') ?></th>
            <th><?= __('Title') ?></th>
            <th><?= __('Slug') ?></th>
            <th><?= __('Teaser Html') ?></th>
            <th><?= __('Desc Html') ?></th>
            <th><?= __('Preview Image File') ?></th>
            <th><?= __('Featured Image File') ?></th>
            <th><?= __('Image Files') ?></th>
            <th><?= __('Is Published') ?></th>
            <th><?= __('Publish Start Date') ?></th>
            <th><?= __('Publish End Date') ?></th>
            <th><?= __('Is Buyable') ?></th>
            <th><?= __('Priority') ?></th>
            <th><?= __('Price') ?></th>
            <th><?= __('Price Net') ?></th>
            <th><?= __('Tax Rate') ?></th>
            <th><?= __('Meta Keywords') ?></th>
            <th><?= __('Meta Description') ?></th>
            <th><?= __('Custom1') ?></th>
            <th><?= __('Custom2') ?></th>
            <th><?= __('Custom3') ?></th>
            <th><?= __('Custom4') ?></th>
            <th><?= __('Custom5') ?></th>
            <th><?= __('View Template') ?></th>
            <th><?= __('Modified') ?></th>
            <th><?= __('Created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($eavAttributeSet->shop_products as $shopProducts): ?>
        <tr>
            <td><?= h($shopProducts->id) ?></td>
            <td><?= h($shopProducts->parent_id) ?></td>
            <td><?= h($shopProducts->type) ?></td>
            <td><?= h($shopProducts->eav_attribute_set_id) ?></td>
            <td><?= h($shopProducts->shop_category_id) ?></td>
            <td><?= h($shopProducts->sku) ?></td>
            <td><?= h($shopProducts->title) ?></td>
            <td><?= h($shopProducts->slug) ?></td>
            <td><?= h($shopProducts->teaser_html) ?></td>
            <td><?= h($shopProducts->desc_html) ?></td>
            <td><?= h($shopProducts->preview_image_file) ?></td>
            <td><?= h($shopProducts->featured_image_file) ?></td>
            <td><?= h($shopProducts->image_files) ?></td>
            <td><?= h($shopProducts->is_published) ?></td>
            <td><?= h($shopProducts->publish_start_date) ?></td>
            <td><?= h($shopProducts->publish_end_date) ?></td>
            <td><?= h($shopProducts->is_buyable) ?></td>
            <td><?= h($shopProducts->priority) ?></td>
            <td><?= h($shopProducts->price) ?></td>
            <td><?= h($shopProducts->price_net) ?></td>
            <td><?= h($shopProducts->tax_rate) ?></td>
            <td><?= h($shopProducts->meta_keywords) ?></td>
            <td><?= h($shopProducts->meta_description) ?></td>
            <td><?= h($shopProducts->custom1) ?></td>
            <td><?= h($shopProducts->custom2) ?></td>
            <td><?= h($shopProducts->custom3) ?></td>
            <td><?= h($shopProducts->custom4) ?></td>
            <td><?= h($shopProducts->custom5) ?></td>
            <td><?= h($shopProducts->view_template) ?></td>
            <td><?= h($shopProducts->modified) ?></td>
            <td><?= h($shopProducts->created) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'ShopProducts', 'action' => 'view', $shopProducts->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'ShopProducts', 'action' => 'edit', $shopProducts->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ShopProducts', 'action' => 'delete', $shopProducts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shopProducts->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>



