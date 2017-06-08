<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;

/**
 * UserInformation component
 */
class UserInformationComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'defaultUserType' => 'loggedOut'
    ];

    public $components = ['Auth'];


    public function beforeFilter(Event $event) {
        $user = $this->Auth->user();
        $controller = $this->_registry->getController();

        if(empty($user)) {
            $controller->set('userType', $this->getConfig('defaultUserType'));
        }
        else {
            $controller->set('userType', $user['type']);
            $controller->set('userId', $user['id']);
        }
    }
}
