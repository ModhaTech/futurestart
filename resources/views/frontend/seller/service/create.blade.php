@extends('layouts.talent') 
@section('content')
<div id="seller-header">
   <div id="sub-header" class="container-fluid">
      <div class="row">
         <div class="col-sm-12 top-cls top-cls-l"></div>
      </div>
   </div>
</div>
<section class="buyer-con-section">
   <div class="container">
      <div class="row">

         @include('frontend.sidebar.seller')


         <div class="col-md-8 col-sm-8 col-xs-12 seller-add-product">
          
                <div class="row">
                  <div class="col-md-6">
                       <h1 class="seller-add-product-h1">Seller Add Services</h1>
                  </div>
                </div>
                <div class="well panel panel-danger panel-m">
                    <div class="panel-body">

                      <div class="main-sec-listinhg" style="padding: 20px;">
                        {{-- Add New code for post --}}
                         <span style="border: 1px solid #ccc;color:#6f6f6f91;padding-left: 10px;padding-top: 10px;padding-bottom: 10px;border-radius: 10px;padding-right: 405px; cursor: pointer;" data-toggle="modal" data-target="#blogpostModal">Seller Add Service</span>
                        {{-- Add New code for post --}}
                      </div>

                    </div>
                 </div> 
         </div>
      </div>
   </div>

  

   {{--Start Social Buzz post popup --}}

   <!-- Modal -->
<div class="modal fade" id="blogpostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="margin-top: 140px;">
    <div class="modal-content">
      <div class="">
         <div class="listing-buzz row">
               <div class="col-md-12">
                  <div class="main-sec-listinhg">
         <div class="comment-sec align-sec">
            <img src="{{ asset('assets/images/social-buzz/logo-listing.png')}}" alt="Future star favicon">
            <span>Start Servicing!</span>
            <button type="button" class="" style="float: right;border: 1px solid;border-radius: 5px;padding-right: 10px;" data-dismiss="modal">
               <span><i class="fa fa-times text-danger" aria-hidden="true"></i></span></button>
         </div>
          <form method="POST" enctype="multipart/form-data" action="{{ route('seller.seller-services.store') }}">
          @csrf
            <div class="message-box align-sec">
              @error('comment')
                <span class="invalid-feedback" role="alert">
                  <strong>Test</strong>
                </span>
              @enderror
            </div>

            <div class="input-sec" style="padding: 20px;padding-top: 0px;padding-bottom: 0px;">
              <div class="chose_product">
                
                 @foreach($post_cat as $post)   
                 @if(in_array($post['id'], $servicesIdArray))                   
                        <div class="row">
                          <div class="col-md-1">
                             <input multiple name="services_seller[]" type="checkbox"  value="{{$post['id']}}" checked/>
                          </div>
                          <div class="col-md-8">
                             <span style="font-size: 16px;">{{$post['name']}}</span>
                          </div>
                        </div>
                         @else
                         <div class="row">
                          <div class="col-md-1">
                            <input multiple name="services_seller[]" type="checkbox"  value="{{$post['id']}}" />
                          </div>
                          <div class="col-md-8">
                             <span style="font-size: 16px;">{{$post['name']}}</span>
                          </div>
                        </div>  
                         @endif
                    @endforeach

                  <input style="float:right;" class="btn" type="submit" name="" value="Add Service">

              </div>
            </div>
          </form>
                  </div>
               </div></div></div>
    </div>
  </div>
</div>

{{-- Social Buzz post popup --}}
  
  
</section>

@endsection