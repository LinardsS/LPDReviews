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
    Route::get('/admin', 'PagesController@admin');


    Route::resource('reviews', 'ReviewsController');
    Auth::routes();

    //Categories
    Route::resource('categories', 'CategoriesController', ['except' => ['create']]);

    Route::get('/home', 'HomeController@index')->name('home');
    //Comments
    Route::post('comments/{review_id}', ['uses'=>'CommentsController@store', 'as'=>'comments.store']);

    //Admin role
    Route::group(['middleware' => ['auth']], function () {
      Route::get('/user', 'DemoController@userDemo')->name('user');
      
      Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin', 'PagesController@admin')->name('admin');
      });
    });
    //Locales
    Route::get('setlocale/{locale}', function ($locale) {
        if (in_array($locale, \Config::get('app.locales'))) {
          session(['locale' => $locale]);
        }
        return redirect()->back();
      });
// });