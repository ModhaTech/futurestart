<?php 

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Plans;
use App\Models\SellerPlans;
use App\Models\CustomPlans;
use App\Models\CommercialAds;
use App\Models\BuyerProducts;
use App\Models\PurchasedProduct;
use Auth;
use Illuminate\Http\Request;
use App\Models\Talents;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Traits\MailsendTrait;
use Validator;
use DB;
use DateTime;
use Session;



class PaymentController extends ApiController
{
	private $conn = [
	    'environment' => 'sandbox',
	    'merchantId' => 'pj2gvd8cz9yx4mqp',
	    'publicKey' => '7kfkb924ynn3dkr6',
	    'privateKey' => '03b30d002e70183e1468dd40cbeab22f'];

    public function paypal(Request $request)
    {
		try 
		{
			$gateway = new \Braintree\Gateway($this->conn);
			$clientToken = $gateway->clientToken()->generate();

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Paypal Client Token',
                'token' =>  $clientToken,
            ]);            

        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
	}

	public function storePaypal(Request $request)
	{
		try {
			$rules = array(
                'amount' => 'required|numeric|min:0|not_in:0',
                'nonce' => 'required',);

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

			$gateway = new \Braintree\Gateway($this->conn);

			$result = $gateway->transaction()->sale([
			  	'amount' => $request->amount,
			  	'paymentMethodNonce' => $request->nonce,
			  	'options' => [
			    	'submitForSettlement' => True
			  	],			  	
			]);

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Paypal Response',
                'data' =>  $result,
            ]);            

        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        } 
	}

	public function commercialAdsStripePayment(Request $request)
	{
		
		try{
			$rules = array(
				'card_number' => 'required',
	            'exp_card' => 'required',
	            'cvc' => 'required',
	            'card_holder_name' => 'required|string',
	            'plan_id' => 'required'
	        );


	        $validator = Validator::make($request->all(), $rules);
	        if ($validator->fails()) 
	        {
	            return $this->respondValidationError('Fields Validation Failed.', $validator);
	        }

	        // Divide Month and Year

			$dateString = $request->exp_card;
			$carbonDate = Carbon::createFromFormat('m/y', $dateString);
			$card_month = $carbonDate->month;
			$card_year = $carbonDate->year;

			$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

			$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';

			$plan = Plans::Where('id', $request->plan_id)->first();

			$amount = $plan->price;
			$amount *= 100;
			$amount = (int) $amount;

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) 
			{
				$customer = $stripe->customers->create([
					'email' => Auth::user()->email,]);
				$stripe_customer_id = $customer->id;
			}
			try {
				$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
				$payment = $stripe->paymentMethods->create([
                        'type' => 'card',
                            'card' => [
                            'number' => $request->card_number,
                            'exp_month' => $card_month,
                            'exp_year' => $card_year,
                            'cvc' => $request->cvc,],
                    ]);

			  	$PaymentIntent = $stripe->paymentIntents->create([
				    'amount' => $amount,
				    'currency' => 'usd',
				    'customer' => $stripe_customer_id,
				    'payment_method' => $payment->id,
				    'confirm' => true,
			  	]);

				$data['pay'] = $PaymentIntent;
			  	if ($PaymentIntent->status == "succeeded") 
			  	{
			  		$planId = $plan->id;
                  $getPlan = SellerPlans::where('user_id','=',Auth::user()->id)->count();

                   $activePlanWhere = ['user_id' => Auth::user()->id];
                   $today = date('Y-m-d h:i:s');
                   $checkPlanExpiredOrNot = SellerPlans::where($activePlanWhere)->where('start_date','<=',$today)->where('end_date','>=',$today)->first();
                   $getClicks = Plans::find($planId);
                   if(!empty($checkPlanExpiredOrNot))
                   {
                   	$fdate = $checkPlanExpiredOrNot['end_date'];
                    $tdate = date('Y-m-d h:i:s');
                    $datetime1 = new DateTime($fdate);
                    $datetime2 = new DateTime($tdate);
                    $interval = $datetime1->diff($datetime2);
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
                            if(!empty($sellerPlan)) 
                            {
                              $addPyamentDetails = DB::table('payment_history')->insert($paymentHistoryArray);
                                if(!empty($addPyamentDetails)) 
                                {
                                    Session::flash('success','Commercial ads plan purchased succesfully.');
                                    return $this->respond([
						                'status' => 'success',
						                'status_code' => $this->getStatusCode(),
						                'message' => 'Ads Purchased Successfully',
						                'data' =>  $data,]);  
                                }
                              }    
                        } 
                        else 
                        {
                             $createPlan = SellerPlans::where('user_id','=',Auth::user()->id)->update($sellerPlanArray);
                             if(!empty($createPlan))  
                             {
                                $addPyamentDetails = DB::table('payment_history')->insert($paymentHistoryArray);
                                if(!empty($addPyamentDetails)) 
                                {
                                  Session::flash('success','Plan upgraded succesfully.');
                                    return $this->respond([
						                'status' => 'success',
						                'status_code' => $this->getStatusCode(),
						                'message' => 'Ads Purchased Successfully',
						                'data' =>  $data,
						            ]);   
                                }
                             }
                        }
			  	}			  
			} 
			catch (\Stripe\Exception\CardException $e) 
			{
				return response()->json([
                        'data' => $e->getError()->code,
                        'message' => 'Your card was declined. Your request was in live mode, but used a known test card.'
                ]);    
			  // Error code will be authentication_required if authentication is needed
				// echo 'Error code is:' . json_encode($data), $e->getError()->code;
				$payment_intent_id = $e->getError()->payment_intent->id;
				$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
			}

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Ads Purchased Successfully',
                'data' =>  $data,
            ]);  
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
	}
	public function commercialAdsHotpayStripePayment(Request $request){
		try{
			$rules = array('plan_id' => 'required');

	        $validator = Validator::make($request->all(), $rules);
	        if ($validator->fails()) 
	        {
	            return $this->respondValidationError('Fields Validation Failed.', $validator);
	        }

			$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
			$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
			$plan = Plans::Where('id', $request->plan_id)->first();

			$amount = $plan->price;
			$amount *= 100;
			$amount = (int) $amount;

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) 
			{
				$customer = $stripe->customers->create([
					'email' => Auth::user()->email,]);
				$stripe_customer_id = $customer->id;
			}

			$stripe_payment_id = Auth::user()->payment_id;
			if ($stripe_payment_id == null) 
			{
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No payment id',]);
			}

			try {
			  	$PaymentIntent = $stripe->paymentIntents->create([
				    'amount' => $amount,
				    'currency' => 'usd',
				    'customer' => $stripe_customer_id,
				    'payment_method' => $stripe_payment_id,
				    'confirm' => true,
			  	]);
				$data['pay'] = $PaymentIntent;
			  	if ($PaymentIntent->status == "succeeded") 
			  	{
			  		$planId = $plan->id;
                       $getPlan = SellerPlans::where('user_id','=',Auth::user()->id)->count();

                       $activePlanWhere = ['user_id' => Auth::user()->id];
                       $today = date('Y-m-d h:i:s');
                       $checkPlanExpiredOrNot = SellerPlans::where($activePlanWhere)->where('start_date','<=',$today)->where('end_date','>=',$today)->first();
                       $getClicks = Plans::find($planId);
                       if(!empty($checkPlanExpiredOrNot))
                       {

                           $fdate = $checkPlanExpiredOrNot['end_date'];
                           $tdate = date('Y-m-d h:i:s');
                           $datetime1 = new DateTime($fdate);
                           $datetime2 = new DateTime($tdate);
                           $interval = $datetime1->diff($datetime2);
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
                       if(empty($getPlan)) {
                            $sellerPlan = SellerPlans::insert($sellerPlanArray); 
                            if(!empty($sellerPlan)) {
                                $addPyamentDetails = DB::table('payment_history')->insert($paymentHistoryArray);
                                if(!empty($addPyamentDetails)) {
                                    // Session::flash('success','Commercial ads plan purchased succesfully.');
                                    return $this->respond([
						                'status' => 'success',
						                'status_code' => $this->getStatusCode(),
						                'message' => 'Ads Purchased Successfully',
						                'data' =>  $data,
						            ]);  
                                    // return redirect(route('payment.success')); 
                                }
                              }    
                        } else {
                             $createPlan = SellerPlans::where('user_id','=',Auth::user()->id)->update($sellerPlanArray);
                             if(!empty($createPlan))  {
                                $addPyamentDetails = DB::table('payment_history')->insert($paymentHistoryArray);
                                if(!empty($addPyamentDetails)) {
                                    Session::flash('success','Plan upgraded succesfully.');
                                    return $this->respond([
						                'status' => 'success',
						                'status_code' => $this->getStatusCode(),
						                'message' => 'Ads Purchased Successfully',
						                'data' =>  $data,
						            ]);  
                                    // return redirect(route('payment.success')); 
                                }
                             }
                        }
			  	}			  
			} catch (\Stripe\Exception\CardException $e) {
			  // Error code will be authentication_required if authentication is needed
				echo 'Error code is:' . $e->getError()->code;
				$payment_intent_id = $e->getError()->payment_intent->id;
				$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
			}

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Ads Purchased Successfully',
                'data' =>  $data,
            ]);  
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}



	public function paypalTest(Request $request){
		// return $request->all();

	}


	public function stripe(Request $request){
		try {
			\Stripe\Stripe::setApiKey(config('stripe.stripe_key'));

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) {
				$customer = \Stripe\Customer::create([
					'email' => Auth::user()->email,
				]);
				$stripe_customer_id = $customer->id;
			}

			$setup_intent = \Stripe\SetupIntent::create([
			  'customer' => $stripe_customer_id
			]);

			// $paymentMethod = \Stripe\PaymentMethod::all([
			//   'customer' => $stripe_customer_id,
			//   'type' => 'card',
			// ]);
			// $data['paymentMethod'] = $paymentMethod;

			$data['client_secret'] = $setup_intent->client_secret; 

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Stripe Secret Key Response',
                'data' =>  $data,
            ]);  
                    

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        } 
	}

	public function stripeCallbackStatus(Request $request){
		$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

		$rules = array(
            'data' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->respondValidationError('Fields Validation Failed.', $validator);
        }

 		$user = User::where('stripe_customer_id', $request->data['object']['customer'])->first();
 		if ($request->type == 'charge.succeeded' && 
 			$request->data['object']['status'] == "succeeded") {

			$cartData = [];
			$condition = [
				'purchased_products.user_id' => $user->id, 
				'purchased_products.delete_flag' => 0,
				'purchased_products.purchased'	=>	null,
			];
			$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();


			if ($purchasedProducts->isNotEmpty()) {
				$cartData = [];
				foreach ($purchasedProducts as $key => $value) {
					$cartData[$value->getTalent['user_id']][] = $value;
					$group = 'cart_'.$value->cart_id;
				}
			}else{
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No Product In Cart',
	            ]);
			}

			$totalAmount = $purchasedProducts->sum('total_amount');
			$totalItems = $purchasedProducts->sum('quantity');
			
			$amount = $totalAmount;
			$amount *= 100;
			$amount = (int) $amount;
			$application_fee = (int) $amount * 0.7;

			// $transfer = $stripe->transfers->create([
			//   	'amount' => $application_fee,
			//   	'currency' => 'usd',
			//   	'destination' => 'acct_1EeMQHDDEqW93OvQ',
			//   	'transfer_group' => $group,
			//   	"source_transaction" => $request->data['object']['id'],
			// ]);
			
			$pps = PurchasedProduct::where($condition)->get();
			foreach ($pps as $key => $pp) {
				$bp 	=	new BuyerProducts;
				$bp->user_id	=	Talents::find($pp->talent_id)
									->first()->user_id;
				$bp->buyer_id	=	$user->id;
				$bp->talent_id	=	$pp->talent_id;
				$bp->active 	=	1;
				$bp->date 		=	date('Y-m-d');
				$bp->created_by	=	$user->id;
				$bp->updated_by	=	$user->id;
				$bp->pp_id		=	$pp->id;
				$bp->save();
			}
			PurchasedProduct::where($condition)->update([
				'purchased'	=>	1,
			]);

 		}
	}
	
	public function storeStripe(Request $request){

		try{
			$rules = array(
	            'method_id' => 'required',
	            // 'client_secret' => 'required'
	        );

	        $validator = Validator::make($request->all(), $rules);
	        if ($validator->fails()) {
	            return $this->respondValidationError('Fields Validation Failed.', $validator);
	        }

			$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

			$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
			$cartData = [];
			$condition = [
				'purchased_products.user_id' => $userId, 
				'purchased_products.delete_flag' => 0,
				'purchased_products.purchased'	=>	null,
			];
			$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();


			if ($purchasedProducts->isNotEmpty()) {
				$cartData = [];
				foreach ($purchasedProducts as $key => $value) {
					$cartData[$value->getTalent['user_id']][] = $value;
					$group = 'cart_'.$value->cart_id;
				}
			}else{
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No Product In Cart',
	            ]);
			}

			$totalAmount = $purchasedProducts->sum('total_amount');
			$totalItems = $purchasedProducts->sum('quantity');
			
			$amount = $totalAmount;
			$amount *= 100;
			$amount = (int) $amount;
			$application_fee = (int) $amount * 0.7;

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) {
				$customer = $stripe->customers->create([
					'email' => Auth::user()->email,
				]);
				$stripe_customer_id = $customer->id;
			}

			try {
			  	$PaymentIntent = $stripe->paymentIntents->create([
			  		// 'client_secret' => $request->client_secret,
				    'amount' => $amount,
				    'currency' => 'usd',
				    'customer' => $stripe_customer_id,
				    'payment_method' => $request->method_id,
				    // 'off_session' => false,
				    'confirm' => true,
			  	]);
				$data['pay'] = $PaymentIntent;
			  	if ($PaymentIntent->status == "succeeded") {
			  		$transfer = $stripe->transfers->create([
					  	'amount' => $application_fee,
					  	'currency' => 'usd',
					  	'destination' => 'acct_1EeMQHDDEqW93OvQ',
					  	'transfer_group' => $group,
					  	"source_transaction" => $PaymentIntent->charges->data[0]->id,
					]);
					$pps = PurchasedProduct::where($condition)->get();
					foreach ($pps as $key => $pp) {
						$bp 	=	new BuyerProducts;
						$bp->user_id	=	Talents::find($pp->talent_id)
											->first()->user_id;
						$bp->buyer_id	=	Auth::id();
						$bp->talent_id	=	$pp->talent_id;
						$bp->active 	=	1;
						$bp->date 		=	date('Y-m-d');
						$bp->created_by	=	Auth::id();
						$bp->updated_by	=	Auth::id();
						$bp->pp_id		=	$pp->id;
						$bp->save();
					}
					PurchasedProduct::where($condition)->update([
						'purchased'	=>	1,
					]);
			  	}			  
			} catch (\Stripe\Exception\CardException $e) {
			  // Error code will be authentication_required if authentication is needed
				echo 'Error code is:' . $e->getError()->code;
				$payment_intent_id = $e->getError()->payment_intent->id;
				$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
			}

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Product Purchased Successfully',
                'data' =>  $data,
            ]);  
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}

	public function confirmStripePayment(Request $request){
	  	try{
	  		$rules = array(
	            'status' => 'required',
	            // 'client_secret' => 'required'
	        );

	        $validator = Validator::make($request->all(), $rules);
	        if ($validator->fails()) {
	            return $this->respondValidationError('Fields Validation Failed.', $validator);
	        }

	  		$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

	  		$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
			$cartData = [];
			$condition = [
				'purchased_products.user_id' => $userId, 
				'purchased_products.delete_flag' => 0,
				'purchased_products.purchased'	=>	null,
			];
			$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();

			if ($purchasedProducts->isNotEmpty()) {
				$cartData = [];
				foreach ($purchasedProducts as $key => $value) {
					$cartData[$value->getTalent['user_id']][] = $value;
					$group = 'cart_'.$value->cart_id;
				}
			}else{
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No Product In Cart',
	            ]);
			}

			$totalAmount = $purchasedProducts->sum('total_amount');
			$totalItems = $purchasedProducts->sum('quantity');
			
			$amount = $totalAmount;
			$amount *= 100;
			$amount = (int) $amount;
			$application_fee = (int) $amount * 0.7;

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) {
				$customer = $stripe->customers->create([
					'email' => Auth::user()->email,
				]);
				$stripe_customer_id = $customer->id;
			}

		  	if ($request->status == "succeeded") {
			 //  	$transfer = $stripe->transfers->create([
				//   	'amount' => $application_fee,
				//   	'currency' => 'usd',
				//   	'destination' => 'acct_1EeMQHDDEqW93OvQ',
				//   	'transfer_group' => $group,
				//   	"source_transaction" => $request->charge_id,
				// ]);
				// $data['trans'] = $transfer;

				$pps = PurchasedProduct::where($condition)->get();
				foreach ($pps as $key => $pp) {
					$bp 	=	new BuyerProducts;
					$bp->user_id	=	Talents::find($pp->talent_id)
										->first()->user_id;
					$bp->buyer_id	=	Auth::id();
					$bp->talent_id	=	$pp->talent_id;
					$bp->active 	=	1;
					$bp->date 		=	date('Y-m-d');
					$bp->created_by	=	Auth::id();
					$bp->updated_by	=	Auth::id();
					$bp->pp_id		=	$pp->id;
					$bp->save();
				}
				PurchasedProduct::where($condition)->update([
					'purchased'	=>	1,
				]);
		  	}
		  	return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Product Purchased Confirm Successfully',
                // 'data' =>  $data,
            ]);  
	  	} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}
	public function hotPayStripe(Request $request){

		try{
			// $rules = array(
	  //           'method_id' => 'required',
	  //           // 'client_secret' => 'required'
	  //       );

	        // $validator = Validator::make($request->all(), $rules);
	        // if ($validator->fails()) {
	        //     return $this->respondValidationError('Fields Validation Failed.', $validator);
	        // }

			$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

			$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
			$cartData = [];
			$condition = [
				'purchased_products.user_id' => $userId, 
				'purchased_products.delete_flag' => 0,
				'purchased_products.purchased'	=>	null,
			];
			$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();


			if ($purchasedProducts->isNotEmpty()) {
				$cartData = [];
				foreach ($purchasedProducts as $key => $value) {
					$cartData[$value->getTalent['user_id']][] = $value;
					$group = 'cart_'.$value->cart_id;
				}
			}else{
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No Product In Cart',
	            ]);
			}

			$totalAmount = $purchasedProducts->sum('total_amount');
			$totalItems = $purchasedProducts->sum('quantity');
			
			$amount = $totalAmount;
			$amount *= 100;
			$amount = (int) $amount;
			$application_fee = (int) $amount * 0.7;

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) {
				$customer = $stripe->customers->create([
					'email' => Auth::user()->email,
				]);
				$stripe_customer_id = $customer->id;
			}

			$stripe_payment_id = Auth::user()->payment_id;
			if ($stripe_payment_id == null) {
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No payment id',
	            ]);
			}
			try {
			  	$PaymentIntent = $stripe->paymentIntents->create([
			  		// 'client_secret' => $request->client_secret,
				    'amount' => $amount,
				    'currency' => 'usd',
				    'customer' => $stripe_customer_id,
				    'payment_method' => $stripe_payment_id,
				    // 'off_session' => false,
				    'confirm' => true,
			  	]);
				$data['pay'] = $PaymentIntent;
			  	if ($PaymentIntent->status == "succeeded") {
			  		$transfer = $stripe->transfers->create([
					  	'amount' => $application_fee,
					  	'currency' => 'usd',
					  	'destination' => 'acct_1EeMQHDDEqW93OvQ',
					  	'transfer_group' => $group,
					  	"source_transaction" => $PaymentIntent->charges->data[0]->id,
					]);
					$pps = PurchasedProduct::where($condition)->get();
					foreach ($pps as $key => $pp) {
						$bp 	=	new BuyerProducts;
						$bp->user_id	=	Talents::find($pp->talent_id)
											->first()->user_id;
						$bp->buyer_id	=	Auth::id();
						$bp->talent_id	=	$pp->talent_id;
						$bp->active 	=	1;
						$bp->date 		=	date('Y-m-d');
						$bp->created_by	=	Auth::id();
						$bp->updated_by	=	Auth::id();
						$bp->pp_id		=	$pp->id;
						$bp->save();
					}
					PurchasedProduct::where($condition)->update([
						'purchased'	=>	1,
					]);
			  	}			  
			} catch (\Stripe\Exception\CardException $e) {
			  // Error code will be authentication_required if authentication is needed
				echo 'Error code is:' . $e->getError()->code;
				$payment_intent_id = $e->getError()->payment_intent->id;
				$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
			}

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Product Purchased Successfully',
                'data' =>  $data,
            ]);  
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}
}