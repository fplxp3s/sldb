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

Route::get('/', function () {return view('index');});

Route::get('/painel', 'HomeController@index')->name('painel');

Auth::routes();

//definir rotas do usuario
Route::group(['prefix' => 'usuarios'], function()
{
    Route::get('/', 'UsuarioController@lista')->name('usuario.lista');
    Route::post('/', 'UsuarioController@lista')->name('usuario.lista'); //utilizado parqa paginacao
    Route::get('/novo', 'UsuarioController@novo')->name('usuario.novo');
    Route::post('/adiciona', 'UsuarioController@adiciona')->name('usuario.adiciona');
    Route::get('/mostra/{id}', 'UsuarioController@mostra')->name('usuario.mostra');
    Route::get('/edita/{id}', 'UsuarioController@edita')->name('usuario.edita');
    Route::post('/atualiza', 'UsuarioController@atualiza')->name('usuario.atualiza');
    Route::get('/remove/{id}', 'UsuarioController@remove')->name('usuario.remove');
});