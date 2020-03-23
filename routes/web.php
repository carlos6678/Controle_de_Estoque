<?php
Auth::routes();

Route::get('/', 'HomeController@index')->name('raiz');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/produtos','HomeController@listarprodutos')->name('produtos'); 
Route::get('/vendas','HomeController@vendas')->name('vendas');
Route::get('/compras','HomeController@compras')->name('compras');
Route::get('/clientes','HomeController@clientes')->name('clientes');
Route::get('/fabricantes','HomeController@fabricantes')->name('fabricantes');
Route::match(['get','post'],'/addCliente','HomeController@adicionarClientes')->name('adicionarCliente');
Route::match(['get','post'],'/addUsuario','HomeController@adicionarUsuarios')->name('adicionarUsuario');
Route::match(['get','post'],'/addFabricante','HomeController@adicionarFabricante')->name('adicionarFabricante');
Route::get('/infoProduto/{id}','AjaxController@infoProduto')->name('infoProdutos');
Route::post('/addProduto','AjaxController@addProduto')->name('adicionarProduto');
Route::post('/editProduto/{id}','AjaxController@editarProduto')->name('editarProduto');
Route::delete('/excluirProduto','AjaxController@excluirProduto')->name('excluirProduto');
Route::post('/addVendas','AjaxController@addVendas')->name('adicionarVendas');
Route::post('/addCompras','AjaxController@addCompras')->name('adicionarCompras');
Route::get('/infoCliente/{id}','AjaxController@infoCliente')->name('infoCliente');
Route::post('/salvarCliente/{id}','AjaxController@salvarCliente')->name('salvarCliente');
Route::delete('/excluirCliente/{id}','AjaxController@excluirCliente')->name('excluirCliente');
Route::get('/infoFabricante/{id}','AjaxController@infoFabricante')->name('infoFabricante');
Route::post('/salvarFabricante/{id}','AjaxController@salvarFabricante')->name('salvarFabricante');
Route::delete('/excluirFabricante/{id}','AjaxController@excluirFabricante')->name('exluirFabricante');