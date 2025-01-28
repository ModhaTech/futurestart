<?php 

namespace App\Http\Controllers\Api\Docs;


class PublicProfileControllerDoc
{


	

/****************************************************

 public function SellerProducts(Request $request, $days = '') {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/my-product?per_page={per_page}&page={page}",
 * summary="Get All Products",
 * description="Get All Products",
 * operationId="GetAllProducts",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
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

 public function SellerProducts(Request $request, $days = '') {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/my-product/{day}?per_page={per_page}&page={page}",
 * summary="Get All Products By Day",
 * description="Get All Products By Day",
 * operationId="GetAllProductsByDay",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="day",
 *      in="path",
 *      required=true,
 *		example="2",
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

	public function storeProduct(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/store-product",
 * summary="Add Product",
 * description="Add Product",
 * operationId="AddProduct",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"category","title","description","price", "product_info", "facebookLink", "instagramLink", "twitterLink", "sampleproduct", "uploadproduct", "commercial"},
 *      @OA\Property(
 *			property="category", 
 *			type="string", 
 *			format="text", 
 *			example="4"
 *		),
 *      @OA\Property(
 *			property="title", 
 *			type="string", 
 *			format="text", 
 *			example="Test Product On The Website 376683"
 *		),
 *       @OA\Property(
 *			property="description", 
 *			type="string", 
 *			format="text", 
 *			example="I am seller who love music. Big fan of legend 2PAC."
 *		),
 *       @OA\Property(
 *			property="price", 
 *			type="string", 
 *			format="text", 
 *			example="134"
 *		),
 *       @OA\Property(
 *			property="product_info", 
 *			type="string", 
 *			format="text", 
 *			example="This is the test product to test on website with all aspects."
 *		),   
 *       @OA\Property(
 *			property="facebookLink", 
 *			type="string", 
 *			format="text", 
 *			example="facebook"
 *		),    
 *       @OA\Property(
 *			property="instagramLink", 
 *			type="string", 
 *			format="text", 
 *			example="instagram"
 *		),    
 *       @OA\Property(
 *			property="twitterLink", 
 *			type="string", 
 *			format="text", 
 *			example="twitter"
 *		),    
 *       @OA\Property(
 *			property="sampleproduct", 
 *			type="string", 
 *			format="text", 
 *			example="uploads/seller-video/9dc43ce58950eae7cc8334b188a03035.mp4"
 *		),    
 *       @OA\Property(
 *			property="uploadproduct", 
 *			type="string", 
 *			format="text", 
 *			example="uploads/seller-product-media/2372ae989c84bfc96a6b7d4af610e711.pdf"
 *		),  
 *       @OA\Property(
 *			property="commercial", 
 *			type="string", 
 *			format="text", 
 *			example="uploads/commercial-product/9b9bbdd280acc21e3fb19de841c48eac.jpg"
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

	public function updateProduct(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/update-product",
 * summary="Update Product",
 * description="Update Product",
 * operationId="UpdateProduct",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"talent_id","category","title","description","price", "product_info", "sampleproduct", "uploadproduct", "commercial"},
 *      @OA\Property(
 *			property="category", 
 *			type="string", 
 *			format="text", 
 *			example="4"
 *		),
 *      @OA\Property(
 *			property="title", 
 *			type="string", 
 *			format="text", 
 *			example="Test Product On The Website 376683"
 *		),
 *       @OA\Property(
 *			property="description", 
 *			type="string", 
 *			format="text", 
 *			example="I am seller who love music. Big fan of legend 2PAC."
 *		),
 *       @OA\Property(
 *			property="price", 
 *			type="string", 
 *			format="text", 
 *			example="134"
 *		),
 *       @OA\Property(
 *			property="product_info", 
 *			type="string", 
 *			format="text", 
 *			example="This is the test product to test on website with all aspects."
 *		),   
 *       @OA\Property(
 *			property="talent_id", 
 *			type="string", 
 *			format="text", 
 *			example="talent_id"
 *		),     
 *       @OA\Property(
 *			property="sampleproduct", 
 *			type="string", 
 *			format="text", 
 *			example="uploads/seller-video/9dc43ce58950eae7cc8334b188a03035.mp4"
 *		),    
 *       @OA\Property(
 *			property="uploadproduct", 
 *			type="string", 
 *			format="text", 
 *			example="uploads/seller-product-media/2372ae989c84bfc96a6b7d4af610e711.pdf"
 *		),  
 *       @OA\Property(
 *			property="commercial", 
 *			type="string", 
 *			format="text", 
 *			example="uploads/commercial-product/9b9bbdd280acc21e3fb19de841c48eac.jpg"
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

	public function storeProductCommercial(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/store-product-commercial",
 * summary="Store Product Commercial",
 * description="Store Product Commercial",
 * operationId="StoreProductCommercial",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
*     	@OA\RequestBody(
*          required=true,
*          @OA\MediaType(
*              mediaType="multipart/form-data",
*              @OA\Schema(
*                  @OA\Property(
*                      property="commercial",
*                      description="commercial",
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

	public function storeUploadProduct(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/store-upload-product",
 * summary="Store Upload Product",
 * description="Store Upload Product",
 * operationId="StoreUploadProduct",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
*     	@OA\RequestBody(
*          required=true,
*          @OA\MediaType(
*              mediaType="multipart/form-data",
*              @OA\Schema(
*                  @OA\Property(
*                      property="uploadproduct",
*                      description="uploadproduct",
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

	public function storeSampleProduct(Request $request){}

**********************************************************/
/**
 * @OA\Post(
 * path="/api/v1/store-sample-product",
 * summary="Store Sample Product",
 * description="Store Sample Product",
 * operationId="StoreSampleProduct",
 * tags={"Products"},
 * security={
 *    {"bearer": {}}
 * },
*     	@OA\RequestBody(
*          required=true,
*          @OA\MediaType(
*              mediaType="multipart/form-data",
*              @OA\Schema(
*                  @OA\Property(
*                      property="sampleproduct",
*                      description="sampleproduct",
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

 public function sellerSale(Request $request) {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/seller-sales",
 * summary="Get Seller Sale",
 * description="Get Seller Sale",
 * operationId="GetSellerSale",
 * tags={"Seller"},
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

 public function sellerAccount(Request $request) {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/seller-account/details",
 * summary="Get Seller Account Details",
 * description="Get Seller Account Details",
 * operationId="GetSellerAccountDetails",
 * tags={"Seller"},
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

 public function getAwards(Request $request) {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/awards?per_page={per_page}&page={page}",
 * summary="Get Seller Awards",
 * description="Get Seller Awards",
 * operationId="GetSellerAwards",
 * tags={"Seller"},
 * security={
 *    {"bearer": {}}
 * },
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

 public function getSimilarProductList(Request $request) {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/similar-product-list/{user_profile_id}?per_page={per_page}&page={page}",
 * summary="Get Similar Product List",
 * description="Get Similar Product List",
 * operationId="GetSimilarProductList",
 * tags={"Seller"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="user_profile_id",
 *      in="path",
 *      required=true,
 *		example="stars-band-f1263317c8d",
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

 public function getTrendingsList(Request $request) {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/trending-list/{user_profile_id}?per_page={per_page}&page={page}",
 * summary="Get Trending List",
 * description="Get Trending List",
 * operationId="GetTrendingList",
 * tags={"Seller"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="user_profile_id",
 *      in="path",
 *      required=true,
 *		example="stars-band-f1263317c8d",
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

