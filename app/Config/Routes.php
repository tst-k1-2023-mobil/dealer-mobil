<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/register', 'Register::index');
$routes->get('/listmobil', 'ListMobil::index');
$routes->post('/listmobil', 'Listmobil::detailPesanan');
$routes->get('/pesan/(:segment)', 'Pesan::formPemesanan/$1');
$routes->post('/pesan', 'Pesan::pesan');
$routes->get('/pesan', 'Pesan::index');


