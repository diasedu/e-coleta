<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

# Acesso a tela de login
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');

# Autenticação.
$routes->post('/auth', 'Login::auth');

# Cadastro de usuário.
$routes->post('/userRegister', 'Login::UserRegister');
