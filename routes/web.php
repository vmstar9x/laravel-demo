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

Route::get('/', function () {
    return view('welcome');
});


//Route::get('api/users/{user}', function (App\Models\User $user) {
//    use 'UserController@index';
//});

Route::post('/admin/login', ['as' => 'admin.postLogin', 'uses' => 'Admin\LoginController@postLogin']);
Route::get('/admin/login', ['as' => 'admin.getLogin', 'uses' => 'Admin\LoginController@login']);
Route::get('/admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\LoginController@logout']);


Route::group(['prefix' => 'admin', 'middleware' => 'checkadmin'], function () {

    Route::get('/', ['as' => 'admin.home', 'uses' => 'HomeController@index']);

    Route::group(['prefix' => 'user', 'namespace' => 'Admin'], function () {

        Route::get('/', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);

        Route::post('/', ['as' => 'admin.user.postIndex', 'uses' => 'UserController@postIndex']);

        Route::get('/add', ['as' => 'admin.user.getAdd', 'uses' => 'UserController@getAdd']);

        Route::post('/add', ['as' => 'admin.user.postAdd', 'uses' => 'UserController@postAdd']);

        Route::get('/edit/{id}', ['as' => 'admin.user.getEdit', 'uses' => 'UserController@getEdit']);

        Route::post('/edit/{id}', ['as' => 'admin.user.postEdit', 'uses' => 'UserController@postEdit']);

        Route::get('/delete/{id}', ['as' => 'admin.user.delete', 'uses' => 'UserController@delete']);

    });

    Route::group(['prefix' => 'category', 'namespace' => 'Admin'], function () {

        Route::get('/', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']);

        Route::post('/', ['as' => 'admin.category.postIndex', 'uses' => 'CategoryController@postIndex']);

        Route::get('/add', ['as' => 'admin.category.getAdd', 'uses' => 'CategoryController@getAdd']);

        Route::post('/add', ['as' => 'admin.category.postAdd', 'uses' => 'CategoryController@postAdd']);

        Route::get('/edit/{id}', ['as' => 'admin.category.getEdit', 'uses' => 'CategoryController@getEdit']);

        Route::post('/edit/{id}', ['as' => 'admin.category.postEdit', 'uses' => 'CategoryController@postEdit']);

        Route::get('/delete/{id}', ['as' => 'admin.category.delete', 'uses' => 'CategoryController@delete']);

    });

    Route::group(['prefix' => 'product', 'namespace' => 'Admin'], function () {

        Route::get('/', ['as' => 'admin.product.index', 'uses' => 'ProductController@index']);

        Route::post('/', ['as' => 'admin.product.postIndex', 'uses' => 'ProductController@postIndex']);

        Route::get('/add', ['as' => 'admin.product.getAdd', 'uses' => 'ProductController@getAdd']);

        Route::post('/add', ['as' => 'admin.product.postAdd', 'uses' => 'ProductController@postAdd']);

        Route::get('/edit/{id}', ['as' => 'admin.product.getEdit', 'uses' => 'ProductController@getEdit']);

        Route::post('/edit/{id}', ['as' => 'admin.product.postEdit', 'uses' => 'ProductController@postEdit']);

        Route::get('/delete/{id}', ['as' => 'admin.product.delete', 'uses' => 'ProductController@delete']);

    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
