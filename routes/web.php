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

Route::post('/app/create_tag', 'AdminController@addTag');
Route::post('/app/edit_tag', 'AdminController@editTag');
Route::get('/app/get_tags', 'AdminController@getTags');
Route::delete('/app/delete_tag/{id}', 'AdminController@deleteTag');
Route::post('/app/upload', 'AdminController@upload');

Route::get('/new', 'TestController@controllerMethod');

Route::get('/new/json', 'TestController@controllerMethodReturnJson');
Route::get('/new/withmeta/{id}', 'TestController@controllerMethodWithMeta');

Route::get('/new/{id}', function ($id) {
    return view('welcome');
});

Route::any('{slug}', function () {
    return view('welcome');
});

Route::any('{slug1}/{slug2}', function () {
    return view('welcome');
});

Route::any('{slug1}/{slug2}/{slug3}', function () {
    return view('welcome');
});