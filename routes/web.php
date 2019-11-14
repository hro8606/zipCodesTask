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

Route::get('/', 'PagesController@index');
Route::get('/live_search/action', 'PagesController@action')->name('live_search.action');
Route::get('/add', 'AddController@index');
Route::post('/add', 'AddController@store');
