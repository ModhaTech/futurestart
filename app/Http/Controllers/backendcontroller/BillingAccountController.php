<?php

namespace App\Http\Controllers;

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

class BillingAccountController extends Controller
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

            if(!$stripe_customer_id) {
                $customer = $stripe->customers->create([
                    'email' => Auth::user()->email,
                ]);

                $stripe_customer_id = $customer->id;

                $user = User::find(Auth::id());
                $user->stripe_customer_id = $stripe_customer_id;
                $user->save();
            }

            $cards = [];
            if($stripe_customer_id) {
                $cards = $stripe->paymentMethods->all([
                    'customer' => $stripe_customer_id,
                    'type' => 'card',
                ]);
            }
			return view('frontend.buyer.billing-account', compact('stripe_customer_id', 'cards'));
		}catch(Exception $e) {
			Session::flash('error', 'Error:'.$e->getMessage());
			return redirect('/');
		}
    }


    public function store(Request $request)
    {

       // return $request->all();
        try {
            $stripe_customer_id = Auth::user()->stripe_customer_id;
            
            $stripe = new \Stripe\StripeClient(
              config('stripe.stripe_key')
            );

            $cards = $stripe->paymentMethods->create([
                'type' => 'card',
                    'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],

            ]);
       //  dd($cards);
            return back();
        }catch(Exception $e) {
            Session::flash('error', 'Error:'.$e->getMessage());
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        try {
            $stripe_customer_id = Auth::user()->stripe_customer_id;

            $stripe = new \Stripe\StripeClient(
              config('stripe.stripe_key')
            );

            $cards =  $stripe->paymentMethods->update(
                $request->card_id,
                [
                    "card" =>[
                        'exp_month' =>  $request->exp_month,
                        'exp_year'  =>  $request->exp_year,
                    ]                    
                ]
            );
            return back();
            return response()->json($cards);
        }catch(Exception $e) {
            Session::flash('error', 'Error:'.$e->getMessage());
            return redirect('/');
        }
         
    }
    /**
     * Get Card details.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCardDetails(Request $request, $card_id)
    {
        // return $card_id;
        try {
            \Stripe\Stripe::setApiKey(config('stripe.stripe_key'));
            $stripe_customer_id = Auth::user()->stripe_customer_id;

            $cards =  \Stripe\Customer::retrieveSource(
                $stripe_customer_id,
                $card_id,
                []
            );
            return response()->json($cards);
		}catch(Exception $e) {
			Session::flash('error', 'Error:'.$e->getMessage());
			return redirect('/');
		}
    }


    public function preferredPaymentMethod(Request $request){
    	

    }

    
}
