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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/hello', 'AdminController@hello');
    Route::get('posts', 'AdminController@index')->name('posts.index');
    Route::get('posts/create', 'AdminController@create')->name('posts.create');
    Route::get('posts/edit/{group}/{id}', 'AdminController@edit')->name('posts.edit');
    Route::post('posts/update/{id}', 'AdminController@update')->name('posts.update');
    Route::post('posts/delete/{id}', 'AdminController@destroy')->name('posts.delete');
    Route::post('posts/mediaAdd/{id}', 'AdminController@mediaAdd')->name('posts.mediaAdd');
    Route::get('posts/mediaGet/{id}', 'AdminController@mediaGet')->name('posts.mediaGet');
    Route::post('posts/mediaDelete', 'AdminController@mediaDelete')->name('posts.mediaDelete');
    Route::get('posts/mediaActivate', 'AdminController@mediaActivate')->name('posts.mediaActivate');
});
// Route::prefix('admin')->group(function() {
//     Route::get('/', 'AdminController@index');
//     Route::get('/hello', 'AdminController@hello');
//     Route::get('posts', 'AdminController@index')->name('posts.index');
//     Route::get('posts/create', 'AdminController@create')->name('posts.create');
//     Route::get('posts/edit/{group}/{id}', 'AdminController@edit')->name('posts.edit');
//     Route::post('posts/update/{id}', 'AdminController@update')->name('posts.update');
//     Route::post('posts/delete/{id}', 'AdminController@destroy')->name('posts.delete');
//     Route::post('posts/mediaAdd/{id}', 'AdminController@mediaAdd')->name('posts.mediaAdd');
//     Route::get('posts/mediaGet/{id}', 'AdminController@mediaGet')->name('posts.mediaGet');
//     Route::post('posts/mediaDelete', 'AdminController@mediaDelete')->name('posts.mediaDelete');
//     Route::get('posts/mediaActivate', 'AdminController@mediaActivate')->name('posts.mediaActivate');
// });
