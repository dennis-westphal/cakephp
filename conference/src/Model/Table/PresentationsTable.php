<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Presentations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Topics
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Presentation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Presentation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Presentation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Presentation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Presentation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Presentation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Presentation findOrCreate($search, callable $callback = null, $options = [])
 */
class PresentationsTable extends Table
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

        $this->setTable('presentations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Topics', [
            'foreignKey' => 'topic_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Rooms', [
            'foreignKey' => 'room_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'presentation_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'presentations_users'
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
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->integer('freeSpots')
            ->requirePresence('freeSpots', 'create')
            ->notEmpty('freeSpots');

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
        $rules->add($rules->existsIn(['topic_id'], 'Topics'));

        return $rules;
    }
}
