<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Metatags;
use App\Models\Talents;
use App\User;
use Response;
use Validator;

class SearchController extends ApiController
{

	public function index(Request $request)
    { 
    	try {
    		$per_page = $request->per_page ? $request->per_page : 10 ;
            $data['catagories'] = TalentCatagory::whereNotIn('id', [17,18])->paginate($per_page);
            foreach($data['catagories'] as $cat){
                $cat->catagory_desc = strip_tags($cat->catagory_desc);
            }
            
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get Star Search',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' =>  $data,
            ]);  
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }	

    }

    public function show($slug)
    {
    	try 
        {
	    	$data['catagory'] = TalentCatagory::where('slug','=',$slug)->first();

			return response()->json([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get Star Search Details',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' =>  $data,
            ]);            

        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function searchTalentMallUser(Request $request)
    {
        try{
            $rules = array(
                'search' => 'required',
                // 'category'  =>  'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            if(!empty($request['search']))
            {

                $per_page = $request->per_page ? $request->per_page : 5;
                 $talents = [];
                 $categories = [];
                 $talentList ='';
                 $categoryList = '';
                 $talentListArr = [];
                 $categoryListArr = [];
                 $sellers = [];
                 $buyers = [];
                 
                $qry = str_split($request['search']);
                $n = '';
                foreach($qry as $q)
                {
                    $n = $n . $q . "%";
                }
                 $searchQuery = rtrim($n, "%");

                 $condition = ['active' => 'Active' , 'approved'=> 1];
                 // if ($request->category == 'talent') {
                    // $data[0]['cat_name']  =  'talent';
                  $data['talent']['result'] = Talents::with('user')->where('title', 'like', '%' . $searchQuery . '%')->where($condition)->paginate($per_page);
                    $data['talent']['count'] = count($data['talent']['result']);
                 // }
                 // if ($request->category == 'categories') {
                    // $data[1]['cat_name']  =  'categories';
                    $data['categories']['result'] = TalentCatagory::where('name', 'like', '%' . $searchQuery . '%')->paginate($per_page);
                    $data['categories']['count'] = count($data['categories']['result']);
                 // }
                 
                 // if ($request->category == 'sellers') {
                    // $data['sellers']['cat_name']  =  'sellers';
                     $sellerCondition = ['role_id' => 4];
                     $data['sellers']['result'] = User::where('username', 'like', '%' . $searchQuery . '%')->where($sellerCondition)->paginate($per_page);
                     $data['sellers']['count'] = count($data['sellers']['result']);
                 // }

                 // if ($request->category == 'buyers') {
                    // $data[0]['cat_name']  =  'buyers';
                    $buyerCondition = ['role_id' => 3];
                    $data['buyers']['result'] = User::where('username', 'like', '%' . $searchQuery . '%')->where($buyerCondition)->paginate($per_page);
                    $data['buyers']['count'] = count($data['buyers']['result']);
                // }
            }  

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get Star Search Details',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

    }

    public function searchTalentMallUserCount(Request $request){
        try{
            $rules = array(
                'search' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            if(!empty($request['search'])){
                 $talents = [];
                 $categories = [];
                 $talentList ='';
                 $categoryList = '';
                 $talentListArr = [];
                 $categoryListArr = [];
                 $sellers = [];
                 $buyers = [];
                 
                $qry = str_split($request['search']);
                $n = '';
                foreach($qry as $q){
                    $n = $n . $q . "%";
                }
                 $searchQuery = rtrim($n, "%");

                 $condition = ['active' => 'Active' , 'approved'=> 1];
                 
                 $talents = Talents::where('title', 'like', '%' . $searchQuery . '%')->where($condition)->get();
                 $talentCount = count($talents);
                 $categories = TalentCatagory::where('name', 'like', '%' . $searchQuery . '%')->get();
                 $categoriesCount = count($categories);
                 
                 $sellerCondition = ['role_id' => 4];
                 $sellers = User::where('username', 'like', '%' . $searchQuery . '%')->where($sellerCondition)->get();
                 $sellersCount = count($sellers);

                 $buyerCondition = ['role_id' => 3];
                 $buyers = User::where('username', 'like', '%' . $searchQuery . '%')->where($buyerCondition)->get();
                 $buyersCount = count($buyers);
                
                $result['category'] = [
                    [
                        'cat_name'  =>  'talent',
                        'count'     =>  $talentCount,
                    ],
                    [
                        'cat_name'  =>  'sellers',
                        'count'     =>  $sellersCount,
                    ],
                    [
                        'cat_name'  =>  'buyers',
                        'count'     =>  $buyersCount,
                    ],
                    [
                        'cat_name'  =>  'categories',
                        'count'     =>  $categoriesCount,
                    ],
                ];

            }  

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get Star Search Details Count',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' =>  $result,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

    }

}
 