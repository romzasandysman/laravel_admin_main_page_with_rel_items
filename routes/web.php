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
Auth::routes();

//GET ROUTES
Route::get('/', 'IndexController@index')->name('index');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/', 'AdminController@index')->name('admin')->middleware('admin');
    Route::get('/admin/add_filial/', 'AdminController@pageAddFillials')->name('admin.filials')->middleware('admin');
    Route::get('/admin/add_station/', 'AdminController@pageAddStation')->name('admin.station')->middleware('admin');

    //POST ROUTES
    Route::post('/admin/add_filial/', 'AdminController@pageAddFillials');
    Route::post('/admin/add_station/', 'AdminController@pageAddStation');
});


