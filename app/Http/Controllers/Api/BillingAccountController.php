<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PurchasedProduct;
use App\Models\CommercialMedia;
use App\Models\SampleMedia;
use App\Models\Talents;
use Auth;
use Session;
use App\User;
use Exception;
use Response;
use App\Models\Card;
use Validator;

class BillingAccountController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
            $stripe_customer_id = Auth::user()->stripe_customer_id;
            $cards = [];
            $paymentMethod = [];
            if(!$stripe_customer_id) {
                $customer = $stripe->customers->create([
                    'email' => Auth::user()->email,
                ]);

                $stripe_customer_id = $customer->id;

                $user = User::find(Auth::id());
                $user->stripe_customer_id = $stripe_customer_id;
                $user->save();
            }

			if($stripe_customer_id) {
                $paymentMethod = $stripe->paymentMethods->all([
                    'customer' => $stripe_customer_id,
                    'type' => 'card',
                ]);
            }

            $data['paymentMethod'] = $paymentMethod;
            $data['preferred_method'] = Auth::user()->payment_id;
            // $data['cards'] = $cards;
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get all cards.',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function store(Request $request)
    {

       // return 'tst';
        try {
            $stripe = new \Stripe\StripeClient('sk_test_51EQHB8Goy9vhCpJJfleUJamtOmbHW4kZCoTV9pqN77uAYEaKUWJ9XUt0G0Hl4sqJ2rau1TNzqfaTyxjYdTZbvJOK003cyfxvat');
            $stripe->charges->create([
                'amount' => 2000,
                'currency' => 'usd',
                'source' => 'tok_mastercard',
                'description' => 'My First Test Charge',
            ]);

            $stripe_customer_id = Auth::user()->stripe_customer_id;
            
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
            // return $stripe;
            // dd($stripe);
            $cards = $stripe->paymentMethods->create([
                'type' => 'card',
                    'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                    // 'api_key'=> $this->stripe
                ],

            ]);
            $cards['api_key'] = new \Stripe\StripeClient(config('stripe.stripe_key'));
       //  dd($cards);
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Card Store Successfully.',
                'data'  =>  $cards
            ]);
        }catch(Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function addCard(Request $request){
    	try {
            $rules = array(
                'method_id' => 'required'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

            $stripe_customer_id = Auth::user()->stripe_customer_id;

            if(!$stripe_customer_id) {
                $customer = $stripe->customers->create([
                    'email' => Auth::user()->email,
                ]);

                $stripe_customer_id = $customer->id;

                $user = User::find(Auth::id());
                $user->stripe_customer_id = $stripe_customer_id;
                $user->save();
            }
         
            $data['card'] = $stripe->paymentMethods->retrieve(
                $request->method_id,
                []
            );

            // return $data;
            if (!empty($data['card'])) {
                $user = User::find(Auth::id());
                $user->payment_id = $data['card']->id;
                $user->save();
            }

            $data['preferred_method'] = $data['card']->id;
		    return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Card Added info.',
                'data'  =>  $data
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function updateCard(Request $request){
    	 try {
            $rules = array(
                'card_id' => 'required',
                'exp_month' => 'required',
                'exp_year' => 'required',
                'name'  =>  'required'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
            $stripe_customer_id = Auth::user()->stripe_customer_id;

            $data['card'] = $stripe->paymentMethods->update(
                $request->card_id,
                [
                    'card'  =>  [
                        'exp_month' =>  $request->exp_month,
                        'exp_year'  =>  $request->exp_year,
                    ],
                    'billing_details' => [
                        'name'  =>  $request->name,
                    ]                    
                ]
            );
            if ($request->preferred_method == true) {
                $user = User::Where('id', Auth::id())->first();
                $user->payment_id = $request->card_id;
                $user->save();
            }
            if ($request->preferred_method == false) {
                $user = User::Where('id', Auth::id())->first();
                $user->payment_id = '';
                $user->save();
            }

            $data['preferred_method'] = Auth::user()->payment_id;

		    return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Card Updated info.',
                'data'  =>  $data
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function deleteCard(Request $request){
    	try {
            $rules = array(
                'card_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
            $stripe_customer_id = Auth::user()->stripe_customer_id;

            $data['card'] = $stripe->paymentMethods->detach(
                $request->card_id,
                []
            );

		    return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Card Deleted info.',
                'data'  =>  $data
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function getCardDetails(Request $request, $card_id)
    {
        try {
            $stripe_customer_id = Auth::user()->stripe_customer_id;

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
            $data['card'] = $stripe->paymentMethods->retrieve(
              $card_id,
              []
            );

            $data['preferred_method'] = Auth::user()->payment_id;
		    return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get Card info.',
                'data'  =>  $data
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function preferredPaymentMethod(Request $request){
        try {
            $rules = array(
                'method_id' => 'required'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $user = User::find(Auth::id());
            $user->payment_id = $request->method_id;
            $user->save();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Preferred Payment Method Set',
                'data'  =>  Auth::user()->payment_id
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function stripeAccountSetup(Request $request){
        try {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Preferred Payment Method Set',
                'data'  =>  Auth::user()->payment_id
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
