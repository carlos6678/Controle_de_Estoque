<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/produtos','HomeController@listarprodutos'); 
Route::get('/vendas','HomeController@vendas');
Route::get('/compras','HomeController@compras');
Route::get('/clientes','HomeController@clientes');
Route::match(['get','post'],'/addCliente','HomeController@adicionarClientes');
Route::match(['get','post'],'/addUsuario','HomeController@adicionarUsuarios');
Route::get('/infoProduto/{id}','AjaxController@infoProduto');
Route::post('/addProduto','AjaxController@addProduto');
Route::post('/editProduto/{id}','AjaxController@editarProduto');
Route::delete('/excluirProduto','AjaxController@excluirProduto');