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
Route::post('/login/user', 'CustomLoginController@loginUser')->name('login.user');

// Route::get ( '/callback-facebook/{service}', 'SocialAuthFacebookController@callback' );
// Route::get ( '/redirect-facebook/{service?}', 'SocialAuthFacebookController@redirect' )->name('facebook');

Route::get('login/facebook', 'SocialAuthFacebookController@redirectToFacebook')->name('signin_with_facebook');
Route::get('login/facebook/callback', 'SocialAuthFacebookController@handleFacebookCallback');

Route::get('login/linkedin', 'SocialAuthLinkedinController@redirectToLinkedin')->name('signin_with_linkedin');
Route::get('login/linkedin/callback', 'SocialAuthLinkedinController@handleLinkedinCallback');

Route::get ( '/callback-twitter/{service}', 'SocialAuthTwitterController@callback' );
Route::get ( '/redirect-twitter/{service?}', 'SocialAuthTwitterController@redirect' )->name('twitter');

// Route::get ( '/callback-linkedin/{service}', 'SocialAuthLinkedinController@callback' );
// Route::get ( '/redirect-linkedin/{service?}', 'SocialAuthLinkedinController@redirect' )->name('linkedin');