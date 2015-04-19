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
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('players/new', ['as' => 'NewPlayer', 'uses' => 'PlayerController@create']);
Route::post('players', ['as' => 'StorePlayer', 'uses' => 'PlayerController@store']);
Route::get('players/{id}', ['as' => 'ShowPlayer', 'uses' => 'PlayerController@show']);
Route::get('players', ['as' => 'IndexPlayer', 'uses' => 'PlayerController@index']);

Route::get('parties/new', ['as' => 'NewPartie', 'uses' => 'PartieController@create']);
Route::post('parties', ['as' => 'StorePartie', 'uses' => 'PartieController@store']);
Route::get('parties/{id}', ['as' => 'ShowPartie', 'uses' => 'PartieController@show']);
Route::get('parties', ['as' => 'IndexPartie', 'uses' => 'PartieController@index']);

Route::get('participation/new/{nb}', ['as' => 'NewParticipation', 'uses' => 'ParticipationController@create']);


