<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Login::index');
$routes->get('/login/logout', 'Login::logout');
$routes->post('/login/autenticarLogin', 'Login::autenticarLogin');
$routes->get('/arealogada/principal', 'arealogada\Principal::index');