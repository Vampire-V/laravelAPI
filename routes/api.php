<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'v1'
], function () {
    Route::get('/roles', 'PermissionController@Permission');
    Route::post('/login', 'UsersController@login');
    Route::post('/register', 'UsersController@register');
    Route::group([
        'middleware' => ['auth:api', 'role:manager,developer','active.token']
    ], function () {
        Route::get('/logout', 'UsersController@logout');
        Route::get('/user', 'UsersController@user');
        Route::apiResource('todo', 'TodoController');
    });
});