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
$routes->get('/home', 'Home::index');
// $routes->get('/petugas', 'Petugas::index');

// $routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
// $routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
// SISWA 
$routes->group('', ['filter' => 'role:siswa'], function ($routes) {
    $routes->get('/siswa', 'Login::siswa');
    $routes->get('siswa/', 'Login::siswa');
    $routes->get('/login/siswa', 'Login::siswa');
});
$routes->group('', ['filter' => 'role:admin, petugas'], function ($routes) {
    $routes->get('/admin', 'Login::admin');
    $routes->get('admin/', 'Login::admin');
    $routes->get('/login/admin', 'Login::admin');
    // Pembayaran Transaksi
    $routes->get('/Pembayaran/index/', 'Pembayaran::index');
    $routes->get('/Pembayaran/savepembayaran/', 'Pembayaran::savepembayaran');
});
$routes->group('', ['filter' => 'role:admin'], function ($routes) {
    // CRUD siswa
    $routes->get('/admin/createsiswa/', 'Admin::createsiswa');
    $routes->get('/admin/readsiswa/', 'Admin::readsiswa');
    $routes->get('/admin/savesiswa/', 'Admin::savesiswa');
    $routes->get('/admin/editsiswa/(:num)', 'Admin::editsiswa/$1');
    $routes->get('/admin/updatesiswa/', 'Admin::updatesiswa');
    // CRUD kelas
    $routes->get('/admin/createkelas/', 'Admin::createkelas');
    $routes->get('/admin/readkelas/', 'Admin::readkelas');
    $routes->get('/admin/savekelas/', 'Admin::savekelas');
    $routes->get('/admin/editkelas/(:num)', 'Admin::editkelas/$1');
    $routes->get('/admin/updatekelas/', 'Admin::updatekelas');
    // CRUD petugas
    $routes->get('/admin/createpetugas/', 'Admin::createpetugas');
    $routes->get('/admin/readpetugas/', 'Admin::readpetugas');
    $routes->get('/admin/savepetugas/', 'Admin::savepetugas');
    $routes->get('/admin/editpetugas/(:num)', 'Admin::editpetugas/$1');
    $routes->get('/admin/updatepetugas/', 'Admin::updatepetugas');
    // CRUD SPP
    $routes->get('/admin/createspp/', 'Admin::createspp');
    $routes->get('/admin/readspp/', 'Admin::readspp');
    $routes->get('/admin/savespp/', 'Admin::savespp');
    $routes->get('/admin/editspp/(:num)', 'Admin::editspp/$1');
    $routes->get('/admin/updatespp/', 'Admin::updatespp');
    // CRUD Akun
    $routes->get('/admin/createakun/', 'Admin::createakun');
    $routes->get('/admin/readakun/', 'Admin::readakun');
    $routes->get('/admin/saveakun/', 'Admin::saveakun');
    $routes->get('/admin/editakun/(:num)', 'Admin::editakun/$1');
    $routes->get('/admin/updateakun/', 'Admin::updateakun');
    // generate laporan 
    $routes->get('/Generate/', 'Generate::index');
    $routes->get('/Generate/index', 'Generate::index');
    $routes->get('/Generate/index/', 'Generate::index');
    $routes->get('/Generate/printpdf', 'Generate::printpdf');
});




$routes->delete('/siswa/(:num)', 'Admin::deletesiswa/$1');




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
