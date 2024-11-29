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

# Abaixo o roteamento para os administradores.

# Tela de cadastro do tipo de coleta.
$routes->get('/arealogada/admin/cadastro/tipoColeta', 'arealogada\admin\cadastro\TipoColeta::index');
$routes->post('/arealogada/admin/cadastro/tipoColeta/consultar', 'arealogada\admin\cadastro\TipoColeta::consultar');
$routes->post('/arealogada/admin/cadastro/tipoColeta/inserirAtualizar', 'arealogada\admin\cadastro\TipoColeta::inserirAtualizar');
$routes->post('/arealogada/admin/cadastro/tipoColeta/resgataRegistro', 'arealogada\admin\cadastro\TipoColeta::resgataRegistro');
$routes->post('/arealogada/admin/cadastro/tipoColeta/excluir', 'arealogada\admin\cadastro\TipoColeta::excluir');

# Tela de cadastro dos coletores
$routes->get('/arealogada/admin/cadastro/coletor', 'arealogada\admin\cadastro\Coletor::index');
$routes->post('/arealogada/admin/cadastro/coletor/consultar', 'arealogada\admin\cadastro\Coletor::consultar');
$routes->post('/arealogada/admin/cadastro/coletor/inserirAtualizar', 'arealogada\admin\cadastro\Coletor::inserirAtualizar');
$routes->post('/arealogada/admin/cadastro/coletor/resgataRegistro', 'arealogada\admin\cadastro\Coletor::resgataRegistro');
$routes->post('/arealogada/admin/cadastro/coletor/excluir', 'arealogada\admin\cadastro\Coletor::excluir');

# Tela de cadastro: Vínculo de usuário e tipo de perfil.
$routes->get('/arealogada/admin/cadastro/usuarioPerfil', 'arealogada\admin\cadastro\UsuarioPerfil::index');
$routes->post('/arealogada/admin/cadastro/usuarioPerfil/consultar', 'arealogada\admin\cadastro\UsuarioPerfil::consultar');
$routes->post('/arealogada/admin/cadastro/usuarioPerfil/vincularDesvincular', 'arealogada\admin\cadastro\UsuarioPerfil::vincularDesvincular');
$routes->post('/arealogada/admin/cadastro/usuarioPerfil/resgataRegistro', 'arealogada\admin\cadastro\UsuarioPerfil::resgataRegistro');

# Tela para solicitantes

# Tela de tickets.
$routes->get('/arealogada/solicitante/ticket', 'arealogada\solicitante\Ticket::index');

# Tela para criar um ticket
$routes->get('/arealogada/solicitante/solicitarColeta', 'arealogada\solicitante\SolicitarColeta::index');
$routes->post('/arealogada/solicitante/solicitarColeta/consultarCep', 'arealogada\solicitante\SolicitarColeta::consultarCep');
$routes->post('/arealogada/solicitante/solicitarColeta/criarSolicitacao', 'arealogada\solicitante\SolicitarColeta::criarSolicitacao');
