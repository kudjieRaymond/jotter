<?php

use Illuminate\Http\Request;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['namespace'=>'Api', 'middleware' => 'cors', 'prefix'=> 'v1'], function(){
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');

	Route::group(['middleware' =>['auth:api']] , function(){
		Route::post('refresh', 'AuthController@refresh');
		Route::post('logout', 'AuthController@logout');
		Route::post('me', 'AuthController@me');


		Route::apiResource("tasks", "TaskController");

		//Route::post("tasks/create", "TaskController@store")->name('tasks.create');
	});
});
