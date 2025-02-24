<?php 

namespace App\Http\Controllers\Api\Docs;


class AuthUserControllerDoc
{

/****************************************************

 public function authenticate(Request $request){}

*****************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/login",
 * summary="Login",
 * description="Login by email, password",
 * operationId="authLogin",
 * tags={"User Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(
 *			property="email", 
 *			type="string", 
 *			format="email", 
 *			example="five_seller@fiveexceptions.com"
 *		),
 *       @OA\Property(
 *			property="password", 
 *			type="string", 
 *			format="password", 
 *			example="Indore@123"
 *		),       
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *		@OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(
 *			property="email", 
 *			type="string", 
 *			format="email", 
 *			example="five_seller@fiveexceptions.com"
 *		),
 *       @OA\Property(
 *			property="password", 
 *			type="string", 
 *			format="password", 
 *			example="Indore@123"
 *		),       
 *    ),
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */


/**********************************************************

	public function register(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user",
 * summary="Register",
 * description="Login by email, password",
 * operationId="authRegister",
 * tags={"User Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"first_name","last_name","email","password"},
 *      @OA\Property(
 *			property="first_name", 
 *			type="string", 
 *			format="email", 
 *			example="five"
 *		),
 *      @OA\Property(
 *			property="last_name", 
 *			type="string", 
 *			format="text", 
 *			example="seller"
 *		),
 *       @OA\Property(
 *			property="email", 
 *			type="string", 
 *			format="text", 
 *			example="five_seller@fiveexceptions.com"
 *		),
  *       @OA\Property(
 *			property="role", 
 *			type="string", 
 *			format="text", 
 *			example="4"
 *		),
 *       @OA\Property(
 *			property="password", 
 *			type="string", 
 *			format="password", 
 *			example="Indore@123"
 *		),   
  *       @OA\Property(
 *			property="password_confirmation", 
 *			type="string", 
 *			format="password", 
 *			example="Indore@123"
 *		),     
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */


/**********************************************************

	public function logout(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/logout",
 * summary="Logout",
 * description="logout user",
 * operationId="authLogout",
 * tags={"User Auth"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */



/**********************************************************

	public function socialUserRegister(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/linkedin_register",
 * summary="LinkedIn Register",
 * description="Linked In register",
 * operationId="authLinkedIn",
 * tags={"User Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"accessToken","provider"},
 *      @OA\Property(
 *			property="accessToken", 
 *			type="string", 
 *			format="text", 
 *			example="AQWvILVcLqJKv1d-jEG67AnaDTrvVuSa7_eLC7HwqiePxIK5UVXUeb92W3rpa1qEFserpbLKUSdYHLEh4WBiuRX3UCfHlsoAacB9DmFPjpA_khIL3hm6Fv-VxxnYRt-woJk_8hBHy5vv4p1hdQ0RLffAZfhwzQuyzghBJyZnIUDzMTN75tZOfsTMrYxIpLLH1iAp6HTlXZuE7DekFKvpS3I7j3oJVQTFI4GCJEfZiGtiviYQ-QnhDVdmaG39RK3FCMr5E15KNcL2A98gG_jiXNd5eBbziVkVZ-bsMvAoEa7-M5MN_EkaQu5SbROQSUOsLj-gYrT-ecixxGlDQI7f55dGqdbLPA"
 *		),
 *      @OA\Property(
 *			property="provider", 
 *			type="string", 
 *			format="text", 
 *			example="linkedin"
 *		), *      
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */



/**********************************************************

	public function socialUserRegister(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/facebook_register",
 * summary="Facebook Register",
 * description="Facebook In register",
 * operationId="authFacebook",
 * tags={"User Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"accessToken","provider"},
 *      @OA\Property(
 *			property="accessToken", 
 *			type="string", 
 *			format="text", 
 *			example="EAACsEhYQps8BAJZBwCuGlUZBZAUXsx373zcwyZCZAm5crjIEmsog4ZB2JnbLC4Q0yeZCqoFKoNNC0yXeUWz7zZAtvVm08TKeHNJ7D9ZA6LZBZBgfL68Eq45Ur14Mp0kcKwt8ssOPWleWiUMZAVRJY96DubRLQfSZC2Yza1cvTdV8c5D0EDJlQO16TmWvum4GiGs4qg5QWoQgXkYN0QEe0K8oTAaGqwrQ36WsrjGz5ldcZCCci9YAZDZD"
 *		),
 *      @OA\Property(
 *			property="provider", 
 *			type="string", 
 *			format="text", 
 *			example="facebook"
 *		), *      
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */


/**********************************************************

	public function socialUserRegister(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/twitter-login",
 * summary="Twitter Register",
 * description="Twitter In register",
 * operationId="authTwitter",
 * tags={"User Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"accessToken","provider"},
 *      @OA\Property(
 *			property="accessToken", 
 *			type="string", 
 *			format="text", 
 *			example="AAAAAAAAAAAAAAAAAAAAANVzOgAAAAAAPOFq%2BU12Yro9OB1p%2FisGDKT%2BUoI%3DVdPmFEbLI0VZ5nJw1AmxqAgRrpUjgou3x8FXororexw9fLeJmu"
 *		),
 *      @OA\Property(
 *			property="provider", 
 *			type="string", 
 *			format="text", 
 *			example="twitter"
 *		), *      
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */



/**********************************************************

	public function changePassword(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/changePassword",
 * summary="Change Password",
 * description="Change Password",
 * operationId="authChagePassword",
 * tags={"User Auth"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"current_password","password", "password_confirmation"},
 *      @OA\Property(
 *			property="current_password", 
 *			type="string", 
 *			format="text", 
 *			example="12345678"
 *		),
 *      @OA\Property(
 *			property="password", 
 *			type="string", 
 *			format="text", 
 *			example="123123123"
 *		),
 *		@OA\Property(
 *			property="password_confirmation", 
 *			type="string", 
 *			format="text", 
 *			example="123123123"
 *		),      
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */ 



/**********************************************************

	public function resetPassword(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/reset-password",
 * summary="Reset Password",
 * description="Reset Password",
 * operationId="authResetPassword",
 * tags={"User Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"current_password","password", "token"},
 *      @OA\Property(
 *			property="token", 
 *			type="string", 
 *			format="text", 
 *			example="d9c16c80f4fe9c85010bb6d7f217582b"
 *		),
 *      @OA\Property(
 *			property="password", 
 *			type="string", 
 *			format="text", 
 *			example="123123123"
 *		),
 *		@OA\Property(
 *			property="password_confirmation", 
 *			type="string", 
 *			format="text", 
 *			example="123123123"
 *		),      
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */ 


/**********************************************************

	public function forgotPassword(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/forgot-password",
 * summary="Forgot Password",
 * description="Forgot Password",
 * operationId="authforgotPassword",
 * tags={"User Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"email"},
 *      @OA\Property(
 *			property="email", 
 *			type="string", 
 *			format="email", 
 *			example="five@fiveexceptions.com"
 *		),
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */ 


/**********************************************************

					User Module


	public function updateRole(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/update-role",
 * summary="Update Role",
 * description="Update Role",
 * operationId="userUpdateRole",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="User Role",
 *    @OA\JsonContent(
 *		required={"role_id"},
 *      @OA\Property(
 *			property="role_id", 
 *			type="string", 
 *			format="text", 
 *			example="4"
 *		),
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */ 


/**********************************************************

	public function updateProfilePicture(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/picture",
 * summary="Change profile picture",
 * description="Change profile picture",
 * operationId="userChangeProfilePicture",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
*     	@OA\RequestBody(
*          required=true,
*          @OA\MediaType(
*              mediaType="multipart/form-data",
*              @OA\Schema(
*                  @OA\Property(
*                      property="profile_pic",
*                      description="profile_pic",
*                      type="file",
*                      @OA\Items(type="string", format="binary")
*                   ),
*               ),
*           ),
*       ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */ 



/****************************************************

 public function fetchUserInfo() {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/user/info",
 * summary="Get User Info",
 * description="Get User Info",
 * operationId="GetUserInfo",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */


/****************************************************

 public function managePublicProfile() {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/user/manage-public-profile",
 * summary="Manage Public Profile",
 * description="Manage Public Profile",
 * operationId="ManagePublicProfile",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */


/****************************************************

 public function managePublicProfile() {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/public-profile/{public_profile_id}/profile",
 * summary="Manage Public Profile",
 * description="Manage Public Profile",
 * operationId="ManagePublicProfile",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="public_profile_id",
 *      in="path",
 *      required=true,
 *		example="stars-band-f1263317c8d",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */


/****************************************************

 public function sellerPublicProfile() {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/public-profile/buyer-futurestarr-e77a3cadfc4/profile",
 * summary="Seller Public Profile",
 * description="Seller Public Profile",
 * operationId="SellerPublicProfile",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */



/**********************************************************

	public function userAccountUpdate(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user-account-update",
 * summary="User Account Update",
 * description="User Account Update",
 * operationId="userAccountUpdate",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"first_name","last_name","email","username", "bio_information", "address", "city", "state", "zip_code", "phone"},
 *      @OA\Property(
 *			property="username", 
 *			type="string", 
 *			format="text", 
 *			example="BuyerNewUser"
 *		),
 *      @OA\Property(
 *			property="bio_information", 
 *			type="string", 
 *			format="text", 
 *			example="Hello, I am buyer. I want to buy somr great talents."
 *		),
 *       @OA\Property(
 *			property="first_name", 
 *			type="string", 
 *			format="text", 
 *			example="sam"
 *		),
  *       @OA\Property(
 *			property="last_name", 
 *			type="string", 
 *			format="text", 
 *			example="jordan"
 *		),
 *       @OA\Property(
 *			property="email", 
 *			type="string", 
 *			format="email", 
 *			example="samjordan01@mail.com"
 *		),   
  *       @OA\Property(
 *			property="address", 
 *			type="string", 
 *			format="text", 
 *			example="Kolkata"
 *		),    
   *       @OA\Property(
 *			property="city", 
 *			type="string", 
 *			format="text", 
 *			example="Kolkata"
 *		),    
   *       @OA\Property(
 *			property="state", 
 *			type="string", 
 *			format="text", 
 *			example="WestBengal"
 *		),    
   *       @OA\Property(
 *			property="zip_code", 
 *			type="string", 
 *			format="text", 
 *			example="123456"
 *		),    
   *       @OA\Property(
 *			property="phone", 
 *			type="string", 
 *			format="text", 
 *			example="1234568795"
 *		),     
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */



/**********************************************************

	public function publicProfileStoreImage(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/store-public-profile-image",
 * summary="Public Profile Store Image",
 * description="Public Profile Store Image",
 * operationId="PublicProfileStoreImage",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
*     	@OA\RequestBody(
*          required=true,
*          @OA\MediaType(
*              mediaType="multipart/form-data",
*              @OA\Schema(
*                  @OA\Property(
*                      property="encode_image",
*                      description="encode_image",
*                      type="file",
*                      @OA\Items(type="string", format="binary")
*                   ),
*               ),
*           ),
*       ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */ 



/**********************************************************

	public function publicProfileStoreBio(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/store-public-profile-bio",
 * summary="Public Profile Store Bio",
 * description="Public Profile Store Bio",
 * operationId="PublicProfileStoreBio",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
*     	@OA\RequestBody(
*          required=true,
*          @OA\MediaType(
*              mediaType="multipart/form-data",
*              @OA\Schema(
*                  @OA\Property(
*                      property="bio_video",
*                      description="bio_video",
*                      type="file",
*                      @OA\Items(type="string", format="binary")
*                   ),
*               ),
*           ),
*       ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *      response=403,
 *          description="Forbidden"
 *      )
 * )
 */ 




/**********************************************************

	public function publicProfileStore(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/store-public-profile",
 * summary="Public Profile Store",
 * description="Public Profile Store",
 * operationId="PublicProfileStore",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"bio_video","encode_image","bio_info"},
 *      @OA\Property(
 *			property="bio_video", 
 *			type="string", 
 *			format="text", 
 *			example="userImage/video-bio/dd111e8e45b1d1c8f5110234add58c95.mp4"
 *		),
 *      @OA\Property(
 *			property="encode_image", 
 *			type="string", 
 *			format="text", 
 *			example="userImage/banner/c275a9ebf819659dbc8029553c193bea.jpg"
 *		),
 *       @OA\Property(
 *			property="bio_info", 
 *			type="string", 
 *			format="text", 
 *			example="Hi"
 *		), 
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */



/**********************************************************

	public function followUser(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/follow-user",
 * summary="Follow User",
 * description="Follow User",
 * operationId="FollowUser",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"posted_by"},
 *      @OA\Property(
 *			property="posted_by", 
 *			type="string", 
 *			format="text", 
 *			example="45"
 *		),
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */







/**********************************************************

	public function editCoverPic(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/user/edit-cover-pic",
 * summary="Edit Cover Pic",
 * description="Edit Cover Pic",
 * operationId="EditCoverPic",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
* },
*     	@OA\RequestBody(
*          required=true,
*          @OA\MediaType(
*              mediaType="multipart/form-data",
*              @OA\Schema(
*                  @OA\Property(
*                      property="encode_image",
*                      description="encode_image",
*                      type="file",
*                      @OA\Items(type="string", format="binary")
*                   ),
*               ),
*           ),
*       ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */



/****************************************************

 public function getRiders() {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/riders?user_id={user_id}&per_page={per_page}&page={page}",
 * summary="Get Riders",
 * description="Get Riders",
 * operationId="GetRiders",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="user_id",
 *      in="path",
 *      required=true,
 *		example="45",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="per_page",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="page",
 *      in="path",
 *      required=true,
 *		example="1",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */




/****************************************************

 public function getFollowing() {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/followings?per_page={per_page}&page={page}",
 * summary="Get Following",
 * description="Get Following",
 * operationId="GetFollowing",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="per_page",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="page",
 *      in="path",
 *      required=true,
 *		example="1",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */




/****************************************************

 public function unfollowUser() {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/unfollow-user/{user_id}",
 * summary="Unfollow User",
 * description="Unfollow User",
 * operationId="Unfollow User",
 * tags={"User Module"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="user_id",
 *      in="path",
 *      required=true,
 *		example="45",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */




/****************************************************

 public function buyerAccount() {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/buyer-account/details",
 * summary="BuyerAccount",
 * description="BuyerAccount",
 * operationId="Buyer Account",
 * tags={"Buyer Module"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */
}
