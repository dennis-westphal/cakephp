<?php

namespace App\Controller;

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
        $topics = $this->Topics->find('all');
        $this->set('topics', $topics);
    }

    public function author($id)
    {
        $topics = $this->Topics->find('authoredBy', [
            'authorId' => $id
        ]);
        $this->set('topics', $topics);

        $this->render('/Topics/index');
    }

    public function view(int $id) {
        $topic = $this->Topics->get($id, [
            'contain' => ['Users', 'Presentations']
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
}
