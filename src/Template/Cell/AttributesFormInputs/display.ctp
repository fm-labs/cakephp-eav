<div class="attributes-form form">
    <?= $this->Form->create($entity, ['novalidate']); ?>
    <?= $this->Form->hidden('id'); ?>
    <?php
    foreach($attrsAvail as $attr) {
        echo $this->Form->input($attr->code, [
            'type' => $attr->type,
            'label' => $attr->title,
            'required' => $attr->is_required
        ]);
    }
    ?>
    <?= $this->Form->button(__('Save')); ?>
    <?= $this->Form->end(); ?>

</div>
<?php
//debug($entity->test);
debug($entity->attributes);
debug($entity);
debug($errors);
debug($entity->entity_attribute_values);
debug($attrsAvail);