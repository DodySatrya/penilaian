<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->group('/admin', ['filter' => 'role:admin'], function($routes) {
    // GET
    $routes->get('/', 'Admin::index');
    $routes->get('siswa', 'Admin::siswa');
    $routes->get('kelas', 'Admin::kelas');
    $routes->get('jurusan', 'Admin::jurusan');
    $routes->get('mapel', 'Admin::mapel');
    $routes->get('penilaian', 'Admin::penilaian');
    $routes->get('penilaian/add', 'Admin::penilaian_add');
    $routes->get('penilaian/edit/(:num)', 'Admin::penilaian_edit/$1');
    $routes->get('jurusan/get/(:num)', 'Admin::getJsonJurusan/$1');
    $routes->get('siswa/get/(:num)', 'Admin::getJsonSiswa/$1');
    $routes->get('mapel/get/(:num)', 'Admin::getJsonMapel/$1');
    $routes->get('nilai/get/(:num)', 'Admin::getJsonNilaiById/$1');
    $routes->get('nilai/detail/(:num)', 'Admin::nilai_detail/$1');
    $routes->get('nilai/getBKM/(:any)/(:num)', 'Admin::getJsonNilai/$1/$2');
    $routes->get('nilai/print/(:num)', 'Admin::nilai_print/$1');
    $routes->get('rapor/(:num)/(:any)', 'Admin::rapor/$1/$2');
    $routes->get('user', 'Admin::user');

    // POST
    $routes->post('jurusan/store', 'Admin::jurusan_store');
    $routes->post('jurusan/update', 'Admin::jurusan_update');
    $routes->post('kelas/store', 'Admin::kelas_store');
    $routes->post('siswa/store', 'Admin::siswa_store');
    $routes->post('siswa/update', 'Admin::siswa_update');
    $routes->post('mapel/store', 'Admin::mapel_store');
    $routes->post('mapel/update', 'Admin::mapel_update');
    $routes->post('mapel/kategori_add', 'Admin::kategori_add');
    $routes->post('nilai/store', 'Admin::nilai_store');
    $routes->post('nilai/update', 'Admin::nilai_update');
    $routes->post('user/store', 'Admin::user_store');
    $routes->post('user/update', 'Admin::user_update');
    $routes->post('user/password_default', 'Admin::password_default');
    
    // DELETE
    $routes->delete('jurusan/delete/(:num)', 'Admin::jurusan_delete/$1');
    $routes->delete('kelas/delete/(:num)', 'Admin::kelas_delete/$1');
    $routes->delete('siswa/delete/(:num)', 'Admin::siswa_delete/$1');
    $routes->delete('mapel/delete/(:num)', 'Admin::mapel_delete/$1');
    $routes->delete('niali/delete/(:num)/(:any)', 'Admin::nilai_delete/$1/$2');
    $routes->delete('mapel/kategori_del/(:num)', 'Admin::kategori_del/$1');
    $routes->delete('user/user_del/(:num)', 'Admin::user_del/$1');
});

// Walikelas Route
$routes->group('/wali_kelas', ['filter' => 'role:wali_kelas'], function($routes) {
    $routes->get('/', 'WaliKelas::index');
    $routes->get('penilaian', 'WaliKelas::penilaian');
    $routes->get('penilaian/add', 'WaliKelas::penilaian_add');
    $routes->get('penilaian/edit/(:num)', 'WaliKelas::penilaian_edit/$1');

    $routes->get('nilai/get/(:num)', 'WaliKelas::getJsonNilaiById/$1');
    $routes->get('nilai/getBKM/(:any)/(:num)', 'WaliKelas::getJsonNilai/$1/$2');
    $routes->get('siswa/get/(:num)', 'WaliKelas::getJsonSiswa/$1');
    $routes->get('mapel/get/(:num)', 'WaliKelas::getJsonMapel/$1');

    $routes->get('nilai/detail/(:num)', 'WaliKelas::nilai_detail/$1');
    $routes->get('nilai/print/(:num)', 'WaliKelas::nilai_print/$1');

    $routes->post('nilai/store', 'WaliKelas::nilai_store');
    $routes->post('nilai/update', 'WaliKelas::nilai_update');

    $routes->delete('niali/delete/(:num)/(:any)', 'WaliKelas::nilai_delete/$1/$2');
});

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
