<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Validator;
use App\Models\SellerStripeAccounts;
use Auth;

class StripeConnectController extends ApiController
{

	public function ConnectStripeAccount(Request $request){
		try{
			$rules = array(
                'email' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

			\Stripe\Stripe::setApiKey(config('stripe.stripe_key'));

			$account = \Stripe\Account::create([
			  	'country' => 'US',
			  	'type' => 'express',
			  	'email'	=>	$request->email,
			  	'capabilities' => [
			    	'card_payments' => [
			      		'requested' => true,
			    	],
			    	'transfers' => [
			      		'requested' => true,
			    	],
			  	],
			]);

			$sa = new SellerStripeAccounts;
			$sa->account_id = $account->id;
			$sa->scope = $account->type;
			$sa->user_id = Auth::id();
			$sa->token_type = 'bearer';
			$sa->save();

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Account connected successfully.',
                'data' => $account
            ]);
		} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
		
	}

	public function LinkStripeAccount(Request $request){
		try{
			$rules = array(
                'account_id' 	=> 'required',
                'refresh_url' 	=> 'required',
                'return_url' 	=> 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

			\Stripe\Stripe::setApiKey(config('stripe.stripe_key'));

			$account_links = \Stripe\AccountLink::create([
			  	'account' => $request->account_id,
			  	'refresh_url' => $request->refresh_url,
			  	'return_url' => $request->return_url,
			  	'type' => 'account_onboarding',
			]);

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Account connected successfully.',
                'data' => $account_links
            ]);
		} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}

	public function stripeAccountAuth(Request $request){		 
		try{
			\Stripe\Stripe::setApiKey(config('stripe.stripe_key'));

			$response = \Stripe\OAuth::token([
			  	'grant_type' => 'authorization_code',
			  	'code' => $request->code,
			]);

			// $fp = fopen(public_path('stripe_auth.txt'), 'a');
			// fwrite($fp, json_encode($response));
			// fclose($fp); 

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Account connected successfully.',
                'data' => $response
            ]);
		} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}

	public function stripeAccountReturn(Request $request){
		// $fp = fopen(public_path('stripe_refresh.txt'), 'a');//opens file in append mode  
		// fwrite($fp, json_encode($request->all()));
		// fclose($fp);
		return $request->all();
	}

	public function stripeAccountDetail(Request $request){
		try {
			$rules = array(
                'account_id' 	=> 'required'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
			$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
			$account = $stripe->accounts->retrieve(
			  	$request->account_id,
			  	[]
			);
			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Retrieve Account Detail.',
                'data' => $account
            ]);
		} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}

}