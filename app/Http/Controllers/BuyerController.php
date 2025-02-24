<?php
namespace App\Http\Controllers;
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
use App\Models\LivestreamVideo;
use App\Models\VideoCall;
use App\Models\FavrioteUser;
use App\Models\SocialFacebookAccount;
use Illuminate\Support\Facades\Crypt;
use Session;
use Route;
use Response;
use Redirect;
use Image as Image;
use Hash;
use DB;
use URL;
use App\Traits\MailsendTrait;
use App\Models\LivestreamCount;
use App\Models\LivestreamComment;

class BuyerController extends Controller 
{

    use MailsendTrait;
    /*** Display a listing of the resource.** @return \Illuminate\Http\Response */

    public function index(Request $request) 
    {
        if (Auth::check()) 
        {
            $buyers = [];
            $userId = !empty(Auth::user()) ? Auth::user()->id : '';
            $user = User::find($userId);
            if (!empty($userId)) 
            {
                $buyers = array();
                $whereArr = array('buyer_id' => $userId, 'active' => 1);
                $buyers = BuyerProducts::where($whereArr)->with('getUserData', 'getTalent', 'getCommercila', 'getSampleMedia', 'getProductMedia')->whereHas('getUserData', function ($query) 
                {
                    $query->where('users.id', '!=', '');
                })->whereHas('getTalent', function ($query) 
                {
                    $query->where('talents.id', '!=', '');
                })->paginate(9);


                /** check user login by social provider or by website ***/
                $metaTags = [];
                $metaTags['title'] = 'Future Starr | Buyer Dashboard';
                return view('frontend.buyer.dashboard', compact('buyers', 'user', 'metaTags'));
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    /*** Show the form for creating a new resource.** @return \Illuminate\Http\Response*/
    public function create() 
    {
        //
    }
    /*** updateUserAccount a newly created resource in storage.** @param  \Illuminate\Http\Request  $request * @return \Illuminate\Http\Response*/
    public function updateUserAccount(Request $request) 
    {
        if(!empty(Auth::check())) 
        {
             if($request->ajax()) 
             {
                $id = !empty(Auth::user()->id)?Auth::user()->id:'';
                $role_id = $request['role'];
                $condition = ['id' => $id];
                $updateArray = ['role_id' => $role_id , 'role_id'=> $role_id,'role_after_social_login' => $role_id];
                $updateRole = User::where($condition)->update($updateArray);
                if($updateRole) 
                {
                   $response = ['success' => 'Your account has been updated successfully!'];
                   return Response::json($response);
                } 
                else 
                {
                   $response = ['error' => 'Something went wrong'];
                   return Response::json($response);
                }
             }
        } 
        else 
        {
             Session::flash('info', 'You must be login firstly.');
             return redirect('/');
        }
    }
    /*** Display the specified resource.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function show() 
    {
        if(!empty(Auth::check())) 
        {
           $checkUserlogin = [];
           $id = !empty(Auth::user()->id)?Auth::user()->id:'';
           $condition = ['id' => $id , 'role_after_social_login' => 0];
           $checkUserlogin = User::where($condition)->with('checkScoialLogin')->whereHas('checkScoialLogin', function ($query) {
                $query->where('social_facebook_accounts.user_id', '!=', '');
            })->first();
            if(!empty($checkUserlogin)) 
            {
                $response = ['checkUserlogin' => $checkUserlogin];
                return Response::json($response);
            } 
            else 
            {
                $response = ['checkUserlogin' => null];
                return Response::json($response);
            }
        } 
        else  
        {
             Session::flash('info', 'You must be login firstly.');
             return redirect('/');
        }
    }

    /*** Show the form for editing the specified resource.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function edit(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $profileData = User::find($id);
            return view('frontend.buyer.profile', compact('profileData'));
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

     /*** Update the specified resource in storage.** @param  \Illuminate\Http\Request  $request* @param  int  $id* @return \Illuminate\Http\Response*/
    public function update(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            if (!empty($request->all())) 
            {
                $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                $request->validate([
                     'username' => 'required|unique:users,username,' . $id, 
                     'buyer_bio_information' => 'required|max:160',
                     'first_name' => 'required|regex:/^[a-zA-Z]+$/u', 
                     'last_name' => 'required|regex:/^[a-zA-Z]+$/u',
                     'email' => 'required|email|unique:users,email,' . $id, 
                     'address' => 'required',
                     'city' => 'required',
                     'state' => 'required', 
                     'zip_code' => 'required|numeric', 
                     'phone' =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:10'
                 ]);
                if($request->first_name == $request->last_name)
                {
                    return Redirect::back()->withErrors(['last_name' => 'first name and last name are same']);
                 }
                if($request->buyer_bio_information)
                {
                    if (str_contains($request->buyer_bio_information, 'https://www.') || str_contains($request->buyer_bio_information, 'www.') || str_contains($request->buyer_bio_information, 'https://') || str_contains($request->buyer_bio_information, 'http://')) 
                    { 
                    session::flash('error', 'URL is not allowed in Bio Information');
                    return redirect('buyer/account-setting');
                    }
                }
                  try 
                  {
                    if ($request->hasFile('profile_pic')) 
                    {
                        $image = $request->file('profile_pic');
                       
                        $extension = $image->extension();
                        $name = md5($image->getClientOriginalName()). '.' .$extension;

                        $destinationPath = public_path('/userImage');
                        chmod($image->move($destinationPath, $name), 0777);
                        $imageName = 'userImage/'.$name;
                     } 
                     else if(!empty($request['old_image']))
                     {
                         $imageName = $request['old_image'];
                     }    
                     else 
                     {
                         $imageName = '';
                     }
                    $user = user::findOrFail($id);
                    $user->username = $request['username'];
                    $user->description = $request['buyer_bio_information'];
                    $user->first_name = $request['first_name'];
                    $user->last_name = $request['last_name'];
                    $user->profile_pic  = $imageName;
                    $user->email = $request['email'];
                    $user->address = $request['address'];
                    $user->city = $request['city'];
                    $user->state = $request['state'];
                    $user->zip_code = $request['zip_code'];
                    $user->phone = $request['phone'];
                    $user->save();
                    Session::flash('success', 'Profile updated successfully.');
                    return redirect('buyer/account-setting');
                  }
                catch(ModelNotFoundException $err) 
                {
                    Session::flash('warning', 'Somethingwent wrong.unable to update the profile at a moment.');
                    return redirect('/buyer/account-setting/');
                }
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    /*** Show the form for manage the public profile resource.** @param  int  $id
     * @return \Illuminate\Http\Response*/

    public function profile(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            $data = [];
            $data = User::find(Auth::user()->id);
            return view('frontend.buyer.profile_data', compact('data'));
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /*** Update the specified resource in storage.** @param  \Illuminate\Http\Request  $request* @param  int  $id* @return \Illuminate\Http\Response*/

     public function public_profile_store(Request $request) 
     {
        //  $request->validate([
        //     'encode_image' => 'required|image|mimes:jpeg,png,jpg',
        //     'video_bio' => 'required|mimes:mp4,wav'
        // ]);

        if(!empty(Auth::check())) 
        {
            if($request->bio_info)
            {
                    if (str_contains($request->bio_info, 'https://www.') || str_contains($request->bio_info, 'www.') || str_contains($request->bio_info, 'https://') || str_contains($request->bio_info, 'http://')) 
                    { 
                        session::flash('error', 'URL is not allowed in Bio Information');
                        return redirect('buyer/public-profile');
                    }
            }
                $image_data = $request['encode_image'];
                if(!empty($image_data)) 
                {
                    $image_array_1 = explode(";", $image_data);
                    $image_array_2 = explode(",", $image_array_1[1]);
                    $data = base64_decode($image_array_2[1]);
                    $image_name = time().$request['author_first_name']. '.png';
                    $upload_path = public_path('userImage/banner/' . $image_name);
                    file_put_contents($upload_path, $data);
                    $path_name = 'userImage/banner/' . $image_name;
                    
                    if($request['db-banner-image'] != '' && file_exists($request['db-banner-image']))
                    {
                         unlink($request['db-banner-image']);
                    } 
                } 
                else 
                {
                     $path_name = $request['db-banner-image'];
                }

            if($request->has('video_bio') ) 
            {
                $video = $request->file('video_bio');

                $extension = $video->extension();
                $video_name = md5($video->getClientOriginalName()). '.' .$extension;

                $video_path = 'userImage/video-bio/'.$video_name;
                $video->move('userImage/video-bio/', $video_name);
                if($request['db-video-name'] != '' && file_exists($request['db-video-name']))
                {
                    unlink($request['db-video-name']);
                } 
            }  
            else 
            {
                $video_path = $request['db-video-name'];
            }
             
          
            if(file_exists($path_name) && file_exists($video_path))
            {

                 $table_array = ['banner_image' => $path_name, 'bio_video' => $video_path ,'description' => $request['bio_info'] ];
                 $update = User::where('id', Auth::user()->id)->update($table_array);
                 if(!empty($update)) 
                 {
                    Session::flash('success', 'Profile data updated successfully!');
                    return redirect()->back();
                 } 
                 else 
                 {
                     Session::flash('error', 'Unbale to process the request. Please try agian later.');
                     return redirect()->back();
                 }
            } 
            else 
            {
                Session::flash('error', 'Unable to upload the requested files. Please try agian later.');
                return redirect()->back();
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /*** Remove the specified resource from storage.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function destroy($id) 
    {
        
    }
    /*** Remove the specified product from storage.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function deleteBuyerProduct(Request $request) 
    {
        if (Auth::check()) 
        {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if ($request->ajax()) 
            {
                if (!empty($request->all())) 
                {
                    try 
                    {
                        $condition = ['id' => $request['id'], 'buyer_id' => $id, 'talent_id' => $request['talent_id']];
                        $checkProduct = BuyerProducts::where($condition)->first();
                        if (!empty($checkProduct)) 
                        {
                            $active = 0;
                            $productArray = ['active' => $active];
                            $updatedId = BuyerProducts::where($condition)->update($productArray);
                            if (!empty($updatedId)) 
                            {
                                $response = ['success' => 'Product deleted successfully.'];
                                return Response::json($response);
                            } 
                            else 
                            {
                                $response = ['error' => 'Unable to delete the product.'];
                                return Response::json($response);
                            }
                        }
                    }
                    catch(ModelNotFoundException $err) 
                    {
                        $response = ['warning' => 'Something went wrong.Unable to delete the Product at a moment.'];
                        return Response::json($response);
                    }
                }
            } 
            else 
            {
                Session::flash('warning', 'Bad Request');
                return redirect('/');
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /*** Add the Buyer rating to prodcut..** @param  int  $id* @return \Illuminate\Http\Response*/
    public function addBuyerRating(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            if ($request->ajax()) 
            {
                $rules = array('award_to_talent' => 'required', 'comment' => 'required');
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) 
                {
                    return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
                } 
                else 
                {
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
                            $response = ['success' => 'Rating added successfully to product..!!'];
                            return Response::json($response);
                        } 
                        else 
                        {
                            $response = ['Error' => 'Unable to add rating to Product'];
                            return Response::json($response);
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
                            $response = ['success' => 'Rating Updated successfully to product..!!'];
                            return Response::json($response);
                        } 
                        else 
                        {
                            $response = ['Error' => 'Unable to add rating to Product'];
                            return Response::json($response);
                        }
                    }
                }
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /*** Add the Buyer messages to prodcut..** @param  request all* @return \Illuminate\Http\Response*/
    public function addBuyerMessage(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            if ($request->ajax()) 
            {
                $rules = array('message_title' => 'required', 'message' => 'required');
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) 
                {
                    return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
                } 
                else 
                {
                    $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                    $messageArray = ['user_id' => $id, 'talent_id' => $request['talent_id'], 'msg_title' => $request['message_title'], 'message' => $request['message'], 'created_by' => $id, 'updated_by' => $id];
                    $buyerContacts = BuyerContacts::create($messageArray);

                    $talent = Talents::where('id', $request['talent_id'])->first();
                    $mess = new ChatMessage;
                    $mess->sent_by = Auth::id();
                    $mess->received_by = $talent->user_id;
                    $mess->message = $request->message;
                    $mess->save();
                    
                    if (!empty($buyerContacts)) 
                    {
                        $user = User::where('id', $talent->user_id)->first();
                        $message = [];
                        $name = $user->first_name.' '.$user->last_name;
                        $sender = Auth::user()->first_name.' '.Auth::user()->last_name;
                        $message = ['sender'=> $sender, 'name' => $name, 'email' => $user->email, 'message' => $request->message];
                        $sendOrfail = $this->sendChatMessageNotification($message);

                        $response = ['success' => 'Added successfully!!'];
                        return Response::json($response);
                    } 
                    else 
                    {
                        $response = ['Error' => 'Error while adding message.'];
                        return Response::json($response);
                    }
                }
            } 
            else 
            {
                $response = ['Error' => 'Bad Request'];
                return Response::json($response);
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /*** Add comment to talent by buyer.* @param  int  $id* @return \Illuminate\Http\Response
     */
    public function addCommentToTalent(Request $request){

       if (!empty(Auth::check())) 
       {
         if ($request->ajax()) 
         {
            $rules = array('comment' => 'required');
            $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) 
                {
                    return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
                } 
                else 
                {
                    $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                    $messageArray = ['talent_id' => $request['talent_id'],'buyer_id'=> $id, 'comment' => $request['comment'], 'created_by' => $id, 'updated_by' => $id];
                    $talentComment = TalentComments::create($messageArray);
                    if (!empty($talentComment)) 
                    {
                        $response = ['success' => 'Comment added successfully!!'];
                        return Response::json($response);
                    } 
                    else 
                    {
                        $response = ['error' => 'Error while adding message.'];
                        return Response::json($response);
                    }
                }
            } 
            else 
            {
                $response = ['error' => 'Bad Request'];
                return Response::json($response);
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    /*** Function to Download Buyer Product.* @param  int  $id* @return \Illuminate\Http\Response*/

    public function downloadBuyerProduct(Request $request)
    {
        if(!empty(Auth::check()))
        {
            $id = !empty(Auth::user()->id)?Auth::user()->id:'';
            if($request->ajax())
            {
                $talent_ids_with_time  = $request['talent_id'].time();
                $allMedia = CommercialMedia::with('getProductMedia','getSampleMedia')->where('talent_id','=',$request['talent_id'])->get();
                $str_storage_path = 'assets/app/products/';
            
            if(!empty($allMedia))
              foreach ($allMedia as  $value) 
              {
                if(!empty($value->image_path)) 
                 {
                $filename = substr($value->image_path, strrpos($value->image_path, '/') + 1);

               $copy_path = $str_storage_path.$talent_ids_with_time . '/commercial_product/';
               File::makeDirectory($copy_path, 0777, true, true);
               if (file_exists($value->image_path)) 
                {
                    if (copy($value->image_path, $copy_path . $filename)) 
                    {} 
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
                            {} 
                    }
                }
                        
                if(!empty($value->getSampleMedia)) 
                {
                    $filename = substr($value->getSampleMedia->path_name, strrpos($value->getSampleMedia->path_name, '/') + 1);
                    $copy_path = $str_storage_path . $talent_ids_with_time . '/sample_media_arr/';
                    File::makeDirectory($copy_path, 0777, true, true);
                    if (file_exists($value->getSampleMedia->path_name)) 
                    {
                        if(copy($value->getSampleMedia->path_name, $copy_path.$filename)) 
                            {}
                    }
                }            
              }
                 
              $files = glob($str_storage_path . $talent_ids_with_time);
              \Madzipper::make('assets/app/all_zip/talent_product' . $request['talent_id'] . '.zip')->add($files)->close();
              $download_url = array(
                    "download_url" => URL::to('/') . "/assets/app/all_zip/talent_product" . $request['talent_id'] . ".zip",
                );

              File::deleteDirectory($str_storage_path . $talent_ids_with_time);
              $response = ['zip' => $download_url];
              return Response::json($response);
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        } 
    }

    /*** Function to load view for chnage password.* @param  int  $id* @return \Illuminate\Http\Response*/
    public function changePassword() 
    {
        if (!empty(Auth::check())) 
        {
            $user = Auth::user();
            return view('frontend.buyer.change-password',compact('user'));
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /*** Function to set the new password.* @param  int  $id* @return
    \Illuminate\Http\Response*/
    public function setPassword(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            if ($request->all()) 
            {
                 $validatedData = $request->validate([
                    'current_password' => 'required|string|min:8',
                    'new_password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'required'
                    ],[
                        'new_password.required' => 'The Password field is required',
                    ]
                );

                if(!(Hash::check($request->get('current_password'), Auth::user()->password)))
                {
                    // The passwords matches

                    $res = 'Your current password does not matches with the password you provided. Please try again.';
                    $response = ['message' => $res,'status' => 201];
                            return $response;

                    // Session::flash('warning', 'Your current password does not matches with the password you provided. Please try again.');
                    // return redirect('/buyer/change-password');
                }
                if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) 
                {
                    //Current password and new password are same

                    $res = 'New Password cannot be same as your current password. Please choose a different password.';
                    $response = ['message' => $res,'status' => 202];
                                return $response;
                    // Session::flash('error', 'New Password cannot be same as your current password. Please choose a different password.');
                    // return redirect('/buyer/change-password');
                }
                //Change Password
                $user = Auth::user();
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
                $res = 'Password changed successfully !';
                $response = ['message' => $res,'status' => 200];
                            return $response;
                // Session::flash('success', 'Password changed successfully !');
                // return redirect('/buyer/change-password');
            }
        } 
        else 
        {
            $res = 'You must be login firstly.';
            $response = ['message' => $res,'status' => 201];
                        return $response;
            // Session::flash('info', 'You must be login firstly.');
            // return redirect('/');
        }
    }

    public function chatMessagees(Request $request) 
    {
       if(!empty(Auth::check())) 
       {
           $chats = Chats::with('getSenderProfile','getReciverProfile','getMessageCount','isFavroite')->where('sent_by', '=', Auth::user()->id)
            ->orWhere('received_by', '=', Auth::user()->id)
            ->orderBy('last_activity', 'desc')->get();
		   
		   $profileData = User::find(Auth::user()->id);

        //    dd( Auth::user()->id);
           return view('frontend.buyer.message',compact('chats', 'profileData'));
       }
    }
    public function favrioteUser(Request $request) 
    {
        if(!empty(Auth::check())) 
        {
            $id = !empty(Auth::user()->id)?Auth::user()->id:'';
            if($request->ajax())
            {
                $fav_user_id  = $request['fav_user_id'];
                $where = ['user_id' => $id , 'fav_user_id' => $fav_user_id];
                $check = FavrioteUser::where($where)->first();
                if(!empty($check)) 
                {
                    $delete = FavrioteUser::where($where)->delete();
                    if(!empty($delete))
                    {
                        $response = ['success' => 'Remove as Favriote user!!'];
                        return Response::json($response);
                    }
                } 
                else 
                {
                   $add = FavrioteUser::create($where);
                   if(!empty($add)) 
                   {
                      $response = ['success' => 'Added as Favriote user!!'];
                      return Response::json($response);
                   } 
                   else 
                   {
                      $response = ['error' => 'Unbale to add as Favriote user!!'];
                      return Response::json($response);
                   }
                }
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    } 

    // Start Video Calling code

    public function videoCallingStoredata(Request $request)
    {
        $mytime = Carbon::now();

        $sender_data = VideoCall::where('sender_id',$request->receiver_id)->where('status',2)->first();
        if (!empty($sender_data)) 
        {
            return $sender_data->status;
        }
        else
        {
           $receiver_data = VideoCall::where('receiver_id',$request->receiver_id)->where('status',2)->first();
                if (!empty($receiver_data)) 
                {
                    return $receiver_data->status;
                }
                else
                {
                    $video_data = VideoCall::where('receiver_id',$request->receiver_id)->where('sender_id',$request->sender_id)->first();


                    if (!empty($video_data)) 
                    {
                        $video_data->status = $request->status;
                        $video_data->status_type = $request->status_type;
                        $video_data->message = $request->message;
                        if ($request->type == null) 
                        {
                             $video_data->type = $video_data->type;
                        }
                        else
                        {
                            $video_data->type = $request->type;
                        }
                        $video_data->call_time = $mytime->toDateTimeString();
                        $video_data->update();
                        return $video_data;
                    }
                    else
                    {
                        $video_call = new VideoCall();
                        $video_call->receiver_id = $request->receiver_id;
                        $video_call->sender_id = $request->sender_id;
                        $video_call->profile_name = Auth::user()->username;
                        $video_call->profile_img = Auth::user()->profile_pic;
                        $video_call->status = $request->status;
                        $video_call->status_type = $request->status_type;
                        $video_call->message = $request->message;
                        $video_call->type = $request->type;
                        $video_call->call_time = $mytime->toDateTimeString();
                        $video_call->save();
                        return $video_call;
                    }
                }
        }
    }
    public function videoCallingCancle(Request $request)
    {
         $mytime = Carbon::now();
         $video_cancle = VideoCall::where('receiver_id',$request->receiver_id)->where('sender_id',$request->sender_id)->first();
         if (!empty($video_cancle)) 
         {
            $video_cancle->receiver_id = $request->receiver_id;
            $video_cancle->sender_id = $request->sender_id;
            $video_cancle->status = $request->status;
            $video_cancle->status_type = $request->status_type;
            $video_cancle->message = $request->message;
            $video_cancle->call_endtime = $mytime->toDateTimeString();
            $video_cancle->update();
            return $video_cancle;
         }
    }
    public function videoCallinggetdata(Request $request)
    {
        $user = VideoCall::where('receiver_id',Auth::user()->id)->where('status',1)->first();
        return $user;
    }
    public function videoPopupcancelsr(Request $request)
    {
        $popup_cancel = VideoCall::where('receiver_id',$request->receiver_id)->where('sender_id',$request->sender_id)->where('call_endtime', '>', Carbon::now()->subSeconds(10)->toDateTimeString())->first();
        if (!empty($popup_cancel)) 
        {
            return $popup_cancel;
        }
        else
        {
             $popup_cancel = VideoCall::where('receiver_id',$request->receiver_id)->where('sender_id',$request->sender_id)->where('call_time', '>', Carbon::now()->subSeconds(40)->toDateTimeString())->where('status',5)->first();
             return $popup_cancel;
        }
        
    }
     
    // End Video Calling code

    // Live Stream page code

    public function liveStreamPage()
    {
        return view('frontend.live-stream.live-page');
    }
    public function liveStreamPageStoreData(Request $request)
    {
       if (Auth::check()==true) 
        {
            $livestream_data = LivestreamVideo::where('user_id',$request->stream_id)->first();
            if (!empty($livestream_data)) 
            {
                if ($request->status == 2) 
                {
                    LivestreamCount::where('stream_id',$request->stream_id)->Delete();
                    LivestreamComment::where('stream_id',$request->stream_id)->Delete();
                    $livestream_data->type = $request->type;
                    $livestream_data->status = $request->status;
                    $livestream_data->update();
                    return $livestream_data;
                }
                else
                {
                    $livestream_data->type = $request->type;
                    $livestream_data->status = $request->status;
                    $livestream_data->update();
                    return $livestream_data;
                }
            }
            else
            {
                $live_video = new LivestreamVideo();
                $live_video->user_id = Auth::user()->id;
                $live_video->type = $request->type;
                $live_video->status = $request->status;
                $live_video->save();
                return $live_video;
            }
        } 
    }

    public function liveStreamViewCount(Request $request)
    {
    	$view_count = LivestreamCount::where('stream_id',$request->stream_id)->count();
       
        $view_comment = DB::table('users')
                    ->join('livestream_comments', 'livestream_comments.comment_id', '=', 'users.id')
                     ->select('livestream_comments.comment','users.username','users.profile_pic')
                    ->where('livestream_comments.stream_id', $request->stream_id)
                    ->get();
    
        $viewRender = view('frontend.live-stream.ajax-comment',compact('view_comment'))->render();
     return response()->json(array('success' => true,'view_count'=>$view_count,'viewRender'=>$viewRender));
        
    }
    public function liveStreamPageview()
    {
         return view('frontend.live-stream.live-all-video');
    }
    public function liveStreamPageVideoget($id)
    {
        $livestream_data_get = LivestreamVideo::where('user_id',$id)->where('type','online')->first();
        return view('frontend.live-stream.live-page-view',compact('livestream_data_get'));
    }
    // Live Stream page code
}
