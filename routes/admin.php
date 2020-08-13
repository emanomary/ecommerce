<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
define('PAGINATION_COUNT',10);
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
//route for logout user
/*Route::get('/logout', static function () {
    Auth::logout();
    return redirect('/login');
});*/

Route::group(['middleware'=>'Auth:admin','namespace'=>'Admin'],function (){

    Route::get('/','DashboardController@index')->name('admin.dashboard');

    /************ begin languages route ***************************************/
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/','LanguagesController@index')->name('admin.languages.index');
        Route::get('create','LanguagesController@create')->name('admin.languages.create');
        Route::post('store','LanguagesController@store')->name('admin.languages.store');
        Route::get('edit/{id}','LanguagesController@edit')->name('admin.languages.edit');
        Route::post('update/{id}','LanguagesController@update')->name('admin.languages.update');
        Route::get('delete/{id}','LanguagesController@destroy')->name('admin.languages.delete');
    });
    /************ end languages route ***************************************/

    /************ begin main categories route ***************************************/
    Route::group(['prefix' => 'main-categories'], function () {
        Route::get('/','MainCategoryController@index')->name('admin.mainCategories.index');
        Route::get('create','MainCategoryController@create')->name('admin.mainCategories.create');
        Route::post('store','MainCategoryController@store')->name('admin.mainCategories.store');
        Route::get('edit/{id}','MainCategoryController@edit')->name('admin.mainCategories.edit');
        Route::post('update/{id}','MainCategoryController@update')->name('admin.mainCategories.update');
        /*Route::get('delete/{id}','MainCategoryController@destroy')->name('admin.mainCategories.delete');*/
    });
    /************ end main categories route ***************************************/

    /************ begin vendors route ***************************************/
    Route::group(['prefix' => 'vendors'], function () {
        /*Route::get('/','VendorController@index')->name('admin.vendors.index');
        Route::get('create','VendorController@create')->name('admin.vendors.create');
        Route::post('store','VendorController@store')->name('admin.vendors.store');
        Route::get('edit/{id}','VendorController@edit')->name('admin.vendors.edit');
        Route::post('update/{id}','VendorController@update')->name('admin.vendors.update');
        Route::get('delete/{id}','VendorController@destroy')->name('admin.mainCategories.delete');*/
    });
    /************ end vendors route ***************************************/
});


Route::group(['middleware'=>'guest:admin','namespace'=>'Admin'],function (){
    Route::get('login','LoginController@getLogin')->name('admin.auth.login');
    Route::post('login','LoginController@login')->name('admin.login');
});


/*Route::get('testhelper',function (){
    return show_name();
});*/
