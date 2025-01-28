<?php

/*
|--------------------------------------------------------------------------
| Web Routes Seller Dashboard
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'blog'], function () 
{
	 Route::get('/{blogId?}', 'BlogController@index')->name('blog.index');
    // Route::get('/{slug?}', 'BlogController@index')->name('blog.index');
    //Route::get('/{slug}', 'BlogController@singleDetailedRq')->name('blog.detailed');
    Route::any('/{category}/{blogId}', 'BlogController@singleDetailedRq')->name('blog.detailed');
    Route::any('/subscribe', 'BlogController@store')->name('blog.subscribe.store');
});
Route::get('public/index.php/blog/{category}/{blogId}', function () 
{
    return redirect('/blog/{category}/{blogId}');
});
Route::any('/blogComment', 'CommentController@index')->name('comment.blog');
Route::get('/blog-post', 'BlogController@blogPostpage')->name('blog.post');
Route::post('/blog-post-create', 'BlogController@blogPostpageCreate')->name('blog.post-create');