<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin\DashboardController::index');
$routes->get('/dashboard', 'Admin\DashboardController::index');

$routes->get('/daftar-produk', 'Admin\ProdukController::index');
$routes->get('/daftar-produk/tambah', 'Admin\ProdukController::form_create');
$routes->get('/daftar-produk/ubah/(:num)', 'Admin\ProdukController::form_update/$1');
$routes->post('/daftar-produk/create-produk', 'Admin\ProdukController::create_produk');
$routes->put('daftar-produk/update-produk/(:num)', 'Admin\ProdukController::update_produk/$1');
$routes->delete('daftar-produk/hapus-produk/(:num)', 'Admin\ProdukController::delete_produk/$1');
$routes->get('/daftar-produk/detail-produk/(:num)', 'Admin\ProdukController::detail-produk/$1');

$routes->get('/daftar-kategori', 'Admin\ProdukController::kategori');
$routes->post('/daftar-kategori/tambah', 'Admin\ProdukController::store');
$routes->put('/daftar-kategori/update/(:num)', 'Admin\ProdukController::update/$1');
$routes->delete('/daftar-kategori/hapus/(:num)', 'Admin\ProdukController::hapus/$1');


