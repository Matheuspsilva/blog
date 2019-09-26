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

//Função anônima
Route::get('/', function () {
    return view('welcome');
});
Route::get('hello-world', 'HelloWorldController@index');
Route::view('/bem-vindo', 'bemvindo',['name' => 'Matheus']);
//Parâmetros dinâmicos
Route::get('/post/{slug}', function($slug){
    return $slug;
})->name('post.single');
//Parâmetros Opcionais
Route::get('/page/{slug?}', function($slug = null){
    return !is_null($slug) ? $slug : 'Comportamento sem a existência do param slug';
});
//Regex em parâmetros
Route::get('/user/{id}', function($slug){
    return $slug;
})->where(['id' => '[0-9]+']);
//Apelido para rotas


