<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->post('/logout', 'Login::logout');

$routes->get('/register', 'Register::index');
$routes->post('/register/auth', 'Register::auth');

$routes->get('/', 'ListMobil::index');
$routes->post('/listmobil', 'Listmobil::detailPesanan');

$routes->get('/pesan/(:segment)', 'Pesan::formPemesanan/$1');
$routes->post('/pesan', 'Pesan::pesan');
$routes->get('/pesan', 'Pesan::index');

$routes->get('/loyalty', 'Loyalty::index');

$routes->get('/transaksi', 'Pesan::transaksi');


