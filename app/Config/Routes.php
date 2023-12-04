<?php

use App\Filters\AuthenticationFilter;
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

$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);
$routes->get('login', 'Login::index');
$routes->get('register', 'Register::index');
$routes->get('users', 'UserListController::index', ['filter' => 'auth']);
$routes->get('tickets', 'TicketController::index', ['filter' => 'auth']);
$routes->get('offices', 'OfficeController::index', ['filter' => 'auth']);
$routes->get('categories', 'CategoryController::index', ['filter' => 'auth']);
$routes->get('profile', 'ProfileController::index', ['filter' => 'auth']);

$routes->post('login', 'Login::loginUser');
$routes->post('register', 'Register::registerUser');

$routes->post('offices/list', 'OfficeController::list');
$routes->post('categories/list', 'CategoryController::list');
$routes->post('tickets/list', 'TicketController::list');
$routes->post('users/list', 'UserListController::list');

$routes->resource('offices', ['controller' => 'OfficeController', 'except' => ['new', 'edit']]);
$routes->resource('categories', ['controller' => 'CategoryController', 'except' => ['new', 'edit']]);
$routes->resource('users', ['controller' => 'UserListController', 'except' => ['new', 'edit']]);
$routes->resource('tickets', ['controller' => 'TicketController', 'except' => ['new', 'edit']]);
