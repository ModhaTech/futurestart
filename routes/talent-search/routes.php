<?php

/*
|--------------------------------------------------------------------------
| Web Routes Star search
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'star-search'], function () 
{
    // Route::get('/{slug?}', 'SearchController@index')->name('search.index');
   Route::get('/{slug?}', 'SearchController@indexnew')->name('search.index');
  
});

//  Route::get('starr/{slug?}', 'SearchController@indexnew')->name('search.newstarr');
 Route::post('/search', 'TalentSearchController@index')->name('search');