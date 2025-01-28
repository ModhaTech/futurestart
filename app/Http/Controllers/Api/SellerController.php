<?php 

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Plans;
use App\Models\SellerPlans;
use App\Models\CustomPlans;
use App\Models\CommercialAds;
use Auth;
use Illuminate\Http\Request;
use App\Models\Talents;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Traits\MailsendTrait;
use Validator;


class SellerController extends ApiController
{
	use MailsendTrait;

	public function getSellerDeletedProduct(Request $request) {
        try {
        	$per_page = $request->per_page ? $request->per_page : 10;
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $days = $request->day ? $request->day : 0;
            $newDay = ($days - 1);
            // return $newDay;
            $today_date = Carbon::now()->format('Y-m-d');
            $end_date = Carbon::now()->subDays($newDay)->format('Y-m-d');
            if (!empty($days) && $days > 0) {
                $whereCondition = ['user_id' => $id, 'active' => 'Deactive'];
                $talents = Talents::where($whereCondition)->orderBy('id', 'DESC')->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->where('talents.deleted_at', '>=', $end_date)->whereHas('getUserData', function ($query) {
                    $query->where('users.id', '!=', '');
                })->paginate($per_page);
            } else {
                $whereCondition = ['user_id' => $id, 'active' => 'Deactive'];
                $talents = Talents::where($whereCondition)->orderBy('id', 'DESC')->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->whereHas('getUserData', function ($query) {
                    $query->where('users.id', '!=', '');
                })->paginate($per_page);

                // $talents = Talents::with('getTalentCategories', 'user')->where($whereCondition)->where('talents.date', '<=', $today_date)->where('talents.date', '>=', $end_date)->orderBy('id', 'DESC')->paginate($per_page);
            }
            $data['products'] = $talents;
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get Deleted Product successfully.',
                'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

	public function bulkDeleteProducts(Request $request) {
        try {
            $rules = array(
                'talent_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            if (!empty($request->talent_id)) {
                $talentId = $request->talent_id;
                $talentArray = [
                	'active' => 'Deactive', 
                	'deleted_at' => Carbon::now()->format('Y-m-d')
                ];
                $talentsDeleted = Talents::WhereIn('id', $talentId)->update($talentArray);
                if (!empty($talentsDeleted)) {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Deleted successfully.'
                    ]);
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unable to deleted the products.'
                    ]);
                }
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function recoverDeleteProduct(Request $request) {
        try{
            $rules = array(
                'talent_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            if (!empty($request->all())) {
                $talentId = $request->talent_id;
                $talentArray = ['active' => 'Active', 'deleted_at' => null];
                $talentsDeleted = Talents::WhereIn('id', $talentId)->update($talentArray);
                if (!empty($talentsDeleted)) {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Recover deleted successfully.'
                    ]);
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unable to recover the products.'
                    ]);
                }
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function deleteProductPermanently(Request $request) {
    	try {
            $rules = array(
                'talent_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            if (!empty($request->all())) {
                $talentId = $request->talent_id;
                $talentsDeleted = Talents::WhereIn('id', $talentId)->delete();
                if (!empty($talentsDeleted)) {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Permanently deleted successfully.'
                    ]);
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unable to permanently delete the products.'
                    ]);
                }
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function commercialAds(Request $request) {
        try {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $palns = [];
            $sellerPlan = [];
            $data['plan'] = Plans::all();
            $condition = ['user_id' => $id, 'end_date' => date('Y-m-d H:i:s') ];
            $data['sellerPlan'] = SellerPlans::where($condition)->orderBy('id', 'DESC')->first();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Commercial Ad Plan',
                'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function commercialAdDashboard(Request $request) {
        try {
            $sellerAds = [];
            $activePlan = [];
            $per_page = $request->per_page ? $request->per_page : 0;
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $data['sellerAds'] = CommercialAds::with('getSellerPlan','getPlanDetail','adViews')->where('user_id', '=', $id)->orderBy('id', 'DESC')->paginate($per_page);
            $activePlanWhere = ['user_id' => Auth::user()->id];
            $today = date('Y-m-d h:i:s');
            $data['activePlan'] = SellerPlans::with('getPlanDetail')->where($activePlanWhere)->where('start_date','<=',$today)->where('end_date','>=',$today)->first();
            
            // return $data;
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Commercial Ad Dashboard',
                'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function addCommercilaAds(Request $request) {
        try{
            $condition = ['user_id' => Auth::user()->id ,'approved' => 1 ,'active' =>'Active','delete_flag'=>0];
            $data['talents'] = Talents::where($condition)->get();
            $empty_array = [
                "id"=> 0,
                "user_id"=> 0,
                "talent_category_id"=> 1,
                "title"=> "please select talent",
                "slug"=> "",
                "description"=> "",
                "price"=> "",
                "product_info"=> "",
                "avg_rating"=> 0,
                "view"=> 13,
                "facebookLink"=> "https://www.facebook.com",
                "instagramLink"=> "https://www.instagram.com",
                "twitterLink"=> "https://www.twitter.com",
                "active"=> "Active",
                "approved"=> 1,
                "award"=> null,
                "delete_flag"=> 0,
                "deleted_at"=> "2022-05-30",
                "date"=> "2022-03-30",
                "created_by"=> 7316,
                "updated_by"=> 7316,
                "created_at"=> null,
                "updated_at"=> "2022-07-17T02:06:33.000000Z"
            ];
            if(count($data['talents']) > 0){
                $i = count($data['talents'])-1;
                for($i;$i>=0;$i--){
                    if($i >= 0){
                        $data['talents'][$i+1] = $data['talents'][$i];
                        if($i == 0){
                            $data['talents'][$i] = $empty_array;
                        }
                    }
                }
            }else{
                $data['talents'][0] = $empty_array;
            }

            //$data2['talents'] = array_push($data['talents'],$empty_array);
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Commercial Ad Dashboard',
                'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function storeCommercialAd(Request $request){
        try {

            $rules = array(
                'title' => 'required',
                'banner' => 'required|mimes:jpg,jpeg,png,mkv,mp4,wav|max:5000',
                'product_id' => 'required',
                'product_url' => 'required'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            if($request->has('banner')) {
                $video = $request->file('banner');
                
                $extension = $video->extension();
                $fileName = md5($video->getClientOriginalName()). '.' .$extension;
                
                $pathName = ('uploads/commercial-ads/' . $fileName);
                $path = storage_path();
                $video->move('uploads/commercial-ads/', $fileName);
            }
            $currentSellerPlan = SellerPlans::where('user_id', '=', Auth::user()->id)->first();
            
            if(!empty($currentSellerPlan)) {
                $adMediaArray =  [
                    'seller_plan_id' => $currentSellerPlan['id'],
                    'user_id' => Auth::user()->id,
                    'description' => $request['title'],
                    'video_name' => $fileName,
                    'video_path' => $pathName,
                    'product_id' => $request['product_id'],
                    'product_url' => $request['product_url'],
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id
                ];
                $addCommercilaAds = CommercialAds::insert($adMediaArray);
                if($addCommercilaAds) {
                     return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Commercila Ad Successfully.'
                    ]);
                } else {
                	return $this->respond([
	                    'status' => 'error',
	                    'status_code' => $this->getStatusCode(),
	                    'message' => 'Unable to add ad at a moment.'
	                ]);
                }
            } else {
            	return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Unable to process your request.You do not have any active plan yet.'
                ]);
            }
         } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function productUrl(Request $request) {

        try {
             
            $rules = array(
                'product_id' => 'required'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $data['product_url'] = route('talent.productInfo', Crypt::encryptString($request->product_id));
	        return $this->respond([
	                'status' => 'success',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'Product URL',
	                'data'	=>	$data
	        ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function postCustomPlan(Request $request) {
        try {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $rules = array(
                'custom_plan' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } else {
                $createArray = ['custom_plan' => $request['custom_plan'], 'user_id' => $id, 'created_by' => $id, 'updated_by' => $id];
                $create = CustomPlans::insert($createArray);
                if (!empty($create)) {
                    $message['content'] = $request['custom_plan'];
                    $this->customPlanMail($message);

                    $data['custom_plan'] = $create;
                    return $this->respond([
		                'status' => 'success',
		                'status_code' => $this->getStatusCode(),
		                'message' => 'Custom plan has been sent successfully.',
		                'data'	=>	$data
		          	]);
                } else {
                	return $this->respond([
		                'status' => 'success',
		                'status_code' => $this->getStatusCode(),
		                'message' => 'Error while sending custom plan.',
		                'data'	=>	$data
		          	]);
                }
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}