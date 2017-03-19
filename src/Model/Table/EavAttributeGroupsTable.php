<?php
namespace Eav\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EavAttributeGroups Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EavAttributeSets
 * @property \Cake\ORM\Association\HasMany $EavAttributeSetsAttributes
 *
 * @method \Eav\Model\Entity\EavAttributeGroup get($primaryKey, $options = [])
 * @method \Eav\Model\Entity\EavAttributeGroup newEntity($data = null, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeGroup[] newEntities(array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Eav\Model\Entity\EavAttributeGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeGroup findOrCreate($search, callable $callback = null, $options = [])
 */
class EavAttributeGroupsTable extends Table
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

        $this->table('eav_attribute_groups');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('EavAttributeSets', [
            'foreignKey' => 'eav_attribute_set_id',
            'className' => 'Eav.EavAttributeSets'
        ]);
        $this->hasMany('EavAttributeSetsAttributes', [
            'foreignKey' => 'eav_attribute_group_id',
            'className' => 'Eav.EavAttributeSetsAttributes'
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
            ->requirePresence('code', 'create')
            ->notEmpty('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->boolean('is_system')
            ->requirePresence('is_system', 'create')
            ->notEmpty('is_system');

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
        $rules->add($rules->isUnique(['code']));
        $rules->add($rules->existsIn(['eav_attribute_set_id'], 'EavAttributeSets'));

        return $rules;
    }
}
