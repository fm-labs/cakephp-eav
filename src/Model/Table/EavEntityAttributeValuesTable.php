<?php
namespace Eav\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Eav\Model\Entity\EavEntityAttributeValue;

/**
 * EavEntityAttributeValues Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EavAttributes
 * @property \Cake\ORM\Association\BelongsTo $EavAttributeSets
 *
 * @method \Eav\Model\Entity\EavEntityAttributeValue get($primaryKey, $options = [])
 * @method \Eav\Model\Entity\EavEntityAttributeValue newEntity($data = null, array $options = [])
 * @method \Eav\Model\Entity\EavEntityAttributeValue[] newEntities(array $data, array $options = [])
 * @method \Eav\Model\Entity\EavEntityAttributeValue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Eav\Model\Entity\EavEntityAttributeValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavEntityAttributeValue[] patchEntities($entities, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavEntityAttributeValue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EavEntityAttributeValuesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('eav_entity_attribute_values');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EavAttributes', [
            'foreignKey' => 'eav_attribute_id',
            'joinType' => 'INNER',
            'className' => 'Eav.EavAttributes'
        ]);
        $this->belongsTo('EavAttributeSets', [
            'foreignKey' => 'eav_attribute_set_id',
            'className' => 'Eav.EavAttributeSets'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('model', 'create')
            ->notEmpty('model');

        $validator
            ->integer('foreignKey')
            ->requirePresence('foreignKey', 'create')
            ->notEmpty('foreignKey');

        //$validator
        //    ->requirePresence('value')
        //    ->allowEmpty('value');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //debug("Eav::buildRules");
        $rules->add($rules->existsIn(['eav_attribute_id'], 'EavAttributes'));
        $rules->add($rules->existsIn(['eav_attribute_set_id'], 'EavAttributeSets'));

        $valueChecker = function(EavEntityAttributeValue $entity) {
            if ($entity->eav_attribute->is_required && empty($entity->value)) {
                //debug("Eav Attribute " . $entity->eav_attribute->code . " is required but empty val: " . $entity->value);
                return false;
            }
            return true;
        };
        $rules->add($valueChecker, '_required', ['errorField' => 'value', 'message' => 'This attribute is required']);
        return $rules;
    }
}
