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

//api/auth/
  route::group(['prefix' => 'auth', 'middleware' => 'cors'], function(){
  route::post('register', 'Auth\AuthController@register');
  route::post('login', 'Auth\AuthController@login');
  route::get('logout', 'Auth\AuthController@logout')->middleware('auth:api');
  route::get('user', 'Auth\AuthController@getUser')->middleware('auth:api'); //The authenticated user
  route::get('profile', 'Auth\AuthController@getProfile')->middleware('auth:api');
  route::get('users', 'Auth\AuthController@allUsers')->middleware('auth:api');
  route::get('user/{id}', 'Auth\AuthController@getOneUser')->middleware('auth:api'); //get single user
  route::post('update-profile', 'Auth\AuthController@updateProfile')->middleware('auth:api');
});

//countries and genders;
Route::group(['prefix' => 'user', 'middlware' => 'cors'], function(){
  route::get('countries', 'Country\CountryController@index');
  route::get('genders', 'Gender\GenderController@index');
});

//photo and gallery

Route::group(['prefix' => 'user', 'middlware' => 'cors'], function(){
  route::get('photos', 'Photos\PhotoController@index')->middleware('auth:api');
  route::post('add_photos', 'Photos\PhotoController@store')->middleware('auth:api');
});


//test endpoint
//api/fake-data/faker; route
route::prefix('fake-data')->group(function(){
  route::get('/faker', 'FakeController@index')->middleware('auth:api');
});