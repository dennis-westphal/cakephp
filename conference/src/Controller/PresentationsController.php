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

    /**
     * Manage presentations for a topic
     *
     * @param int $topicId
     *
     * @return \Cake\Http\Response|null
     */
    public function manage(int $topicId) {
        // Get the topic first
        $topicsTable = TableRegistry::get('Topics');
        $topic = $topicsTable->get($topicId, [
            'contain' => ['Users', 'Presentations', 'Presentations.Rooms']
        ]);

        // Check if we have a topic
        if(empty($topic)) {
            $this->Flash->error('Topic not found.');
            return $this->redirect(['controller' => 'topics', 'action' => 'author']);
        }

        // Check if the user is authorized to add presentations to the topic
        if($topic->user->id !== $this->Auth->user('id')) {
            $this->Flash->error('You are not authorized to access this topic.');
            return $this->redirect(['controller' => 'topics', 'action' => 'author']);
        }

        // Get the available rooms
        $roomsTable = TableRegistry::get('Rooms');
        $rooms = $roomsTable->find('list')->toArray();

        // Set the topic, rooms and the options for the date and time input fields
        $this->set([
            'topic' => $topic,
            'rooms' => $rooms,
            'dateTimeOptions' => $this->Presentations::DATE_TIME_OPTIONS
        ]);
    }

    /**
     * Add a new presentation for a topic
     *
     * @param int $topicId
     *
     * @return \Cake\Http\Response|null
     */
    public function add(int $topicId) {
        // Only allow form posts
        $this->request->allowMethod('post');

        // Get the topic
        $topicsTable = TableRegistry::get('Topics');
        $topic = $topicsTable->get($topicId);

        // Check if the topic exists
        if(empty($topic)) {
            $this->Flash->error('Topic not found.');
            return $this->redirect(['controller' => 'topics', 'action' => 'author']);
        }

        // Check if the user is authorized to add presentations to the topic
        if(!$topic->userIsAuthor($this->Auth->user('id'))) {
            $this->Flash->error('You are not authorized to add presentations to this topic.');
            return $this->redirect(['controller' => 'topics', 'action' => 'author']);
        }

        // Create a new presentation
        $presentation = $this->Presentations->newEntity([
            'topic_id' => $topicId, // Use the topic id passed in the url
            'room_id' => $this->request->getData('room'), // Use the room id sent with the form
            'date' => Time::createFromFormat( // Create a Date object based on the sent date and time
                'd.m.Y H:i',
                $this->request->getData('date').' '.$this->request->getData('time')
            ),
            'freeSpots' => 10 // Use a fixed number of free spots for now
        ]);

        // Try to save the presentation
        if ($this->Presentations->save($presentation)) {
            $this->Flash->success('The presentation has been saved.');
            return $this->redirect(['action' => 'manage', $topicId]);
        }

        // Display an error message if saving didn't work
        $message = 'The presentation could not be saved.';
        foreach($presentation->getErrors() as $field => $errors) {
            $message .= '<br>'.ucfirst($field).': ';

            $message .= join('; ', $errors);
        }
        $this->Flash->error($message, ['escape' => false]);
        return $this->redirect(['action' => 'manage', $topicId]);
    }
}
