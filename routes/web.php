<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'JobsController@index');
Route::post('/feed', 'JobsController@feed')->middleware('cors');
Route::get('/advanced-search', 'JobsController@search');
Route::get('/login', 'PagesController@login');
Route::post('/login', 'PagesController@login');
Route::get('/pipeline/{name}', 'PagesController@pipeline');
Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@sendContact');
Route::get('/category/{cat}', 'JobsController@category');
Route::get('/cities/{cat}', 'JobsController@city');
Route::get('/companies/{cat}', 'JobsController@company');
Route::get('/job/{id}', 'JobsController@show');
Route::get('/out/{id}', 'JobsController@redirectTo');
Route::get('/views', function() {
    return \App\View::all()->groupBy('job')->toArray();
});
Route::get('/views', function() {
    return \App\View::all()->groupBy('job')->toArray();
});
Route::get('/views/{company}', 'JobsController@views');
Route::get('/redirects', function() {
    return \App\Redirect::all()->toArray();
});
Route::get('/redirects/{company}', 'JobsController@clicks');
