<?php

use Illuminate\Support\Facades\Route;

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


Route::resource('productos','ProductosController');
Route::resource('carritos','CarritosController');
Route::resource('compras','ComprasController');
//Mostrar todos los productos
//Route::get('/productos','ProductosController@index');
//Mostrar el formulario para crear un nuevo producto
//Route::get('/productos/create','ProductosController@create');
//Guarddar un nuevo producto
//Route::post('/productos','ProductosController@store');
//Mostrar un producto en particular
//Route::get('/productos/{id}','ProductosController@show');
//Editar un producto en particular
//Route::get('/productos/{id}/edit','ProductosController@edit');
//Actualizar un producto en particular
//Route::put('/productos/{id}','ProductosController@update');
//Eliminar un producto en particular
//Route::delete('/productos/{id}','ProductosController@destroy');

//Mostrar todos los carritos
//Route::get('/carritos','CarritosController@index');
//Mostrar el formulario para crear un nuevo carrito
//Route::get('/carritos/create','CarritosController@create');
//Guardar un nuevo carrito
//Route::post('/carritos','CarritosController@store');
//Mostrar un carrito en particular
//Route::get('/carritos/{id}','CarritosController@show');
//Editar un carrito en particular
//Route::get('/carritos/{id}/edit','CarritosController@edit');
//Actualizar un carrito en particular
//Route::put('/carritos/{id}','CarritosController@update');
//Eliminar un carrito en particular
//Route::delete('/carritos/{id}','CarritosController@destroy');

//Mostrar todos las compras
//Route::get('/compras','ComprasController@index');
//Mostrar el formulario para crear una nueva compra
//Route::get('/compras/create','ComprasController@create');
//Guardar una nueva compras compra
//Route::post('/compras','ComprasController@store');
//Mostrar una compra en particular
//Route::get('/compras/{id}','ComprasController@show');
//Editar una compra en particular
//Route::get('/compras/{id}/edit','ComprasController@edit');
//Actualizar una compra en particular
//Route::put('/compras/{id}','ComprasController@update');
//Eliminar una compra en particular
//Route::delete('/compras/{id}','ComprasController@destroy');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
