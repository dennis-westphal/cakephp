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
        $topics = $this->Topics->find('all', [
            'contain' => ['Users']
        ]);
        $this->set('topics', $topics);
    }
}
