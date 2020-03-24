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
//Artisan commands
//Clear Cache facade value:
Route::get('/clear-cache', 'ArtisanController@clearCache');
//Reoptimized class loader:
//Route::get('/optimize',  'ArtisanController@optimize');
//Route cache:
Route::get('/route-cache',  'ArtisanController@routeCache');
//Clear Route cache:
Route::get('/route-clear',  'ArtisanController@routeClear');
//Clear View cache:
Route::get('/view-clear',  'ArtisanController@viewClear');
//Clear Config cache:
Route::get('/config-cache',  'ArtisanController@configCache');
Route::get('/storage-link',  'ArtisanController@storageLink');
Route::get('change/{locale}','ArtisanController@changeLang')->name('languageChange'); 
Auth::routes();

Route::prefix('admin')->group(function() {
    Route::get('/', 'Admin::AdminController@index');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'locale']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::prefix('{lang?}')->middleware('locale')->group(function() {

    Route::get('/', 'LoctechController@index')->name('home');
    Route::get('/contacts', 'LoctechController@contacts')->name('contacts');
    Route::get('/products', 'LoctechController@products')->name('products');
    Route::get('/products/{alias}', 'LoctechController@products_view')->name('products.view');
    Route::get('/services', 'LoctechController@services')->name('services');


});






//PROGRAMS LIST
// Route::get('programs', 'ProgramsController@programs_list')->name('programs_list')->middleware('auth');
// Route::get('programs/create', 'ProgramsController@programs_create')->name('programs_create')->middleware('auth');
// Route::get('programs/edit/{id}', 'ProgramsController@progarms_edit')->name('programs_edit')->middleware('auth');
// Route::post('programs/update/{id}', 'ProgramsController@programs_update')->name('programs_update')->middleware('auth');
//PROGRAMS LIST
// SLOTS
// Route::get('slots', 'ProgramsController@slots_list')->name('slots_list')->middleware('auth');
// Route::post('slots/create', 'ProgramsController@slots_create')->name('slots_create')->middleware('auth');
// Route::get('slots/edit/{id?}', 'ProgramsController@slots_edit')->name('slots_edit')->middleware('auth');
// SLOTS
// ASSIGNS
// Route::get('assigns', 'ProgramsController@assigns_list')->name('assigns_list')->middleware('auth');
// Route::post('assigns/create', 'ProgramsController@assigns_create')->name('assigns_create')->middleware('auth');
// Route::get('assigns/edit/{id?}', 'ProgramsController@assigns_edit')->name('assigns_edit')->middleware('auth');
// ASSIGNS