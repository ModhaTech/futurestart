<?php

namespace App\Http\Controllers;

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

class TShirtProductController extends Controller
{
    private $_api_context;
    
    public function __construct() {
        // parent::__construct();
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    
	public function show()
    {
        $var = [];
        $product = Product::with('variants')->find(1);
        // return $product->variants;
        foreach ($product->variants as $key => $variant) {
            // if ($variant->status == 1) {
                $var['gender'][] = $variant->gender;
                $var['type'][] = $variant->type;
                $var['color'][] = $variant->color;
                $var['size'][] = $variant->size;
            // }            
        }
        // return $product;
        $variant['gender'] = array_unique($var['gender']);
        $variant['type'] = array_unique($var['type']);
        $variant['color'] = array_unique($var['color']);
        $variant['size'] = array_unique($var['size']);

        return view('frontend.buyer.t-shirt.t-shirt-show', compact('product', 'variant'));
    }


    public function tShirtAddToCart(Request $request)
    {

        $validator = $request->validate([
            'gender' => 'required',
            'color' => 'required',
            'neck' => 'required',
            'size' => 'required',
        ]);

    	$product = Product::where('id', $request->slug)->first();
    	$variant = ProductVariant::where('product_id', $product->id)
    			->where('gender', $request->gender)	
    			->where('color', $request->color)	
    			->where('type', $request->neck)	
    			->where('size', $request->size)	
    			->first();

    	$cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        if ($cart == null) {
        	$cart = new Cart;
        	$cart->user_id 	=	Auth::id();
        	$cart->save();
        }

        $cart_product = CartProduct::Where('cart_id', $cart->id)
        				->where('sku', $variant->sku)
        				->first();                        
		
        if ($cart_product == null) {
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

        return $subtotal;
    }


    public function tShirtCheckoutShow(){
    	$shipping = ShippingType::all();
    	$cart = Cart::with('cart_products', 'billing_address', 'shipping_address')
                ->where('user_id', Auth::id())->whereNull('status')->first();
        if ($cart == null) {
            return redirect('buyer/t-shirt');
        }
    	$variants = ProductVariant::whereIn('sku', $cart->cart_products->pluck('sku'))->get();
        if ($cart->cart_products->isEmpty()) {
            return redirect('buyer/t-shirt');
        }
    	return view('frontend.buyer.t-shirt.t-shirt-checkout', compact('cart', 'shipping', 'variants'));
    }


    public function changeShipping(Request $request){
        $shipping = ShippingType::all();
        $set_shipping = ShippingType::find($request->sid);

        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();

        $cart->total        =   $cart->subtotal + $set_shipping->price + round($cart->subtotal * 0.04, 2);
        $cart->shipping     =   $set_shipping->price;
        $cart->tax          =   round($cart->subtotal * 0.04, 2);
        $cart->shipping_id  =   $set_shipping->id;
        $cart->save();

        return view('frontend.buyer.t-shirt.checkout-shipping-render', compact('cart', 'shipping'))->render();
    }


    public function removeCartProduct(Request $request){

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

        return view('frontend.buyer.t-shirt.checkout-shipping-render', compact('cart', 'shipping'))->render();
    }


    public function saveShippingAddress(Request $request){
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
        if ($address == null) {
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

        return view('frontend.buyer.t-shirt.change-addr-render', compact('address'))->render();

    }

    public function saveBillingAddress(Request $request){
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
        if ($address == null) {
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


        return view('frontend.buyer.t-shirt.change-addr-render', compact('address'))->render();
    }

    public function payment(){
        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        $shipping = UserAddress::where('user_id',Auth::id())->where('address_type','shipping')->first();
        $billing = UserAddress::where('user_id',Auth::id())->where('address_type','billing')->first();
        if($shipping == null || $billing == null){
            \Session::flash('error', 'please enter an address');
            // return Redirect::route('buyer.checkout.show');
            return Redirect::back()->withErrors(['error' => 'please enter an address']);
        }
        return view('frontend.buyer.t-shirt.t-shirt-payment', compact('cart'));
    }


    public function paypal(){
        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        $products = CartProduct::where('cart_id', $cart->id)->get()->pluck('sku');
        // return $products;
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
        // return $payment;
        // return json_decode($payment, true);
        // dd($payment->create($this->_api_context));
        try {
            $payment->create($this->_api_context);
            // return $payment;
        }
        catch(\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::flash('error', 'Connection timeout');
                return Redirect::route('addmoney.paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('addmoney.paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::flash('error', 'Unknown error occurred');
        return Redirect::route('addmoney.paywithpaypal');
    }

    public function paypalStatusSuccess(Request $request){
        // return $request->all();
        return view('frontend.seller.payment.thank-you');
    }

    public function paypalStatusCancel(Request $request){
        // return $request->all();
        return view('frontend.seller.payment.payment-cancel');
        
    }


    public function stripe(Request $request){
        // dd($request->all());
        if (!empty(Auth::check())) {
            if (Auth::user()->role_id == '3') {
                try{
                    $stripe_customer_id = Auth::user()->stripe_customer_id;
                    if(!$stripe_customer_id) {
                        $stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
                        $customer = $stripe->customers->create([
                            'email' => Auth::user()->email,
                        ]);
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
                            'exp_month' => $request->expiry_month,
                            'exp_year' => $request->expiry_year,
                            'cvc' => $request->cvc,
                        ],
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

                    if ($PaymentIntent->status == "succeeded") {
                        $cart = Cart::findOrFail($cart->id);
                        $cart->status = 1;
                        $cart->save();
                        Session::flash('success', 'T Shirt purchased successfully');
                        return redirect('/');
                    }

                    
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

}