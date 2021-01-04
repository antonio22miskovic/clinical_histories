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

        Route::apiresource('user', 'Api\User\UserController');

        Route::apiresource('waiting_list', 'Api\Waiting_list\Waiting_listController');

        Route::get('waiting_list/detect/{ci}', 'Api\Waiting_list\Waiting_listController@detectPatient');

        Route::apiresource('patient', 'Api\Patient\PatientController');

        Route::apiresource('medical/record', 'Api\Medical_record\Medical_recordController');

        Route::apiresource('medical/treatment', 'Api\Medical_treatment\Medical_treatmentController');

        Route::apiresource('diagnosi', 'Api\Diagnosi\DiagnosiController');

        Route::apiresource('disease', 'Api\Disease\DiseaseController');

        Route::apiresource('medical/consultation', 'Api\Medical_consultation\Medical_consultationController');

	 	Route::apiresource('specialist', 'Api\Specialist\SpecialistController');

        Route::get('specialist/auth/user', 'Api\Specialist\SpecialistController@AuthUserSpecialist');

        Route::get('specialist/auth/user', 'Api\Specialist\SpecialistController@AuthUserSpecialist');

	});