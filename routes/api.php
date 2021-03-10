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

//api/auth/register; route
route::prefix('auth')->group(function(){
  route::post('register', 'Auth\AuthController@register');
  route::post('login', 'Auth\AuthController@login');
  route::get('logout', 'Auth\AuthController@logout')->middleware('auth:api');
  route::get('user', 'Auth\AuthController@getUser')->middleware('auth:api');
});

//api/fake-data/faker; route
route::prefix('fake-data')->group(function(){
  route::get('/faker', 'FakeController@index');
});