<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. Landing & Auth (Public)
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::loginProcess');
$routes->get('logout', 'Auth::logout');

// 2. Protected Routes (Sudah ada Implementasi Controller & View)
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Dashboard menggunakan Home::index
    $routes->get('dashboard', 'Home::index');
    
    // Endpoint Task & Users kita hapus dulu sampai Controllernya kita buat nanti
});