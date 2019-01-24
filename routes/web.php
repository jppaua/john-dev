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

Auth::routes();
Route::get('register-merchant', 'RegisterMerchantController@index');
Route::post('register-merchant', 'RegisterMerchantController@register')->name('register-merchant');

Route::view('merchant-confirmed', 'confirmation.merchant');
Route::view('user-confirmed', 'confirmation.user');


Route::get('/', function () {
    return view('welcome');
});



//Route::get('/img/{path}', 'ImageController@show')->where('path', '.*');
//
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('{user}', 'UserController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('threads', 'ThreadsController@index');
Route::get('threads/create', 'ThreadsController@create');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show');
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy');

Route::post('/threads/{channel}/{thread}/upVote', 'UpVotesController@store');
Route::delete('/threads/{channel}/{thread}/upVote', 'UpVotesController@destroy');

Route::post('/threads/{channel}/{thread}/downVote', 'DownVotesController@store');
Route::delete('/threads/{channel}/{thread}/downVote', 'DownVotesController@destroy');

Route::post('threads', 'ThreadsController@store');
Route::get('threads/{channel}', 'ThreadsController@index');
//Route::resource('threads', 'ThreadsController');
Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::patch('/replies/{reply}', 'RepliesController@update');
Route::delete('/replies/{reply}', 'RepliesController@destroy');
Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->middleware('auth');

Route::post('replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('replies/{reply}/favorites', 'FavoritesController@destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
