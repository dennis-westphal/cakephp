<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Show topics list as start page
    $routes->connect('/', ['controller' => 'Topics', 'action' => 'index']);

    // Login and logout using a simpler URL
    $routes->connect('/login', ['controller' => 'users', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'users', 'action' => 'logout']);

    // Use a registration URL
    $routes->connect('/register', ['controller' => 'users', 'action' => 'add']);

    // Connect the view topic to a different URL
    $routes->connect('/details/*', // We can use Wildcards (*) to define parameters to pass to the controller
        ['controller' => 'topics', 'action' => 'view']
    );

    // Show topics for an author
    $routes->connect(
        '/author-topics/:id',
        ['controller' => 'topics', 'action' => 'author'],
        [
            'id' => '[0-9]+', // Restrict IDs to be numeric
            'pass' => ['id'] // Pass the ID as first parameter
        ]
    );

    // Connect all the other topic actions to a shorter url
    $routes->connect('/t/:action', ['controller' => 'topics']);

    $routes->scope('/presentations', function (RouteBuilder $routes) {
        $routes->extensions(['json', 'xml', 'pdf']);

        $routes->connect('/:action', ['controller' => 'Presentations']);
        $routes->connect('/:action/*', ['controller' => 'Presentations']);
    });

    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
