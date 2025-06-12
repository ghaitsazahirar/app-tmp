<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing::index');
$routes->group('admin', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('login', 'Auth::index');
    $routes->post('auth/login', 'Auth::login');
    $routes->get('logout', 'Auth::logout');
});
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('/admin', 'Admin::index');
    $routes->post('/store', 'Admin::store');
    $routes->get('/edit/(:num)', 'Admin::edit/$1');
    $routes->post('/update/(:num)', 'Admin::update/$1');
    $routes->delete('/delete/(:num)', 'Admin::delete/$1');
