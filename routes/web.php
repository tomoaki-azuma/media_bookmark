<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'verified'], function() {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/edit', 'HomeController@edit');

    Route::get('/bookmark/user/{user_id}', 'BookmarkController@show_by_uid')->where('id', '[0-9]+');
    Route::get('/bookmark/{id}', 'BookmarkController@show')->where('id', '[0-9]+');
    Route::get('/bookmark/create', 'BookmarkController@create');
    Route::post('/bookmark/store', 'BookmarkController@store');
    Route::get('/bookmark/edit/{id}', 'BookmarkController@edit')->where('id', '[0-9]+');
    Route::get('/bookmark/share', 'BookmarkController@share');
    Route::post('/bookmark/destroy', 'BookmarkController@destroy');
    Route::get('/bookmark/search_init', 'BookmarkController@search_init');
    Route::post('/bookmark/search', 'BookmarkController@search');
    Route::post('/bookmark/add_favorite_and_search', 'BookmarkController@add_favorite_and_search');
    Route::post('/bookmark/delete_favorite', 'BookmarkController@delete_favorite');
    Route::post('/bookmark/delete_favorite_and_search', 'BookmarkController@delete_favorite_and_search');
    Route::get('/bookmark/my_favorite', 'BookmarkController@init_my_favorite');
    Route::get('/bookmark/get_my_favorite', 'BookmarkController@my_favorite');

    Route::get('/program/bm/{bm_id}', 'ProgramController@show_by_bmid')->where('bm_id', '[0-9]+');
    Route::post('/program/store', 'ProgramController@store');
    Route::get('/program/show/{id}', 'ProgramController@show');
    Route::post('/program/destroy', 'ProgramController@destroy');
    Route::post('/program/metadata', 'ProgramController@metadata');

    Route::get('/user', 'UserController@index');
    Route::post('/user/store', 'UserController@store');

});


Route::get('/mbm/programs/{program}', 'MbmController@get_programs')->where('bm_id', '[0-9]+');
Route::get('/mbm/{share_token}', 'MbmController@index');

Route::get('/login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
Route::get('/login/twitter/callback', 'Auth\LoginController@handleTwitterCallback');
