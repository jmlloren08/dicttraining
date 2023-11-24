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
$routes->setAutoRoute(true);
$routes->set404Override();

$routes->get('dashboard', 'DashboardController::index');
$routes->get('login', 'Login::index');
$routes->get('register', 'Register::index');

$routes->post('login', 'Login::loginUser');
$routes->post('register', 'Register::registerUser');

$routes->post('offices/list', 'OfficeController::list');
$routes->post('categories/list', 'CategoryController::list');
$routes->post('tickets/list', 'TicketController::list');
$routes->post('users/list', 'UserListController::list');

$routes->resource('offices', ['controller' => 'OfficeController', 'except' => ['new', 'edit']]);
$routes->resource('categories', ['controller' => 'CategoryController', 'except' => ['new', 'edit']]);
$routes->resource('tickets', ['controller' => 'TicketController', 'except' => ['new', 'edit']]);
$routes->resource('users', ['controller' => 'UserListController', 'except' => ['new', 'edit']]);
//service('auth2')->routes($routes);