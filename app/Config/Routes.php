<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Shop::index');
$routes->get('/tambah-produk', 'Shop::tambah');
$routes->post('/shop/simpan', 'Shop::simpan');
$routes->get('/edit-produk/(:num)', 'Shop::edit/$1');
$routes->post('/shop/update/(:num)', 'Shop::update/$1');
$routes->get('/shop/delete/(:num)', 'Shop::delete/$1');
$routes->get('/shop/add-to-cart/(:num)', 'Shop::addToCart/$1');
$routes->get('/keranjang', 'Shop::keranjang');
$routes->get('/shop/hapus-keranjang/(:num)', 'Shop::hapusKeranjang/$1');
$routes->post('/shop/checkout', 'Shop::checkout');
$routes->get('/register', 'Auth::register');
$routes->post('/auth/simpanRegister', 'Auth::simpanRegister');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/prosesLogin', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');
$routes->post('/shop/simpan-kategori', 'Shop::simpanKategori');