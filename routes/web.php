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

//Route Resource

Route::resource('/users', 'UserController');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->namespace('Admin')->group(function(){
        
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');
       
        Route::prefix('profile')->name('profile.')->group(function(){
            Route::get('/','ProfileController@index')->name('index');
            Route::post('/','ProfileController@update')->name('update');
        
        });

    });
    
});

Auth::routes();

