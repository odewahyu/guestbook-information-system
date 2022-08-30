<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Login
$routes->get('/login', 'Login::index', ['filter' => 'loginFilter']);

//Admin
$routes->get('/home-admin', 'Home::homeAdmin', ['filter' => 'adminFilter']);
$routes->get('/admin', 'Admin::index', ['filter' => 'adminFilter']);
$routes->get('/admin/create', 'Admin::create', ['filter' => 'adminFilter']);
$routes->get('/admin/edit/(:num)', 'Admin::edit/$1', ['filter' => 'adminFilter']);
$routes->get('/admin/delete', 'Admin::delete', ['filter' => 'adminFilter']);

$routes->get('/pegawai', 'Pegawai::index', ['filter' => 'adminFilter']);
$routes->get('/pegawai/create', 'Pegawai::create', ['filter' => 'adminFilter']);
$routes->get('/pegawai/edit/(:num)', 'Pegawai::edit/$1', ['filter' => 'adminFilter']);
$routes->get('/pegawai/delete', 'Pegawai::delete', ['filter' => 'adminFilter']);

$routes->get('/jabatan', 'Jabatan::index', ['filter' => 'adminFilter']);
$routes->get('/jabatan/create', 'Jabatan::create', ['filter' => 'adminFilter']);
$routes->get('/jabatan/edit/(:num)', 'Jabatan::edit/$1', ['filter' => 'adminFilter']);
$routes->get('/jabatan/delete', 'Jabatan::delete', ['filter' => 'adminFilter']);

$routes->get('/tamu', 'Tamu::index', ['filter' => 'adminFilter']);
$routes->get('/tamu/create', 'Tamu::create', ['filter' => 'adminFilter']);
$routes->get('/tamu/edit/(:num)', 'Tamu::edit/$1', ['filter' => 'adminFilter']);
$routes->get('/tamu/delete', 'Tamu::delete', ['filter' => 'adminFilter']);

//Pegawai
$routes->get('/home-pegawai', 'Home::homePegawai', ['filter' => 'pegawaiFilter']);
$routes->get('/jadwal', 'Jadwal::index', ['filter' => 'pegawaiFilter']);
$routes->get('/permintaan', 'Permintaan::index', ['filter' => 'pegawaiFilter']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
