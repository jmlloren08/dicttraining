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

$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

$routes->post('offices/list', 'OfficeController::list', ['filter' => 'groupfilter:admin']);
$routes->post('categories/list', 'CategoryController::list', ['filter' => 'groupfilter:admin']);
$routes->post('users/list', 'UsersController::list', ['filter' => 'groupfilter:admin']);
$routes->post('tickets/list', 'TicketController::list', ['filter' => 'auth']);

$routes->resource('offices', ['controller' => 'OfficeController', 'except' => ['new', 'edit'],'filter' => 'groupfilter:admin' ]);
$routes->resource('categories', ['controller' => 'CategoryController', 'except' => ['new', 'edit'],'filter' => 'groupfilter:admin' ]);
$routes->resource('users', ['controller' => 'UserController', 'except' => ['new', 'edit'],'filter' => 'groupfilter:admin' ]);
$routes->resource('tickets', ['controller' => 'TicketController', 'except' => ['new', 'edit'],'filter' => 'auth' ]);

service('auth')->routes($routes);