<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('dashboard', 'DashboardController::index', ['filter' => 'session']);

$routes->post('offices/list', 'OfficeController::list', ['filter' => 'group:admin']);
$routes->post('categories/list', 'CategoryController::list', ['filter' => 'group:admin']);
$routes->post('users/list', 'UsersController::list', ['filter' => 'group:admin']);
$routes->post('tickets/list', 'TicketController::list', ['filter' => 'session']);

$routes->resource('offices', ['controller' => 'OfficeController', 'except' => ['new', 'edit'],'filter' => 'group:admin' ]);
$routes->resource('categories', ['controller' => 'CategoryController', 'except' => ['new', 'edit'],'filter' => 'group:admin' ]);
$routes->resource('users', ['controller' => 'UserController', 'except' => ['new', 'edit'],'filter' => 'group:admin' ]);
$routes->resource('tickets', ['controller' => 'TicketController', 'except' => ['new', 'edit'],'filter' => 'session' ]);

service('auth')->routes($routes);