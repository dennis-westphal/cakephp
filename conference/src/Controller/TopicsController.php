<?php

namespace App\Controller;

use App\Model\Entity\Topic;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Topics Controller
 *
 * @property \App\Model\Table\TopicsTable $Topics
 *
 * @method \App\Model\Entity\Topic[] paginate($object = null, array $settings = [])
 */
class TopicsController extends AppController {
    public function initialize() {
        parent::initialize();

        // Load the flash component so it can be used it controller methods
        $this->loadComponent('Flash');
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'author', 'view']);
        $this->Auth->setConfig('authorize', ['Controller']);
    }

    public function isAuthorized($user = null) {
        if ($this->request->getParam('action') === 'add') {
            return !empty($user) && $user['type'] === 'author';
        }

        return true;
    }

    public function index() {
        $this->paginate = [
            'limit' => 3,
            'contain' => ['Users'],
            'sortWhitelist' => ['title', 'created', 'Users.surname']
        ];

        if($this->request->getData('search')) {
            $this->paginate['finder'] = ['search' => ['term' => $this->request->getData('search')]];
        }
        $topics = $this->paginate($this->Topics);
        $this->set('topics', $topics);
    }

    public function author(int $id) {
        $this->paginate = [
            'limit' => 3,
            'contain' => ['Users'],
            'sortWhitelist' => ['title', 'created', 'Users.surname'],
            'finder' => ['authoredBy' => ['authorId' => $id]]
        ];

        $topics = $this->paginate($this->Topics);
        $this->set('topics', $topics);

        if($this->Auth->user('id') !== $id) {
            $this->render('/Topics/index');
        }
    }

    public function view(int $id) {
        $topic = $this->Topics->get($id, [
            'contain' => ['Users', 'Presentations', 'Presentations.Rooms']
        ]);

        $this->set('topic', $topic);
    }

    public function add() {
        $topic = $this->Topics->newEntity();

        if ($this->request->is('post')) {
            $topic = $this->Topics->patchEntity($topic, $this->request->getData());

            if ($this->Topics->save($topic)) {
                $this->Flash->success('The topic has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The topic could not be saved.');
        }

        $usersTable = TableRegistry::get('Users');
        $authors = $usersTable->find('list')->find('authors');

        $this->set('topic', $topic);
        $this->set('authors', $authors);
    }

    public function edit(int $id) {
        $topic = $this->Topics->get($id, [
            'contain' => ['Users']
        ]);

        if ($this->request->is(['put', 'post', 'patch'])) {
            if(!$topic->userIsAuthor($this->Auth->user('id'))) {
                $this->Flash->error('You are not authorized to edit this topic.');
                return $this->redirect(['action' => 'author', $this->Auth->user('id')]);
            }

            $topic = $this->Topics->patchEntity($topic, $this->request->getData());

            if ($this->Topics->save($topic)) {
                $this->Flash->success('The topic has been updated.');
                return $this->redirect(['action' => 'author', $this->Auth->user('id')]);
            }

            $this->Flash->error('The topic could not be updated.');
        }

        $usersTable = TableRegistry::get('Users');
        $authors = $usersTable->find('list')->find('authors');

        $this->set('topic', $topic);
        $this->set('authors', $authors);
    }

    public function delete(int $id) {
        $this->request->allowMethod(['post', 'delete']);

        $topic = $this->Topics->get($id);

        if(!$topic->userIsAuthor($this->Auth->user('id'))) {
            $this->Flash->error('You are not authorized to delete this topic.');
            return $this->redirect(['action' => 'author']);
        }

        if ($this->Topics->delete($topic)) {
            $this->Flash->success('The topic has been deleted.');
        }
        else {
            $this->Flash->error('The topic could not be deleted.');
        }

        return $this->redirect(['action' => 'author']);
    }
}
