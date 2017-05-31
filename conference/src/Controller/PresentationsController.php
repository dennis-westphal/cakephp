<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Presentations Controller
 *
 * @property \App\Model\Table\PresentationsTable $Presentations
 *
 * @method \App\Model\Entity\Presentation[] paginate($object = null, array $settings = [])
 */
class PresentationsController extends AppController {
    public function beforeFilter(Event $event) {
        $this->Auth->allow(['topic', 'room']);
    }

    public function topic(int $topicId) {
        $presentations = $this->Presentations->findByTopicId($topicId);

        $this->set(compact('presentations'));
        $this->set('_serialize', 'presentations');
    }

    public function room(int $roomId) {
        $presentations = $this->Presentations->findByRoomId($roomId);

        $this->set([
            'presentations' => $presentations,
            'interval' => $this->Presentations::DATE_TIME_OPTIONS['interval']
        ]);
        $this->set('_serialize', false);
    }

    public function manage(int $topicId) {
        $topicsTable = TableRegistry::get('Topics');
        $topic = $topicsTable->get($topicId, [
            'contain' => ['Users', 'Presentations', 'Presentations.Rooms']
        ]);
        $roomsTable = TableRegistry::get('Rooms');
        $rooms = $roomsTable->find('list')->toArray();

        if(empty($topic)) {
            $this->Flash->error('Topic not found.');
            return $this->redirect(['controller' => 'topics']);
        }

        if($topic->user->id !== $this->Auth->user('id')) {
            $this->Flash->error('You are not authorized to access this topic.');
            return $this->redirect(['controller' => 'topics']);
        }

        $this->set([
            'topic' => $topic,
            'rooms' => $rooms,
            'dateTimeOptions' => $this->Presentations::DATE_TIME_OPTIONS
        ]);
    }

    public function add(int $topicId) {
        $this->request->allowMethod('post');
        $topicsTable = TableRegistry::get('Topics');

        $topic = $topicsTable->get($topicId);

        if(!$topic->userIsAuthor($this->Auth->user('id'))) {
            $this->Flash->error('You are not authorized to add presentations to this topic.');
            return $this->redirect(['controller' => 'topics', 'action' => 'author']);
        }

        $presentation = $this->Presentations->newEntity([
            'topic_id' => $topicId,
            'room_id' => $this->request->getData('room'),
            'date' => Time::createFromFormat(
                'd.m.Y H:i',
                $this->request->getData('date').' '.$this->request->getData('time')
            ),
            'freeSpots' => 10
        ]);

        if ($this->Presentations->save($presentation)) {
            $this->Flash->success('The presentation has been saved.');
            return $this->redirect(['action' => 'manage', $topicId]);
        }

        $this->Flash->error('The presentation could not be saved.');

        return $this->redirect(['action' => 'manage', $topicId]);
    }
}
