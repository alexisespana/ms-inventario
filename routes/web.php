<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => ''], function () use ($router) {
    $router->post('/', 'Productos\ProductosController@productos');
});
$router->group(['prefix' => 'Productos'], function () use ($router) {
    $router->post('/lista', 'Productos\ProductosController@listaProductos');
    $router->post('/registrar', 'Productos\ProductosController@Registrar');
    $router->post('/editar', 'Productos\ProductosController@Editar');
    $router->post('/ingresarProductos', 'Productos\ProductosController@IngresarProductos');
});

$router->group(['prefix' => 'Ventas'], function () use ($router) {
    $router->get('/listar', 'Ventas\VentasController@ListarVentas');
    $router->post('/registrar', 'Ventas\VentasController@RegistarVenta');
    $router->get('/detalles', 'Ventas\VentasController@DetallesVentas');
   
});

