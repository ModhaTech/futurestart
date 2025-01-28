<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\ShippingType;
use App\Models\CartProduct;
use App\Models\UserAddress;
use App\Models\Cart;
use Auth;
use DB;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Plan;
use Redirect;
use URL;
use App\User;
use Session;
use Response;
use Validator;

class TShirtProductController extends ApiController
{
    private $_api_context;
    
    public function __construct() 
    {
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function show()
    {
        try{
            $var = [];
            $product = Product::with('variants')->find(1);
            foreach ($product->variants as $key => $variant) 
            {
                    $var['gender'][] = $variant->gender;
                    $var['type'][] = $variant->type;
                    $var['color'][] = $variant->color;
                    $var['size'][] = $variant->size;          
            }
            $data['product'] = $product;
            $data['variant']['gender'] = array_unique($var['gender']);
            $data['variant']['type'] = array_unique($var['type']);
            $data['variant']['color'] = array_unique($var['color']);
            $data['variant']['size'] = array_unique($var['size']);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'T-Shirt Product',
                'data' => $data
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function tShirtAddToCart(Request $request)
    {
        // return 'test';
        try{
            $rules = array(                
                'gender' => 'required',
                'color' => 'required',
                'neck' => 'required',
                'size' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $product = Product::where('id', 1)->first();
        	$variant = ProductVariant::where('product_id', $product->id)
        			->where('gender', $request->gender)	
        			->where('color', $request->color)	
        			->where('type', $request->neck)	
        			->where('size', $request->size)	
        			->first();

        	$cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
            if ($cart == null) 
            {
            	$cart = new Cart;
            	$cart->user_id 	=	Auth::id();
            	$cart->save();
            }

            $cart_product = CartProduct::Where('cart_id', $cart->id)
            				->where('sku', $variant->sku)
            				->first();                        
    		
            if ($cart_product == null) 
            {
    			$cart_product = new CartProduct;
    	        $cart_product->cart_id		=	$cart->id;
    	        $cart_product->product_id	=	$product->id;	
    	        $cart_product->sku			=	$variant->sku;
    	        $cart_product->price		=	$product->price;
                $cart_product->save();
    		}

    		$subtotal = CartProduct::Where('cart_id', $cart->id)->get()->pluck('price')->sum();
            
            $shipping = ShippingType::find(1);
    		$cart->subtotal 	=	$subtotal;
    		$cart->total 		=	$subtotal + $shipping->price + round($cart->subtotal * 0.04, 2);
    		$cart->shipping 	=	$shipping->price;
    		$cart->tax 			=	round($cart->subtotal * 0.04, 2);
    		$cart->shipping_id 	=	$shipping->id;
    		$cart->save();

            $data['cart'] = $cart;
            $data['cart_product'] = $cart_product;
            
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Add in cart successfully',
                'data' => $data
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function tShirtCheckoutShow()
    {
        try{
        	$data['shipping'] = ShippingType::all();
            $cart =Cart::with('cart_products', 'billing_address', 'shipping_address')
                    ->where('user_id', Auth::id())->whereNull('status')->first();
        	$data['cart'] = $cart;
        	$data['variants'] = ProductVariant::whereIn('sku', $cart->cart_products->pluck('sku'))->get();
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'T-Shirt Product',
                'data' => $data
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function changeShipping(Request $request)
    {
            $rules = array('sid' => 'required');
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
        
            $data['shipping'] = ShippingType::all();
            $set_shipping = ShippingType::find($request->sid);

            $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();

            $cart->total        =   $cart->subtotal + $set_shipping->price + round($cart->subtotal * 0.04, 2);
            $cart->shipping     =   $set_shipping->price;
            $cart->tax          =   round($cart->subtotal * 0.04, 2);
            $cart->shipping_id  =   $set_shipping->id;
            $cart->save();
            $data['cart'] = $cart;
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Change shipping',
                'data' => $data]);
    }
    public function removeCartProduct(Request $request)
    {
            $rules = array('sku' => 'required');
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $user = Auth::user();
        
            $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
            $shipping = ShippingType::all();
            $cart_product = CartProduct::Where('cart_id', $cart->id)
                            ->where('sku', $request->sku)
                            ->delete();

            $subtotal = CartProduct::Where('cart_id', $cart->id)->get()->pluck('price')->sum();
            
            $cart->subtotal =   $subtotal;                
            $cart->total    =   $subtotal + $cart->shipping + round($cart->subtotal * 0.04, 2);
            $cart->tax      =   round($cart->subtotal * 0.04, 2);
            $cart->save();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Product removed successfully',
                'data' => $cart]);
    }
    public function saveShippingAddress(Request $request)
    {
        try{
        $this->validate($request, [
          'name' => 'required',
          'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          'address'=>'required',
          'street' => 'required',
          'city' => 'required',
          'state' => 'required',
          'country' => 'required',
          'zipcode' => 'required|numeric'
         
       ]);
        $address = UserAddress::Where('user_id', Auth::id())->where('address_type', 'shipping')->first();
        if ($address == null) 
        {
            $address = new UserAddress;
            $address->user_id   =   Auth::id();
        }
        $address->name          =   $request->name;
        $address->phone         =   $request->phone;
        $address->address       =   $request->address;
        $address->street        =   $request->street;
        $address->city          =   $request->city;
        $address->state         =   $request->state;
        $address->country       =   $request->country;
        $address->zipcode       =   $request->zipcode;
        $address->address_type  =   'shipping';
        $address->save();

        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        $cart->ship_addr_id =   $address->id;
        $cart->save();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Address saved successfully',
                'data' => $address
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function saveBillingAddress(Request $request)
    {
          $this->validate($request, [
          'name' => 'required',
          'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          'address'=>'required',
          'street' => 'required',
          'city' => 'required',
          'state' => 'required',
          'country' => 'required',
          'zipcode' => 'required|numeric'
         
       ]);
        $address = UserAddress::Where('user_id', Auth::id())->where('address_type', 'billing')->first();
        if ($address == null) 
        {
            $address = new UserAddress;
            $address->user_id   =   Auth::id();
        }
        $address->name          =   $request->name;
        $address->phone         =   $request->phone;
        $address->address       =   $request->address;
        $address->street        =   $request->street;
        $address->city          =   $request->city;
        $address->state         =   $request->state;
        $address->country       =   $request->country;
        $address->zipcode       =   $request->zipcode;
        $address->address_type  =   'billing';
        $address->save();

        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        $cart->bill_addr_id =   $address->id;
        $cart->save();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Address saved successfully',
                'data' => $address]);
    }

    public function payment()
    {
        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        // return view('frontend.buyer.t-shirt.t-shirt-payment', compact('cart'));
    }
    public function paypal()
    {
        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        $products = CartProduct::where('cart_id', $cart->id)->get()->pluck('sku');
        $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
        $amt = $cart->total;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName(Auth::user()->email)->setCurrency('USD')->setQuantity(1)->setPrice($cart->total);
        /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($cart->total);
        $transaction = new Transaction();

        $transaction->setAmount($amount)->setItemList($item_list)->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('buyer/t-shirt-paypal-success'))->setCancelUrl(url('buyer/t-shirt-paypal-cancel'));
        $payment = new Payment();
        $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
            // return $payment;
        }
        catch(\PayPal\Exception\PPConnectionException $ex) 
        {
            if (\Config::get('app.debug')) 
            {
                \Session::flash('error', 'Connection timeout');
                return Redirect::route('addmoney.paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } 
            else 
            {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('addmoney.paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach ($payment->getLinks() as $link) 
        {
            if ($link->getRel() == 'approval_url') 
            {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) 
        {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::flash('error', 'Unknown error occurred');
        return Redirect::route('addmoney.paywithpaypal');
    }

    public function paypalStatusSuccess(Request $request)
    {
        return view('frontend.seller.payment.thank-you');
    }

    public function paypalStatusCancel(Request $request)
    {
        return view('frontend.seller.payment.payment-cancel');
    }
    public function stripe(Request $request)
    {
        try{
            $rules = array(                
                'card_number' => 'required',
                'exp_month' => 'required',
                'exp_year' => 'required',
                'cvc' => 'required');
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
               return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            if (!empty(Auth::check())) 
            {
                if (Auth::user()->role_id == '3') 
                {
                    // try{
                    $stripe_customer_id = Auth::user()->stripe_customer_id;
                        if(!$stripe_customer_id) 
                        {
                            $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
                            $customer = $stripe->customers->create([
                                'email' => Auth::user()->email,
                            ]);
                            $user = Auth::user();
                            $user->stripe_customer_id=$customer->id;
                            $user->save();      
                            $stripe_customer_id = $customer->id;
                        }
                        $userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
                        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
                        $product_count = CartProduct::where('cart_id', $cart->id)->get()->count();
                        $group = 'ct'.$cart->id;
                        $totalAmount = $cart->total;
                        $totalItems = $product_count;

                        // stripe payment integration start
                        $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

                        $payment = $stripe->paymentMethods->create([
                            'type' => 'card',
                                'card' => [
                                'number' => $request->card_number,
                                'exp_month' => $request->exp_month,
                                'exp_year' => $request->exp_year,
                                'cvc' => $request->cvc,],
                        ]);
                        
                        $amount = $totalAmount;
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
                        // return $PaymentIntent;
                        if ($PaymentIntent->status == "succeeded") 
                        {
                            $cart = Cart::findOrFail($cart->id);
                            $cart->status = 1;
                            $cart->save();
                            // Session::flash('success', 'T Shirt purchased successfully');
                            // return redirect('/');
                            return $this->respond([
                                'status' => 'success',
                                'status_code' => $this->getStatusCode(),
                                'message' => 'T Shirt purchased successfully',
                            ]);
                        }

                    // }catch(Exception $e) {
                        // Session::flash('error', 'Error:'.$e->getMessage());
                        // return redirect('/');
                    //}
                    // stripe payment integration end
                } 
                else 
                {
                    // Session::flash('info', 'Please login from buyer account to purchase the items.');
                    // return redirect('/');
                }
            } 
            else 
            { 
                // Session::flash('info', 'You must be login firstly.');
                // return redirect('/');
            }
        }catch (\Stripe\Exception\CardException $e) 
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
    }

}