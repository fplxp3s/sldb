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

Route::get('/', 'SiteController@index')->name('site.index');
Route::get('/Categoria/{categoria}', 'SiteController@listaProdutosPorCategoria')->name('site.produtos.categoria');
Route::get('/Produto/{nome}', 'SiteController@exibeDetalhesProduto')->name('site.produto.detalhe');
Route::get('/Loja/{nome}', 'SiteController@exibeDetalhesLoja')->name('site.loja.detalhe');

Route::get('/painel', 'SiteController@painel')->name('site.painel');

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


//definir rotas da loja
Route::group(['prefix' => 'lojas'], function()
{
    Route::get('/', 'LojaController@lista')->name('loja.lista');
    Route::post('/', 'LojaController@lista')->name('loja.lista'); //utilizado parqa paginacao
    Route::get('/novo', 'LojaController@novo')->name('loja.novo');
    Route::post('/adiciona', 'LojaController@adiciona')->name('loja.adiciona');
    Route::get('/mostra/{id}', 'LojaController@mostra')->name('loja.mostra');
    Route::get('/edita/{id}', 'LojaController@edita')->name('loja.edita');
    Route::post('/atualiza', 'LojaController@atualiza')->name('loja.atualiza');
    Route::get('/remove/{id}', 'LojaController@remove')->name('loja.remove');
});

//definir rotas dos produtos
Route::group(['prefix' => 'produtos'], function()
{
    Route::get('/', 'ProdutoController@lista')->name('produto.lista');
    Route::post('/', 'ProdutoController@lista')->name('produto.lista'); //utilizado parqa paginacao
    Route::get('/novo', 'ProdutoController@novo')->name('produto.novo');
    Route::post('/adiciona', 'ProdutoController@adiciona')->name('produto.adiciona');
    Route::get('/mostra/{id}', 'ProdutoController@mostra')->name('produto.mostra');
    Route::get('/edita/{id}', 'ProdutoController@edita')->name('produto.edita');
    Route::post('/atualiza', 'ProdutoController@atualiza')->name('produto.atualiza');
    Route::get('/remove/{id}', 'ProdutoController@remove')->name('produto.remove');
});