<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RSSFeedController;
use App\Http\Controllers\blogsitemapController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SearchController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


    // ******************* IOS Domain Verification Code ***************** \\


Route::get('.well-known/apple-developer-merchantid-domain-association.txt', function () 
{
    // Replace the content with the actual content of your verification file
    $verificationContent = config('ios_verification_domain.ios_key');

    // Set the appropriate response headers for the verification file
    return response($verificationContent, 200)
        ->header('Content-Type', 'text/plain');
});

//Auth::routes(['login' => false]);
Route::group(['middleware' => ['XSS']], function () 
{
Route::get('/clear', function() 
{
    
    Artisan::call('config:clear');
  Artisan::call('config:cache');
  Artisan::call('route:clear');
  Artisan::call('cache:clear');
    
    return " config Cache is cleared";
});



// Route::get('/sitemap', function() 
// {
//     Artisan::call('make:controller blogsitemapController');
//     return "successs controller ";
// });




// Route::get('/emailtest', function () {
//     try {
//         Mail::raw('This is a test email', function ($message) {
//             $message->to('rohitgannote9009@gmail.com')
//                     ->subject('Test Email');
//         });
//         return 'Test email sent!';
//     } catch (\Exception $e) {
//         Log::error('Mail sending failed: ' . $e->getMessage());
//         return 'Failed to send email: ' . $e->getMessage();
//     }
// });




Route::get('/home', function()
{
    return redirect('/');
});
Route::get('/public', function () 
{
    return redirect('/');
});
Route::get('public/index.php/blog/{cat}/{slug}', function () 
{
    return redirect('/blog/{cat}/{slug}');
});
// Route::middleware(['htmlMinifier'])->group(static function(){
// Route::get('/', 'HomeController@index')->name('home');
Route::get('home_more', 'HomeController@home_more')->name('home.more');    

// Route::get('newhome', 'HomeController@newhome')->name('newhome');
// Route::get('homenew', 'HomeController@homenew')->name('homenew');

    Route::get('/', 'HomeController@newhome2')->name('home');

// });
//  Route::get('starr/{slug?}', [SearchController::class, 'indexnew'])->name('search.newstarr');

Route::get('/old', 'HomeController@oldhomepage')->name('old');
Route::post('/search-chat-users', 'HomeController@searchChatUsers')->name('search-chat-users');
Route::get('/user-block', 'HomeController@userBlockbyAdmin')->name('user.block');

Route::get('/approve-talent/{id}', 'HomeController@approveTalent')->name('approve.talent');
Route::get('/admin-talent-preview/{id}', 'HomeController@viewTalentForAdmin')->name('admin.talent.preview');

Route::group(['prefix' => 'buyer','middleware' => ['auth', 'buyer']], function () 
{
    Route::get('/shopping-cart', 'CartController@index')->name('cart.index');
    Route::get('/update-card', 'CartController@updateCard')->name('update.card');
    Route::post('/update-card', 'CartController@updateCard')->name('update.card.post');
    Route::post('/shopping-cart-hot', 'CartController@stripeHotpay')->name('cart.index.hot');
    Route::post('/shopping-cart-ps', 'CartController@stripePaymentSelectpay')->name('cart.index.ps');
    Route::post('/shopping-cart', 'CartController@storeStripe')->name('cart.index.post');
   Route::post('/deleteCartItem', 'CartController@deleteCartItem')->name('cart.delete-item');
});
  
Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
Route::post('paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));
Route::post('pay-with-stripe', array('as' => 'pay-with-stripe','uses' => 'PaymentController@payWithStripe'));

Route::get('paypal-payment-cancel', array('as' => 'payment.cancel','uses' => 'PaymentController@paymentCancel'));
Route::get('paypal-payment-success', array('as' => 'payment.success','uses' => 'PaymentController@paymentSuccess'));

Route::post('/image-upload', 'SellerController@imageUpload')->name('image-upload');

Route::get('/delete-account/', 'CommonuserController@index')->middleware('verified')->name('user.delete-account');
Route::post('/post-delete-account/', 'CommonuserController@deleteAccount')->name('delete-account');
Route::get('/talent-mail-to-buyers', 'CommonuserController@newAddedTalentMailToBuyers')->name('talent-mail-to-buyers');

Route::post('api/init-guest-chat', 'Admin\SupportChatGuestController@initGuestFront')->name('front.guest.chat.init');
Route::post('api/send/message/guest', 'Admin\SupportChatGuestController@store')->name('guest.chat.message.store');
Route::post('api/send/message/user', 'Admin\SupportChatGuestController@storeUser')->name('user.chat.message.store');
Route::get('api/get-unread-message/guest/{sender_id}', 'Admin\SupportChatGuestController@getUnreadMessagesGuest')->name('guest.chat.get.unread');
Route::get('api/get-unread-message/user/{sender_id}', 'Admin\SupportChatGuestController@getUnreadMessagesUser')->name('user.chat.get.unread');

Auth::routes();

// we will update the Register page next to begin the 2nd phase of the overhaul to bring this application into 2025
//Route::get('/register', [RegisterController::class, 'showRegistrationFormInertia'])->middleware('guest')->name('register');

Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages')->name('load-latest-message');
Route::post('/send', 'MessagesController@postSendMessage')->name('send-message');
Route::post('/send/del', 'MessagesController@deleteMessage');
Route::get('/fetch-old-messages', 'MessagesController@getOldMessages')->name('old-message');

Route::get('/get-user-card/{card_id}', 'BillingAccountController@getCardDetails');

/*
|--------------------------------------------------------------------------
| Buyer and seller public profile route start.
|--------------------------------------------------------------------------
*/

Route::get('/buyer/{id}', 'PublicProfileController@index')->name('buyer-public-profile');
Route::get('/seller/{id}', 'PublicProfileController@create')->name('seller-public-profile');
Route::post('/profile-visitor', 'PublicProfileController@visitorProfile')->name('profile-visitor');
Route::post('/stream-visitor', 'PublicProfileController@visitorStream')->name('stream-visitor');
Route::post('/stream-visitor_comment', 'PublicProfileController@visitorStreamComment')->name('liveviewer-Comment');

Route::group(['prefix' => 'message', 'middleware' => 'auth' ], function () {
    Route::post('/send', 'PublicProfileController@store')->name('public.profile.message.send');
});
Route::group(['prefix' => 'rider', 'middleware' => 'auth'], function () {
    Route::post('/add', 'PublicProfileController@update')->name('public.profile.rider.add');
});
Route::group(['prefix' => 'user', 'middleware' => 'auth' ], function () {
    Route::post('/unfollow/{id}/{authid}', 'PublicProfileController@unfollowUser')->name('unfollow.user');
});
Route::group(['prefix' => 'favourite-user', 'middleware' => 'auth' ], function () {
    Route::post('/create/{id}', 'FavouriteUserController@index')->name('add-fav-user');
});

Route::group(['prefix' => 'notification', 'middleware' => 'auth' ], function () {
    Route::post('/send', 'FavouriteUserController@send_notification')->name('send-notification');
});

Route::group(['prefix' => 'chat-users', 'middleware' => 'auth' ], function () {
    Route::get('/', 'HomeController@users')->name('chat-users');
});

/*
|--------------------------------------------------------------------------
| Buyer and seller public profile route end
|--------------------------------------------------------------------------
*/

//  /*** Verification Routes */

Route::group(['middleware' => 'auth'], function () 
{
    Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
});
    
     /*** Verification Routes */
     
// Start Video Route

Route::group(['prefix' => 'video','middleware' => 'auth'], function () 
{
       // Start Video Calling Code
    Route::get('/video-calling-storedata', 'BuyerController@videoCallingStoredata')->name('video.videostoredata');
    Route::get('/video-calling-cancle', 'BuyerController@videoCallingCancle')->name('video.callingCancle');
    Route::get('/video-calling-getreceiverdata', 'BuyerController@videoCallinggetdata')->name('video.videogetreceiverdata');
    Route::get('/video-calling-popupcancel', 'BuyerController@videoPopupcancelsr')->name('video.videopopupcancel');
        // End video Calling code

        // Start Live Stream video route
    Route::get('/live-page', 'BuyerController@liveStreamPage')->name('livestream.live-page');
    Route::get('/live-page-view', 'BuyerController@liveStreamPageview')->name('livestream.live-page-view');
    Route::get('/live-page-videoget/{id}', 'BuyerController@liveStreamPageVideoget')->name('livestream.live-pageget');
    Route::post('/live-page-store-data', 'BuyerController@liveStreamPageStoreData')->name('livestream.live-page-store-data');
    Route::post('/live-page-data-get', 'BuyerController@liveStreamStoreDataget')->name('livestream.userstatus');
    Route::post('/live-stream-viewcount', 'BuyerController@liveStreamViewCount')->name('livestream.liveviewCount');

    // End Live Stream video route

});

Route::group(['prefix' => 'riders', 'middleware' => 'auth' ], function () 
{         
    Route::get('/', 'RidersController@index')->name('riders.index');
});
Route::post('/checkout', 'CartController@afterpayment')->name('checkout.credit-card');

Route::get('buyer-seller/chat-message/{id}', 'ChatMessageController@chat');
Route::get('buyer-seller/refresh-message/{lmi}/{rec}', 'ChatMessageController@refreshMessage');
Route::post('buyer-seller/chat-message', 'ChatMessageController@sendMessage');
Route::get('buyer-seller/inbox-message/{cond}', 'ChatMessageController@getInboxMessage');
Route::get('buyer-seller/getalluser', 'ChatMessageController@getAllUser');
Route::get('buyer-seller/getallreaduser', 'ChatMessageController@getAllReadMsg');
Route::get('buyer-seller/getallunreaduser', 'ChatMessageController@getAllUnreadMsg');
Route::get('buyer-seller/delete-message/{id}', 'ChatMessageController@deleteInboxMessage');
Route::post('buyer-seller/check-delete-message', 'ChatMessageController@checkDeleteInboxMessage');
Route::get('buyer-seller/auto-reply', 'ChatMessageController@sendAutoMessage');

Route::post('/blogs/save-other-liks', 'BlogController@addBlogLinks');


Route::post('/stripe-callback-status', 'Api\PaymentController@stripeCallbackStatus');

Route::get('talent-mall/product-info/N/A', function()
{
    return back();
});

Route::get('video-call/sender/{id}', 'AudioVideoController@send_call');
Route::get('video-call/receiver/{id}', 'AudioVideoController@receive_call');
Route::get('audio-call/sender/{id}', 'AudioVideoController@audio_send_call');
Route::get('audio-call/receiver/{id}', 'AudioVideoController@audio_receive_call');
Route::get('/live-stream-start/{id}', 'AudioVideoController@liveStreamStart');
Route::get('/live-stream-view/{id}', 'AudioVideoController@liveStreamView');


//sitemap
Route::get('sitemap.xml', 'XmlSitemapController@index');
Route::get('news-sitemap.xml', 'NewsXmlSitemapController@index');
Route::get('/testing', 'TestsitemapController@index');
// Route::get('new1-sitemap.xml', [blogsitemapController::class, 'index']);
//RSS Feed
Route::get('feed', [RSSFeedController::class, 'index']);
Route::get('comments-feed', [RSSFeedController::class, 'comments']);

});

