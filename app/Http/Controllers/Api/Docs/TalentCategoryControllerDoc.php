<?php 

namespace App\Http\Controllers\Api\Docs;


class TalentCategoryControllerDoc
{

	
/****************************************************

 public function category(Request $request, $days = '') {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/categories",
 * summary="Get Categories",
 * description="Get Categories",
 * operationId="GetCategories",
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


	
/****************************************************

 public function futureStarrMarketplace(Request $request) {}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/futurestarr/marketplace",
 * summary="Future Starr Marketplace",
 * description="Future Starr Marketplace",
 * operationId="FutureStarrMarketplace",
 * tags={"Marketplace Module"},
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
}
