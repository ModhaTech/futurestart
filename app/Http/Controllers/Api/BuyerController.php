<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\BuyerProducts;
use App\Models\Talents;
use App\Models\CommercialMedia;
use App\Models\SampleMedia;
use App\Models\ProductMedia;
use App\Models\TalentRatings;
use App\Models\BuyerContacts;
use App\Models\TalentComments;
use App\Models\PurchasedProduct;
use App\Models\SocialBuzzRiders;
use App\Models\Fanbase;
use App\Models\TalentRiders;
use App\Models\ChatMessage;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileRequest;
use App\Models\Chats;
use App\Models\FavrioteUser;
use App\Models\SocialFacebookAccount;
use App\Models\VideoCall;
use Illuminate\Support\Facades\Crypt;
use Session;
use Route;
use Response;
use Image as Image;
use Hash;
use DB;
use URL;
use App\Models\LivestreamVideo;
use App\Models\LivestreamCount;
use App\Models\LivestreamComment;
use App\Traits\MailsendTrait;

class BuyerController extends ApiController
{
	public function index(Request $request){
		try{
			$per_page = $request->per_page ? $request->per_page : 10;
	        $whereArr = array('buyer_id' => Auth::id(), 'active' => 1);
	        $data['products'] = BuyerProducts::where($whereArr)->with('getUserData', 'getTalent', 'getCommercila', 'getSampleMedia', 'getProductMedia')->whereHas('getUserData', function ($query) {
	            $query->where('users.id', '!=', '');
	        })->whereHas('getTalent', function ($query) {
	            $query->where('talents.id', '!=', '');
	        })->paginate($per_page);

	        $data['user'] = Auth::user();
	        return $this->respond([
		        'status' => 'success',
		        'status_code' => $this->getStatusCode(),
		        'message' => 'Get Product successfully.',
		        'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}


	public function addCommentToTalent(Request $request){

       try {
       	    $rules = array(
                'comment' => 'required',
                'talent_id' => 'required|numeric|min:0|not_in:0'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

               
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $messageArray = ['talent_id' => $request['talent_id'],'buyer_id'=> $id, 'comment' => $request['comment'], 'created_by' => $id, 'updated_by' => $id];
            $data['comment'] = TalentComments::create($messageArray);

            return $this->respond([
		        'status' => 'success',
		        'status_code' => $this->getStatusCode(),
		        'message' => 'comment saved successfully.',
		        'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function addBuyerRating(Request $request) 
    {
		try 
        {
            
            $rules = array(
            	'award_to_talent' => 'required',
                'comment' => 'required',
                'talent_id' => 'required|numeric|min:0|not_in:0');

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $t = Talents::where('id', $request->talent_id)->first();
            if ($t == null) 
            {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Talent id is invalid',
                ]);
            }

            $id = isset(Auth::user()->id) ? Auth::user()->id : '';
            $now = Carbon::now();
            $whereCondition = ['talent_id' => $request['talent_id'], 'user_id' => $id];
            $talentRating = TalentRatings::where($whereCondition)->first();
            /* if rating not found */
            if (empty($talentRating)) 
            {
                $ratingArray = ['user_id' => $id, 'talent_id' => $request['talent_id'], 'rating' => $request['award_to_talent'], 'buyer_comment' => $request['comment'], 'created_by' => $id, 'updated_by' => $id];
                $rating = TalentRatings::create($ratingArray);
                $talentRating = getTalentRating($request['talent_id']);
                $condition = ['id' => $request['talent_id']];
                $updateArray = ['avg_rating' => $talentRating];
                $ratingUpdate = Talents::where($condition)->update($updateArray);
                if (!empty($ratingUpdate)) 
                {
                    return $this->respond([
				        'status' => 'success',
				        'status_code' => $this->getStatusCode(),
				        'message' => 'Rating add successfully.',
				        // 'data'	=>	$data
		            ]);
                }
                /* if rating Found */
            } 
            else 
            {
                $updateArray = ['rating' => $request['award_to_talent'], 'buyer_comment' => $request['comment'], 'updated_by' => $id, 'updated_at' => $now];
                $condition = ['talent_id' => $request['talent_id'], 'user_id' => $id];
                $updated = TalentRatings::where($condition)->update($updateArray);
                $talentRating = getTalentRating($request['talent_id']);
                $condition = ['id' => $request['talent_id']];
                $updateArray = ['avg_rating' => $talentRating];
                $ratingUpdate = Talents::where($condition)->update($updateArray);
                if (!empty($ratingUpdate)) 
                {                    
		            return $this->respond([
				        'status' => 'success',
				        'status_code' => $this->getStatusCode(),
				        'message' => 'Rating update successfully.',
				        // 'data'	=>	$data
		            ]);
                }
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function deleteBuyerProduct(Request $request) 
    {
        try 
        {
        	$rules = array(
            	'id' => 'required|numeric|min:0|not_in:0',
                'talent_id' => 'required|numeric|min:0|not_in:0');

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

			$id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $condition = ['id' => $request['id'], 'buyer_id' => $id, 'talent_id' => $request['talent_id']];
            $checkProduct = BuyerProducts::where($condition)->first();
            if (!empty($checkProduct)) {
                $active = 0;
                $productArray = ['active' => $active];
                $updatedId = BuyerProducts::where($condition)->update($productArray);
                if (!empty($updatedId)) {
                    return $this->respond([
				        'status' => 'success',
				        'status_code' => $this->getStatusCode(),
				        'message' => 'Product delete successfully.',
				        // 'data'	=>	$data
		            ]);
                }
            }
            return $this->respond([
		        'status' => 'success',
		        'status_code' => $this->getStatusCode(),
		        'message' => 'Product unable to delete.',
		        // 'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function downloadBuyerProduct(Request $request){

        try{
                
            $rules = array(
                'talent_id' => 'required|numeric|min:0|not_in:0'

            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

    		$id = !empty(Auth::user()->id)?Auth::user()->id:'';
            $talent_ids_with_time  = $request['talent_id'].time();

            $allMedia = CommercialMedia::with('getProductMedia','getSampleMedia')->where('talent_id','=',$request['talent_id'])->get();

            $str_storage_path = 'assets/app/products/';
            
            if(!empty($allMedia))

            foreach ($allMedia as  $value) {
                
                if(!empty($value->image_path)) {

                    $filename = substr($value->image_path, strrpos($value->image_path, '/') + 1);

                    $copy_path = $str_storage_path.$talent_ids_with_time . '/commercial_product/';
                    File::makeDirectory($copy_path, 0777, true, true);
                    
                       if (file_exists($value->image_path)) {
                            if (copy($value->image_path, $copy_path . $filename)) {
                                
                            } 
                        } 
                }

                if(!empty($value->getProductMedia)) 
                {
                   
                    $filename = substr($value->getProductMedia->pdf_path, strrpos($value->getProductMedia->pdf_path, '/') + 1);
                    $copy_path = $str_storage_path . $talent_ids_with_time . '/product_media/';

                    File::makeDirectory($copy_path, 0777, true, true);

                      if (file_exists($value->getProductMedia->pdf_path)) 
                      {
                        if (copy($value->getProductMedia->pdf_path, $copy_path . $filename)) 
                        {
                                    
                        } 
                      }
                }
                    
                if(!empty($value->getSampleMedia)) 
                {

                    $filename = substr($value->getSampleMedia->path_name, strrpos($value->getSampleMedia->path_name, '/') + 1);
                    $copy_path = $str_storage_path . $talent_ids_with_time . '/sample_media_arr/';
                  
                    File::makeDirectory($copy_path, 0777, true, true);
                    if (file_exists($value->getSampleMedia->path_name)) 
                    {
                        if (copy($value->getSampleMedia->path_name, $copy_path.$filename)) 
                        {
                        }
                    }
                }            
            }
             
           
            $files = glob($str_storage_path . $talent_ids_with_time);

            \Madzipper::make('assets/app/all_zip/talent_product' . $request['talent_id'] . '.zip')->add($files)->close();
            $download_url = array(
                "download_url" => URL::to('/') . "/assets/app/all_zip/talent_product" . $request['talent_id'] . ".zip",
            );

            File::deleteDirectory($str_storage_path . $talent_ids_with_time);
            $data['zip'] = $download_url;
            
            return $this->respond([
		        'status' => 'success',
		        'status_code' => $this->getStatusCode(),
		        'message' => 'Zipped product',
		        'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    // Start Video Calling Api Code
    // sender side api

       public function postCallingApi(Request $request)
    {
        $mytime = Carbon::now();
    // End Condition code
        $sender_data = VideoCall::where('sender_id',$request->receiver_id)->where('status',2)->first();

        if (!empty($sender_data)) 
        {
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
               // 'message' => 'User busy',
                'data'  =>  $sender_data
                 ]);
        }

        else
        {
          $receiver_data = VideoCall::where('receiver_id',$request->receiver_id)->where('status',2)->first();
          if (!empty($receiver_data)) 
          {
               return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                //'message' => 'User busy',
                'data'  =>  $receiver_data
                ]);
          }
          else
          {
             $receiver_data = VideoCall::where('receiver_id',$request->receiver_id)->where('sender_id',Auth::user()->id)->first();
             if (!empty($receiver_data)) 
             {
                    $receiver_data->status = 1;
                    $receiver_data->status_type = "calling";
                    $receiver_data->message = "User busy";
                    $receiver_data->type = $request->type;
                    $receiver_data->call_time = $mytime->toDateTimeString();
                    $receiver_data->update();
                     return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        // 'message' => 'calling',
                        'data'  =>  $receiver_data
                    ]);
             }
             else
             {
                    $new_receiver_data = new VideoCall();
                    $new_receiver_data->receiver_id = $request->receiver_id;
                    $new_receiver_data->sender_id = Auth::user()->id;
                    $new_receiver_data->profile_name = Auth::user()->username;
                    $new_receiver_data->profile_img = Auth::user()->profile_pic;
                    $new_receiver_data->status = 1;
                    $new_receiver_data->status_type = "calling";
                    $new_receiver_data->message = "User busy";
                    $new_receiver_data->type = $request->type;
                    $new_receiver_data->call_time = $mytime->toDateTimeString();
                    $new_receiver_data->save();
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        //'message' => 'calling',
                        'data'  =>  $new_receiver_data
                    ]);

             }
          }
        }

     // End Condition code

      
    }


    public function getCallingApi(Request $request)
    {
         $receiver_data = VideoCall::where('receiver_id',$request->receiver_id)->where('sender_id',Auth::user()->id)->first();
         return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'  =>  $receiver_data
            ]);
    }
     public function postRejectCallingApi(Request $request)
    {
       $mytime = Carbon::now();
       $receiver_data = VideoCall::where('receiver_id',$request->receiver_id)->where('sender_id',Auth::user()->id)->first();
       
        if (!empty($receiver_data)) 
        {
            if (($receiver_data->status == 1) or ( $receiver_data->status == 2)) 
            {
                $receiver_data->status = 4;
                $receiver_data->status_type = "sender_rejected";
                $receiver_data->message = "call reject by sender";
                $receiver_data->call_endtime = $mytime->toDateTimeString();
                $receiver_data->update();

                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'  =>   $receiver_data
                ]);
            }
            else
            {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'  =>   $receiver_data
                ]);
            }
        }
         
    }
    // sender side api

    // Receiver Side Api
     public function postReceivingApi(Request $request)
    {
        $mytime = Carbon::now();

        $sender_data = VideoCall::where('receiver_id',Auth::user()->id)->where('status',1)->first();
        
        if (!empty($sender_data)) 
        {
            $sender_data->status = 2;
            $sender_data->status_type = "connected";
            $sender_data->message = "User busy on another call";
            $sender_data->update();
             return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'  =>  $sender_data
            ]);
        }
    }
    public function getReceivingApi(Request $request)
    {

        if (isset($request->status_type)) 
        {
            $sender_data = VideoCall::where('receiver_id',Auth::user()->id)->where('status',1)->where('status_type', $request->status_type)->first();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'  =>  $sender_data
            ]);
        }
        else
        {
            $sender_data = VideoCall::where('receiver_id',Auth::user()->id)->where('status','!=',0)->where('id', $request->id)->first();
            if (!empty($sender_data)) 
            {
                return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'  =>  $sender_data
                ]);
            }
            else
            {
                $sender_data = VideoCall::where('sender_id',Auth::user()->id)->where('status','!=',0)->where('id', $request->id)->first();
                return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'  =>  $sender_data
                ]);
            }
        }
    }
    public function postRejectReceivingApi(Request $request)
    {
       $mytime = Carbon::now();
       $sender_data = VideoCall::where('receiver_id',Auth::user()->id)->where('id', $request->id)->first();
       
        if (!empty($sender_data)) 
        {
            if (($sender_data->status == 1) or ( $sender_data->status == 2)) 
            {
                $sender_data->status = 3;
                $sender_data->status_type = "receiver_rejected";
                $sender_data->message = "call reject by receiver";
                $sender_data->call_endtime = $mytime->toDateTimeString();
                $sender_data->update();

                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'  =>   $sender_data
                ]);
            }
            else
            {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'  =>   $sender_data
                ]);
            }
        }  
    }
    // Receiver Side Api

    // Live Stream Api
    public function postLiveStreamApi(Request $request)
    {
       if (Auth::check()==true) 
        {
            $livestream_data = LivestreamVideo::where('user_id',Auth::user()->id)->first();
            if (!empty($livestream_data)) 
            {
                if ($livestream_data->status == 1) 
                {
                    LivestreamCount::where('stream_id',Auth::user()->id)->Delete();
                    LivestreamComment::where('stream_id',Auth::user()->id)->Delete();
                    $livestream_data->type = "offline";
                    $livestream_data->status = 2;
                    $livestream_data->update();
                    return $livestream_data;
                }
                else
                {
                    $livestream_data->type = "online";
                    $livestream_data->status = 1;
                    $livestream_data->update();
                    return $livestream_data;
                }
            }
            else
            {
                $live_video = new LivestreamVideo();
                $live_video->user_id = Auth::user()->id;
                $live_video->type = "online";
                $live_video->status = 1;
                $live_video->save();
                return $live_video;
            }
        } 
    }

     // Stream Visitor Count
    public function postVisitorStream(Request $request)
    {
        $view_id = Auth::user()->id;
        $livestream_view = LivestreamCount::where('stream_id',$request->stream_id)->where('view_id',$view_id)->first();
            if (!empty($livestream_view)) 
            {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => "Stream already view",
                    'data'  =>   $livestream_view
                ]);
            }
            else
            {
                $live_stream = new LivestreamCount();
                $live_stream->stream_id = $request->stream_id;
                $live_stream->view_id = $view_id;
                $live_stream->save();
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => "Stream viewer add ",
                    'data'  =>   $live_stream
                ]);
            }
    }
    public function postVisitorStreamComment(Request $request)
    {
        $live_streamcomment = new LivestreamComment();
        $live_streamcomment->stream_id = $request->stream_id;
        $live_streamcomment->comment_id = Auth::user()->id;
        $live_streamcomment->comment = $request->stream_comment;
        $live_streamcomment->save();
         return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => "Stream comment add",
                    'data'  =>   $live_streamcomment
                ]);
        
    }

     public function liveStreamViewCountComment(Request $request)
    {
        $view_count = LivestreamCount::where('stream_id',$request->stream_id)->count();
       
        $view_comment = DB::table('users')
                    ->join('livestream_comments', 'livestream_comments.comment_id', '=', 'users.id')
                     ->select('livestream_comments.comment','users.username','users.profile_pic')
                    ->where('livestream_comments.stream_id', $request->stream_id)
                    ->get();
    
        return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => "Stream comment and count get",
                    'view_count' => $view_count,
                    'view_comment' => $view_comment
                ]);
        
    }
    // Live Stream Api

}