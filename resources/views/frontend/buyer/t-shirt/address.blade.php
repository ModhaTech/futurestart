	{{-- Start Shipping Address Modal Pop Up --}}
<div class="modal" id="shippingAddressModal">
	<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
  				<h4 class="modal-title">Shipping Address</h4>
  				<button type="button" class="close" data-dismiss="modal">x</button>
			</div>
			<div class="modal-body">
   				<div class="sbm_addresstext">
			      	<form action="" method="POST" style="padding: 30px 0;" id="saveShippingAddress">
			      	 	@csrf
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-7">
			      	 				<input type="text" required="" name="name" class="form-control" placeholder="Full Name" value="{{ $cart->shipping_address->name ?? '' }}" >
			      	 				  @if ($errors->has('name'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('name') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 			<div class="col-md-5">
			      	 				<input required="" type="tel" name="phone" pattern="[0-9]{10}" class="form-control" placeholder="Phone Number" value="{{ $cart->shipping_address->phone ?? '' }}" >
			      	 				 @if ($errors->has('phone'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('phone') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 		</div>				      	 		
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<input required="" type="text" name="street" class="form-control" placeholder="Suite or Apartment" value="{{ $cart->shipping_address->street ?? '' }}" >
			      	 		 @if ($errors->has('street'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('street') }}</strong>
			                          </span>
			                      @endif
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<input required="" type="text" name="address" class="form-control" placeholder="Address" value="{{ $cart->shipping_address->address ?? '' }}" >
			      	 		 @if ($errors->has('address'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('address') }}</strong>
			                          </span>
			                      @endif
			      	 	</div>			      	 	
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-6">
			      	 				<input required="" type="text" name="city" class="form-control" placeholder="City" value="{{ $cart->shipping_address->city ?? '' }}" >
			      	 				 @if ($errors->has('city'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('city') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 			<div class="col-md-6">
			      	 				<input required="" type="text" name="state" class="form-control" placeholder="State" value="{{ $cart->shipping_address->state ?? '' }}" >
			      	 				 @if ($errors->has('state'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('state') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 		</div>
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-6">
			      	 				<input required="" type="text" name="country" class="form-control" placeholder="Country" value="{{ $cart->shipping_address->country ?? '' }}">
                                     @if ($errors->has('country'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('country') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 			<div class="col-md-6">
			      	 				<input required="" type="Number" name="zipcode" class="form-control" placeholder="Zipcode" value="{{ $cart->shipping_address->zipcode ?? '' }}" >
			      	 				 @if ($errors->has('zipcode'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('zipcode') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 		</div>
			      	 	</div>
			      	 	<button type="submit" class="btn btn-primary">Save</button>
			      	</form>
   				</div>
			</div>       
		</div>
	</div>
</div>  

{{-- Start Billing Address Modal Pop Up --}}
<div class="modal" id="billingAddressModal">
	<div class="modal-dialog">
  		<div class="modal-content">
    		<div class="modal-header">
      			<h4 class="modal-title">Billing Address</h4>
      			<button type="button" class="close" data-dismiss="modal">x</button>
    		</div>
    		<div class="modal-body">
       			<div class="sbm_addresstext">
      	 			<form action="" method="POST" style="padding: 30px 0;" id="saveBillingAddress">
			      	 	@csrf
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-7">
			      	 				<input required="" type="text" name="name" class="form-control" placeholder="Full Name" value="{{ $cart->billing_address->name ?? '' }}">
			      	 				 @if ($errors->has('name'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('name') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 			<div class="col-md-5">
			      	 				<input required="" type="tel" name="phone" pattern="[0-9]{10}" class="form-control" placeholder="Phone Number" value="{{ $cart->billing_address->phone ?? '' }}">
			      	 				 @if ($errors->has('phone'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('phone') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 		</div>				      	 		
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<input required="" type="text" name="street" class="form-control" placeholder="Suite or Apartment" value="{{ $cart->billing_address->street ?? '' }}">
			      	 		 @if ($errors->has('street'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('street') }}</strong>
			                          </span>
			                      @endif
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<input required="" type="text" name="address" class="form-control" placeholder="Address" value="{{ $cart->billing_address->address ?? '' }}">
			      	 		 @if ($errors->has('address'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('address') }}</strong>
			                          </span>
			                      @endif
			      	 	</div>			      	 	
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-6">
			      	 				<input required="" type="text" name="city" class="form-control" placeholder="City" value="{{ $cart->billing_address->city ?? '' }}">
			      	 				 @if ($errors->has('city'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('city') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 			<div class="col-md-6">
			      	 				<input required="" type="text" name="state" class="form-control" placeholder="State" value="{{ $cart->billing_address->state ?? '' }}">
			      	 				 @if ($errors->has('state'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('state') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 		</div>
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-6">
			      	 				<input required="" type="text" name="country" class="form-control" placeholder="Country" value="{{ $cart->billing_address->country ?? '' }}">
			      	 				 @if ($errors->has('country'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('country') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 			<div class="col-md-6">
			      	 				<input required="" type="number" name="zipcode" min="0" class="form-control" placeholder="Zipcode" value="{{ $cart->billing_address->zipcode ?? '' }}">
			      	 				 @if ($errors->has('zipcode'))
			                         <span class="invalid-feedback" role="alert">
			                              <strong>{{ $errors->first('zipcode') }}</strong>
			                          </span>
			                      @endif
			      	 			</div>
			      	 		</div>
			      	 	</div>
			      	 	<button type="submit" class="btn btn-primary">Save</button>
			      	</form>
       			</div>
    		</div>       
  		</div>
	</div>
</div>