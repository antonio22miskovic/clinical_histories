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
    	Route::post('me', 'Auth\AuthController@me');

		});

	// rutas de especialista
	Route::group(['prefix' => 'doctor'], function ($router) {

	 	Route::apiresource('quota', 'Api\Quota\QuotaController');

        Route::apiresource('waiting_list', 'Api\Waiting_list\Waiting_listController');

        Route::apiresource('patient', 'Api\Patient\PatientController');

	 	Route::apiresource('specialist', 'Api\Specialist\SpecialistController');
        Route::get('specialist/auth/user', 'Api\Specialist\SpecialistController@AuthUserSpecialist');
        Route::get('specialist/auth/user', 'Api\Specialist\SpecialistController@AuthUserSpecialist');

	});