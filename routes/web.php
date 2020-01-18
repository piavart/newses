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

Route::get('/', 'NewsController@Index')->name('index');
Route::post('/', 'NewsController@IndexPost');


Route::get('/create', 'NewsController@CreateForm')->name('create');
Route::post('/create', 'NewsController@CreateNewsPost');

Route::get('/news/{id}', 'NewsController@GetSingleNews')->name('single_news');
Route::get('/news/{id}/edit', 'NewsController@GetEditNews')->name('edit_news');
Route::post('/news/{id}/edit', 'NewsController@PostEditNews');
Route::post('/news/{id}/update', 'NewsController@UpdateNews');