<?php 

namespace App\Http\Controllers\Api\Docs;


class SellerControllerDoc
{



/****************************************************

 public function getSellerDeletedProduct(){}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/get-deleted-product?day={day}&per_page={per_page}&page={page}",
 * summary="Get Deleted Products",
 * description="Get Deleted Products",
 * operationId="getDeletedProducts",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="day",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
  *   @OA\Parameter(
 *      name="page",
 *      in="path",
 *      required=true,
 *		example="1",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
  *   @OA\Parameter(
 *      name="per_page",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *      description="Success",
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

	public function bulkDeleteProducts(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/bulk-delete-product",
 * summary="Bulk Delete Products",
 * description="Bulk Delete Products",
 * operationId="BulkDeleteProducts",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"talent_id",},
 *      @OA\Property(
 *			property="talent_id", 
 *			type="object",
 *			example="[20,21]"
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

	public function recoverDeleteProduct(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/recover-deleted-product",
 * summary="Recover Bulk Delete Products",
 * description="Recover Bulk Delete Products",
 * operationId="RecoverBulkDeleteProducts",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"talent_id",},
 *      @OA\Property(
 *			property="talent_id", 
 *			type="object",
 *			example="[20,21]"
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

	public function deleteProductPermanently(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/deleted-product-permanently",
 * summary="Permanently Delete Products",
 * description="Permanently Delete Products",
 * operationId="PermanentlyDeleteProducts",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"talent_id",},
 *      @OA\Property(
 *			property="talent_id", 
 *			type="object",
 *			example="[20,21]"
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


/****************************************************

 public function commercialAds(){}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/seller-commercial-ads",
 * summary="Get Commercial Ads",
 * description="Get Commercial Ads",
 * operationId="GetCommercialAds",
 * tags={"SellerAds"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *      description="Success",
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

 public function commercialAdDashboard(){}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/seller-commercial-ad-dashboard",
 * summary="Get Commercial Ads Dashboard",
 * description="Get Commercial Ads Dashboard",
 * operationId="GetCommercialAdsDashboard",
 * tags={"SellerAds"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *      description="Success",
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

 public function addCommercilaAds(){}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/seller-add-commercial-ad",
 * summary="Add Commercial Ads",
 * description="Add Commercial Ads",
 * operationId="AddCommercialAds",
 * tags={"SellerAds"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *      description="Success",
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

	public function storeCommercialAd(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/seller-store-commercial-ad",
 * summary="Store Commercial Ads ( Use on postman)",
 * description="Store Commercial Ads",
 * operationId="StoreCommercialAds",
 * tags={"SellerAds"},
 * security={
 *    {"bearer": {}}
 * },

 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"talent_id",},
 *      @OA\Property(
 *			property="banner", 
 *			type="text",
 *			example="image upload"
 *		),
 *      @OA\Property(
 *			property="title", 
 *			type="text",
 *			example="Commercial Ad"
 *		),
 *      @OA\Property(
 *			property="product", 
 *			type="text",
 *			example="Test Product On The Website 8"
 *		),
 *      @OA\Property(
 *			property="product_url", 
 *			type="text",
 *			example="http://ec2-18-224-33-209.us-east-2.compute.amazonaws.com/talent-mall/product-info/eyJpdiI6Inp2RFI3Z2NoT0lqeGZPL1F0VFpwRkE9PSIsInZhbHVlIjoiemFsSE9FUFJJTFlFOEIwcmZXb0lRQT09IiwibWFjIjoiOTc2MmJlZjU3MGEwZGIyYjc3Y2FhOGI5MjJlOGIxZGRhZjhlOTJmOThjODY0MjI0ZWQ5MjQ2ZmNkNTYyYmNlYyJ9"
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

/****************************************************

 public function getSellerDeletedProduct(){}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/seller-product-url?product_id={product_id}",
 * summary="Get Seller Products URL",
 * description="Get Seller Products URL",
 * operationId="GetSellerProductsURL",
 * tags={"SellerAds"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="product_id",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *      description="Success",
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

	public function postCustomPlan(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/seller-store-custom-plan",
 * summary="Store Custom Plan",
 * description="Store Custom Plan",
 * operationId="StoreCustomPlan",
 * tags={"SellerAds"},
 * security={
 *    {"bearer": {}}
 * },

 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"custom_plan",},
 *      @OA\Property(
 *			property="custom_plan", 
 *			type="text",
 *			example="Plan details"
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

}
