<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// --- Halaman Publik ---
$routes->get('/', 'ProdukController::index');

// --- Auth Routes ---
$routes->get('/register', 'Auth::register');
$routes->post('/auth/simpanRegister', 'Auth::simpanRegister');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/prosesLogin', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// --- Produk CRUD (Dilindungi Auth Filter) ---
$routes->get('/tambah-produk', 'ProdukController::tambah', ['filter' => 'auth']);
$routes->post('/produk/simpan', 'ProdukController::simpan', ['filter' => 'auth']);
$routes->get('/edit-produk/(:num)', 'ProdukController::edit/$1', ['filter' => 'auth']);
$routes->post('/produk/update/(:num)', 'ProdukController::update/$1', ['filter' => 'auth']);
$routes->post('/produk/delete/(:num)', 'ProdukController::delete/$1', ['filter' => 'auth']);

// --- Kategori (Dilindungi Auth Filter) ---
$routes->post('/kategori/simpan', 'KategoriController::simpan', ['filter' => 'auth']);

// --- Keranjang & Checkout ---
$routes->get('/keranjang', 'KeranjangController::index');
$routes->post('/keranjang/add/(:num)', 'KeranjangController::addToCart/$1');
$routes->post('/keranjang/hapus/(:num)', 'KeranjangController::hapus/$1');
$routes->post('/keranjang/checkout', 'KeranjangController::checkout');