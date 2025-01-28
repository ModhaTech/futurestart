@extends('layouts.talent') 
@section('title', $user['username'].' | Future Starr')
@section('content')
<style>
   . ul li {
   color: #6f6f6f;
   }
   a, a:focus, a:hover 
   {
   color: #6f6f6f;
   }
   .seller ul.seller_data_left_ul.seller_data_left_ul 
   {
   flex-direction: column;
   }
   .seller ul.seller_data_left_ul li.seller_data_left_li 
   {
   margin-bottom: 10px;
   }
   .pd0 
   {
   padding: 0px!important;
   }
   section.seller-profile.pd0 
   {
   padding: 24px 0 0 0px!important;
   }
   section.knowledge-section-top.pd0 
   {
   padding-bottom: 50px!important;
   }
   .p-1 div 
   {
   display: flex;
   flex-direction: column;
   padding: 0px;
   width: 100%;
   }
   .seller .rd 
   {
   margin: 10px 0 0 0;
   width: 100%;
   }
   .sta-r i.fa.fa-star 
   {
   color: red;
   }
   .sta-r i.fa.fa-star 
   {
   position: unset;
   }
   label.label_pro 
   {
   padding-top:20px   
   /* position: absolute;
   left: 20px; */
   }
   .chose_product select 
   {
   margin-top: 5px!important;
   }
   .input-sec 
   {
       position: relative;
   }
p.loc-dd 
{
    color: #fff!important;
    font-size: 18px!important;
}
</style>
<!-- banner start -->


<section class="wow fadeIn cover-background buyer-banner-sec socail-buzz background-position-top top-space" style="background-image:url({{ !empty($user['banner_image']) ? asset($user['banner_image']) : asset('assets/images/maxresdefault.jpg') }}); height: 350px !important;" ></section>

<section class="seller-profile pd0 ht-300 margin-top-negative">
   <div class="container" style="margin-top: 5px;">
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 star-background-image">
           <div class="seller_data">
             <div class="public-profile-main">
               <div class="seller_data_left no-left">
                  <img src="{{ !empty($user['profile_pic']) && file_exists($user['profile_pic']) ? asset($user['profile_pic']) : url('assets/images/star-logo.png') }}" width="250px" alt="profileImage"class="buyer-dd1" style="margin-top: -2px;">     
                 <img src="/assets/images/star.png" width="250px" alt="profileImage" class="buyer-dd" >
               </div>
             </div>
           </div>
         </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
            <div class="seller_data_left pt-4 pb-4 right-sec-buyer"> 
               <div class="star-right-dd">
               <h1 class="username-dd" style="position:relative; top:20px;">{{ $user['first_name'] ? : '' }}&nbsp;{{ $user['last_name'] ? : '' }}</h1>
               <p class="loc-dd" style="position:relative; top:20px;">
                  {{ $user['city'] ? : '' }}
                  @if (!empty($user['city']) && !empty($user['state']))
                      /
                  @endif
               </p>
               </div>
            </div>
         </div>
      </div>
    </div>
</section> 
<section class="seller-profile pd00">
<div class="container">
  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="seller_data">
         <div class="public-profile-main">
            <div class="seller_data_right pt-4">
               <div class="seller_data_right-inner">
                  <h3>Video Bio</h3>
                  @if($user['bio_video'] && file_exists($user['bio_video']))
                    @if(!empty($livestream_data_get) && ($livestream_data_get->status == 1))
                    
                  <!-- Live Stream code -->
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-8">
                           <video style="min-height: 180px!important;" id="remote-video-stream-view" autoplay></video>
                           <div class="user_live" style="display: none; position: absolute;padding: 2px 12px 2px 12px;background-color: #ef174f;border-radius: 5px;text-transform: uppercase;left:30px;top:15px;color: white;font-weight: 600;">Live</div>
                           <input type="hidden" value="{{$user['id']}}" id="live_page_userid">
                        </div>
                        <div class="col-lg-4">
                           <textarea class="stream_viewer_comment" style="padding-right: 62px;height: 150px;" class="form-control" placeholder="Enter Your Comment"></textarea>
                           <button class="btn streamCommentSend" style="position: absolute;margin-left: 0;right: 18px;top: 105px;    padding: 1px 5px;background-color: rgb(239, 23, 79);font-weight: 600;border-radius: 5px;color: white;font-size: 14px;">Send</button>
                            <!-- <h1 class="username-dd" style="position:relative; top:20px;">{{ $user['username']}}</h1> -->
                        </div>
                     </div>
                  </div>
                   <!-- Live Stream code -->
                   @else
                    <video id="optional_video_live" muted autoplay loop width="400" style="width: 94%; margin: auto;" poster="{{ asset('assets/images/futurestarrlogo.jpg') }}" controls controlsList="nodownload" autoplay>
                        <source src="{{ asset($user['bio_video']) }}" id="video_here">
                        Your browser does not support HTML5 video.
                     </video>
                   @endif
                  @elseif(!empty($livestream_data_get))
                  @if($livestream_data_get->status == 1)
                   <!-- Live Stream code -->
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-8">
                           <video style="min-height: 180px!important;" id="remote-video-stream-view" autoplay></video>
                           <div class="user_live" style="display: none; position: absolute;padding: 2px 12px 2px 12px;background-color: #ef174f;border-radius: 5px;text-transform: uppercase;left:30px;top:15px;color: white;font-weight: 600;">Live</div>
                           <input type="hidden" value="{{$user['id']}}" id="live_page_userid">
                        </div>
                        <div class="col-lg-4">
                           <textarea class="stream_viewer_comment" style="padding-right: 62px;height: 150px;" class="form-control" placeholder="Enter Your Comment"></textarea>
                           <button class="btn streamCommentSend" style="position: absolute;margin-left: 0;right: 18px;top: 105px;    padding: 1px 5px;background-color: rgb(239, 23, 79);font-weight: 600;border-radius: 5px;color: white;font-size: 14px;">Send</button>
                           
                        </div>
                     </div>
                  </div>
                   <!-- Live Stream code -->
                 
                  @endif
                  @else
                   <!-- <img src="{{ asset('assets/images/futurestarrlogo.jpg') }}" class="round-rect" alt="profileImage"> -->
                   <h5 style="color:black;"><i class="fa fa-video-camera" aria-hidden="true"></i><br/><br/>No video available</h5>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<a class="scroll-top-arrow" href="javascript:void(0);"><i class="ti-arrow-up"></i></a>
<script>
    document.getElementById('send-message').addEventListener('click', function() {
        // Perform the AJAX request to send the message
        // After the message is sent successfully, close the modal
        $('#sendMessage').modal('hide'); // Close the modal
    });
</script>
<!-- Rider Modal Start-->
<div class="modal fade" id="riderModal" role="dialog">
   <div class="modal-dialog">
      <form>
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <span style="margin-top:10px;"  class="pull-right">
                  <!-- <i class="fa fa-motorcycle riders"></i> -->
                  <img style="width: 17px !important;
                     height: 20px;
                     border-radius: 0%;
                     object-fit: contain;margin-left: 5px;" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">
                  <span style="color:black; font-weight:bold;">({{ count($riders) }}) </span> <b>Riders</b> &nbsp;
               </span>
               <span style="color:white; font-weight:bold;" class="modal-title pro-pop-sp"><b> Riders</b> </span>
            </div>
            <div class="modal-body">
               <div class="centered-modal-body">
                  @if($user['role_id'] != 4)
                     <div>
                        <h4>Sorry, you cannot add yourself as a Rider</h4>
                     </div>
                  @elseif(!empty($self_rider))
                  <div>
                     <span class=emoji>&#x1F44D;</span>
                     <h4>You are already a rider.</h4>
                  </div>
                  @else
                  <div id="div-rider">
                     <h4>Are you ready to ride?</h4>
                     <button type="button" class="btn btn-danger" data-to="{{ Crypt::encryptString($user['id']) }}" data-from="{{ !empty(Auth::user()->id) ? Auth::user()->id : ''}}" data-url="{{ route('public.profile.rider.add') }}" id="add-rider" onClick="buttonDisable()">SAVE</button>
                     <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                  </div>
                  @endif
               </div>
            </div>
            <div class="modal-footer-awards">
               <div class="fanbase-background">
                  <h5>Fan Base</h5>
               </div>
               @if(count($riders) > 0)
               @foreach($riders as $rider) 
               @if(Auth::check() && $rider->role == 'seller')
               @php 
               $profile_link = route('seller-public-profile', $rider->public_profile )
               @endphp
               @elseif( Auth::check() && $rider->role == 'buyer')
               @php 
               $profile_link = route('buyer-public-profile', $rider->public_profile ) 
               @endphp
               @else 
               @php $profile_link = 'javascript:void(0)' @endphp
               @endif
               <div class="pop-content">
                  <a target="_blank" href="{{ $profile_link }}" alt="public-profile">
                  <img  class="circular img-40" src="{{ !empty($rider->profile_pic) ? asset($rider->profile_pic): asset('assets/images/profile.png')}}">
                  </a>
                  <div class="content-sec-pop">
                     <h6>{{ $rider->first_name ?: '' }}&nbsp;{{ $rider->last_name ?: ''}}</h6>
                  </div>
               </div>
               @endforeach
               @else
               <div class="no-fanbase-data-found">
                  <h5>No Riders yet!</h5>
               </div>
               @endif
            </div>
         </div>
      </form>
   </div>
</div>
<!-- Rider Modal End-->
<!-- Send Message Modal Start-->
<div class="modal fade" id="sendMessage" role="dialog">
   <div class="modal-dialog">
      @if(!empty(Auth::check()))
      @if($user['id'] != Auth::user()->id)
      <form>
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Send Message </h4>
            </div>
            <div class="modal-body">
               <p style="font-size: 15px; font-weight: 500;">Information: To do one to one chat you can add as rider to this user by click on button riders next to this.</p>
               <div class="form-group">
                  <label>Your Message</label>
                  <br />
                  <textarea class="form-control" name="message"  id="message" rows="6"  required placeholder="Write here"> </textarea>
                  <span class="invalid-feedback" id="message_error"></span>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" id="send-message" data-to="{{ Crypt::encryptString($user['id'] ) }}" data-from="{{ !empty(Auth::user()->id) ? Auth::user()->id : ''  }}" data-url="{{ route('public.profile.message.send')}}" >Send</button>
               <button type="button" class="btn btn-default btn-d" data-dismiss="modal">Cancel</button>
            </div>
         </div>
      </form>
      @else
      <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Send Message </h4>
            </div>
            <div class="modal-body" style="text-align: center;padding: 10px;margin-top: 20px;">
               <h4>User cannot send messages to themselves.</h4>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default btn-d" data-dismiss="modal">Cancel</button>
            </div>
         </div>
      </div>
      @endif
      @endif
   </div>
</div>
<!-- Send Message Modal End-->

<!-- Get Services Modal Start-->
<div class="modal fade" id="getServices" role="dialog">
   <div class="modal-dialog">
      @if(!empty(Auth::check()))
    
      <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Service </h4>
            </div>
               <form>
               <!-- Modal content-->
                  <div class="modal-body" style="text-align: center;padding: 10px;margin-top: 20px;">
                     <div class="form-group">
                        <label>Your Message</label>
                        <br />
                        <textarea class="form-control" name="message"  id="message" rows="6"  required placeholder="Write here"> </textarea>
                        <span class="invalid-feedback" id="message_error"></span>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" id="send-message" data-to="{{ Crypt::encryptString($user['id'] ) }}" data-from="{{ !empty(Auth::user()->id) ? Auth::user()->id : ''  }}" data-url="{{ route('public.profile.message.send')}}" >Send</button>
                     <button type="button" class="btn btn-default btn-d" data-dismiss="modal">Cancel</button>
                  </div>
            
               </form>
           
           
         </div>
      </div>
      
      @endif
   </div>

</div>
<!-- Get Services Modal End-->
</section>


<section class="knowledge-section-top pd0">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-xs-12 col-md-3">
            <div class="seller_data_left_ul_main">
               <ul class="seller_data_left_ul">
                  <li class="seller_data_left_li">                           
                     <img src="{{ asset('assets/images/view.png') }}">
                     <a>Views ({{ $profile_views }})</a>
                  </li>
                  <li class="seller_data_left_li">                           
                     <img src="{{ asset('assets/images/saler_saler _red_star.png') }}">
                     <a>SALES ({{ getSellerSale($user['id']) }})</a>
                  </li>
                  <li class="seller_data_left_li">                           
                     <img src="{{ asset('assets/images/sales_award_yellow_star.png') }}">
                     <a>AWARDS ({{ getSellerTalentAward($user['id'])}})</a>
                  </li>
                  <li class="seller_data_left_li">                          
                     <a> <img src="{{ asset('assets/images/star_green.png') }}"> RIDERS ({{ count($riders) }})</a>
                  </li>
                  <li class="seller_data_left_li">                           
                     <a><img src="{{ asset('assets/images/star_blue.png') }}">FOLLOWING ({{$following}})</a>
                  </li>
               </ul>
            </div>
            <div class="bio_info">
               <div class="text-left">
                  <h3 style="color:#000!important;">Bio Info</h3>
                  <p> {{ $user['description'] ?: 'User has not uploaded  their "Bio"' }}</p>
               </div>
            
               <div class="p-1">
                  <div class="text-center">
                     @if(!empty(Auth::check()))
                     <button type="button" class="btn btn-primary msgme"  data-toggle="modal" data-target="#sendMessage">Message me</button>
                     <a type="button" class="btn btn-primary rd mb-3"  data-toggle="modal" data-target="#riderModal"> <img style="width: 25px !important;
                        height: 20px;
                        border-radius: 0%;
                        object-fit: contain;margin-left: 5px;" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">  Riders</a>
                     @if(!empty($seller_service))
                     <div class="mt-3 mb-3">
                        <ul style="border: 1px solid #ff503f!important;border-radius: 5px;font-size: 17px!important;color: #ff503f!important;font-weight: 600;">
                           <li style="font-size: 17px!important;color: #ff503f!important;border-bottom: 1px solid #ff503f!important;margin-right: 0; padding: 10px;">Services</li>
                            @foreach($seller_service as $ss)
                              <li style="text-align:left;padding: 8px;font-size: 14px;" value="volvo">{{ $ss['name']}}</li>
                            @endforeach
                        </ul>
                     </div>
                      <button type="button" class="btn btn-primary msgme" data-toggle="modal" data-target="#getServices">Submit Price Quote</button>
                     @endif
                    

                     @else
                     <button type="button" class="btn btn-primary msgme" data-toggle="modal" data-target="#register_my_model"> Message me</button>
                     <a type="button" class="btn btn-primary rd mb-3" data-toggle="modal" data-target="#register_my_model"> <img style="width: 25px !important;
                        height: 20px;
                        border-radius: 0%;
                        object-fit: contain;margin-left: 5px;" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }} ">  Riders</a>
                     <button type="button" class="btn btn-primary msgme" data-toggle="modal" data-target="#register_my_model">Service</button>
                     @endif
                  </div>
               </div>
            </div>
            <br>                          
          
       
         </div>
         <div class="col-md-1 col-lg-1 hide-space">
            <p>Space</p>
         </div>
         <!--right SIde Start-->
         <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8  buzz-middle new">
         <!-- code added of seller product -->
            <div class="dash-heading">
               <h1>{{ $user['first_name']}} {{ $user['last_name']}} - PRODUCTS</h1>
            </div>
            <div class="listing-buzz row">
               <div class="col-md-12">
                  <div id="talent-mal-list" class="filter-content overflow-hidden" style="min-height: 0px">
                     <ul  class="portfolio-grid work-3col gutter-medium hover-option6 lightbox-portfolio" id="talent_list">
                        @if(count($talents) >0 )
                        @foreach($talents as $talent)
                        <li class="design web photography grid-item wow fadeInUp last-paragraph-no-margin" style="width: 48%">
                           <figure>

                              @if(!empty($talent->commercialMedia[0]->image_path))
                              @php 
                                 $video = explode(".",$talent->commercialMedia[0]->image_path) 
                              @endphp
                               
                              @if(strtolower(end($video)) =="mp4" || strtolower(end($video)) =="ogv")

                                 <video muted autoplay loop id="my-player" poster=""  controls>
                                    <source src="{{asset($talent->commercialMedia[0]->image_path)}}" type="video/mp4">
                                    <source src="{{asset($talent->commercialMedia[0]->image_path)}}" type="video/oggy">
                                    Your browser does not support
                                    HTML5 video.
                                 </video>

                              @endif

                              @if(strtolower(end($video)) =="mkv")

                                 <video muted autoplay loop id="my-player" poster=""  controls>
                                    <source src="{{asset($talent->commercialMedia[0]->image_path)}}" type="video/x-matroska">
                                    <source src="{{asset($talent->commercialMedia[0]->image_path)}}" type="video/x-matroska">
                                    Your browser does not support
                                    HTML5 video.
                                 </video>

                              @endif

                              @if(strtolower(end($video)) =="mp3" || strtolower(end($video)) =="mpeg")
                                 <video muted autoplay loop poster="{{asset('assets/images/talent-mall/audio-bg.png')}}"  controls>
                                    <source src="{{asset($talent->commercialMedia[0]->image_path)}}" type="video/mp3">
                                    <source src="{{asset($talent->commercialMedia[0]->image_path)}}" type="video/ogg">
                                    Your browser does not support
                                    HTML5 mp3.
                                 </video>
                              @endif

                              @if(strtolower(end($video)) =="png" || strtolower(end($video)) =="jpg" || strtolower(end($video)) =="jpeg")
                              @if(file_exists($talent->commercialMedia[0]->image_path))
                               
                                 @php 
                                     $image = $talent->commercialMedia[0]->image_path 
                                 @endphp
                              @else
                                   
                                   @php  $image = 'assets/images/star-logo.png'; @endphp
                              @endif
                               <a href="javascript:void(0);"  class="cursor">
                                    <img alt="productInfo" src="{{ asset($image)}}"/>
                              </a>
                              @endif

                              @elseif(!empty($talent->sampleMedia[0]->image_path))

                              @php
                              $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                              $contentType = mime_content_type($talent->sampleMedia[0]->image_path);
                              if(in_array($contentType, $allowedMimeTypes) && file_exists($talent->sampleMedia[0]->image_path)){
                              $imagePath = $talent->sampleMedia[0]->image_path;                  
                              } else {
                              $imagePath= 'assets/images/star-logo.png';       
                              }
                              @endphp

                                
                              <div class="portfolio-img bg-extra-dark-gray position-relative text-center overflow-hidden border border-bottom-0">
                                 <a href="javascript:void(0);"  class="cursor">
                                 <img src="{{ asset($imagePath)}}" alt="productInfo"/>
                                 </a>
                              </div>
                              @else 

                              <div class="portfolio-img bg-extra-dark-gray position-relative text-center overflow-hidden border border-bottom-0">
                                 <a href="javascript:void(0);"  class="cursor">
                                 <img src="{{ asset('assets/images/star-logo.png')}}" alt="logo"/>
                                 </a>
                              </div>
                              @endif
                              <figcaption class="bg-white p-3 border border-top-0">
                                 <div class="portfolio-hover-main">
                                    <div class="portfolio-hover-box">
                                       <div class="portfolio-hover-content position-relative text-left">
                                          <a href="{{ route('talent.productInfo', $talent->slug )}}" >
                                          <span  class="line-height-normal font-weight-600 text-small margin-5px-bottom text-extra-dark-gray display-block pro-tit">{{$talent->title}}
                                          </span>
                                          </a>
                                          <p  class="text-medium-gray text-extra-small mb-0 pro-info">{{ Str::limit($talent->product_info,35) }}
                                          </p>
                                          <p class="d-flex justify-content-between text-primary pt-1 mt-2 pro-pri"><strong>${{$talent->price}}</strong>   
                                             <a class="pro-more" href="{{ route('talent.productInfo', $talent->slug )}}" class="text-uppercase text-small">View more <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                          </p>
                                          {{-- <p class="trophy-cust">
                                             <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 1 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                             <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 2 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                             <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 3 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                             <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 4 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                             <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 5 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                             <span class="cmt-count">({{$talent->get_talent_awards_count}})</span>
                                          </p> --}}
                                       </div>
                                    </div>
                                 </div>
                              </figcaption>
                           </figure>
                        </li>
                        @endforeach
                        @else
                        <b>NO PRODUCT INFORMATION AVAILABLE!</b>
                        @endif
                     </ul> 
                  </div> 
               </div>
            </div>
         <!-- code end of seller product -->
         <!-- code start of TRENDING-->
            <div class="dash-heading">
               <h1>{{ $user['first_name']}} {{ $user['last_name']}} - Trending</h1>
            </div>
            <div class="listing-buzz row">

               <div class="col-md-12">
                  
                  @if(count($socialBuzzList) >0 )
                  @php $i = 1; 
                     $j = 1;
                     $k = 0;
                     $c= 1;
                  @endphp
                  @foreach($socialBuzzList as $socialbuzzList)
                  @if(Auth::check() && $socialbuzzList->getUserData['role_id'] == '4')
                  @php 
                  $profile_link = route('seller-public-profile', $socialbuzzList->getUserData['public_profile'] )
                  @endphp
                  @elseif(Auth::check() && $socialbuzzList->getUserData['role_id'] == '3')
                  @php 
                  $profile_link = route('buyer-public-profile', $socialbuzzList->getUserData['public_profile'] ) 
                  @endphp
                  @else
                  @php $profile_link = 'javascript:void(0)' @endphp
                  @endif
                  <div class="main-sec-listinhg">
                    
                     <div class="message-box align-sec">
                        <div class="dash-heading colorClass">
                           <?php $commentstring = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $socialbuzzList->comment); ?>
                           <h3>{{$commentstring}}</h3>
                        </div>
                        @if(!empty($socialbuzzList->product_link))  @endif
                        @if (strpos($socialbuzzList->product_img_path, '.jpg') !== false || strpos($socialbuzzList->product_img_path, '.jpeg') !== false || strpos($socialbuzzList->product_img_path, '.png') !== false) 
                        @if(!empty($socialbuzzList->product_img_path) && file_exists($socialbuzzList->product_img_path)) 
                        <img class="img-fluid" src="{{ URL::asset($socialbuzzList->product_img_path)}}" alt="Social Media Images">
                        @endif
                        @endif
                        @if(strpos($socialbuzzList->product_img_path, '.mp4') !== false)
                        <video muted autoplay loop id="my-player" oster="{{asset('assets/images/music-background.png')}}" style="width: 100%" controls>
                        <source src="{{asset($socialbuzzList->product_img_path)}}" type="video/mp4">
                        <source src="{{asset($socialbuzzList->product_img_path)}}" type="video/ogg">
                        Your browser does not support
                        HTML5 video.
                        </video>
                        @endif
                        @if(strpos($socialbuzzList->product_img_path, '.mp3') !== false || strpos($socialbuzzList->product_img_path, '.mpeg') !== false)
                        <video muted autoplay loop id="my-player" poster="{{asset('assets/images/talent-mall/audio-bg.png')}}" style="width: 100%" controls preload="auto" autobuffer>
                           <source src="{{asset($socialbuzzList->product_img_path)}}" type="audio/mp3">
                           <source src="{{asset($socialbuzzList->product_img_path)}}" type="audio/ogg">
                           Your browser does not support
                           HTML5 video.
                        </video>
                        @endif
                     </div>
                     <div class="socail-box">
                        <ul>
                           @if($check==true)
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#giveAward<?php echo $i; ?>">
                              <li><img src="{{ asset('assets/images/social-buzz/cup.png')}}" alt="award">&nbsp;{{ count($socialbuzzList->getSocialBuzzAwards)}}&nbsp;Awards</li>
                           </a>
                           @else 
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                              <li><img src="{{ asset('assets/images/social-buzz/cup.png')}}" alt="award">&nbsp;{{ count($socialbuzzList->getSocialBuzzAwards)}}&nbsp;Awards</li>
                           </a>
                           @endif
                           @if($check==true) 
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#comment<?php echo $i; ?>">
                              <li><img src="{{ asset('assets/images/social-buzz/chat.png')}}" alt="chat">&nbsp;{{ count($socialbuzzList->getSocialBuzzComments)}}&nbsp;Comments</li>
                           </a>
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#shareModal<?php echo $i; ?>">
                              <li><img src="{{ asset('assets/images/social-buzz/share.png')}}" alt="Share"> Share</li>
                           </a>
                           @php 
                           $url = $socialbuzzList->product_link;
                           $host = explode('/',$url); 
                           $talent_id = !empty($host[5])?$host[5]:'';
                           @endphp
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#purchaseModal<?php echo $i; ?>">
                              <li><img src="{{ asset('assets/images/social-buzz/cart.png')}}" alt="Cart"> @php $count = totalPurchasePerTalent($talent_id) @endphp {{ $count}} Purchase</li>
                           </a>
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#ridersModal<?php echo $i; ?>">
                              <li><img class="riders" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">&nbsp;{{ count($socialbuzzList->getSocialBuzzRiders)}}&nbsp;Riders</li>
                           </a>
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#viewsModal<?php echo $i; ?>">
                              <li><img class="riders" alt="commercial Ads" class="hover-images" style="width: 28px;" src="{{ asset('assets/images/view.png') }}">&nbsp;{{ count($socialbuzzList->getSocialBuzzViewcount)}}&nbsp;Views</li>
                           </a>
                           @else 
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                              <li><img src="{{ asset('assets/images/social-buzz/chat.png')}}" alt="chat">&nbsp;{{ count($socialbuzzList->getSocialBuzzComments)}}&nbsp; Comments</li>
                           </a>
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                              <li><img src="{{ asset('assets/images/social-buzz/share.png')}}" alt="Share"> Share</li>
                           </a>
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                              <li><img src="{{ asset('assets/images/social-buzz/cart.png')}}" alt="Cart"> Purchase</li>
                           </a>
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                              <li><img class="riders" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">&nbsp;{{ count($socialbuzzList->getSocialBuzzRiders)}}&nbsp;Riders</li>
                           </a>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                              <li><img style="height: 28px;" class="riders" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/view.png') }}">&nbsp;{{ count($socialbuzzList->getSocialBuzzViewcount)}}&nbsp;Views</li>
                           </a>
                           @endif    
                        </ul>
                        <div class="report-sec">
                           @if($check==true)
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#reportUser<?php echo $i; ?>">
                           <img src="{{ asset('assets/images/social-buzz/flag.png')}}" alt="Report"> Report
                           </a>
                           @else
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                           <img src="{{ asset('assets/images/social-buzz/flag.png')}}" alt="Report"> Report
                           </a>
                           @endif
                        </div>
                     </div>                    
                  </div>
                
                  
                  <!-- Comment Modal -->
                  <div class="modal fade" id="comment<?php echo $j;?>" role="dialog" data-keyboard="false" data-backdrop="static">
                     <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Leave a comment</h4>
                           </div>
                           <div class="modal-body">
                              <div class="centered-modal-body">
                                 <textarea class="form-control" name="comment" id="comment_txt{{$socialbuzzList->id}}"  class ="adsd" placeholder="Your Comment.. "></textarea>
                                 <div class="row">
                                    <div class="col-md-12" style="height:250px;overflow-y: scroll;">
                                       @if(count($socialbuzzList->getSocialBuzzComments) > 0)
                                       @foreach($socialbuzzList->getSocialBuzzComments as $comment)
                                        @if($comment->commentBy == null)
                                          @continue
                                       @endif
                                       @if(Auth::check() && $comment->commentBy['role_id'] = '3')
                                       @php $c_p_link=  route('buyer-public-profile', $comment->commentBy['public_profile']) @endphp
                                       @elseif(Auth::check() && $comment->commentBy['role_id'] = '4')
                                       @php $c_p_link=  route('seller-public-profile', $comment->commentBy['public_profile']) @endphp
                                       @else
                                       @php $c_p_link = 'javascript::void(0)' @endphp
                                       @endif
                                       <div class="pop-content">
                                          <a target="_blank" href="{{ $c_p_link }}" alt="profile link">
                                          <img  class="circular img-40" src="{{ !empty($comment->commentBy['profile_pic']) && file_exists($comment->commentBy['profile_pic']) ? asset($comment->commentBy['profile_pic']) : asset('assets/images/profile.png')}}">
                                          </a>
                                          <div class="content-sec-pop">
                                             <h6>{{ $comment->commentBy['first_name'] }} {{ $comment->commentBy['last_name'] }}</h6>
                                             <span> {{$comment->post_comment}} </span>
                                          </div>
                                       </div>
                                       @endforeach 
                                       @else
                                       <div class="pop-content">
                                          <p>No Comment Yet.</p>
                                       </div>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div  class="modal-footer">
                              <button class="btn btn-danger btn-d" type="button" id="social-comment" onclick="commentSave('{{$socialbuzzList->id}}')">SAVE</button>
                              <button class="btn btn-default btn-d" data-dismiss="modal" type="button">CANCEL</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Comment Modal End-->
                  <!--- Awards Modal Start --->
                  <div class="modal fade" id="giveAward<?php echo $j;?>" role="dialog" data-keyboard="false" data-backdrop="static">
                     <div class="modal-dialog">
                        <form>
                           @csrf
                           <!-- Modal content-->
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h5 class="pull-right">
                                    <i class="fa fa-trophy"></i>
                                    <span style="color:black">( {{ count($socialbuzzList->getSocialBuzzAwards)}} )</span>&nbsp;Awards
                                 </h5>
                                 <h4 class="modal-title"> Awards </h4>
                              </div>
                              <div class="modal-body">
                                 <div class="centered-modal-body">
                                 
                                  {{-- @if($user['role_id'] != '4') --}}
                                    @if(count($socialbuzzList->alreadyAwarded) > 0)
                                    <div>
                                       <span class=emoji>&#x1F44D;</span>
                                       <h4>You have already awarded this talent.</h4>
                                    </div>
                                    @else
                              
                                    
                                    <div>
                                       <h4>Are you sure to award this talent?</h4>
                                       <button type="button" class="btn btn-danger" onclick="addAward('{{$socialbuzzList->id}}')" >SAVE</button>
                                       <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>  
                                    </div>

                                 
                                    @endif
                                  {{-- @else
                                     <div>
                                       <h4>Seller could not be awarded to itself</h4>
                                       <button type="button" class="btn btn-danger" onclick="addAward('{{$socialbuzzList->id}}')" disabled>SAVE</button>
                                       <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>  
                                     </div>
                                  @endif --}}
                                   

                                 </div>
                                 <div class="modal-footer-awards">
                                    <div class="fanbase-background">
                                       <h5>Fan Base</h5>
                                    </div>
                                    @if(count($socialbuzzList->getSocialBuzzAwards) > 0)
                                    @foreach($socialbuzzList->getSocialBuzzAwards as $fanbase)
                                      @if($fanbase->awardBy == null)
                                        @continue
                                      @endif
                                    @if(Auth::check() && $fanbase->awardBy['role_id'] = '3')
                                    @php $a_p_link=  route('buyer-public-profile', $fanbase->awardBy['public_profile']) @endphp
                                    @elseif(Auth::check() && $fanbase->awardBy['role_id'] = '4')
                                    @php $a_p_link=  route('seller-public-profile', $fanbase->awardBy['public_profile']) @endphp
                                    @else
                                    @php $a_p_link = 'javascript::void(0)' @endphp
                                    @endif
                                    <div class="pop-content">
                                       <a target="_blank" href="{{ $a_p_link }}" alt="profile link">
                                       <img  class="circular img-40" src="{{ !empty($fanbase->awardBy['profile_pic']) && file_exists($fanbase->awardBy['profile_pic']) ? asset($fanbase->awardBy['profile_pic']) : asset('assets/images/profile.png') }}">
                                       </a>
                                       <div class="content-sec-pop">
                                          <h6> {{ $fanbase->awardBy['first_name'] }} {{ $fanbase->awardBy['last_name'] }} </h6>
                                       </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="no-fanbase-data-found">
                                       <h5>No one awarded this talent yet!</h5>
                                    </div>
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <!--- Awards Modal End --->
                  <!--- Riders Modal Start --->
                  <div class="modal fade" id="ridersModal<?php echo $j; ?>" role="dialog" data-keyboard="false" data-backdrop="static">
                     <div class="modal-dialog">
                        <form>
                           @csrf
                           <!-- Modal content-->
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h5 class="pull-right">
                                    <!-- <i class="fa fa-bicycle"></i> -->
                                    <img alt="commercial Ads" class="hover-images mcycle" src="{{ asset('assets/images/rider-green.png') }}"> <!-- {{ asset('assets/images/rider-green.png') }} http://localhost:8000/assets/images/rider-green.png-->
                                    <span style="color:black">( {{ count($socialbuzzList->getSocialBuzzRiders)}} )</span>&nbsp;Riders
                                 </h5>
                                 <h4 class="modal-title"> Riders </h4>
                              </div>
                              <div class="modal-body">
                                 <div class="centered-modal-body">
                                    @if(count($socialbuzzList->selfRider) > 0)
                                    <div>
                                       <span class=emoji>&#x1F44D;</span>
                                       <h4>You are already a rider to this talent.</h4>
                                    </div>
                                    @else 
                                    <div>
                                       <h4>Are you ready to ride?</h4>
                                       <button type="button" class="btn btn-danger" id="add_" onclick="addRider('{{$socialbuzzList->id}}')">SAVE</button>
                                       <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                                    </div>
                                    @endif
                                 </div>
                                 <div class="modal-footer-awards">
                                    <div class="fanbase-background">
                                       <h5>Fan Base</h5>
                                    </div>
                                    @if(count($socialbuzzList->getSocialBuzzRiders) > 0)
                                    @foreach($socialbuzzList->getSocialBuzzRiders as $fanbase)
                                    @if($fanbase->rideBy == null)
                                        @continue
                                      @endif
                                    @if(Auth::check() && $fanbase->rideBy['role_id'] = '3')
                                    @php $r_p_link=  route('buyer-public-profile', $fanbase->rideBy['public_profile']) @endphp
                                    @elseif(Auth::check() && $fanbase->rideBy['role_id'] = '4')
                                    @php $r_p_link=  route('seller-public-profile', $fanbase->rideBy['public_profile']) @endphp
                                    @else
                                    @php $r_p_link = 'javascript::void(0)' @endphp
                                    @endif
                                    <div class="pop-content">
                                       <a target="_blank" href="{{ $r_p_link }}" alt="profile link">
                                       <img  class="circular img-40" src="{{ !empty($fanbase->rideBy['profile_pic']) && file_exists($fanbase->rideBy['profile_pic']) ? asset($fanbase->rideBy['profile_pic']) :asset('assets/images/profile.png')}}">
                                       </a>
                                       <div class="content-sec-pop">
                                          <h6>{{ $fanbase->rideBy['first_name'] }} {{ $fanbase->rideBy['last_name'] }}</h6>
                                       </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="no-fanbase-data-found">
                                       <h5>No Riders yet!</h5>
                                    </div>
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <!--- Riders Modal End --->
                  <!-- Report User Modal Start-->
                  <div class="modal fade report-user" id="reportUser<?php echo $j; ?>" role="dialog" data-keyboard="false" data-backdrop="static">
                     <div class="modal-dialog">
                        <form>
                           <!-- Modal content-->
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"> Report </h4>
                              </div>
                              <div class="modal-body">
                                 <div class="centered-modal-body">
                                    @if($socialbuzzList->report =='1')
                                    <h4>Flag this user for inappropriate behaviour</h4>
                                    <button type="button" class="btn btn-danger" onclick="reportUser('{{$socialbuzzList->id}}','{{$socialbuzzList->user_id}}')">YES</button>
                                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                                    @else
                                    <h4>You have already flag this user for inappropriate behaviour.</h4>
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <!-- Report User Modal End-->
                  <!-- Purchase Modal Start-->
                  <div class="modal fade report-user" id="purchaseModal<?php echo $j; ?>" role="dialog" data-keyboard="false" data-backdrop="static">
                     <div class="modal-dialog">
                        <form>
                           <!-- Modal content-->
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"> Purchase </h4>
                              </div>
                               <div class="modal-body">
                                 <div class="centered-modal-body">
                                   @if(!empty($socialbuzzList->product_link))
                                    <h4>Would you like to purchase?</h4>
                                    <button type="button" id="url" class="btn btn-danger" onclick="goToPurchaseProduct('{{$socialbuzzList->product_link}}')" target="_blank">YES</button>
                                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                                    @else
                                   <h4>No product added to purchase..Keep exploring on <b class="text-danger">Future Starr Social Buzz</b></h4>
                                    @endif
                                 </div>
                              </div>

                              <div class="modal-footer">
                                 <!-- <button type="submit" class="btn btn-danger">SHARE</button> -->
                                 <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <!-- Purchase Modal End-->
                  <!-- Send Message Modal End-->
                  <div class="social-buzz-modals">
                     <div class="modal fade share-modal" id="shareModal<?php echo $j; ?>" role="dialog" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog">
                           <form #social="ngForm" (ngSubmit)="shareOnSocialMedia(social)">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"> Share </h4>
                              </div>
                              <div class="modal-body">
                                 <!-- <div class="form-group">
                                    <textarea class="form-control" style="resize: none" rows="5" placeholder="say something..."></textarea>
                                    </div> -->
                                 @if(!empty($socialbuzzList->product_link))
                                 <div class="form-group">
                                    <div class="btn-group btn-icons" role="group">
                                       <br />
                                       <ul class="nav">
                                          <li class="list-item-facebook">
                                             <a href="http://www.facebook.com/sharer.php?u={{$socialbuzzList->product_link}}" target="_blank" class="social-btn-facebook btn modal-btn btn-bg customer share">
                                             <i class="fa fa-facebook"> </i>
                                             <span class="separator"></span> FACEBOOK</a>
                                          </li>
                                          <li class="list-item-instagram">
                                             <a href="https://plus.google.com/share?url={{$socialbuzzList->product_link}}" target="_blank" class="social-btn-instagram btn modal-btn btn-bg customer share">
                                             <i class="fa fa-google-plus"></i>
                                             <span class="separator"></span> GOOGLE +</a>
                                          </li>
                                          <li class="list-item-twitter">
                                             <a href="http://twitter.com/share?text=share&url={{$socialbuzzList->product_link}}
                                                " target="_blank" class="social-btn-twitter btn modal-btn btn-bg customer share">
                                             <i class="fa fa-twitter"></i>
                                             <span class="separator"></span> TWITTER</a>
                                          </li>
                                          <li class="list-item-linkedin">
                                             <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{$socialbuzzList->product_link}}" target="_blank" class="social-btn-linkedin btn modal-btn btn-bg customer share">
                                             <i class="fa fa-linkedin" aria-hidden="true"></i>
                                             <span class="separator"></span> LINKEDIN</a>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 @else
                                 <h4 class="text-center">No product added to share..Keep exploring on <b class="text-danger">Future Starr Social Buzz</b></h4>
                                 @endif
                              </div>
                              <div class="modal-footer">
                                 <!-- <button type="submit" class="btn btn-danger">SHARE</button> -->
                                 <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!-- Share Modal End-->
                  @php
                  $i++;
                  $j++; 
                  $k++;
                  $c++;
                  @endphp
                  @endforeach
                  
                  @else
                      <h1 class="text-danger text-center" style="margin-top: 5pc; margin-bottom: 5pc;">No Trending available. </h1>
                  @endif  

               </div>
             
            </div>
            <!-- code End of TRENDING -->

             <!-- code Start of Post -->

            <div class="dash-heading">
               <h1>{{ $user['first_name']}} {{ $user['last_name']}} - Post</h1>
            </div>
            <div class="listing-buzz row">
                <div class="col-md-12">
                  @if(!empty($sellerpost))
                     @foreach($sellerpost as $post)
                     <div class="main-sec-listinhg">
                        <div class="message-box align-sec">
                           <div class="dash-heading colorClass">
                              <h3>{{$post->title}}</h3>
                           </div>
                           @if(strpos($post->content, '.mp4') !== false)
                              <video muted autoplay loop id="my-player" oster="{{asset('assets/images/music-background.png')}}" style="width: 100%" controls>
                                 <source src="{{asset($post->content)}}" type="video/mp4">
                                 <source src="{{asset($post->content)}}" type="video/ogg">
                                 Your browser does not support HTML5 video.
                              </video>
                           @else
                              <img src="{{asset($post->content)}}">
                           @endif
                        </div>
                     </div>
                     @endforeach
                  @endif
                </div>
            </div>

              <!-- code End of Post -->
         </div>
         <!-- Right side Model End-->
      </div>
   </div>
</section>
@endsection
@section('javascript')
<script>
   $('#lightSlider3').lightSlider({
      item: 4,
      loop:true,
      slideMargin: 15,
      useCSS:true,
      pager: true,
      responsive : [
      {
         breakpoint:400,
         settings: {
            item:1,
            slideMove:1
         }
      }
      ],
   
   });
</script>
<script type="text/javascript">
   $(document).ready(function() 
   {
      // Start Live Page View Code
         
         const webSocketstreamview = new WebSocket("wss://futurestarr.com:3002");

    webSocketstreamview.onmessage = (event) => {
        handleSignallingDatastreamview(JSON.parse(event.data))
    }

function handleSignallingDatastreamview(data) 
{
    switch (data.type) 
    {
        case "offer":
             // console.log(data.offer,'offer')
            peerConnstreamview.setRemoteDescription(data.offer)
            createAndSendAnswerstreamview()
            break
        case "candidate":
             // console.log(data.candidate,'candidate')
            peerConnstreamview.addIceCandidate(data.candidate)
    }
}

function createAndSendAnswerstreamview () 
{
    peerConnstreamview.createAnswer((answer) => {
        peerConnstreamview.setLocalDescription(answer)
        sendDatastreamview({
            type: "send_answer",
            answer: answer
        })
    }, error => {
        console.log(error)
    })
}

function sendDatastreamview(data) 
{
    data.username = username
    webSocketstreamview.send(JSON.stringify(data))
}


let localStreamstreamview
let peerConnstreamview

function joinCallstreamview() 
{
    username = $('#live_page_userid').val();
    $('.user_live').show();

    let configuration = {
            iceServers: [
                {
                    "urls": ["stun:stun.l.google.com:19302", 
                    "stun:stun1.l.google.com:19302", 
                    "stun:stun2.l.google.com:19302"]
                }
            ]
        }
    peerConnstreamview = new RTCPeerConnection(configuration)

    peerConnstreamview.onaddstream = (e) => {
               document.getElementById("remote-video-stream-view").srcObject = e.stream
         };

    peerConnstreamview.onicecandidate = ((e) => {
            if (e.candidate == null)
                return
            
            sendDatastreamview({
                type: "send_candidate",
                candidate: e.candidate
            })
        })

        sendDatastreamview({ type: "join_call" })

         peerConnstreamview.canTrickleIceCandidates = () => {
            console.log('connected stream');
        }

        // View count Data Store

        $.ajax({
            url: '{!! route('stream-visitor') !!}',
            type: 'POST',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "stream_id":username
                  },
                 success: function(response) 
                 {
                   console.log('success in Count',response)
                 },
                 error:function(error) 
                 {
                    console.log('error', error);
                 }
           });
        // View count Data Store
}

setTimeout(joinCallstreamview, 3000);

let isAudiostreamview = true
function muteAudio() 
{
    isAudiostreamview = !isAudiostreamview
    localStreamstreamview.getAudioTracks()[0].enabled = isAudiostreamview
}

let isVideostreamview = true
function muteVideo() 
{
    isVideostreamview = !isVideostreamview
    localStreamstreamview.getVideoTracks()[0].enabled = isVideostreamview
}
 $(".streamCommentSend").click(function() 
{
   var stream_comment = $('.stream_viewer_comment').val();
   var stream_id = $('#live_page_userid').val();
   console.log(stream_comment,"Stream Comment Get");
     $.ajax({
            url: '{!! route('liveviewer-Comment') !!}',
            type: 'POST',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "stream_id":stream_id,
                    "stream_comment":stream_comment
                  },
                 success: function(response) 
                 {
                  console.log(response);
                 },
                 error:function(error) 
                 {
                    console.log('error', error);
                 }
        });
});


      // End Live Page View code
      
      $("#send-message").click(function() 
      {
         var message_to = $(this).data('to');
         var message_from = $(this).data('from');
         var message = $("#message").val();
         var url = $(this).data('url');
         
         var post_data = {
            "_token": "{{ csrf_token() }}",
            to : message_to,
            from : message_from,
            message : message
         };
   
         $.ajax({ 
            url: url,
            type: 'POST',
            data : post_data,
            beforeSend: function()
            {
               $("#send-message").prop('disabled', true);
               $("#send-message").text('Sending');
            },
            success: function(response) {
   
               if(response.success) 
               {
                  toastr.success(response.success);
                  $("#message").val('');
                  return true;
               }
               if(response.error) {
                  toastr.error(response.error);
                  return false;
               }
               if(response.info) {
                  toastr.info(response.info);
                  $("#message").val('');
                  return false;
               }
               if(response.required) {
                  toastr.error(response.required);
                  $("#message").css('border','1px solid red');
                  return false;
               }
   
            }, 
            complete: function() {
               $("#send-message").prop('disabled', false);
               $("#send-message").text('Send');
            }, 
            error: function(data) {
               toastr.error(data);
            }
         });
      });
   
      $("#add-rider").click(function() 
      {
         
         var to = $(this).data('to');
         var from = $(this).data('from');
         var url = $(this).data('url');
         
         var post_data = {
            "_token": "{{ csrf_token() }}",
            to : to,
            from : from,
         };
   
         $.ajax({ 
            url: url,
            type: 'POST',
            data : post_data,
            beforeSend: function(){
               $("#add-rider").prop('disabled', true);
               $("#add-rider").text('SAVING');
            },
            success: function(response) {
   
               if(response.success) {
                  toastr.success(response.success);
                  document.getElementById('div-rider').innerHTML = "<span class=emoji>&#x1F44D;</span><h4>You are a rider.</h4>";
                  setTimeout(function(){ window.location.reload() }, 500);
                  return true;
               }
               if(response.error) {
                  toastr.error(response.error);
                  return false;
               }
               if(response.info) {
                  toastr.info(response.info);
                  return false;
               }
               if(response.required) {
                  toastr.error(response.required);
                  return false;
               }
   
            }, 
            complete: function() {
               $("#add-rider").prop('disabled', false);
               $("#add-rider").text('SAVE');
            }, 
            error: function(data) {
               toastr.error(data);
            }
         });
   
      });
   });
   
   $(document).ready(function()
   {
      $.getJSON('https://ipapi.co/json/', function(data) {
         var postdata1 = JSON.stringify(data, null, 2);
         var postdata = JSON.parse(postdata1);
         var ip = postdata.ip;
         var country = postdata.country_name;
         var pathname = window.location.pathname;
         var post_data = {'ip': ip, 'country': country,'pathname': pathname,  "_token": "{{ csrf_token() }}",};
         $.ajax({
            type: 'POST',
            url: '{!! route('profile-visitor') !!}',
            data: post_data,
            success:function(response) {
   
               console.log('response', response);
   
            }, error: function(error) {
   
            }
         });
      });
   });
</script>
<!------ posts script------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/vendor/emoji-picker/lib/js/config.js') }}"></script>
<script src="{{ asset('assets/vendor/emoji-picker/lib/js/util.js') }}"></script>
<script src="{{ asset('assets/vendor/emoji-picker/lib/js/jquery.emojiarea.js') }}"></script>
<script src="{{ asset('assets/vendor/emoji-picker/lib/js/emoji-picker.js') }}"></script>
<script type="text/javascript">
   $(function () {
    // Initializes and creates emoji set from sprite sheet
       window.emojiPicker = new EmojiPicker({
           emojiable_selector: '[data-emojiable=true]',
           assetsPath: "{!! asset('assets/vendor/emoji-picker/lib/img/') !!}",
           popupButtonClasses: 'icon-smile'
       });
   
       window.emojiPicker.discover();
   });
   function commentSave(postId) {
         var url = '{!! route('social-buzz.storeComments') !!}';
         var comment = $("textarea#comment_txt"+postId).val();
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "comment": comment,
                  "post_id":postId
            },
           
            success: function(response)
            {
                 if(response.validation_error) 
                 {
                    $("#social-comment").show();
                    toastr.warning(response.validation_error);
                    $('[id^="comment_txt"]').css('border-color', '#ff503f');
                 }
                 if(response.success) 
                 {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 2000);
                 }
                  if(response.error) 
                  {
                    toastr.error(response.error);
                  }
            },
            
            error: function(data)
            {
              if(data)
              {
                toastr.error('Bad Request.');
              }
            }
        });
   }
   function addAward(postId)
   {
         $('[id^="giveAward"]').modal('hide');
         var url = '{!! route('social-buzz.storeAward') !!}';     
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "post_id":postId
            },
            success: function(response)
            {
                 if(response.validation_error) 
                 {
                    toastr.warning(response.validation_error);
                 }
                 if(response.success) 
                 {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                  if(response.error) 
                  {
                    toastr.error(response.error);
                  }
            },
            error: function(data)
            {
              if(data)
              {
                toastr.error('Bad Request.');
              }
            }
        });
   }
   
   function addRider(postId)
   {
         $('[id^="ridersModal"]').modal('hide');
         var url = '{!! route('social-buzz.storeRider') !!}';   
          $("#add_rider").attr("disabled", true);  
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "post_id":postId
            },
            success: function(response)
            {
                 if(response.validation_error) 
                 {
                    toastr.warning(response.validation_error);
                 }
                 if(response.success) 
                 {
                    toastr.success(response.success);
                      $('#add_rider').removeAttr('disabled',false);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                  if(response.error) 
                  {
                    toastr.error(response.error);
                  }
            },
            error: function(data)
            {
              if(data)
              {
                toastr.error('Bad Request.');
              }
            }
           
        });
   }
   function goToPurchaseProduct(productLink)
   {
    if(productLink) 
    {
        $('[id^="purchaseModal"]').modal('hide');
        window.open(productLink);
    }
   }
   function reportUser(postId, userId)
   {
         $('[id^="reportUser"]').modal('hide');
         var url = '{!! route('social-buzz.reportUser') !!}';     
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "post_id":postId,
                  "user_id":userId
            },
            success: function(response)
            {
                 if(response.validation_error) 
                 {
                    toastr.warning(response.validation_error);
                 }
                 if(response.success) 
                 {
                    toastr.success(response.success);
                    setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) 
                 {
                    toastr.error(response.error);
                 }
            },
            error: function(data)
            {
              if(data)
              {
                toastr.error('Bad Request.');
              }
            }
        });
   }
   
</script>
<script type="text/javascript">
   $(document).ready(function()
   {
       var value = '<?php Session::get('isOpen') ?>';
       if(value == true) 
       {
         $('#stripeModal').modal('show');  
       }
   });
   
   
   ;(function($){
   
   /**
   * jQuery function to prevent default anchor event and take the href * and the title to make a share popup
   *
   * @param  {[object]} e           [Mouse event]
   * @param  {[integer]} intWidth   [Popup width defalut 500]
   * @param  {[integer]} intHeight  [Popup height defalut 400]
   * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
   */
   $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) 
   {
   
   // Prevent default anchor event
   e.preventDefault();
   
   // Set values for window
   intWidth = intWidth || '500';
   intHeight = intHeight || '400';
   strResize = (blnResize ? 'yes' : 'no');
   
   // Set title and open popup with focus on it
   var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
       strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
       objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
   }
   
   /* ================================================== */
   
   $(document).ready(function ($) 
   {
   $('.customer.share').on("click", function(e) 
   {
       $(this).customerPopup(e);
   });
   });
   
   }(jQuery));
</script>
<script type="text/javascript">
   function addAdView(adId) 
   {
        var url = '{!! route('social-buzz.add-ad-views') !!}';     
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "ad_id":adId
            },
            success: function(response)
            {},
            error: function(data)
            {
              /*  toastr.error('Bad Request.')*/;
            }
        });
   }
</script>



@stop