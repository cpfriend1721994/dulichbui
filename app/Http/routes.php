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
Route::auth();
Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', 'HomeController@index');
Route::get('user/{id}','UserController@show');
Route::get('tour/{id}','TourController@show');

Route::group(['middleware' => 'user'], function () {

    Route::post('user/{id}','UserController@update');

    Route::post('link_create','TourController@createLink');
    Route::post('link_update','TourController@updateLink');
    Route::post('link_delete','TourController@deleteLink');
    Route::post('link_update_by_own','TourController@updateLinkByOwn');
    
    
    Route::post('tour_create','TourController@create');
    Route::post('tour_update/{id}','TourController@update');
    Route::get('tour_destroy/{id}','TourController@destroy');

    Route::post('plan','PlanController@show');
    Route::post('plan_create/{id}','PlanController@create');   
    Route::get('plan_destroy/{id}','PlanController@destroy');
    Route::get('plan_delete_photo/{id}','PlanController@deletePhoto');
    Route::post('plan_update/{id}','PlanController@update');
    Route::post('plan_update_photo/{id}','PlanController@updatePhoto');

    Route::post('comment_create','CommentController@create');
    Route::post('comment_update/{id}','CommentController@update');
    Route::get('comment_destroy/{id}','CommentController@destroy');
});
