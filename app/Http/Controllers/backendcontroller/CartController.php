<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchasedProduct;
use App\Models\CommercialMedia;
use App\Models\SampleMedia;
use App\Models\Talents;
use App\Models\BuyerProducts;
use Auth;
use Session;
use App\User;
use Exception;
use Response;
use Redirect;
use App\Models\UserCarts;
use App\Models\Card;

class CartController extends Controller
{

	public function index(Request $request)
	{
		if (!empty(Auth::check())) {
			if (Auth::user()->role_id == '3') {
				try{
					// \Stripe\Stripe::setApiKey(config('stripe.stripe_key'));
					$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
					$stripe_customer_id = Auth::user()->stripe_customer_id;
					if(!$stripe_customer_id) {
						$customer = $stripe->customers->create([
							'email' => Auth::user()->email,
						]);					
						$stripe_customer_id = $customer->id;
					}

					$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
					$cartData = [];
					$condition = [
						'purchased_products.user_id' => $userId, 
						'purchased_products.delete_flag' => 0,
						'purchased_products.purchased'	=>	null,
					];
					$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();
					if (!empty($purchasedProducts)) {
						$cartData = [];
						foreach ($purchasedProducts as $key => $value) {
							$cartData[$value->getTalent['user_id']][] = $value;
							$group = 'cart_'.$value->cart_id;
						}
					}

					if ($purchasedProducts->isEmpty()) {
						Session::flash('info', 'Your cart is empty');
						return redirect('/');
					}
					$totalAmount = $purchasedProducts->sum('total_amount');
					$totalItems = $purchasedProducts->sum('quantity');

					// stripe payment integration start
					// \Stripe\Stripe::setApiKey(config('stripe.stripe_key'));
					
					$amount = $totalAmount;
					$amount *= 100;
					$amount = (int) $amount;
					$application_fee = (int) $amount * 0.7;
					
					// $cards = Card::Where('user_id', Auth::id())->get();
					$payment_intent = $stripe->paymentIntents->create([
						'description' => 'Stripe Test Payment',
						'amount' => $amount,
						'currency' => 'USD',
						'description' => 'Payment From CodeTestDev',
						'payment_method_types' => ['card'],						
					]);

					$cards = $stripe->paymentMethods->all([
	                    'customer' => $stripe_customer_id,
	                    'type' => 'card',
	                ]);
					// return $cards;
					$intent = $payment_intent->client_secret;
					return view('frontend.cart.index', compact('cartData', 'totalAmount', 'totalItems', 'intent', 'stripe_customer_id', 'cards'));
				}catch(Exception $e) {
                    Session::flash('error', 'Error:'.$e->getMessage());
                    return redirect('/');
                }
				// stripe payment integration end
			} else {
				Session::flash('info', 'Please login from buyer account to purchase the items.');
				return redirect('/');
			}
		} else {
			Session::flash('info', 'You must be login firstly.');
			return redirect('/');
		}
	}

	public function storeStripe(Request $request){
		try {
		$stripe_customer_id = Auth::user()->stripe_customer_id;

		$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
		$cartData = [];
		$condition = [
			'purchased_products.user_id' => $userId, 
			'purchased_products.delete_flag' => 0,
			'purchased_products.purchased'	=>	null,
		];
		$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();
		if (!empty($purchasedProducts)) {
			$cartData = [];
			foreach ($purchasedProducts as $key => $value) {
				$cartData[$value->getTalent['user_id']][] = $value;
				$group = 'cart_'.$value->cart_id;
			}
		}

		if ($purchasedProducts->isEmpty()) {
			Session::flash('info', 'Your cart is empty');
			return redirect('/');
		}
		$totalAmount = $purchasedProducts->sum('total_amount');
		$totalItems = $purchasedProducts->sum('quantity');

		// stripe payment integration start
		$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
		
		$amount = $totalAmount;
		$amount *= 100;
		$amount = (int) $amount;
		$application_fee = (int) $amount * 0.7;
				

		if(!$stripe_customer_id) {
			$customer = $stripe->customers->create([
				'email' => Auth::user()->email,
			]);
			
			$stripe_customer_id = $customer->id;
			$user = User::find(Auth::user()->id);
			$user->stripe_customer_id = $stripe_customer_id;
			$user->save();
			
		}

		$payment = $stripe->paymentMethods->create([
		  	'type' => 'card',
			  	'card' => [
			    'number' => $request->card_number,
			    'exp_month' => $request->expiry_month,
			    'exp_year' => $request->expiry_year,
			    'cvc' => $request->cvc,
		  	],
		]);

		if ($request->preferred == 'preferred') {
			$user = User::find(Auth::id());
			$user->payment_id = $payment->id;
			$user->save();
		}
		
		$PaymentIntent = $stripe->paymentIntents->create([
		    'amount' => $amount,
		    'currency' => 'usd',
		    'customer' => $stripe_customer_id,
		    'payment_method' => $payment->id,
		    // 'off_session' => true,
		    'confirm' => true,
	  	]);

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
		
			return redirect('/');
		}
        } catch (\Stripe\Error\Card $e) {
        	Session::flash('error', $e->getMessage());
        	return redirect('/buyer/shopping-cart/');
            // return Redirect::refresh()->withFlashMessage($e->getMessage());
        } catch (\Stripe\Error\InvalidRequest $e) {
        	Session::flash('error', $e->getMessage());
        	return redirect('/buyer/shopping-cart/');
            // return Redirect::refresh()->withFlashMessage($e->getMessage());
        } catch (\Stripe\Error\Authentication $e) {
        	Session::flash('error', $e->getMessage());
        	return redirect('/buyer/shopping-cart/');
            // return Redirect::refresh()->withFlashMessage($e->getMessage());
        } catch (\Stripe\Error\ApiConnection $e) {
        	Session::flash('error', $e->getMessage());
        	return redirect('/buyer/shopping-cart/');
            // return Redirect::refresh()->withFlashMessage($e->getMessage());
        } catch (\Stripe\Error\Base $e) {
        	Session::flash('error', $e->getMessage());
        	return redirect('/buyer/shopping-cart/');
            // return Redirect::refresh()->withFlashMessage($e->getMessage());
        } catch (Exception $e) {
        	Session::flash('error', $e->getMessage());
        	return redirect('/buyer/shopping-cart/');
            // return Redirect::refresh()->withFlashMessage($e->getMessage());
        }
	}
	
	public function stripeHotpay(Request $request){

		$token = $request->input('stripeToken');
		$card_number = $request->input('card_number');
		$stripe_customer_id = Auth::user()->stripe_customer_id;

		$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
		$cartData = [];
		$condition = [
			'purchased_products.user_id' => $userId, 
			'purchased_products.delete_flag' => 0,
			'purchased_products.purchased'	=>	null,
		];
		$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();
		if (!empty($purchasedProducts)) {
			$cartData = [];
			foreach ($purchasedProducts as $key => $value) {
				$cartData[$value->getTalent['user_id']][] = $value;
				$group = 'cart_'.$value->cart_id;
			}
		}

		$totalAmount = $purchasedProducts->sum('total_amount');
		$totalItems = $purchasedProducts->sum('quantity');
		
		$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
		
		$amount = $totalAmount;
		$amount *= 100;
		$amount = (int) $amount;
		$application_fee = (int) $amount * 0.7;
				

		if(!$stripe_customer_id) {
			$customer = $stripe->customers->create([
				'email' => Auth::user()->email,
			]);
			$stripe_customer_id = $customer->id;
		}
		
		// $user = User::find(Auth::user()->id);
		// $user->stripe_customer_id = $stripe_customer_id;
		// $user->save();

		// $payment = $stripe->paymentMethods->create([
		//   	'type' => 'card',
		// 	  	'card' => [
		// 	    'number' => $request->card_number,
		// 	    'exp_month' => $request->expiry_month,
		// 	    'exp_year' => $request->expiry_year,
		// 	    'cvc' => $request->cvc,
		//   	],
		// ]);
		

		$PaymentIntent = $stripe->paymentIntents->create([
		    'amount' => $amount,
		    'currency' => 'usd',
		    'customer' => $stripe_customer_id,
		    'payment_method' => Auth::user()->payment_id,
		    // 'off_session' => true,
		    'confirm' => true,
	  	]);

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
		
			return redirect('/');

		}
	}
	
	public function stripePaymentSelectpay(Request $request){
		// return $request->all();

		$token = $request->input('stripeToken');
		$card_number = $request->input('card_number');
		$stripe_customer_id = Auth::user()->stripe_customer_id;

		$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
		$cartData = [];
		$condition = [
			'purchased_products.user_id' => $userId, 
			'purchased_products.delete_flag' => 0,
			'purchased_products.purchased'	=>	null,
		];
		$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();
		if (!empty($purchasedProducts)) {
			$cartData = [];
			foreach ($purchasedProducts as $key => $value) {
				$cartData[$value->getTalent['user_id']][] = $value;
				$group = 'cart_'.$value->cart_id;
			}
		}

		$totalAmount = $purchasedProducts->sum('total_amount');
		$totalItems = $purchasedProducts->sum('quantity');
		
		$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
		
		$amount = $totalAmount;
		$amount *= 100;
		$amount = (int) $amount;
		$application_fee = (int) $amount * 0.7;

		if(!$stripe_customer_id) {
			$customer = $stripe->customers->create([
				'email' => Auth::user()->email,
			]);
			$stripe_customer_id = $customer->id;
		}

		$PaymentIntent = $stripe->paymentIntents->create([
		    'amount' => $amount,
		    'currency' => 'usd',
		    'customer' => $stripe_customer_id,
		    'payment_method' => $request->card_set,
		    // 'off_session' => true,
		    'confirm' => true,
	  	]);

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
		
			return redirect('/');

		}
	}


	public function deleteCartItem(Request $request) {		
		if(!empty(Auth::check())) {
			if(!empty($request->all())) {
				$cartItemId = $request['id'];
				$condition = ['id' => $cartItemId];
				$updateArray = ['delete_flag' => 1];
				$update = PurchasedProduct::where($condition)->update($updateArray);
				$cart_id = PurchasedProduct::where($condition)->first()->cart_id;
				$product_price = PurchasedProduct::where('cart_id', $cart_id);
		 		$product_price->where('delete_flag', 0);
				$total = $product_price->get()->pluck('total_amount')->sum();
				$quantity = $product_price->get()->pluck('quantity')->sum();

				UserCarts::where('id', $cart_id)->update([
				 	'total_amount'	=>	$total,
				 	'quantity'		=>	$quantity,
				]); 
				if(!empty($update)) {
				 	$response = ['success' => 'Product removed from the cart.'];
                    return Response::json($response);
				} else {
				 	 $response = ['error' => 'Unable to remove the product from the cart.'];
                     return Response::json($response);
				}
			}
		} else {
			 Session::flash('info', 'You must be login firstly.');
             return redirect('/');
		}
	}

	/**
     * Update Card.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
	public function updateCard(Request $request)
    {
		try {
			\Stripe\Stripe::setApiKey(env('STRIPE_KEY_TEST_ST'));
			$last4 = Auth::user()->card_last_four_digit;
			$stripe_customer_id = Auth::user()->stripe_customer_id;
			
			if ($request->isMethod('post')) {
				$token = $request->input('stripeToken');
				\Stripe\Customer::update($stripe_customer_id, [
					'source' => $token,
				]);
				$card_number = $request->input('card_number');
				$card_number_four_digit = substr($card_number, -4);
				$user = User::find(Auth::user()->id);
				if(!$stripe_customer_id) {
					$user->stripe_customer_id = $stripe_customer_id;
				}
				$user->card_last_four_digit = $card_number_four_digit;
				$user->save();
				$last4 = $card_number_four_digit;
				Session::flash('success', 'Card has been updated successfully.');
			}
			return view('frontend.cart.update_card', compact('stripe_customer_id', 'last4'));
		}catch(Exception $e) {
			Session::flash('error', 'Error:'.$e->getMessage());
			return redirect('/');
		}
    }
}
  