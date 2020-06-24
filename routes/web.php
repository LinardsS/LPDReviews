<?php

use Illuminate\Support\Facades\Route;
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

//Route::redirect('/','/en');

// Route::group(['prefix' => '{language}'], function() {
 
    Route::get('/', 'PagesController@index');
    Route::get('/about', 'PagesController@about');
    Route::get('/services', 'PagesController@services');


    Route::resource('reviews', 'ReviewsController');
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
    //Comments
    Route::post('comments/{review_id}', ['uses'=>'CommentsController@store', 'as'=>'comments.store']);
// });