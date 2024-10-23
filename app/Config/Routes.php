<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Login::index');
$routes->get('/cadastro/usuario', 'Login::cadastrar');
$routes->post('/cadastro/cadastrarUsuario', 'Login::cadastrarUsuario');
$routes->get('/login/logout', 'Login::logout');
$routes->post('/login/autenticarLogin', 'Login::autenticarLogin');
$routes->get('/arealogada/principal', 'arealogada\Principal::index');