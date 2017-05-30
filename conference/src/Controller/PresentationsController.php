<?php

namespace App\Controller;

use Cake\Event\Event;
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

        $this->set(compact('presentations'));
        $this->set('_serialize', false);
    }

    public function index(int $topicId) {
        $topicsTable = TableRegistry::get('Topics');
        $topic = $topicsTable->get($topicId, [
            'contain' => ['Users', 'Presentations']
        ]);

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
            'minDate' => $this->Presentations::MIN_DATE,
            'maxDate' => $this->Presentations::MAX_DATE,
            'minTime' => $this->Presentations::MIN_TIME,
            'maxTime' => $this->Presentations::MAX_TIME
        ]);
    }
}
