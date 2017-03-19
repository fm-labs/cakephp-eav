<?php
namespace Eav\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EavAttributeSetsAttributes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EavAttributeSets
 * @property \Cake\ORM\Association\BelongsTo $EavAttributes
 *
 * @method \Eav\Model\Entity\EavAttributeSetsAttribute get($primaryKey, $options = [])
 * @method \Eav\Model\Entity\EavAttributeSetsAttribute newEntity($data = null, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeSetsAttribute[] newEntities(array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeSetsAttribute|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Eav\Model\Entity\EavAttributeSetsAttribute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeSetsAttribute[] patchEntities($entities, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeSetsAttribute findOrCreate($search, callable $callback = null, $options = [])
 */
class EavAttributeSetsAttributesTable extends Table
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

        $this->table('eav_attribute_sets_attributes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('EavAttributeSets', [
            'foreignKey' => 'eav_attribute_set_id',
            'joinType' => 'INNER',
            'className' => 'Eav.EavAttributeSets'
        ]);
        $this->belongsTo('EavAttributes', [
            'foreignKey' => 'eav_attribute_id',
            'joinType' => 'INNER',
            'className' => 'Eav.EavAttributes'
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
        $rules->add($rules->existsIn(['eav_attribute_set_id'], 'EavAttributeSets'));
        $rules->add($rules->existsIn(['eav_attribute_id'], 'EavAttributes'));

        return $rules;
    }
}
