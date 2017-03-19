<?php
namespace Eav\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EavAttributeSets Model
 *
 * @property \Cake\ORM\Association\HasMany $EavAttributeSetsAttributes
 * @property \Cake\ORM\Association\HasMany $EavEntityAttributeValues
 * @property \Cake\ORM\Association\HasMany $ShopCategories
 * @property \Cake\ORM\Association\HasMany $ShopProducts
 *
 * @method \Eav\Model\Entity\EavAttributeSet get($primaryKey, $options = [])
 * @method \Eav\Model\Entity\EavAttributeSet newEntity($data = null, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeSet[] newEntities(array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeSet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Eav\Model\Entity\EavAttributeSet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeSet[] patchEntities($entities, array $data, array $options = [])
 * @method \Eav\Model\Entity\EavAttributeSet findOrCreate($search, callable $callback = null, $options = [])
 */
class EavAttributeSetsTable extends Table
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

        $this->table('eav_attribute_sets');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsToMany('EavAttributes', [
            'foreignKey' => 'eav_attribute_set_id',
            'through' => 'Eav.EavAttributeSetsAttributes'
        ]);
        $this->hasMany('EavEntityAttributeValues', [
            'foreignKey' => 'eav_attribute_set_id',
            'className' => 'Eav.EavEntityAttributeValues'
        ]);
        $this->hasMany('ShopCategories', [
            'foreignKey' => 'eav_attribute_set_id',
            'className' => 'Eav.ShopCategories'
        ]);
        $this->hasMany('ShopProducts', [
            'foreignKey' => 'eav_attribute_set_id',
            'className' => 'Eav.ShopProducts'
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
            ->notEmpty('title')
            ->add('title', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['title']));
        $rules->add($rules->isUnique(['code']));

        return $rules;
    }

    public function register($modelName, $code, $config = [])
    {
        $data = ['model' => $modelName, 'code' => $code];
        $set = $this->find()
            ->where(['model' => $modelName, 'code' => $code])
            ->first();

        if (!$set) {
            $set = $this->newEntity($config + $data);
            debug($set->toArray());
            if (!$this->save($set)) {
                debug($set->errors());
                exit;
            }
        }
        return $set;
    }
}
