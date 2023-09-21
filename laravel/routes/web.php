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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ミーティング 一覧
Route::get('/meetings/', 'MeetingsController@index')->name('meetings_index');

//ミーティング 登録
Route::get('/meetings/create', 'MeetingsController@create')->name('meetings_create');

//ミーティング 登録 - 保存
Route::post('/meetings/store', 'MeetingsController@store')->name('meetings_store');

//ミーティング 編集
Route::get('/meetings/edit/{id}', 'MeetingsController@edit')->name('meetings_edit');

//ミーティング 削除
Route::get('/meetings/delete/{id}', 'MeetingsController@delete')->name('meetings_delete');

//ユーザー 一覧
Route::get('/users/', 'UsersController@index')->name('users_index');

//ユーザー 登録
Route::get('/users/create', 'UsersController@create')->name('users_create');

//ユーザー 登録 - 保存
Route::post('/users/store', 'UsersController@store')->name('users_store');

//ユーザー 編集
Route::get('/users/edit/{id}', 'UsersController@edit')->name('users_edit');

//ユーザー 削除
Route::get('/users/delete/{id}', 'UsersController@delete')->name('users_delete');
