<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['add', 'logout']);
    }

    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success('The registration was successful.');

                $this->Auth->setUser($user->toArray());

                return $this->redirect($this->Auth->redirectUrl());
            }

            $this->Flash->error('Could not save registration.');
        }
        $this->set('user', $user);
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Flash->success('Successfully logged in.');

                $this->Auth->setUser($user);

                return $this->redirect($this->Auth->redirectUrl());
            }

            $this->Flash->error('Invalid username or password.');
        }
    }

    public function logout() {
        $this->Flash->success('Successfully logged out.');

        return $this->redirect($this->Auth->logout());
    }
}
