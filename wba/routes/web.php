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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/check', 'HomeController@check')->name('check');
Auth::routes();

//Admin
Route::name('admin.')->group(function () {
	Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
        Route::get('dashboard', 'Admin\HomeController@index')->name('dashboard');
        Route::resource('customer','Admin\CustomerController');
        Route::get('printBorrow', 'Admin\CustomerController@printBorrow')->name('printBorrow');
        Route::get('printSaving', 'Admin\CustomerController@printSaving')->name('printSaving');
        Route::resource('borrow','Admin\BorrowController');
        Route::resource('saving','Admin\SavingController');
    });
});
//User
Route::name('user.')->group(function () {
	Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
        Route::get('dashboard', 'User\UserController@index')->name('dashboard');
        Route::get('borrow', 'User\UserController@borrow')->name('borrow');
        Route::get('saving', 'User\UserController@saving')->name('saving');
        Route::get('edit/{id}', 'User\UserController@edit')->name('edit');
        Route::post('edit/update/{id}', 'User\UserController@update')->name('update');
    });
});
