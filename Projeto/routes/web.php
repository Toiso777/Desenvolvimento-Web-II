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

Route::get('/', function () {
    //App::setLocale(Session::get('idioma', Config::get('app.locale')));
    return view('welcome');
})->name('welcome');

// Rotas do CRUD de recursos básicos
Route::resource('tipoproduto', "TipoProdutoController");
Route::resource('produto', "ProdutoController");

// Rotas do CRUD de pedidos
Route::get('/pedido', "PedidoController@index")->name("pedido.index");
Route::get('/pedido-admin', "PedidoController@indexAdmin")->name("pedido.adminIndex");
Route::post('/pedido/{endereco_id}', "PedidoController@store")->name("pedido.store");
Route::post('/pedido/{pedido_id}/{endereco_id}', "PedidoController@enviarPedido")->name("pedido.enviarPedido");

// Rotas do CRUD de Pedido_Produtos
Route::get('/pedidoproduto/getPedidoProdutosList/{id}', "PedidoProdutoController@getPedidoProdutosList")->name("pedidoproduto.getPedidoProdutosList");
Route::get('/pedidoproduto/getTodosProdutosDeTipo/{id}', "PedidoProdutoController@getTodosProdutosDeTipo")->name("pedidoproduto.getTodosProdutosDeTipo");
Route::post('/pedidoproduto/{id_pedido}/{id_produto}/{id_endereco}/{quantidade}', "PedidoProdutoController@store")->name("pedidoproduto.store");
Route::delete('/pedidoproduto/{id_pedido}/{id_produto}', "PedidoProdutoController@destroy")->name("pedidoproduto.destroy");

//Endereço
Route::resource('endereco', 'EnderecoController');

// Rotas de autenticação
Route::get('idioma/{idioma}', "IdiomaController@trocaIdioma")->name("idioma.trocaIdioma");

// Rotas de autenticação

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    // Logout route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Register routes
    // Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    // Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    // Password reset routes
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
});
