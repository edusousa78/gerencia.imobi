<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

// Rotas de autenticação - devem vir antes das rotas protegidas
$routes->get('/', 'Admin\AuthController::index');
$routes->get('login', 'Admin\AuthController::index');
$routes->get('admin/login', 'Admin\AuthController::index');
$routes->post('admin/login', 'Admin\AuthController::login');
$routes->get('admin/logout', 'Admin\AuthController::logout');

// Rotas protegidas
$routes->group('admin', ['filter' => ['auth', 'permission']], function($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\DashboardController::index');
    
    // Módulo de Permissões
    $routes->group('permissoes', function($routes) {
        $routes->get('/', 'Admin\PermissoesController::index');
        $routes->get('nova', 'Admin\PermissoesController::nova');
        $routes->post('criar', 'Admin\PermissoesController::criar');
        $routes->get('editar/(:num)', 'Admin\PermissoesController::editar/$1');
        $routes->post('atualizar/(:num)', 'Admin\PermissoesController::atualizar/$1');
        $routes->get('excluir/(:num)', 'Admin\PermissoesController::excluir/$1');
    });

    // Módulo de Usuários
    $routes->group('usuarios', function($routes) {
        $routes->get('/', 'Admin\UsuariosController::index');
        $routes->get('novo', 'Admin\UsuariosController::novo');
        $routes->post('criar', 'Admin\UsuariosController::criar');
        $routes->get('editar/(:num)', 'Admin\UsuariosController::editar/$1');
        $routes->post('atualizar/(:num)', 'Admin\UsuariosController::atualizar/$1');
    });

    // Módulo de Imóveis
    $routes->group('imoveis', function($routes) {
        $routes->get('/', 'Admin\ImoveisController::index');
        $routes->get('novo', 'Admin\ImoveisController::novo');
        $routes->post('criar', 'Admin\ImoveisController::criar');
        $routes->get('editar/(:num)', 'Admin\ImoveisController::editar/$1');
        $routes->post('atualizar/(:num)', 'Admin\ImoveisController::atualizar/$1');
        $routes->get('detalhes/(:num)', 'Admin\ImoveisController::detalhes/$1');
        $routes->post('upload-fotos/(:num)', 'Admin\ImoveisController::uploadFotos/$1');
        $routes->get('excluir/(:num)', 'Admin\ImoveisController::excluir/$1');
        $routes->get('midias/(:num)', 'Admin\ImoveisController::midias/$1');
        $routes->post('upload-midia/(:num)', 'Admin\ImoveisController::uploadMidia/$1');
        $routes->get('excluir-midia/(:num)', 'Admin\ImoveisController::excluirMidia/$1');
        $routes->get('definir-capa/(:num)', 'Admin\ImoveisController::definirCapa/$1');
    });

    // Módulo de Locações
    $routes->group('locacoes', function($routes) {
        $routes->get('/', 'Admin\LocacoesController::index');
        $routes->get('nova', 'Admin\LocacoesController::nova');
        $routes->post('criar', 'Admin\LocacoesController::criar');
        $routes->get('editar/(:num)', 'Admin\LocacoesController::editar/$1');
        $routes->post('atualizar/(:num)', 'Admin\LocacoesController::atualizar/$1');
    });
    
    // Rotas para contratos
    $routes->get('contratos/gerar/(:num)', 'Admin\ContratosController::gerar/$1');
    $routes->get('contratos/download/(:num)', 'Admin\ContratosController::download/$1');
    $routes->get('contratos/enviar/(:num)', 'Admin\ContratosController::enviar/$1');
    
    // Demais módulos...
});

// Rotas do Site Público
$routes->get('/', 'Home::index');
$routes->get('imoveis', 'Imoveis::index');
$routes->get('imovel/(:num)', 'Imoveis::detalhes/$1');
$routes->get('sobre', 'Paginas::sobre');
$routes->get('contato', 'Paginas::contato');
