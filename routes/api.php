<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api-access'], 'prefix' => '/v1'], function () 
{
    // User Registeration Process All Steps Routes
    Route::get('/user/notification', 'Api\UserController@usernotification');
    Route::get('/user/notification2', 'Api\UserController@usernotification2');
    Route::post('/user/login', 'Api\UserController@authenticate');
    
    
    //get all followers
    Route::post('/get-all-followers', 'Api\SocialBuzzController@getFollowers');
    Route::post('/followers-send-mail', 'Api\SocialBuzzController@followersSendMail');

    /* Signup & Signin through Apple */
    Route::get('/apple/redirect','Api\UserController@redirectToApple');
    Route::get('/apple/callback','Api\UserController@handleAppleCallback');
    
    
    /* Signup though facebook */
    Route::post('/user/facebook_register', 'Api\UserController@socialUserRegister');
    Route::post('/user/linkedin_register', 'Api\UserController@socialUserRegister');
    Route::post('/user/twitter_register', 'Api\UserController@socialUserRegister');

    Route::get('/trending-list/{userid}', 'Api\PublicProfileController@getTrendingsList');
    Route::get('/similar-product-list/{userid}', 'Api\PublicProfileController@getSimilarProductList');
    
    Route::get('/public-profile/{userid}/profile', 'Api\PublicProfileController@sellerPublicProfile');
    Route::post('/user', 'Api\UserController@register');
    
    Route::get('/verify/{token}', 'Api\UserController@verifyUser');  
    Route::post('/user/forgot-password', 'Api\PasswordController@forgotPassword');
    Route::get('/forgot/validate-url/{token}', 'Api\PasswordController@validateURL');
    Route::post('/user/reset-password', 'Api\PasswordController@setNewUserPasswordRq');

    Route::post('/contact-us', 'Api\ContactUsController@contactUs');
    // Talent open Api routes

    Route::get('/futurestarr/marketplace', 'Api\TalentCategoryController@futureStarrMarketplace');
    
    Route::get('/category/{id}/detail', 'Api\TalentCategoryController@categoryById');
    Route::post('/contact-us', 'Api\UserController@contactUs');
    
    /*********************************************/
    Route::get('/talents/{slug}/category', 'Api\TalentCategoryController@talentsByCategory');
    Route::get('/talents/{slug}/product-info', 'Api\TalentCategoryController@productByCategory');
    
    /****************************************************/
    Route::get('/star-search', 'Api\SearchController@index');
    Route::get('/star-search/{slug}', 'Api\SearchController@show');
    Route::get('/talent-search', 'Api\SearchController@searchTalentMallUser');
    Route::get('/talent-search-count', 'Api\SearchController@searchTalentMallUserCount');

    /*************** ******************************/
    //Social Buzz API's
    Route::get('/blog-categories','Api\BlogController@blogCategory');    
    Route::get('/blogs/{slug?}','Api\BlogController@blogs');
    Route::post('blog-subscribe','Api\BlogController@blogSubscribe');
    Route::get('/related-blogs/{slug?}','Api\BlogController@relatedBlogs');
    Route::get('/blogs/{category}/{blogId}','Api\BlogController@blogById');
    Route::get('/blogs/{category}/{blogId}/comments','Api\BlogController@getComment');

    Route::get('/social-buzz/listing','Api\SocialBuzzController@socialBuzz');
    Route::get('/social-buzz-awards/listing','Api\SocialBuzzController@getSocialBuzzAwards');
    Route::get('/social-buzz-riders/listing','Api\SocialBuzzController@getSocailBuzzRiders');
    Route::get('/social-buzz-comments/listing', 'Api\SocialBuzzController@getSocailBuzzComments');
    Route::get('/social-buzz-views/listing','Api\SocialBuzzController@getSocailBuzzViews');
    Route::get('/get-commercial-ads','Api\SocialBuzzController@getAds');
    Route::post('/store-viewcount','Api\SocialBuzzController@storeViewcount');

    Route::get('/buyer/{id}','Api\PublicProfileController@index');
    Route::get('/seller/{id}','Api\PublicProfileController@sellerPublicProfile');
    Route::post('twitter-login','Auth\RegisterController@twitter');
    Route::any('twitter-callback','Auth\RegisterController@twitterCallback');
    Route::get('/tallent-mall','Api\TalentMallController@index');
    Route::get('/tallent-mall/search','Api\TalentMallController@show');
    Route::get('/talent-mall/product-info/{id}','Api\TalentMallController@productInfo');
    Route::get('/talent-mall/similar-product/{id}','Api\TalentMallController@similarProduct');
     Route::get('/talent-mall/all-similar-product/{id}', 'Api\TalentMallController@allSimilarProductGet');
    Route::get('/talent-mall/get-rider','Api\TalentMallController@getRider');
    Route::get('/talent-mall/award','Api\TalentMallController@TalentAwards');
    Route::get('/talent-mall/comment','Api\TalentMallController@talentComment');

    Route::post('/send-call','Api\AudioVideoController@send_call');
    Route::post('/video-calling-getreceiverdata2', 'Api\AudioVideoController@videoCallinggetdata');
    Route::post('/video-calling-storedata2', 'Api\AudioVideoController@videoCallingStoredata');

});

// auth:api | jwt.verify
Route::group(['middleware' => ['jwt', 'XSS', 'activity'], 'prefix' => '/v1'], function () 
{
    Route::post('/logout','Api\UserController@logout');
    //Authenticated routes will be written here
    Route::post('/user/update-role','Api\UserController@updateRole');
    Route::post('/user/picture','Api\UserController@updateProfilePicture');
    Route::get('/user/info','Api\UserController@fetchUserInfo');
    Route::get('/user/manage-public-profile','Api\UserController@managePublicProfile');
    Route::post('/user/delete-account','Api\UserController@deleteUserAccount');
    Route::post('/user/change-password','Api\UserController@changeUserAccountPassword');


          // Video Calling Api
    Route::post('/video-calling-storedata','Api\BuyerController@postCallingApi');
    Route::get('/video-calling-getdata','Api\BuyerController@getCallingApi');
    Route::post('/video-calling-rejectdata','Api\BuyerController@postRejectCallingApi');
    Route::post('/video-receiving-accept','Api\BuyerController@postReceivingApi');

    Route::get('/video-receiving-getdata','Api\BuyerController@getReceivingApi')->middleware('throttle:100,0.8');
    
    Route::post('/video-receiving-rejectdata','Api\BuyerController@postRejectReceivingApi');

    Route::post('/video-calling-callend','Api\BuyerController@videoCallingendcall');
        // Video Calling Api

        // Live Streaming Api
    Route::post('/live-stream-storedata','Api\BuyerController@postLiveStreamApi');
    Route::post('/live-stream-viewvisitor','Api\BuyerController@postVisitorStream');
    Route::post('/live-stream-commentstore','Api\BuyerController@postVisitorStreamComment');
    Route::get('/live-stream-viewcountcomment', 'Api\BuyerController@liveStreamViewCountComment');

        // Live Streaming Api
    // Blogs
    Route::post('/blogs/add-comment','Api\BlogController@addComment');
    Route::post('/user/store-public-profile-image', 'Api\UserController@publicProfileStoreImage');
    Route::post('/user/store-public-profile','Api\UserController@publicProfileStore');
    Route::post('/user/store-public-profile-bio','Api\UserController@publicProfileStoreBio');
    Route::get('/buyer-account/details','Api\UserController@buyerAccount');
    Route::post('/user/edit-cover-pic','Api\UserController@editCoverPic');
    Route::post('/user-account-update','Api\UserController@userAccountUpdate');

    Route::get('/riders','Api\UserController@getRiders');
    Route::get('/followings','Api\UserController@getFollowing');
    Route::get('/awards','Api\UserController@getAwards');
    Route::get('/unfollow-user/{following}', 'Api\UserController@unfollowUser');
    Route::post('/follow-user','Api\SocialBuzzController@followUser');

    Route::post('/user/changePassword','Api\UserController@changePassword');
    Route::get('/categories','Api\TalentCategoryController@category');
    Route::get('/seller-account/details', 'Api\UserController@sellerAccount');
    Route::get('/seller-sales','Api\PublicProfileController@sellerSale');
    Route::post('/store-product-commercial', 'Api\PublicProfileController@storeProductCommercial');
    Route::post('/store-sample-product','Api\PublicProfileController@storeSampleProduct');
    Route::post('/store-upload-product','Api\PublicProfileController@storeUploadProduct');
    Route::post('/store-product','Api\PublicProfileController@storeProduct');
    Route::post('/update-product','Api\PublicProfileController@updateProduct');
    Route::any('/my-product/{days?}','Api\PublicProfileController@SellerProducts');    
    /*******************************************************
                Social Buzz API
    *******************************************************/
    Route::post('/create-social-buzz','Api\SocialBuzzController@postSocialBuzz');
    Route::post('/update-social-buzz','Api\SocialBuzzController@updateSocialBuzz');    
    Route::post('/social-buzz-comment','Api\SocialBuzzController@postSocialBuzzComment');
    Route::post('/social-buzz-rider','Api\SocialBuzzController@postSocialBuzzRider');
    Route::post('/social-buzz-award','Api\SocialBuzzController@postSocialBuzzAward');
    Route::post('/social-buzz-report','Api\SocialBuzzController@socialBuzzReport');
    Route::get('/social-buzz-product-listing', 'Api\SocialBuzzController@socialBuzzProductListing');
    Route::post('/post-talent-award','Api\TalentCategoryController@postTalentAward');
    Route::get('/talent-award/{talentId}/listing', 'Api\TalentCategoryController@talentAwardListing');
    Route::get('/talent-rider/{talentId}/listing', 'Api\TalentCategoryController@talentRiderListing');
    Route::post('/talent/add-to-cart','Api\TalentCategoryController@addtoCart');
    Route::post('/post-talent-rider','Api\TalentCategoryController@postTalentRider');
    Route::post('/contact-message','Api\TalentCategoryController@contactMe');
    Route::post('/talent-report-seller','Api\TalentCategoryController@reportSeller');

    /*******************************************************
                Seller API
    *******************************************************/
    Route::get('/get-deleted-product','Api\SellerController@getSellerDeletedProduct');
    Route::post('/bulk-delete-product','Api\SellerController@bulkDeleteProducts');
    Route::post('/recover-deleted-product','Api\SellerController@recoverDeleteProduct');
    Route::post('/deleted-product-permanently', 'Api\SellerController@deleteProductPermanently');

    Route::get('/seller-commercial-ads','Api\SellerController@commercialAds');
    Route::get('/seller-commercial-ad-dashboard','Api\SellerController@commercialAdDashboard');
    Route::get('/seller-add-commercial-ad','Api\SellerController@addCommercilaAds');
    Route::get('/seller-product-url','Api\SellerController@productUrl');
    Route::post('/seller-store-commercial-ad','Api\SellerController@storeCommercialAd');
    Route::post('/seller-store-custom-plan','Api\SellerController@postCustomPlan');

    /*******************************************************
                Message API
    *******************************************************/
    Route::get('/chat-message','Api\ChatMessageController@chat');
    Route::get('/chat-refresh','Api\ChatMessageController@refreshMessage');
    Route::post('/chat-message','Api\ChatMessageController@sendMessage');
    Route::get('/inbox-message','Api\ChatMessageController@getInboxMessage');
    Route::get('/getalluser','Api\ChatMessageController@getAllUser');
    Route::get('/getallreaduser','Api\ChatMessageController@getAllReadMsg');
    Route::get('/getallunreaduser','Api\ChatMessageController@getAllUnreadMsg');
    Route::post('/delete-message','Api\ChatMessageController@deleteInboxMessage');
    Route::post('/mass-delete-message','Api\ChatMessageController@massDeleteInboxMessage');
    Route::get('/get-all-contact','Api\ChatMessageController@getAllContact');
    Route::post('/autoreply-setting','Api\ChatMessageController@autoreplySetting');
    Route::get('/autoreply-setting','Api\ChatMessageController@getAutoMessage');
    Route::get('/auto-reply','Api\ChatMessageController@sendAutoMessage');


    Route::get('/load-latest-messages','Api\FloatChatController@getLoadLatestMessages')->name('load-latest-message');
    Route::post('/send','Api\FloatChatController@postSendMessage')->name('send-message');
    Route::post('/send/del','Api\FloatChatController@deleteMessage');
    Route::get('/fetch-old-messages','Api\FloatChatController@getOldMessages');
    Route::get('/get-chat-users','Api\FloatChatController@users');
    Route::post('/chat-users/add-super-star','Api\FloatChatController@addSuperStar');
  


    /*******************************************************
                Payment API
    *******************************************************/

    Route::get('/paypal','Api\PaymentController@paypal');
    Route::post('/paypal','Api\PaymentController@storePaypal');    
    Route::post('/paypal-test','Api\PaymentController@paypalTest');

    Route::get('/stripe','Api\PaymentController@stripe');
    Route::post('/stripe-commercial-ads', 'Api\PaymentController@commercialAdsStripePayment');
    Route::post('/stripe-hotpay-commercial-ads', 'Api\PaymentController@commercialAdsHotpayStripePayment');
    Route::post('/stripe','Api\PaymentController@storeStripe');
    Route::post('/stripe-confirm','Api\PaymentController@confirmStripePayment');
    Route::post('/stripe-hotpay','Api\PaymentController@hotPayStripe');
    
    Route::get('/get-card','Api\BillingAccountController@index');
    Route::post('/card-details','Api\BillingAccountController@store');
    Route::get('/get-card/{id}','Api\BillingAccountController@getCardDetails');
    Route::post('/add-card','Api\BillingAccountController@addCard');
    Route::post('/card-update','Api\BillingAccountController@updateCard');
    Route::post('/card-delete','Api\BillingAccountController@deleteCard');
    Route::post('/preferred-payment-method', 'Api\BillingAccountController@preferredPaymentMethod');
    /********************************************************************
    ***************************  Buyer API      *************************
    *********************************************************************/

    Route::get('/buyer-products','Api\BuyerController@index');
    Route::post('/add-comment-to-talent','Api\BuyerController@addCommentToTalent');
    Route::post('/add-buyer-rating','Api\BuyerController@addBuyerRating');
    Route::post('/download-buyer-product','Api\BuyerController@downloadBuyerProduct');
    Route::post('/delete-buyer-product','Api\BuyerController@deleteBuyerProduct');

    /*********************************************************************
                    Tallent Mall Controller API
    *********************************************************************/

    Route::post('/talent-mall/add-to-cart','Api\TalentMallController@addTalentToCart');    
    Route::post('/talent-mall/give-award','Api\TalentMallController@giveTalentAward');    
    Route::get('/cart-product','Api\TalentMallController@cartProducts');
    Route::post('/remove-cart-item','Api\TalentMallController@deleteCartItem');
    Route::post('/talent-mall/add-rider','Api\TalentMallController@addRiderToTalent');

    Route::post('/connect-stripe-account','Api\StripeConnectController@ConnectStripeAccount');
    Route::get('/connect-stripe-account/auth','Api\StripeConnectController@stripeAccountAuth');
    Route::get('/connect-stripe-account/return', 'Api\StripeConnectController@stripeAccountReturn');
    Route::post('/link-stripe-account','Api\StripeConnectController@LinkStripeAccount');
    Route::post('/connect-stripe-account/retrieve', 'Api\StripeConnectController@stripeAccountDetail');


    /*********************************************************************
     *          T Shirt COntroller API
     * ******************************************************************/

    Route::get('/t-shirt/show','Api\TShirtProductController@show');
    Route::post('/t-shirt/add-to-cart','Api\TShirtProductController@tShirtAddToCart');
    Route::get('/t-shirt/checkout-show','Api\TShirtProductController@tShirtCheckoutShow');
    Route::post('/t-shirt/changeShipping','Api\TShirtProductController@changeShipping');
    Route::post('/t-shirt/removeCartProduct','Api\TShirtProductController@removeCartProduct');
    Route::post('/t-shirt/saveShippingAddress', 'Api\TShirtProductController@saveShippingAddress');
    Route::post('/t-shirt/saveBillingAddress', 'Api\TShirtProductController@saveBillingAddress');
    Route::post('/t-shirt-stripe','Api\TShirtProductController@stripe');  
});



