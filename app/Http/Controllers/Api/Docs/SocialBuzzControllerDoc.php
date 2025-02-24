<?php 

namespace App\Http\Controllers\Api\Docs;


class SocialBuzzControllerDoc
{
	
/****************************************************

 public function socialBuzz(Request $request, $days = '') {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/social-buzz/{category_id}/listing",
 * summary="Get Social Buzz Listing",
 * description="Get Social Buzz Listing",
 * operationId="GetSocialBuzzListing",
 * tags={"SocialBuzz"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="category_id",
 *      in="path",
 *      required=true,
 *		example="5",
 *      @OA\Schema(
 *           type="integer"
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

 public function getSocailBuzzComments(Request $request, $days = '') {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/social-buzz-comments/{post_id}/listing",
 * summary="Get Social Buzz Listing",
 * description="Get Social Buzz Listing",
 * operationId="GetSocialBuzzListing",
 * tags={"SocialBuzz"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="post_id",
 *      in="path",
 *      required=true,
 *		example="243",
 *      @OA\Schema(
 *           type="integer"
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

 public function getSocialBuzzAwards(Request $request, $days = '') {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/social-buzz-awards/{post_id}/listing",
 * summary="Get Social Buzz Awards",
 * description="Get Social Buzz Awards",
 * operationId="GetSocialBuzzAwards",
 * tags={"SocialBuzz"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="post_id",
 *      in="path",
 *      required=true,
 *		example="243",
 *      @OA\Schema(
 *           type="integer"
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

 public function socialBuzzProductListing(Request $request, $days = '') {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/social-buzz-product-listing",
 * summary="Get Social Buzz Product Listing",
 * description="Get Social Buzz Product Listing",
 * operationId="GetSocialBuzzProductListing",
 * tags={"SocialBuzz"},
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

	public function postSocialBuzzComment(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/social-buzz-comment",
 * summary="Post Social Buzz Comments",
 * description="Post Social Buzz Comments",
 * operationId="PostSocialBuzzComments",
 * tags={"SocialBuzz"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"social_buzz_id"},
 *      @OA\Property(
 *			property="social_buzz_id", 
 *			type="string", 
 *			format="integer", 
 *			example="243"
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

	public function socialBuzzReport(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/social-buzz-report",
 * summary="SocialBuzz Report",
 * description="SocialBuzz Report",
 * operationId="SocialBuzzReport",
 * tags={"SocialBuzz"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"social_buzz_id"},
 *      @OA\Property(
 *			property="social_buzz_id", 
 *			type="string", 
 *			format="integer", 
 *			example="236"
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

	public function postSocialBuzzAward(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/social-buzz-award",
 * summary="Post SocialBuzz Award",
 * description="Post SocialBuzz Award",
 * operationId="PostSocialBuzzAward",
 * tags={"SocialBuzz"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"social_buzz_id"},
 *      @OA\Property(
 *			property="social_buzz_id", 
 *			type="string", 
 *			format="integer", 
 *			example="236"
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

	public function postSocialBuzz(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/create-social-buzz",
 * summary="Create Social Buzz",
 * description="Create Social Buzz",
 * operationId="CreateSocialBuzz",
 * tags={"SocialBuzz"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="social_buzz_id",
 *      in="query",
 *      required=true,
 *		example="243",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="comment",
 *      in="query",
 *      required=true,
 *		example="Test Comment 79",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="category_id",
 *      in="query",
 *      required=true,
 *		example="5",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
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

/**********************************************************

	public function updateSocialBuzz(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/update-social-buzz",
 * summary="Update Social Buzz",
 * description="Update Social Buzz",
 * operationId="UpdateSocialBuzz",
 * tags={"SocialBuzz"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="social_buzz_id",
 *      in="query",
 *      required=true,
 *		example="243",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="comment",
 *      in="query",
 *      required=true,
 *		example="Test Comment 79",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="category_id",
 *      in="query",
 *      required=true,
 *		example="5",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
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

}