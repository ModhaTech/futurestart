@extends('layouts.talent')

@section('content')

<style type="text/css">
	 .ts-checkout .checkout-heading{
		color: #1a68ab;
		font-size: 40px;
	    line-height: 40px;
	    margin: 0 0 25px;
	    padding: 0;
	    letter-spacing: 2;
	    font-weight:normal;
	   	font-family: Impact, fantasy!important;
	   
	}
	.ts-checkout .checkout-border{
		margin: 0 auto;
		width: 60px;
		border-bottom: 3px solid #1a68ab;
		margin-top:10px;
	}
	.ts-checkout{
		margin:0;
		padding: 30px 0!important;
		background-color: #f3f3f3;
	}
/*	.ts-checkout .shipment .shipmentdiv{
		width: 100%;
		border:1px solid #ddd;
		margin-bottom: 10px;
		padding: 5px;
		border-radius: 4px;
	}*/

	.ts-checkout .checkout-subheading{
		color: #000000;
		font-size: 20px;
	    line-height: 40px;
	    margin: 0 0 25px !important;
	    padding: 0;
	    font-weight: 600;
	    letter-spacing: 0;
	    text-align: center;
	    font-family: Open Sans,sans-serif;
	}
/*	.ts-checkout .shipmentdiv p{
		font-size: 12px!important;
		font-weight: 600!important;
		color: gray!important;
		line-height: 1!important;
	}*/
	 .ts-checkout .cart_summarytext p{
		font-size: 14px!important;
		font-weight: 600!important;
		color: gray!important;
		
	}
	.ts-checkout .cart_summary p.price{
		font-size: 14px!important;
		font-weight: 500!important;
		color: gray!important;
	}
	.ts-checkout .sb_addresstext p{
		font-size: 14px!important;
		font-weight: 600!important;
		color: gray!important;
		line-height: 1!important;
	}
	.ts-checkout .payment_btn{
		background-color: #c9302c;
	    width: 100%; 
	    font-size: 12px; 
	    color: white;
	}

	.ts-checkout .cart_summarytext .summarytext_shift{
		margin-left:  40px;
	}
	.ts-checkout .cart_summarytext .summarytext_change{
		color:#5bc0de;
		font-size: 14px; 
		margin-right: 10px;
	}
	.ts-checkout .checkout_footer{
		height: 70px;
		width: 100%;
		background-color: #f5f4f4;
	}
	.ts-checkout .sbm_addresstext p{
		font-size: 16px!important;
		font-weight: 600!important;
		color: gray!important;
		line-height: 1!important;
	}

	.ts-checkout i.edit-address {
	    font-size: 16px;
	    margin-left: 5px;
	    color: #474747;
	    cursor: pointer;
	    padding: 5px;
	}
	.ts-checkout i.edit-address:hover{
		color:#c9302c;
	}
	.ts-checkout .shipping-info input.form-check-input{
    	width: 14px;
    	height: 14px;
	}
	.ts-checkout .shipping-info label{
	    padding-left: 30px;
	    font-size: 14px;
    	font-weight: 500;
    	line-height: 18px;
    	cursor: pointer;
	}
	.ts-checkout .shipping-info label span{
		display: block;
	}
	.ts-checkout .shipping-info .form-check{
		margin: 15px 0;
	    border: 1px solid #bbbbbb;
	    padding: 8px;
	    border-radius: 8px;
	}
	.ts-checkout input.paypal{
		width: auto;
	    border: 0;
	    margin: auto;
	    display: block;
	}
	.form-w-stripe, .form-w-paypal {
	    background: #ffffff;
	    padding: 30px;
	    box-shadow: 0px 1px 7px 1px #ddd;
	}
	.ts-checkout .cart{
	    background: #fff;
	    box-shadow: 0px 2px 6px 2px #ddd;
    	padding: 15px 15px 30px 15px;
	}
	.ts-checkout .cart .subheading{
        font-size: 20px;
        margin-bottom: 30px !important;
    	/*border-bottom: 1px solid #999;*/
    	padding-bottom: 5px;
	}
    
	.ts-checkout .cart .item-detail{
		margin-top: 15px;
	}
	.ts-checkout .cart .item-detail h4{
		font-size: 18px;
	}
	.ts-checkout .cart .item-detail span{
		font-size: 15px;
	}
	.ts-checkout .tgl-btn {
	    margin-top: 25px;
	    border-top: 1px solid #ddd;
	    padding-top: 13px;
	}
	.ts-checkout .tgl-btn a.active{
		color: #ff0000;
	}
    .ts-checkout .tgl-btn a {
	    display: block;
	    padding: 6px 0;
	}
    .ts-checkout .check-side{
    	background-color: #ffffff;
    	box-shadow: 0px 2px 6px 2px #ddd;
    	padding: 15px 20px 20px 20px;
    }

    .ts-checkout .row.item-row:not(:last-child) {
	    margin-bottom: 30px;
	    border-bottom: 1px solid #dddddd;
	    padding-bottom: 30px;
	}
	.ts-checkout .row.item-row .pro-rm{
	    display: block;
	    padding: 0px 7px;
	    line-height: 20px;
	    border-radius: 4px;
	}
	.ts-checkout .add-addr{
	    text-transform: capitalize;
	    margin-top: 10px;
	    display: block;
	    color: #ff214f;
	}
	.ts-checkout h2.pwhp {
	    font-size: 22px;
	    font-weight: 400;
	    padding-bottom: 35px;
	}
	.ts-checkout h3.sorry-paypal {
	    color: #666 !important;
	    text-align: center;
	    font-weight: 400;
	}
	#shippingAddressModal .close, #billingAddressModal .close{
	    position: absolute;
    	top: 0;
	}
	#shippingAddressModal .btn-primary, #billingAddressModal .btn-primary{
		display: block;
	    margin-left: auto;
	    padding: 3px 10px !important;
	    font-size: 13px;
	    font-weight: 500;
	}
	/* Media Query */

	@media screen and (max-width: 769px) {
	  .ts-checkout .cart_summarytext .summarytext_shift {
	       margin-left: 0px!important; 
	  }
	 .ts-checkout .cart_summarytext .summarytext_change {
	 		margin-right: 0px;
	 }
	 .ts-checkout .cart_summary .product_total{
	 	margin-top: 34px;
	 }
	}
	@media screen and (max-width: 400px){
		.ts-checkout .cart_summarytext, .cart_summary{
			width: 50%;
		}
		.ts-checkout .cart_summary .product_total {
            margin-top: 0px; 
		}
	}
	

</style>


{{-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Play:wght@700&family=Russo+One&display=swap" rel="stylesheet"> --}}

<section class="wow fadeIn cover-background background-position-top top-space t-shirts-head" style="background-image: url({{ asset('/assets/images/tshirt/fututure_tsirt.jpg') }}); visibility: visible; animation-name: fadeIn;">
  	<div class="opacity-medium bg-extra-dark-gray"></div>
  	<div class="container">
    	<div class="row">
	      	<div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
	        	<div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
	          <!-- start page title -->
	          		<h1 class="alt-font text-white font-weight-700 mb-2">CHECKOUT</h1>
	          <!-- end page title -->
	          <!-- start sub title -->
	          {{-- <span class="display-block text-white alt-font"> --}}
	          {{-- T-SHIRTS AVAILABLE</span> --}}
	          <!-- end sub title -->
	        	</div>
	      	</div>
	    </div>
  	</div>
</section>

<section class="ts-checkout">
	<div class="container">
    	<div class="row">
		    <div class="col-md-4">
		    	<div class="check-side">
			    	<div class="checkout-sec">
			    		<h2 class="checkout-subheading">Cart Summary</h2>	      	 
			      	 	<div class="row justify-content-md-center">
			      	 		<div class="col-md-6 col-6 cart_summarytext">
				      	 		<p class="summarytext_shift">Subtotal</p>
						      	<p class="summarytext_shift">Shipping</p>
						      	<p class="summarytext_shift">Est.Tax</p>
						      	<p class="summarytext_shift">Total</p>
				      	 	</div>
				      	 	<div class="col-md-6 col-6 cart_summary">
				      	 		<p class="price">${{ $cart->subtotal }}</p>
				      	 		<p class="price">${{ $cart->shipping }}</p>
				      	 		<p class="price">${{ $cart->tax }}</p>
				      	 		<p class="price">${{ $cart->total }}</p>
				      	 	</div>		      	 		
				      	</div>
				      	<div class="tgl-btn">
				      		<a href="javascript:void(0)" class="pay-w-stripe active">Pay With Stripe</a>
				      		<a href="javascript:void(0)" class="pay-w-paypal">Pay With Paypal</a>
				      	</div>	
			    	</div>			    	
			    </div>
		    </div>	
		    <div class="col-md-8">
		    	<div class="form-w-paypal" style="display: none;">
		    		<h2 class="pwhp" >Pay With Paypal</h2>
		    		{{-- <form action ="{{ url('buyer/t-shirt-paypal')}}" method="POST">
	                  @csrf
	                  <input class="paypal" type="image" value="submit" src="{{asset('assets/images/seller/checkout-paypal.png')}}" width="300"  name="submit" onMouseOver="this.src='{{asset('assets/images/seller/checkout-paypal.png')}}'">
	               </form> --}}
	               <!-- <h3 class="sorry-paypal">Sorry we are not accepting paypal at the moment</h3> -->
	               <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <!-- <label for="amount" class="col-md-4 control-label">Total Amount</label> -->

                            <div class="">
                                <input id="amount" type="hidden" class="form-control" name="amount" value="{{ $cart->total }}" autofocus>
                                <!-- <p>Total Amount - ${{ $cart->total }}</p> -->

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Pay Now (${{$cart->total}})</button>
                            </div>
                        </div>
                    </form>
		    	</div>
               <div class="form-w-stripe">
               		<h2 class="pwhp">Pay With Stripe</h2>
               		<form role="form" action="{{ url('buyer/t-shirt-stripe') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY_PK_TEST') }}"  id="payment-form">
	                @csrf
	                <div class='form-row row'>
	                   <div class='col-xs-12 form-group cvc'>
	                      <label class='control-label required'>Card Number</label>
	                      <input autocomplete='off' class='form-control card-number' name="card_number" maxlength="16" size='20' type='text' placeholder='1234 1234 1234 1234' aria-label="Credit or debit card number">               
	                   </div>
	                </div>
	                <div class='form-row row'>
	                   <div class='col-xs-12 col-md-4 form-group cvc'>
	                      <label class='control-label required'>CVC</label> 
	                      <input autocomplete='off'  class='form-control card-cvc' maxlength="3" placeholder='ex. 311' size='4' type='text' name="cvc">
	                   </div>
	                   <div class='col-xs-12 col-md-4 form-group expiration'>
	                      <label class='control-label required'>Expiration Month</label>
	                      <input class='form-control card-expiry-month' name="expiry_month" placeholder='MM' size='2'  type='text' maxlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, ''); validateExpiryMonth(this);">
                                <span id="expiry-month-error" class="text-danger"></span>

	                   </div>
	                   <div class='col-xs-12 col-md-4 form-group expiration'>
	                      <label class='control-label required'>Expiration Year</label> <input class='form-control card-expiry-year' name="expiry_year" placeholder='YY' maxlength="2" size='2' type='text'>
	                   </div>
	                </div>
	                <div class='form-row row'>
	                   <div class='col-md-12 error form-group hide'>
	                      <div class='alert-danger alert'>Please correct the errors and try
	                         again.
	                      </div>
	                   </div>
	                </div>
	                <div class="row">
	                   	<div class="col-xs-12">
	                      <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{$cart->total}})</button>
	            					  <!-- Modal -->
        					<div class="modal fade" id="myModal1" role="dialog">
        						<div class="modal-dialog">
        						
        						  <!-- Modal content-->
        						  <div class="modal-content">
        							<!--<div class="modal-header">
        							  <button type="button" class="close" data-dismiss="modal">&times;</button>
        							  <h4 class="modal-title">Modal Header</h4>
        							</div>-->
        							<div class="modal-body" style="text-align:center;">
        							  <img src="{{asset('assets/images/boom.png')}}" alt="paypal">
        							  <p>Boom! Your Payment Processed. <br>
        									Thank You!</p>
        							</div>
        							<div class="modal-footer">
        							  <button type="button" class="btn-continue">Continue</button>
        							</div>
        						  </div>
        						</div>
        					</div>							  
	                   	</div>
	                </div>
	             </form>
               </div>
		    </div>	
	    </div>
  	</div>
</section>
@endsection

<script>
function validateExpiryMonth(input) {
    var value = parseInt(input.value, 10); // Parse the input value as an integer
    var errorElement = document.getElementById('expiry-month-error');
    if (isNaN(value) || value < 1 || value > 12) {
        errorElement.textContent = 'Invalid expiry month. Please enter a value between 1 and 12.';
        input.classList.add('is-invalid'); // Add 'is-invalid' class to indicate validation error
    } else {
        errorElement.textContent = ''; // Clear the error message
        input.classList.remove('is-invalid'); // Remove 'is-invalid' class
    }
}
</script>