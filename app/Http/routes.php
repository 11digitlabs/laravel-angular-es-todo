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

Route::get( '/', 'AppController@index' );



Route::group( [ 'prefix' => 'api/v1' ], function () {
    Route::get( 'tasks/search/{name?}', 'TasksController@search' );
    Route::resource( 'tasks', 'TasksController' );
} );

