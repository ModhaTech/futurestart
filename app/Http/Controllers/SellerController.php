<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\UsersRoles;
use App\Models\SellerInboxes;
use App\Models\TalentDownloads;
use App\Models\SocialAccounts;
use App\Models\BuyerProduct;
use App\Models\SampleMedia;
use App\Models\ProductMedia;
use App\Models\CommercialMedia;
use App\Models\Plans;
use App\Models\SellerPlans;
use App\Models\CommercialAds;
use App\Models\CommercialAdViews;
use App\Models\Talents;
use App\Models\TalentAwards;
use App\Models\SellerContacts;
use App\Models\CustomPlans;
use App\Models\BuyerProducts;
use App\Models\TalentCatagory;
use App\Models\PromoteProducts;
use App\Models\SocialPromoteUsers;
use App\Models\SocialShares;
use App\Models\SellerStripeAccounts;
use App\Models\PurchasedProduct;
use App\Models\Chats;
use App\Models\Sellerpost;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Crypt;
use Session;
use Route;
use Response;
use Carbon\Carbon;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Traits\MailsendTrait;
use DateTime;

class SellerController extends Controller {

    use MailsendTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        if (Auth::check()) 
        {

            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $talentAwardUsers = [];
            $condition = ['id' => $id];
            $userInfo = User::with('getUserRole', 'getMessages', 'getSocialAccounts')->Where($condition)->get();
            $talentCondition = ['user_id' => $id, 'active' => 'Active'];
            $talents = Talents::where($talentCondition)->get();
            if (!empty($talents)) 
            {
                $talentIdsArray = [];
                $talendAwardUsers = [];
                foreach ($talents as $key => $value) 
                {
                    array_push($talentIdsArray, $value->id);
                }
                $talendAwardUsers = TalentAwards::WhereIn('talent_id', $talentIdsArray)->with('getUsers', 'getTalents')->groupBy('talent_awards.user_id')->get();
            }
            $custom = ['title' => 'Future Starr | Seller Dashboard'];
            return view('frontend.seller.dashboard.index', compact('userInfo', 'talendAwardUsers', 'custom'));
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        //

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        //

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        //

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit() 
    {
        if(Auth::check()) 
        {
              $profileData = [];
              $profileData = Auth::user();
              $custom = ['title' => 'Future Starr | Edit Seller Account'];
              return view('frontend.seller.profile.index', compact('profileData','custom'));
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
	
	public function profile() 
    {
        if(Auth::check()) 
        {
              $profileData = [];
              $profileData = Auth::user();
              $custom = ['title' => 'Future Starr | Edit Seller Account'];
              return view('frontend.seller.profile.profile', compact('profileData','custom'));
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) 
    {
        if (!empty(Auth::check())) {
            if (!empty($request->all())) 
            {
                $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                $request->validate([
                    'username' => 'required|unique:users,username,' . $id,  
                    'seller_bio_information' => 'required', 
                    'first_name' => 'required|regex:/^[a-zA-Z]+$/u',
                    'last_name' => 'required|regex:/^[a-zA-Z]+$/u', 
                    'email' => 'required|email|unique:users,email,' . $id,
                    'address' => 'required', 
                    'city' => 'required',
                    'state' => 'required', 
                    'zip_code' => 'required|numeric', 
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:10'
                 ]);

                if($request->first_name == $request->last_name)
                {
                    return Redirect::back()->withErrors(['last_name' => 'first name and last name are same']);
                }
                if($request->seller_bio_information)
                {
                    if (str_contains($request->seller_bio_information, 'https://www.') || str_contains($request->seller_bio_information, 'www.') || str_contains($request->seller_bio_information, 'https://') || str_contains($request->seller_bio_information, 'http://')) 
                    { 
                    Session::flash('error', 'URL is not allowed in Bio Information');
                    return redirect('seller/account-setting');
                    }
                }
                try {
                      if ($request->hasFile('profile_pic')) {
                          $image = $request->file('profile_pic');
                        
                          $extension = $image->extension();
                          $name = md5($image->getClientOriginalName()). '.' .$extension;
                        
                        $destinationPath = public_path('/userImage');
                        chmod($image->move($destinationPath, $name), 0777);
                        $imageName = 'userImage/'.$name;
                     } else if(!empty($request['old_image'])){
                         $imageName = $request['old_image'];
                     }    else {
                         $imageName = '';
                     }
                    $user = user::findOrFail($id);
                    $user->username = $request['username'];
                    $user->description = $request['seller_bio_information'];
                    $user->first_name = $request['first_name'];
                    $user->last_name = $request['last_name'];
                    $user->profile_pic = $imageName;
                    $user->email = $request['email'];
                    $user->address = $request['address'];
                    $user->city = $request['city'];
                    $user->state = $request['state'];
                    $user->zip_code = $request['zip_code'];
                    $user->phone = $request['phone'];
                    $user->save();
                    Session::flash('success', 'Profile updated successfully.');
                    return redirect('seller/account-setting');
                }
                catch(ModelNotFoundException $err) {
                    Session::flash('warning', 'Something went wrong.unable to update the profile at a moment.');
                    return redirect('/seller/account-setting/');
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
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
           $custom = ['title' => 'Future Starr | Seller Messages'];
           return view('frontend.seller.profile.message',compact('chats', 'profileData','custom'));

       }
  }

        /*** Function to load view for chnage password.* @param  int  $id* @return \Illuminate\Http\Response*/
    public function changePassword() 
    {
        if (!empty(Auth::check())) 
        {
            $profileData = [];
            $profileData = Auth::user();
            $custom = ['title' => 'Future Starr | Seller Change Password'];
            return view('frontend.seller.profile.change-password',compact('profileData','custom'));
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /*** Function to set the new password.* @param  int  $id* @return \Illuminate\Http\Response*/
    public function setPassword(Request $request) 
    {
       // return $request->all();
        if (!empty(Auth::check())) 
        {
            if ($request->all()) 
            {
                $validatedData = $request->validate([
                    'current_password' => 'required|string|min:8',  
                    'new_password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'min:8'             
                    ],[
                        'new_password.required' => 'The Password field is required',
                    ]
                );
                
                if (!(Hash::check($request->get('current_password'), Auth::user()->password))) 
                {
                
                    $res = 'Your current password does not matches with the password you provided. Please try again.';

                     $response = ['message' => $res,'status' => 201];
                            return $response;
                    // The passwords matches
                    // Session::flash('warning', 'Your current password does not matches with the password you provided. Please try again.');
                    // return redirect('/seller/change-password');
                }
                if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) 
                {
                    $res = 'New Password cannot be same as your current password. Please choose a different password.';
                    $response = ['message' => $res,'status' => 202];
                            return $response;
                    //Current password and new password are same
                    // Session::flash('error', 'New Password cannot be same as your current password. Please choose a different password.');
                    // return redirect('/seller/change-password');
                }
                
                $user = Auth::user();
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
                $res = 'Password changed successfully !';
                $response = ['message' => $res,'status' => 200];
                            return $response;
                // Session::flash('success', 'Password changed successfully !');
                // return redirect('/seller/change-password');
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
    /*** Remove the specified resource from storage.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function destroy($id) 
    {
        //

    }
    /*** Update Scoial Media Account Details.*
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSocialMedia(Request $request) 
    {
        if (!empty(Auth::check())) {
            if (!empty($request->all())) {
                $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                $socialAccountArray = ['user_id' => $id, 'facebook_link' => $request['facebook_link'], 'twitter_link' => $request['twitter_link'], 'insta_link' => $request['insta_link'], 'user_id' => $id];
                $checkAlreadyExist = SocialAccounts::where($condition)->first();
                if (!empty($checkAlreadyExist)) {
                    $sociallAccounts = SocialAccounts::where($condition)->update($socialAccountArray);
                } else {
                    $sociallAccounts = SocialAccounts::create($socialAccountArray);
                }
                if (!empty($sociallAccounts)) {
                    $response = ['success' => 'Added successfully!!'];
                    return Response::json($response);
                } else {
                    $response = ['Error' => 'Error while adding message.'];
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
    /**
     * Commercial ads of Seller.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSellerAds(Request $request) 
    {
        if (!empty(Auth::check())) {
            $commercialAds = [];
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $condition = ['user_id' => $id];
            $commercialAds = CommercialAds::where($condition)->with('getPlan', 'getSellerPlan', 'getAdsViews','custom')->get();
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /************* SELLER PURCHASE COMMERCIAL ADS ****************/
    /**
     * Fetch  Seller Plans details .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commercialAds(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $palns = [];
            $sellerPlan = [];
            $plans = Plans::all();
            $condition = ['user_id' => $id, 'end_date' => date('Y-m-d H:i:s') ];
            $sellerPlan = SellerPlans::where($condition)->orderBy('id', 'DESC')->first();
            $custom = ['title' => 'Future Starr | Seller Commercial Ad Dashboard'];
            return view('frontend.seller.commercial.index', compact('plans', 'sellerPlan','custom'));
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Function to post the custom seller contact .
     *
     * @param  int  success
     * @return \Illuminate\Http\Response
     */
    public function postSellerContact(Request $request) 
    {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if ($request->ajax()) {
                $rules = array('name' => 'required', 'email' => 'required', 'message' => 'required');
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
                } else {
                    $createArray = ['user_id' => $id, 'username' => $request['name'], 'email' => $request['email'], 'description' => $request['message']];
                    $create = SellerContacts::create($createArray);
                    if (!empty($create)) {
                        $response = ['success' => 'Added successfully!!'];
                        return Response::json($response);
                    } else {
                        $response = ['error' => 'Unable to add contact.'];
                        return Response::json($response);
                    }
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Function to post custom plan.
     * payment method :  PAYPAL
     * @param  int  success
     * @return \Illuminate\Http\Response
     */
    public function postCustomPlan(Request $request) 
    {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $rules = array('custom_plan' => 'required',);
            $customMessages = ['required' => 'Write something in textbox.'];
            $validator = Validator::make($request->all(), $rules, $customMessages);
            if ($validator->fails()) {
                return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
            } else {
                $createArray = ['custom_plan' => $request['custom_plan'], 'user_id' => $id, 'created_by' => $id, 'updated_by' => $id];
                $create = CustomPlans::insert($createArray);
                if (!empty($create)) {
                    $message['content'] = $request['custom_plan'];
                    $this->customPlanMail($message);
                    $response = ['success' => 'Custom plan has been sent successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Error while sending custom plan.'];
                    return Response::json($response);
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Function to purchase the commercial ads plan .
     * payment method :  PAYPAL
     * @param  int  success
     * @return \Illuminate\Http\Response
     */
    public function sellerSale(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            $todayPurchasedIdArray = [];
            $purchasedIdArray = [];
            $getAllDetails = [];
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $today = Carbon::now()->format('Y-m-d');
            $condition = ['user_id' => $id, 'date' => $today];
            $sellerTalent = BuyerProducts::where($condition)->get();
            if (!empty($sellerTalent)) {
                foreach ($sellerTalent as $key => $value) 
                {
                    $talentId = $value->pp_id;
                    array_push($todayPurchasedIdArray, $talentId);
                }
            }
            $sellerTalentAll = BuyerProducts::where('user_id', $id)->get();
            if (!empty($sellerTalentAll)) 
            {
                foreach ($sellerTalentAll as $key => $value) 
                {
                    $talentId = $value->pp_id;
                    array_push($purchasedIdArray, $talentId);
                }
            }
            $whereCondition = ['delete_flag' => 0, 'purchased' => 1];

            $dailySales = PurchasedProduct::whereIn('id', $todayPurchasedIdArray)
                ->where($whereCondition)
                ->get();

            $dailyRevenue = PurchasedProduct::whereIn('id', $todayPurchasedIdArray)
                ->where($whereCondition)
                ->get()
                ->pluck('total_amount')
                ->sum();

            $totalRevenue =PurchasedProduct::whereIn('id', $purchasedIdArray)
                ->where($whereCondition)
                ->get()
                ->pluck('total_amount')
                ->sum();

            $downloads = BuyerProducts::where('user_id', $id)->get();
            $saleInformation = ['dailySales' => $dailySales, 'dailyRevenue' => $dailyRevenue, 'totalRevenue' => $totalRevenue, 'downloads' => $downloads];
            $custom = ['title' => 'Future Starr | Seller Sales Dashboard'];
            return view('frontend.seller.sales.index', compact('saleInformation','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    /******* MY DELETED PRODUCTS SECTION FUNCTIONS START ***********/

    public function getSellerDeletedProduct(Request $request, $days = '') 
    {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $days = !empty($request->segment(4)) ? $request->segment(4) : 0;
            $newDay = ($days - 1);
            $today_date = Carbon::now()->format('Y-m-d');
            $end_date = Carbon::now()->subDays($newDay)->format('Y-m-d');
            if (!empty($days) && $days > 0) {
                $whereCondition = ['user_id' => $id, 'active' => 'Deactive'];
                $talents = Talents::where($whereCondition)->orderBy('id', 'DESC')->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->where('talents.deleted_at', '<=', $today_date)->where('talents.deleted_at', '<=', $today_date)->where('talents.deleted_at', '>=', $end_date)->whereHas('getUserData', function ($query) {
                    $query->where('users.id', '!=', '');
                })->paginate(5);
            } else {
                $whereCondition = ['user_id' => $id, 'active' => 'Deactive'];
                $talents = Talents::where($whereCondition)->orderBy('id', 'DESC')->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->whereHas('getUserData', function ($query) {
                    $query->where('users.id', '!=', '');
                })->paginate(5);
            }
            $custom = ['title' => 'Future Starr | Seller Deleted Products'];
            return view('frontend.seller.products.deleted-product', compact('talents','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    public function deleteMyProductUndo(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if (!empty($request->all())) {
                $talentId = explode(",", $request['talent_id']);
                $talentArray = ['active' => 'Active', 'deleted_at' => null];
                $talentsDeleted = Talents::WhereIn('id', $talentId)->update($talentArray);
                if (!empty($talentsDeleted)) {
                    $response = ['success' => 'Deleted product recovered successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Unable to undo the products.'];
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
    public function deleteMyProductPermanently(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if (!empty($request->all())) {
                $talentId = explode(",", $request['talent_id']);
                $talentsDeleted = Talents::WhereIn('id', $talentId)->delete();
                if (!empty($talentsDeleted)) {
                    $response = ['success' => 'Product deleted permanently.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Unable to delete the products.'];
                    return Response::json($response);
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /******* MY DELETED PRODUCTS SECTION FUNCTIONS END ***********/

    /******* SELLER  PRODUCT ALL, ADD, EDIT, DELETE START ********/

    public function SellerProducts(Request $request, $days = '') 
    {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $days = !empty($request->segment(4)) ? $request->segment(4) : 0;
            $newDay = ($days - 1);
            $today_date = Carbon::now()->format('Y-m-d');
            $end_date = Carbon::now()->subDays($newDay)->format('Y-m-d');
            if (!empty($days) && $days > 0) {
                $whereCondition = ['user_id' => $id, 'active' => 'Active'];
                $talents = Talents::with('getTalentCategories', 'user')->where($whereCondition)->where('talents.date', '<=', $today_date)->where('talents.date', '>=', $end_date)->orderBy('id', 'DESC')->paginate(5);
            } else {
                $whereCondition = ['user_id' => $id, 'active' => 'Active'];
                $talents = Talents::where($whereCondition)->orderBy('id', 'DESC')->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->whereHas('getUserData', function ($query) {
                    $query->where('users.id', '!=', '');
                })->paginate(5);
            }
            $checkSellerStripeAccount = SellerStripeAccounts::where('user_id','=',$id)->first();
            if(!empty($checkSellerStripeAccount)) {
                 Session::put('isOpen', true);
            } else  { Session::put('isOpen', false); }
            $custom = ['title' => 'Future Starr | Seller Product Section'];
            return view('frontend.seller.products.index', compact('talents','checkSellerStripeAccount','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function deleteMyProduct(Request $request) 
    {
        if (Auth::check()) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if ($request->ajax()) {
                if (!empty($request->all())) {
                    try {
                        $condition = ['id' => $request['talent_id']];
                        $checkProduct = Talents::where($condition)->first();
                        if (!empty($checkProduct)) {
                            $talentArray = [
                                'active' => 'Deactive',
                                'deleted_at' => Carbon::now()->format('Y-m-d')
                            ];
                            $updatedId = Talents::where($condition)->update($talentArray);
                            if (!empty($updatedId)) {
                                $response = ['success' => 'Product deleted successfully.'];
                                return Response::json($response);
                            } else {
                                $response = ['error' => 'Unable to delete the product.'];
                                return Response::json($response);
                            }
                        }
                    }
                    catch(ModelNotFoundException $err) {
                        $response = ['warning' => 'Something went wrong.Unable to delete the Product at a moment.'];
                        return Response::json($response);
                    }
                }
            } else {
                Session::flash('warning', 'Bad Request');
                return redirect('/');
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function bulkDeleteProducts(Request $request) 
    {
        if (!empty(Auth::check())) 
        {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if (!empty($request->all())) {
                $talentId = explode(",", $request['talent_id']);
                $talentArray = [
                    'active' => 'Deactive',
                    'deleted_at' => Carbon::now()->format('Y-m-d')
                ];
                $talentsDeleted = Talents::WhereIn('id', $talentId)->update($talentArray);
                if (!empty($talentsDeleted)) {
                    $response = ['success' => 'Deleted successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Unable to deleted the products.'];
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

    public function addProduct(Request $request) 
    {
        $id = !empty(Auth::user()->id)?Auth::user()->id:'';
        $checkSellerStripeAccount = SellerStripeAccounts::where('user_id','=',$id)->first();
        if(empty($checkSellerStripeAccount)) {
               $custom = ['title' => 'Future Starr | Add Product Section'];
               return redirect(route('seller.my-product','custom'));
        } 
        else 
        {
            $catagories = TalentCatagory::all();
            $custom = ['title' => 'Future Starr | Add Product Section'];
            return view('frontend.seller.products.forms.form', compact('catagories','custom'));
        }
    }
    
    public function storeProduct(Request $request) 
    {
        if(!empty(Auth::check())){

            try {

                if (!empty($request->all())) 
                {

                    $request->validate([
                           'category' => 'required',
                           'title' => 'required|unique:talents,title',
                           'description' => 'required',
                           'price' => 'required',
                           'product_info' => 'required',
                           'facebookLink' => 'required',
                           'instagramLink' => 'required',
                           'twitterLink' => 'required',
                           'video' => 'required',
                           'pdf' => 'required',
                           'commercial' => 'required',
                           'productright' => 'required',
                        ]);
                    $poductArray = [
                                'user_id'=>Auth::user()->id,
                                'talent_category_id' => $request['category'],
                                'title' => $request['title'],
                                'slug'  => \Str::slug($request['title']),
                                'description' => $request['description'],
                                'price' => $request['price'],
                                'product_info' => $request['product_info'],
                                'facebookLink' => $request['facebookLink'],
                                'instagramLink' => $request['instagramLink'],
                                'twitterLink' => $request['twitterLink'],
                                'created_by' => Auth::user()->id,
                                'updated_by' => Auth::user()->id,
                                'date' => Carbon::now()->format('Y-m-d')
                            ];
                    $talentInsert = Talents::insertGetId($poductArray);
                    if (!empty($talentInsert)) 
                    {
                        
                        $sampleMediaPath = '';
                        $productMedia    = '';
                        $commercialMedia = '';

                        if ($request->hasFile('video')) 
                        {
                            $video = $request->file('video');
    
                            $extension = $video->extension();
                            $fileName = md5($video->getClientOriginalName()). '.' .$extension;

                            $pathName = ('uploads/seller-video/' . $fileName);
                            $video->move('uploads/seller-video/', $fileName);
                            
                            $sampleMediaArray = ['talent_id' => $talentInsert, 'path_name' => $pathName, 'video_name' => $fileName];
                            $sampleMediaPath = $pathName;
                            $insertSampleMedia = SampleMedia::insert($sampleMediaArray);

                        }
                        if ($request->hasFile('pdf')) 
                        {   // Multiple Image Upload

                            if($pdf = $request->file('pdf'))
                            {
                                foreach($pdf as $file)
                                {
                                    $extension = $file->extension();
                                    $fileName = md5($file->getClientOriginalName()).'.'.$extension;
                                    $pathName = ('uploads/seller-product-media/'.$fileName);
                                    $path = storage_path();
                                    $file->move('uploads/seller-product-media/', $fileName);
                                    $inputimage = new ProductMedia();
                                    $inputimage->pdf_name = $fileName;
                                    $inputimage->talent_id = $talentInsert;
                                    $inputimage->pdf_path = $pathName;
                                    $inputimage->save();
                                }
                            }

                        }
                        if ($request->hasFile('commercial')) 
                        {
                            $commercial = $request->file('commercial');
                            
                            $extension = $commercial->extension();
                            $fileName = md5($commercial->getClientOriginalName()). '.' .$extension;

                            $path = storage_path();
                            $pathName = ('uploads/commercial-product/' . $fileName);
                            $commercial->move('uploads/commercial-product/', $fileName);
                            
                            $commercialMediaArray = ['talent_id' => $talentInsert, 'image_name' => $fileName, 'image_path' => $pathName];
                            $commercialMedia = $pathName;

                            $insertCommercilaMedia = CommercialMedia::insert($commercialMediaArray);

                        }
                        $user = User::find(Auth::user()->id);

                        if (!empty($user)) {
                            
                            $categoryName = TalentCatagory::pluck('name')->first();
                            
                            $commercialMedia = asset($sampleMediaPath);
                            $sampleMedia = asset($productMedia);
                            $uploadedProduct = asset($commercialMedia);

                            $data = array('talent_id' => $talentInsert, 'title' => $request['title'], 'description' => $request['product_info'], 'category' => $categoryName, 'price' => $request['price'], 'seller_name' => $user->first_name . " " . $user->last_name, 'pathToImage' => '', 'commercialMedia'=> $commercialMedia, 'sampleMedia' => $sampleMedia, 'productMedia' => $uploadedProduct , 'slug' => \Str::slug($request['title']));

                           /** Mail goes to admin to approve the talent ****/
                            $this->talentApprovalMail($data);

                        }
                        Session::flash('success', 'Product added successfully and sent for the admin approval.');
                        return redirect(route('seller.my-product'));
                    } else {
                        Session::flash('error', 'Error while adding the product.');
                        return redirect(route('seller.my-product'));
                    }
                }
            }
            catch(ModelNotFoundException $err) {
                Session::flash('warning', 'Somethingwent wrong.unable to update the profile at a moment.');
                return redirect('/buyer/account-setting/');
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }


    public function editProduct(Request $request, $id = '') 
    {

        if(!empty(Auth::check()))
        {
             $user_id = Auth::user()->id;
             $checkSellerStripeAccount = SellerStripeAccounts::where('user_id','=',$user_id)->first();

             if(empty($checkSellerStripeAccount))
             {
                Session::flash('info', 'Your stripe account is not connected with future starr.');
                return redirect(route('seller.my-product'));

             } else {

                 /** find talent **/
                 $talents = [];
                 $talentCategories = [];

                 $whereCondition = ['user_id' => $user_id, 'id' => $id, 'active' => 'Active'];
                 $talent = Talents::where($whereCondition)->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->first();
                 
                 if(!empty($talent))
                 {
                    if(empty($talent['approved'])) {
                        
                        Session::flash('info', 'Your product is under admin approvel process.');
                        return redirect(route('seller.my-product'));

                    } else {

                        $talentCategories = TalentCatagory::all();
                        $custom = ['title' => 'Future Starr | Seller Edit Product Section'];
                        return view('frontend.seller.products.edit', compact('talent', 'talentCategories','custom'));
                   }

                 } else {
                       
                       Session::flash('error', "No product found.");
                       return redirect(route('seller.my-product'));
                 }
            }

        }  else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }

    }

   
    public function updateProduct(Request $request) {

        if (!empty(Auth()->check())) {

            $userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
           
            if (!empty($request->all())) {
               
                $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
               
                try {
                    $request->validate([
                           'category' => 'required',
                           'title' => 'required|unique:talents,title,'.$request['talent_id'],
                           'description' => 'required',
                           'price' => 'required',
                           'product_info' => 'required',
                    ]);
                    $productArray = ['user_id'=>Auth::user()->id, 'talent_category_id' => $request['category'], 'title' => $request['title'], 'slug' => \Str::slug($request['title']), 'description' => $request['description'], 'price' => $request['price'], 'product_info' => $request['product_info'], 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id, 'date' => Carbon::now()->format('Y-m-d') ];
                    $whereCondition = ['active' =>'Active' ,'id' => $request['talent_id']];

                    $updated = Talents::where($whereCondition)->update($productArray);
                    if(!empty($updated)) {
                        $updateCondtion  = ['talent_id' => $request['talent_id']];

                        if ($request->hasFile('video')) {

                            $video = $request->file('video');
                            
                            $extension = $video->extension();
                            $fileName = md5($video->getClientOriginalName()). '.' .$extension;

                            $pathName = ('uploads/seller-video/' . $fileName);
                            $path = storage_path();
                            $video->move('uploads/seller-video/', $fileName);

                            $sampleMediaArray = ['talent_id' => $request['talent_id'], 'path_name' => $pathName, 'video_name' => $fileName];
                            $insertSampleMedia = SampleMedia::where($updateCondtion)->update($sampleMediaArray);

                        }
                       
                        if($pdf = $request->file('pdf'))
                        {
                            foreach($pdf as $file)
                            {
                                $extension = $file->extension();
                                $fileName = md5($file->getClientOriginalName()).'.'.$extension;
                                $pathName = ('uploads/seller-product-media/'.$fileName);
                                $path = storage_path();
                                $file->move('uploads/seller-product-media/', $fileName);
                                $inputimage = new ProductMedia();
                                $inputimage->pdf_name = $fileName;
                                $inputimage->talent_id = $request['talent_id'];
                                $inputimage->pdf_path = $pathName;
                                $inputimage->save();
                            }
                        }
                        if ($request->hasFile('commercial')) 
                        {
                            $commercial = $request->file('commercial');
                            
                            $extension = $commercial->extension();
                            $fileName = md5($commercial->getClientOriginalName()). '.' .$extension;

                            $path = storage_path();
                            $pathName = ('uploads/commercial-product/' . $fileName);
                            $commercial->move('uploads/commercial-product/', $fileName);
                            
                            $commercialMediaArray = ['talent_id' => $request['talent_id'], 'image_name' => $fileName, 'image_path' => $pathName];
                            $insertCommercilaMedia = CommercialMedia::where($updateCondtion)->update($commercialMediaArray);

                        }

                        Session::flash('success', 'Product updated successfully.');
                        return redirect(route('seller.my-product'));
                    }
                }
                catch(ModelNotFoundException $err) 
                {
                    Session::flash('error', 'Unable to update the product.');
                    return redirect(route('seller.my-product'));
                }
            }
        } 
        else 
        {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /******* SELLER  PRODUCT ALL, ADD, EDIT, DELETE END ********/

    /****************** COMMERCIAL DASHBOARD FUNCTION*************/

    public function commercialAdDashboard(Request $request) {
        if (!empty(Auth::check())) {
            $sellerAds = [];
            $activePlan = [];
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $sellerAds = CommercialAds::with('getSellerPlan','getPlanDetail','adViews')->where('user_id', '=', $id)->orderBy('id', 'DESC')->get();
            $activePlanWhere = ['user_id' => Auth::user()->id];
            $today = date('Y-m-d h:i:s');
            $activePlan = SellerPlans::where($activePlanWhere)->where('start_date','<=',$today)->where('end_date','>=',$today)->first();
            
            $custom = ['title' => 'Future Starr | Seller Commercial Ad Dashboard'];
            return view('frontend.seller.commercial.commercial-ad-dashboard', compact('sellerAds','activePlan','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function addCommercilaAds(Request $request) {
        if(Auth::check()==true){
              $getSellerTalents = Talents::where('user_id','=', Auth::user()->id)->get();
              $custom = ['title' => 'Future Starr | Seller Add Commercial Ads'];
              return view('frontend.seller.commercial.add-commercial-ads', compact('getSellerTalents','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function storeCommercialAd(Request $request)
    {
         if (!empty(Auth::check())) 
         {
            $request->validate([
                           'title' => 'required',
                           'banner' => 'required|mimes:jpg,jpeg,png,mkv,mp4,wav|max:5000',
                           'product' => 'required',
                           'product_url' => 'required'
                    ]);
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
                               'product_id' => $request['product'],
                               'product_url' => $request['product_url'],
                               'created_by' => Auth::user()->id,
                               'updated_by' => Auth::user()->id
                            ];
                $addCommercilaAds = CommercialAds::insert($adMediaArray);
                if($addCommercilaAds) {
                     Session::flash('success', 'Ad added successfully.');
                     return redirect(route('seller.commercial-ads-dashboard'));
                } else {
                     Session::flash('error', 'Unable to add ad at a moment.');
                     return redirect(route('seller.addCommercilaAds'));
                }
            } else {
                     Session::flash('error', 'Unable to process your request.You do not have any active plan yet.');
                     return redirect(route('seller.commercial-ads-dashboard'));
            }
         } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
         }
    }

    /************************** END ******************************/

    /****************** PROMOTE PRODUCT START ********************/

    public function getPromoteProduct(Request $request) {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $days = !empty($request->segment(4)) ? $request->segment(4) : 0;
            $newDay = ($days - 1);
            $today_date = Carbon::now()->format('Y-m-d');
            $end_date = Carbon::now()->subDays($newDay)->format('Y-m-d');
            if (!empty($days) && $days > 0) {
                $whereCondition = ['user_id' => $id, 'active' => 'true'];
                $products = PromoteProducts::with('getTalent', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->where($whereCondition)->where('date', '<=', $today_date)->where('date', '>=', $end_date)->orderBy('id', 'DESC')->whereHas('getTalent', function ($query) {
                    $query->where('approved', '=', 1);
                })->paginate(5);
            } else {
                $whereCondition = ['user_id' => $id, 'active' => 'true'];
                $products = PromoteProducts::with('getTalent', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->where($whereCondition)->orderBy('id', 'DESC')->whereHas('getTalent', function ($query) {
                    $query->where('id', '!=', '');
                    $query->where('approved', '=', 1);
                })->paginate(5);
            }
            $custom = ['title' => 'Future Starr | Seller Promoted Product Section'];
            return view('frontend.seller.products.promote-product', compact('products','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect(route('seller.promote-product'));
        }
    }

    public function postPromoteProduct(Request $request) {

        if(!empty(Auth::check())) {
          $id = !empty(Auth::user()->id)?Auth::user()->id:'';
          if(!empty($request->all())) {

            $rules = [
                        'title' => 'required',
                        'message' => 'required',
                        'social_name' => 'required',
                     ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);

            }  else {
                $promoteProductArray = [
                               'user_id' => $id,
                               'talent_id' => $request['talent_id'],
                               'social_id' => $request['social_name'],
                               'title' => $request['title'] ,
                               'message' => $request['message'] ,
                               'date' => Carbon::now()->format('Y-m-d'),
                            ];

                $promoteProduct = PromoteProducts::insertGetId($promoteProductArray);
                   if(!empty($promoteProduct)) {
                       $socialShareArray = [
                                    'name' => $request['social_name'],
                                    'created_by' => $id,
                                    'updated_by' => $id
                                  ];
                       $socialShares = SocialShares::insertGetId($socialShareArray);
                       if(!empty($socialShares)) {
                           $socialPromoteArray = [
                                  'promote_id' => $promoteProduct,
                                  'social_share_id' =>  $socialShares
                            ];
                        $inserted = SocialPromoteUsers::create($socialPromoteArray);
                        if(!empty($inserted)) {
                               $response = ['success' => 'Product promoted successfully.'];
                        return Response::json($response);
                        } else {
                        $response = ['error' => 'Error in promoting product.'];
                        return Response::json($response);
                        }
                    }
                }
            }
          }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

   public function editPromoteProduct(Request $request) {
        if(!empty(Auth::check())){
            $userId =  !empty(Auth::user()->id)?Auth::user()->id:'';
            if(!empty($request->all())) {
                $rules = [
                            'title' => 'required',
                            'message' => 'required',
                            'social_name' => 'required',
                         ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
                }  else {
                    $updateArray = [
                                      'title' => $request['title'],
                                      'message' => $request['message'],
                                      'social_id' => $request['social_name'],
                                      'updated_at' => Carbon::now()
                                  ];
                    $whereCondition = ['user_id' => $userId , 'id'=> $request['promote_id']];
                    $updated  = PromoteProducts::where($whereCondition)->update($updateArray);
                    if(!empty($updated)) {
                        $response = ['success' => 'Promoted product updated successfully.'];
                        return Response::json($response);
                    } else {
                        $response = ['error' => 'Error while updation in product.'];
                        return Response::json($response);
                    }
                }
           }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
   }
   public function deletePromoteProduct(Request $request) {
        if(!empty(Auth::check())){
             if(!empty($request->all())) {
                  $condition = ['id' => $request['promote_id']];
                  $updateArray = ['active' => 'false'];
                  $deleted = PromoteProducts::where($condition)->update($updateArray);
                  if(!empty($deleted)) {
                        $response = ['success' => 'Product deleted permanently.'];
                        return Response::json($response);
                  } else {
                        $response = ['error' => 'Enable to delete Product.'];
                        return Response::json($response);
                  }
             }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
   }

    /**************** PROMOTE PRODUCT END *************************/

    public function imageUpload(Request $request){
        if(!empty(Auth::check())) {
           if($request->ajax()) {
             if($request->has('profile_pic')) {
                    $video = $request->file('profile_pic');
                    
                    $extension = $video->extension();
                    $fileName = md5($video->getClientOriginalName()). '.' .$extension;
                    
                    $pathName = ('userImage/' . $fileName);
                    $path = storage_path();
                    $video->move('userImage/', $fileName);
                    if(Auth::user()->profile_pic !='' && file_exists(Auth::user()->profile_pic)){
                         $file_path = public_path().'/'.Auth::user()->profile_pic;
                         unlink($file_path);
                    }
            }
            $updateProfileArray = ['profile_pic' => $pathName];
            $whereCondition = ['id' => Auth::user()->id];
            $updateProfile = User::where($whereCondition)->update($updateProfileArray);

            if (!empty($updateProfile)) {
                $response = ['success' => 'Profile picture updated successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Please choose a different profile picture.'];
                    return Response::json($response);
                }
           }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

     /**
     * Show the form for manage the public profile resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function public_profile(Request $request) {
        
        if (!empty(Auth::check())) {
             
            $data = [];
            $data = User::find(Auth::user()->id);

            return view('frontend.seller.profile.profile_data', compact('data'));

        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function public_profile_store(Request $request) {

        //  $request->validate([
        //     'encode_image' => 'required|image|mimes:jpeg,png,jpg',
        //     'video_bio' => 'required|mimes:mp4,wav'
        // ]);

        if(!empty(Auth::check())) 
        {
            if($request->bio_info)
            {
                    if (str_contains($request->bio_info, 'https://www.') || str_contains($request->bio_info, 'www.') || str_contains($request->bio_info, 'https://')) { 
                    session::flash('error', 'URL is not allowed in Bio Information');
                    return redirect('seller/public-profile');
                }
            }
            $image_data = $request['encode_image'];
                if(!empty($image_data)) {
                    $image_array_1 = explode(";", $image_data);
                    $image_array_2 = explode(",", $image_array_1[1]);
                    $data = base64_decode($image_array_2[1]);
                    $image_name = time().$request['author_first_name']. '.png';
                    $upload_path = public_path('userImage/banner/' . $image_name);      
                    file_put_contents($upload_path, $data);
                    $path_name = 'userImage/banner/' . $image_name;
                    
                } else {
                     $path_name = $request['db-banner-image'];
                }
            
            if($request->has('video_bio') ) 
            {
                $video = $request->file('video_bio');
               
                $extension = $video->extension();
                $video_name = md5($video->getClientOriginalName()). '.' .$extension;

                $video_path = 'userImage/video-bio/'.$video_name;
                $video->move('userImage/video-bio/', $video_name);
                if($request['db-video-name'] != '' && file_exists($request['db-video-name'])){
                         unlink($request['db-video-name']);
                } 
            }  
            else 
            {
                   $video_path = $request['db-video-name'];
            }
            // if(file_exists($path_name) && file_exists($video_path)){

                 $table_array = [
                    'banner_image' => $path_name, 
                    'bio_video' => $video_path ,
                    'description' => $request['bio_info'] 
                ];
                 $update = User::where('id', Auth::user()->id)->update($table_array);
                 if(!empty($update)) {
                    Session::flash('success', 'Profile data updated successfully!');
                    return redirect()->back();
                 } else {
                     Session::flash('error', 'Unbale to process the request. Please try agian later.');
                     return redirect()->back();
                 }
            // } else {
            //     Session::flash('error', 'Unable to upload the requested files. Please try agian later.');
            //     return redirect()->back();
            // }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
     }
	 
	 /****** billing page *****/
	 public function accountinfo() 
     {
       if(!empty(Auth::check())) 
       {		   
           return view('frontend.seller.account-info');            
       }
    }

    public function commercialAdsPayment($id){
        $id = Crypt::decryptString($id);
        $plan = Plans::Where('id', $id)->first();
        // return $plan;
        return view('frontend/seller/commercial/payment', compact('plan'));
    }

    public function commercialAdsStripePayment(Request $request)
    {
        // return $request->all();
        if (!empty(Auth::check())) 
        {
            if (Auth::user()->role_id == '4') 
            {
                try{
                    $stripe_customer_id = Auth::user()->stripe_customer_id;
                    if(!$stripe_customer_id) 
                    {
                          // stripe payment integration start
                        $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
                        $customer = $stripe->customers->create([
                            'email' => Auth::user()->email,
                        ]);
                        $stripe_customer_id = $customer->id;
                        // dd($stripe_customer_id);
                    }

                    $id = Crypt::decryptString($request->plan_id);
                    $plan = Plans::Where('id', $id)->first();
                    // dd($plan);

                  
                    $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
                    $payment = $stripe->paymentMethods->create([
                        'type' => 'card',
                            'card' => [
                            'number' => $request->card_number,
                            'exp_month' => $request->expiry_month,
                            'exp_year' => $request->expiry_year,
                            'cvc' => $request->cvc,
                        ],
                    ]);
                    
                    $amount = $plan->price;
                    $amount *= 100;
                    $amount = (int) $amount;
                    // $application_fee = (int) $amount * 0.7;
                    $PaymentIntent = $stripe->paymentIntents->create([
                        'amount' => $amount,
                        'currency' => 'usd',
                        'customer' => $stripe_customer_id,
                        'payment_method' => $payment->id,
                        // 'off_session' => true,
                        'confirm' => true,
                    ]);

                    // dd($PaymentIntent);
                   
                    if ($PaymentIntent->status == "succeeded") 
                    {
                        $planId = $plan->id;
                       $getPlan = SellerPlans::where('user_id','=',Auth::user()->id)->count();

                       $activePlanWhere = ['user_id' => Auth::user()->id];
                       $today = date('Y-m-d h:i:s');
                       // dd($today);
                       $checkPlanExpiredOrNot = SellerPlans::where($activePlanWhere)->where('start_date','<=',$today)->where('end_date','>=',$today)->first();
                       // dd($checkPlanExpiredOrNot);
                       $getClicks = Plans::find($planId);
                       if(!empty($checkPlanExpiredOrNot))
                       {

                           $fdate = $checkPlanExpiredOrNot['end_date'];
                           // dd($fdate);
                           $tdate =  date('Y-m-d h:i:s');
                           // dd($tdate);
                           $datetime1 = new DateTime($fdate);
                           // dd($datetime1);
                           $datetime2 = new DateTime($tdate);
                           $interval = $datetime1->diff($datetime2);
                           // dd($interval);
                           $days = $interval->format('%a');
                           $numDays = 30 + $days;
                           $adClicksRemaining = $checkPlanExpiredOrNot['total_ads'];
                           $adClcikPermonth = $adClicksRemaining + $getClicks['clicks'];
                       } 
                       else 
                       {
                           $adClcikPermonth = $getClicks['clicks'];
                           $numDays = 30;
                       }
                       
                       $startDate = Carbon::now()->format('Y-m-d h:i:s');
                       $endDate = Carbon::now()->addDays($numDays);
                       $sellerPlanArray = [
                                 'plan_id' => $planId,
                                 'total_ads' => $adClcikPermonth,
                                 'user_id' => !empty(Auth::user()->id)?Auth::user()->id:'',
                                 'start_date' => $startDate ,
                                 'end_date' => $endDate,
                                 'created_by' => !empty(Auth::user()->id)?Auth::user()->id:'',
                                 'updated_by' => !empty(Auth::user()->id)?Auth::user()->id:'',
                            ];   
                       $paymentHistoryArray = [ 
                                'user_id' => !empty(Auth::user()->id)?Auth::user()->id:'',
                                'transaction_id' => $PaymentIntent->charges->data[0]->balance_transaction,
                                'token' => $PaymentIntent->charges->data[0]->id,
                                'PayerID' => !empty(Auth::user()->id)?Auth::user()->id:'',
                                'amount' => $plan->price,
                                'description' => 'Commercial ad plans',
                                'transaction_payload' => json_encode($PaymentIntent),
                            ];
                       if(empty($getPlan)) 
                       {
                            $sellerPlan = SellerPlans::insert($sellerPlanArray); 
                            if(!empty($sellerPlan)) {
                                $addPyamentDetails = DB::table('payment_history')->insert($paymentHistoryArray);
                                if(!empty($addPyamentDetails)) {
                                    Session::flash('success','Commercial ads plan purchased succesfully.');
                                    return redirect(route('payment.success')); 
                                }
                              }    
                        } 
                        else 
                        {
                             $createPlan = SellerPlans::where('user_id','=',Auth::user()->id)->update($sellerPlanArray);
                             if(!empty($createPlan))  {
                                $addPyamentDetails = DB::table('payment_history')->insert($paymentHistoryArray);
                                if(!empty($addPyamentDetails)) {
                                    Session::flash('success','Plan upgraded succesfully.');
                                    return redirect(route('payment.success')); 
                                }
                             }
                        }
                    }                    
                }
                catch(Exception $e) 
                {
                    Session::flash('error', 'Error:'.$e->getMessage());
                    return redirect('/');
                }
                // stripe payment integration end
            } 
            else 
            {
                Session::flash('info', 'Please login from buyer account to purchase the items.');
                return redirect('/');
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    // Press Release And Service Page

    public function pressReleaseIndex()
    {
         $custom = ['title' => 'Future Starr | Seller Press Release Post'];
        return view('frontend.seller.pressrelease.create',compact('custom'));
    
    }
    public function pressReleaseStore(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'video' => 'required',
            'description' => 'required'
      ]);
        
            $post = new Sellerpost();
            $post->title = $request->input('title');

            $video = $request->file('video');
            $extension = $video->extension();
            $fileName = md5($video->getClientOriginalName()). '.' .$extension;
            $pathName = ('uploads/seller-posts/' . $fileName);
            $video->move('uploads/seller-posts/', $fileName);
            $post->content = $pathName;
            $post->description = $request->input('description');
            $post->user_id = Auth::user()->id;
            $post->save();
            Session::flash('success', 'Post create successfully');
            return redirect(url()->previous());
        
    }

    public function serviceSellerIndex(Request $request)
    {
        
        $post_cat = PostCategory::get()->toArray();
        $seller_id = Auth::user()->id; 
        $user = User::find($seller_id);
        $userServices = $user->sellerServices()->get();
        // dd($userServices);
        $servicesIdArray = array();
        foreach($userServices as $userService)
        {
            array_push($servicesIdArray, $userService->id);
        }
        $custom = ['title' => 'Future Starr | Seller Services'];
        return view('frontend.seller.service.create',compact('custom','post_cat', 'servicesIdArray'));
    }
    public function sellerServiceStore(Request $request)
    {


       $seller_id = Auth::user()->id; 
        
        $user = User::find($seller_id);
        $service_id = $request->services_seller; 
        $user->sellerServices()->sync($service_id);

        Session::flash('success', 'services add successfully');
            return redirect(url()->previous());
    }

}
