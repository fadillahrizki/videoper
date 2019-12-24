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

Route::get('search','HomeController@search')->name('search');
Route::get('filter','HomeController@filter')->name('filter');
Route::get('','HomeController@index')->name('home');
Route::post('comment','HomeController@comment')->name('comment');

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('','AdminController@index')->name('admin.index');
    Route::post('addImage','AdminController@addImage')->name('admin.addImage');
    Route::post('follow','AdminController@follow')->name('admin.follow');

    Route::prefix('followers')->group(function(){
        Route::get('','FollowerController@index')->name('followers.index');
    });

    Route::prefix('videos')->group(function(){
        Route::get('','VideoController@index')->name('videos.index');
        Route::get('search','VideoController@search')->name('videos.search');
        Route::match(['get','post'],'create','VideoController@create')->name('videos.create');
        Route::match(['get','post'],'update/{id}','VideoController@update')->name('videos.update');
        Route::get('{id}','VideoController@single')->name('videos.single');
        Route::get('delete/{id}','VideoController@delete')->name('videos.delete');
    });

    Route::get('{id}/search','AdminController@search')->name('admin.search');
    Route::get('{id}','AdminController@profile')->name('admin.profile');
});

Route::get('{id}','HomeController@single')->name('single');
Route::get('comment/{id}','HomeController@deleteComment')->name('deleteComment');




