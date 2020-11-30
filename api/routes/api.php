<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

		// rutas de autenticazion
	Route::group(['prefix' => 'auth'], function ($router) {

	    	Route::post('login', 'Auth\AuthController@login');
	    	Route::post('logout', 'Auth\AuthController@logout');
	        Route::post('refresh', 'Auth\AuthController@refresh');
	    	Route::post('get-auth-user', 'Auth\AuthController@getAuthUser');

		});