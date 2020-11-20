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

Route::get('routers/token', 	['as' => 'router.token', 	'uses' => 'RouterController@getToken']);

Route::get('routers', ['as' => 'router.index', 	'uses' => 'RouterController@index']);
Route::get('routers/create', 	['as' => 'router.create', 	'uses' => 'RouterController@create']);
Route::post('routers/store', 	['as'=>  'router.store', 	'uses' => 'RouterController@store']);
Route::get('routers/{id}/edit', ['as'=>  'router.edit', 	'uses' => 'RouterController@edit']);
Route::patch('routers/{id}', 	['as'=>  'router.update', 	'uses' => 'RouterController@update']);