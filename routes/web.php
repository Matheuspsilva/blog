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

//use Illuminate\Routing\Route;

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('hello-world', 'HelloWorldController@index');
Route::view('/bem-vindo', 'bemvindo',['name' => 'Matheus']);
//Parâmetros dinâmicos
    //Apelido para rotas
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

//Grupo de rotas & prefixo

// Route::prefix('posts')->name('post.')->group(function(){

//     Route::get('/', 'PostController@index')->name('index');

//     Route::get('/create', 'PostController@index')->name('index');

//     Route::post('/save', 'PostController@save')->name('save');

// });
//Grupo de Rotas & Namespace
// Route::namespace('Admin')->prefix('admin')->group(function(){

//     Route::get('/users/','UserController@index')->name('users.index');

//     Route::get('/posts/', 'PostController@index')->name('post.index');
// });

//Route Resource

Route::resource('/users', 'UserController');


// Route::prefix('admin')->namespace('admin')->group(function(){

//     Route::prefix('posts')->name('posts.')->group(function(){

//         Route::get('/create', 'PostController@create')->name('create');

//         Route::post('/store', 'PostController@store')->name('store');

//     });

// });

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->namespace('Admin')->group(function(){
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');
       
        });
});



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
