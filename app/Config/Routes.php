<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/Homeuser', 'HomeUser::index', ['filter' => 'auth']);

$routes->get('/login', 'AuthController::login');
$routes->add('/login', 'AuthController::login'); 
$routes->get('/logout', 'AuthController::logout');
$routes->get('/login/register', 'AuthController::register');
$routes->add('/register', 'AuthController::register'); 



$routes->get('/barang', 'BarangController::index', ['filter' => 'auth']);
$routes->add('/barang', 'BarangController::create', ['filter' => 'auth']);
$routes->post('barang/edit/(:any)', 'BarangController::edit/$1', ['filter' => 'auth']);
$routes->get('/barang/delete/(:any)', 'BarangController::delete/$1', ['filter' => 'auth']);

$routes->get('/baranguser', 'BarangUserController::index', ['filter' => 'auth']);
$routes->add('/baranguser', 'BarangUserController::create', ['filter' => 'auth']);
$routes->post('baranguser/edit/(:any)', 'BarangUserController::edit/$1', ['filter' => 'auth']);
$routes->get('/baranguser/delete/(:any)', 'BarangUserController::delete/$1', ['filter' => 'auth']);

$routes->get('/manajemenuser', 'ManajemenUserController::index', ['filter' => 'auth']);
$routes->add('/manajemenuser/edit/(:any)', 'ManajemenUserController::edit/$1', ['filter' => 'auth']);
$routes->get('/manajemenuser/delete/(:any)', 'ManajemenUserController::delete/$1', ['filter' => 'auth']);

$routes->get('/generate-pdf', 'Home::generatePdf', ['filter' => 'auth']);
$routes->get('/generateuser-pdf', 'HomeUser::generateuserPdf', ['filter' => 'auth']);


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
