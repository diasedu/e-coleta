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

# Tela para consultar um ticket.
$routes->get('/arealogada/solicitante/acompanharSolicitacao', 'arealogada\solicitante\AcompanharSolicitacao::index');
$routes->post('/arealogada/solicitante/acompanharSolicitacao/consultar', 'arealogada\solicitante\AcompanharSolicitacao::consultar');
$routes->post('/arealogada/solicitante/acompanharSolicitacao/ver', 'arealogada\solicitante\AcompanharSolicitacao::ver');
# $routes->post('/arealogada/solicitante/acompanharSolicitacao/criarSolicitacao', 'arealogada\solicitante\AcompanharSolicitacao::criarSolicitacao');

# Tela para coletores

# Consulta de consulta dos tickets gerais.
$routes->get('/arealogada/coletor/solicitacaoAberta', 'arealogada\coletor\SolicitacaoAberta::index');
$routes->post('/arealogada/coletor/solicitacaoAberta/consultar', 'arealogada\coletor\SolicitacaoAberta::consultar');
$routes->post('/arealogada/coletor/solicitacaoAberta/ver', 'arealogada\coletor\SolicitacaoAberta::ver');
$routes->post('/arealogada/coletor/solicitacaoAberta/mudarStatus', 'arealogada\coletor\SolicitacaoAberta::mudarStatus');

# Consulta de consulta dos tickets gerais.
$routes->get('/arealogada/coletor/meuAtendimento', 'arealogada\coletor\MeuAtendimento::index');
$routes->post('/arealogada/coletor/meuAtendimento/consultar', 'arealogada\coletor\MeuAtendimento::consultar');
$routes->post('/arealogada/coletor/meuAtendimento/ver', 'arealogada\coletor\MeuAtendimento::ver');
$routes->post('/arealogada/coletor/meuAtendimento/mudarStatus', 'arealogada\coletor\MeuAtendimento::mudarStatus');