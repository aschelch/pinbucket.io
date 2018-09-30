<?php

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
  if(Auth::check()){
    return redirect('home');
  }
  return view('welcome');
});

Auth::routes();

Route::get('/home/{team?}', 'HomeController@index')->name('home');

Route::get('/teams', 'TeamsController@index')->name('team.index');
Route::get('/team', 'TeamsController@add')->name('team.add');
Route::post('/team', 'TeamsController@create');
Route::get('/join', 'TeamsController@join')->name('team.join');
Route::post('/join', 'TeamsController@joining');

Route::post('/link', 'LinksController@create');
