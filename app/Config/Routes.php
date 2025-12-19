<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- 1. PUBLIC (Tanpa Login) ---
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::loginProcess');
$routes->get('logout', 'Auth::logout');

// --- 2. PROTECTED (Harus Login) ---
$routes->group('', ['filter' => 'auth'], function($routes) {

    $routes->get('dashboard', 'Home::index');
    
    // B. BLOK KHUSUS MANAGER
    $routes->group('manager', ['filter' => 'role:Manager'], function($routes) {
        // --- User Management ---
        $routes->get('users', 'UserController::index');             // List Karyawan
        $routes->get('users/register', 'UserController::register');  // Form Tambah
        $routes->post('users/store', 'UserController::store');      // Proses Simpan
        $routes->get('users/edit/(:num)', 'UserController::edit/$1'); // Form Edit
        $routes->post('users/update/(:num)', 'UserController::update/$1'); // Proses Update
        $routes->get('users/delete/(:num)', 'UserController::delete/$1'); // Proses Hapus
    });

    // C. BLOK KHUSUS SUPERVISOR & LEADER
    $routes->group('management', ['filter' => 'role:Supervisor,Leader'], function($routes) {
        // Nanti diisi fitur Approve Task atau Assign Task
    });

    // D. BLOK KHUSUS PROGRAMMER
    $routes->group('dev', ['filter' => 'role:Programmer'], function($routes) {
        // Nanti diisi fitur Update Task Progress
    });

});