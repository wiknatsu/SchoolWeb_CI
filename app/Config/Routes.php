<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================================
// 1. PUBLIC ROUTES
// ==========================================
$routes->get('/', 'Home::index');
$routes->get('profil/tentang', 'Home::about');
$routes->get('profil/(:segment)', 'Home::page/$1');
$routes->get('berita', 'Home::news');
$routes->get('berita/kategori/(:segment)', 'Home::newsByCategory/$1');
$routes->get('berita/(:segment)', 'Home::newsDetail/$1');
$routes->get('galeri', 'Home::gallery');
$routes->get('kontak', 'Home::contact');
$routes->post('kontak/kirim', 'Home::sendContact');

// API & AJAX
$routes->get('api/search', 'Api\NewsApi::search');
$routes->get('api/traffic', 'Api\NewsApi::trafficStats');

// ==========================================
// 2. AUTHENTICATION ROUTES
// ==========================================
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');

// ==========================================
// 3. ADMIN PANEL ROUTES (Protected by Auth)
// ==========================================
$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // News
    $routes->get('berita', 'Admin\News::index');
    $routes->get('berita/tambah', 'Admin\News::create');
    $routes->post('berita/simpan', 'Admin\News::store');
    $routes->get('berita/edit/(:num)', 'Admin\News::edit/$1');
    $routes->post('berita/update/(:num)', 'Admin\News::update/$1');
    $routes->get('berita/hapus/(:num)', 'Admin\News::delete/$1');
    $routes->post('berita/highlight/(:num)', 'Admin\News::toggleHighlight/$1');
    $routes->post('berita/upload-editor', 'Admin\News::uploadEditorImage');

    // News Categories
    $routes->get('kategori', 'Admin\Categories::index');
    $routes->post('kategori/simpan', 'Admin\Categories::store');
    $routes->post('kategori/update/(:num)', 'Admin\Categories::update/$1');
    $routes->get('kategori/hapus/(:num)', 'Admin\Categories::delete/$1');

    // Static Pages
    $routes->get('halaman', 'Admin\Pages::index');
    $routes->get('halaman/tambah', 'Admin\Pages::create');
    $routes->post('halaman/simpan', 'Admin\Pages::store');
    $routes->get('halaman/edit/(:num)', 'Admin\Pages::edit/$1');
    $routes->post('halaman/update/(:num)', 'Admin\Pages::update/$1');
    $routes->get('halaman/hapus/(:num)', 'Admin\Pages::delete/$1');

    // School Profile
    $routes->get('profil-sekolah', 'Admin\Profile::index');
    $routes->post('profil-sekolah/update', 'Admin\Profile::update');

    // School Apps
    $routes->get('aplikasi', 'Admin\Apps::index');
    $routes->post('aplikasi/simpan', 'Admin\Apps::store');
    $routes->post('aplikasi/update/(:num)', 'Admin\Apps::update/$1');
    $routes->get('aplikasi/hapus/(:num)', 'Admin\Apps::delete/$1');

    // Gallery
    $routes->get('galeri', 'Admin\Gallery::index');
    $routes->post('galeri/simpan', 'Admin\Gallery::store');
    $routes->post('galeri/update/(:num)', 'Admin\Gallery::update/$1');
    $routes->get('galeri/hapus/(:num)', 'Admin\Gallery::delete/$1');

    // User Management (Superadmin only)
    $routes->get('pengguna', 'Admin\Users::index', ['filter' => 'role:superadmin']);
    $routes->get('pengguna/tambah', 'Admin\Users::create', ['filter' => 'role:superadmin']);
    $routes->post('pengguna/simpan', 'Admin\Users::store', ['filter' => 'role:superadmin']);
    $routes->get('pengguna/edit/(:num)', 'Admin\Users::edit/$1', ['filter' => 'role:superadmin']);
    $routes->post('pengguna/update/(:num)', 'Admin\Users::update/$1', ['filter' => 'role:superadmin']);
    $routes->get('pengguna/hapus/(:num)', 'Admin\Users::delete/$1', ['filter' => 'role:superadmin']);

    // Settings & Diagnostics
    $routes->get('pengaturan', 'Admin\Settings::index');
    $routes->get('pengaturan/clear-cache', 'Admin\Settings::clearCache');
});
