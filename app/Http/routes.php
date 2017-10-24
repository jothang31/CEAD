<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
| 
| Route::get('/', function () {return view('welcome');});
|
*/


Route::get('login', 'LoginController@show');
Route::post('login', 'LoginController@singin');
Route::get('logout', 'LoginController@singout');

Route::group(['middleware' => 'usersession'], function () {

	Route::get('/', 'HomeController@show');
	Route::get('me', 'MeController@show');

	Route::group(['middleware' => 'userprofile'], function () {
		
		Route::get('admin/user', 'UserController@show');
		Route::get('admin/user/new', 'UserController@newShow');
		Route::post('admin/user/new/save', 'UserController@save');
		Route::get('admin/user/update', 'UserController@updateShow');
		Route::post('admin/user/update/save', 'UserController@update');
		Route::post('user/get', 'UserController@get');
		Route::get('user/get/match', 'UserController@getMatch');

		Route::get('admin/institution/structure', 'InstitutionStructureController@show');
		Route::post('admin/institution/structure/get', 'InstitutionStructureController@get');
		Route::post('admin/institution/structure/save', 'InstitutionStructureController@save');
		Route::get('admin/institution/structure/update', 'InstitutionStructureController@update');
		Route::get('admin/institution/structure/subgroup', 'InstitutionStructureController@subgroup');

		Route::get('admin/region', 'RegionController@show');
		Route::get('admin/region/new', 'RegionController@newShow');
		Route::get('admin/region/new/save', 'RegionController@save');
		Route::get('admin/region/update', 'RegionController@updateShow');
		Route::get('admin/region/update/save', 'RegionController@update');

		Route::get('admin/meet', 'MeetController@show');

		Route::get('countrydepartment/get', 'CountryDepartmentController@get');
		Route::get('countrydepartment/save', 'CountryDepartmentController@save');
		Route::get('countrydepartment/update', 'CountryDepartmentController@update');
		Route::get('municipality/get', 'MunicipalityController@get');
		Route::get('municipality/save', 'MunicipalityController@save');
		Route::get('municipality/update', 'MunicipalityController@update');
		Route::get('zone/get', 'ZoneController@get');
		Route::get('zone/save', 'ZoneController@save');
		Route::get('zone/update', 'ZoneController@update');

	});

});
