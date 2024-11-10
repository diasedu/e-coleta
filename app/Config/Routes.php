<?php

use CodeIgniter\Router\RouteCollection;

ini_set('display_errors', true);

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Login::index');
$routes->get('/cadastro/usuario', 'Login::cadastrar');
$routes->post('/cadastro/cadastrarUsuario', 'Login::cadastrarUsuario');
$routes->get('/login/logout', 'Login::logout');
$routes->post('/login/autenticarLogin', 'Login::autenticarLogin');
$routes->get('/arealogada/principal', 'arealogada\Principal::index');
$routes->get('/arealogada/cadastro/tipoColeta', 'arealogada\cadastro\TipoColeta::index');
$routes->post('/arealogada/cadastro/tipoColeta/consultar', 'arealogada\cadastro\TipoColeta::consultar');
$routes->post('/arealogada/cadastro/tipoColeta/inserirAtualizar', 'arealogada\cadastro\TipoColeta::inserirAtualizar');
$routes->post('/arealogada/cadastro/tipoColeta/resgataRegistro', 'arealogada\cadastro\TipoColeta::resgataRegistro');
$routes->post('/arealogada/cadastro/tipoColeta/excluir', 'arealogada\cadastro\TipoColeta::excluir');