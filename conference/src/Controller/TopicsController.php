<?php

namespace App\Controller;

/**
 * Topics Controller
 *
 * @property \App\Model\Table\TopicsTable $Topics
 *
 * @method \App\Model\Entity\Topic[] paginate($object = null, array $settings = [])
 */
class TopicsController extends AppController {

    public function index() {
        $topics = $this->Topics->find('all');
        $this->set('topics', $topics);
    }

    public function view(int $id) {
        $topic = $this->Topics->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('topic', $topic);
    }
}
