@extends('layouts.talent') @section('content')
<!-- Start Banner -->
{{-- <section class="wow fadeIn cover-background background-position-top top-space">
<img src="{{asset($category['catagory_image_path']??'assets/images/homepage-5-slider-img-2.jpg')}}" width="100%"/>
   <div class="opacity-medium"></div>
   
</section> --}}
<style type="text/css">
   .talent-mall-ban 
   {
     margin-top: 73px;
   }
   .talent-mall-ban .text-uppercase.alt-font.text-extra-dark-gray.margin-20px-bottom.font-weight-700.sm-width-100.xs-width-100.fnd-tlt-hr
   {
      margin-top: 10px;
   }
   .nmbar
   {
      background-color: rgb(21, 24, 41);
   }
     .top-bg
   {
      background-color: rgb(21, 24, 41);
   }
   nav
   {
      background-color: rgb(21, 24, 41)!important;
   }
</style>

<!-- End Banner -->
<!-- Start Content -->
<link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
<section class="talent-mall-ban">
   <h1 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100 fnd-tlt-hr"><img src="/assets/images/f-star.png" class="star" alt="star"> Find The Best Talent Here <img src="/assets/images/f-star.png" class="star" alt="star"></h1>
   <div class="container-fluid" class="talent-mall-con-adjust">
      <div class="row">
         <!-- Start left side content -->
         <aside class="col-lg-3 col-md-4 col-sm-4 col-xs-12 fnd-tlt-hr-aside">
            <div class="col-sm-12 fnd-tlt-hr-asides">
               <!-- start Filter -->
               <div class="text-extra-dark-gray text-uppercase font-weight-600 text-small aside-title mb-2">
                  <span>Filter Price</span>
               </div>
               <input type="range" class="slider_r" id="customRange1"  name="ram"  min="0" max="1000" value="0" >
               <p>Price: <span id="demo" class="text-danger">0</span></p>
               <script>
                  var slider = document.getElementById("customRange1");
                  var output = document.getElementById("demo");
                  output.innerHTML = slider.value;
                  
                  slider.oninput = function() {
                    output.innerHTML = this.value;
                  }
               </script>
               <!-- End Filter -->
               <!-- Start Categories -->
               <div class="text-extra-dark-gray text-uppercase font-weight-600 text-small aside-title mb-4" ><span>Categories</span></div>
               <ul class="list-style-6 text-small text-left mb-4" >
                  @foreach($catagories as $catagory)
                   @php $checked = $id == $catagory->id ? 'checked':''; @endphp
                  <li id="list-checkbox{{$catagory->id}}" class="talent-mall-category d-flex justify-content-between align-items-center pr-0 @if($id == $catagory->id)custom-active-talent-li @endif">{{ $catagory->name}}
                     <input class="w-auto mb-0 case catagoryInputs" {{$checked}} type="checkbox" name="catagories[]" data-cat-id="{{$catagory->id}}" id="checkbox{{$catagory->id}}" value="{{$catagory->id}}">
                  </li>
                  @endforeach
               </ul>
               <!-- End Categories --> 
               <!-- Start Award Rating -->
               <div class="text-extra-dark-gray text-uppercase font-weight-600 text-small aside-title mb-4"><span>Award Rating</span></div>
               <ul class="list-style-6 text-small" >
                  <li class="d-flex justify-content-between align-items-center pr-0 awdli">
                     <span class="trophy-cust"> 
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     </span>
                     <label class="mb-0" >
                     </label>
                     <input  type="checkbox"  value="5" id="star-check5" data-star="5" class="w-auto mb-0 case chech">
                  </li>
                  <li class="d-flex justify-content-between align-items-center pr-0" >
                     <span class="trophy-cust"> 
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     </span>
                     <label class="mb-0" >
                     </label>
                     <input  type="checkbox" value="4" id="star-check4" data-star="4" class="w-auto mb-0 case chech">
                  </li>
                  <li class="d-flex justify-content-between align-items-center pr-0" >
                     <span class="trophy-cust"> 
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     </span>
                     <label class="mb-0" >
                     </label>
                     <input  type="checkbox" value="3" id="star-check3" data-star="3" class="w-auto mb-0 case chech">
                  </li>
                  <li class="d-flex justify-content-between align-items-center pr-0" >
                     <span class="trophy-cust"> 
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     </span>
                     <label class="mb-0" >
                     </label>
                     <input  type="checkbox" id="star-check2" value="2" data-star="2" class="w-auto mb-0 case chech">
                  </li>
                  <li class="d-flex justify-content-between align-items-center pr-0" >
                     <span class="trophy-cust"> 
                     <i class="fa fa-trophy gold" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     <i class="fa fa-trophy grey" aria-hidden="true"></i>
                     </span>
                     <label class="mb-0" >
                     </label>
                     <input  type="checkbox" id="star-check1" value="1" data-star="1" class="w-auto mb-0 case chech">
                  </li>
               </ul>
            </div>
         </aside>
         <!-- End Left side  -->
         @if(count($talents) == 0 )
         @php $class = 'talent_list'; @endphp
         @else
         @php $class =''; @endphp
         @endif
         <main class="col">
            <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 xs-padding-15px-lr fl-data">
                  <div class="col-sm-12">
                     <div id="talent-mal-list" class="filter-content overflow-hidden">
                        <ul  class="portfolio-grid work-3col gutter-medium hover-option6 lightbox-portfolio {{$class}}" id="talent_list">
                           <!-- start portfolio-item item -->
                           @if(count($talents) > 0)
                           @foreach($talents as $talent)
                           <li class="design web photography grid-item wow fadeInUp last-paragraph-no-margin">
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
                                    <img class="optional_video_live{{ $talent['getUserData']['id'] }}" alt="productInfo" src="{{ asset($image)}}"/>
                                    @php
                                      $count = 0; //Initialize variable
                                    @endphp
                                    @foreach($livestream_data_get as $livestream_data)
                                       @if( ($livestream_data->user_id == $talent['getUserData']['id']) && ($livestream_data->status == 1))
                                       @php
                                         $count ++;
                                       @endphp
                                      
                                       <div class="user_live{{ $talent['getUserData']['id'] }}" style="display: none; position: absolute;padding: 0px 6px;background-color: #ef174f;border-radius: 2px;text-transform: uppercase;left:5px;top:5px;color: white;font-weight: 600;">Live</div>
                                      <video style="min-height: 16vw!important; width: 95%;" class="remote-video-stream-view{{$livestream_data->user_id}}" autoplay>
                                      </video>
                                      <input type="hidden" value="{{ $livestream_data->user_id }}" class="live_page_userid">
                                       <input type="hidden" class="loop_stream_count" value="{{($count)}}" name="">
                                       
                                      
                                      @endif
                                    @endforeach

                                 </a>
                                 @endif

                                 @elseif(!empty($talent->sampleMedia[0]->image_path))

                                 @php
                                 $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                                 $contentType = mime_content_type($talent->sampleMedia[0]->image_path);
                                 if(in_array($contentType, $allowedMimeTypes) && file_exists($talent->sampleMedia[0]->image_path))
                                 {
                                    $imagePath = $talent->sampleMedia[0]->image_path;       
                                 } 
                                 else 
                                 {
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
                                             @if(strlen($talent->title) > 32)
                                             <span  class="line-height-normal font-weight-600 text-small margin-5px-bottom text-extra-dark-gray display-block pro-tit">{{substr($talent->title, 0, 32)}}...
                                             </span>
                                             @else
                                             <span  class="line-height-normal font-weight-600 text-small margin-5px-bottom text-extra-dark-gray display-block pro-tit">{{$talent->title}}
                                             </span>
                                             @endif
                                             </a>
                                             <p  class="text-medium-gray text-extra-small mb-0 pro-info">{{ Str::limit($talent->product_info,35) }}
                                             </p>
                                             <p class="d-flex justify-content-between text-primary pt-1 mt-2 pro-pri"><strong>${{$talent->price}}</strong>   
                                                <a class="pro-more" href="{{ route('talent.productInfo', $talent->slug )}}" class="text-uppercase text-small">View more <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                             </p>
                                             <p class="trophy-cust">
                                                <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 1 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                                <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 2 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                                <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 3 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                                <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 4 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                                <i class="fa fa-trophy {{ $talent->get_talent_awards_count >= 5 ? 'gold' : 'grey' }}" aria-hidden="true"></i>
                                                <span class="cmt-count">({{$talent->get_talent_awards_count}})</span>

                                               <!--  <a class="pro-more" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#myModal-desc" class="text-uppercase text-small">Read more <i class="fa fa-arrow-right" aria-hidden="true"></i></a> -->
                                               <a class="moreless-button" data-id="{{$talent->id}}" href="javascript: void(0)">Read more</a>
                                                <p style="display: none;margin-top: 30px; text-align: justify;" class="moretext{{$talent->id}}">{{$talent->product_info}}</p>
                                             </p>
                                          </div>
                                       </div>
                                    </div>
                                 </figcaption>
                              </figure>
                           </li>
                           <!-- Product Description Model -->

                                <!--  <div id="myModal-desc" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             <h4 class="modal-title">Description</h4>
                                          </div>
                                          <div class="modal-body">

                                             <p>{{$talent->product_info}}</p>
                                          </div>
                                          <div class="modal-footer"></div>
                                       </div>
                                    </div>
                                 </div> -->
      
                           <!-- Product Description Model -->
                           @endforeach
                           @endif
                        </ul>

                        <div  class="wow fadeInUp mt-5 pagination-row">
                           <div class="pagination text-big text-uppercase  d-flex  w-100">
                              <div class="pagination">  
                                 
                                 @if(count($totalCount) > 9) 
                                 @php $index = count($talents) - 1; @endphp
                                 <!-- Pagination goes here --->
                                     <a href="javascript:void(0);" id="{{ $talents[$index]->id }}" class="show_more btn btn-success text-center" title="Load more posts" data-category="">Show more</a>
                                     <span class="loding btn btn-success text-center" style="display: none;">
                                          <span class="loding_txt">Loading...</span>
                                     </span>

                                 @endif

                               </div>

                            </div>
                        </div>

                     </div>
                  </div>
               
               </div>
            </div>
            <!-- <div  class="row">
               <div class="noProductFound">
                 <h3> Sorry! No Products Found. </h3>
               </div>
               </div> -->
         </main>
      </div>
   </div>

</section>
<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;"><i  class="ti-arrow-up"></i></a>
@endsection
@section('javascript')
<script>
   $(document).ready(function() 
   {
       //const live_page_userid = $('#live_page_userid').val();
      
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
    var live_page_userid_new = $(".live_page_userid");

       console.log($(live_page_userid_new[0]).val(),'new data');
        //var arrayids = [];
      for(var i = 0; i < live_page_userid_new.length; i++) 
         {
            var ids = $(live_page_userid_new[i]).val();

              // var obj = {};
              // obj.username = ids
              // arrayids.push(obj);

            $(".optional_video_live"+ids).hide();
            $(".user_live"+ids).show();
           
            console.log(ids,'get ids username');
            username = ids;
         }
    // console.log(arrayids,"username get")

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
    //peerConn.addStream(localStream)

    peerConnstreamview.onaddstream = (e) => {
                
               console.log(remoteStream,"remote Stream set");
                for(var i = 0; i < live_page_userid_new.length; i++) 
                {
                  var remoteStream = e.stream;
                  const videoEle = $('.remote-video-stream-view'+username)[i];
                  videoEle.srcObject = remoteStream;
                }
              // document.getElementById("remote-video-stream-view").srcObject = e.stream
                
               
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
}
          
 setTimeout(joinCallstreamview, 3000);
      // End Live Page View code


     $('#customRange1, [id^="checkbox"], [id^="star-check"]').change(function(){ 
      console.log('Yes check checkbox Set');
      var hasClass = $("#talent_list").hasClass('talent_list');
      if(hasClass) 
      {
         $("#talent_list").removeClass('talent_list');
      }
      var getid = $(this).data('cat-id');
      var hasClass = $('#list-checkbox'+getid).hasClass('custom-active-talent-li');
      if(hasClass == true) 
      {
          $('#list-checkbox'+getid).removeClass('custom-active-talent-li');
      }
      var price = $("#customRange1").val();
      $("#priceValue").text(price);
      var category = [];
   
      $('[id^="checkbox"]:checked').each(function() 
      {
            category.push($(this).data('cat-id'));
            $('#list-checkbox'+$(this).data('cat-id')).addClass('custom-active-talent-li');
      }); 
      var star = [];
        $('[id^="star-check"]:checked').each(function() 
        {
            star.push($(this).data('star'));
        }); 
      var selected_values = category;
      var star_values = star;
      var url = "{!! route('talent.show') !!}";
      $.ajax({
              type: "post",
              url: url,
              data: {
                    "_token": "{{ csrf_token() }}",
                    "price":price,  
                    "categories" : selected_values,
                    "stars" : star_values 
              },
              success: function(response){
                 console.log('talent response', response);
                 if(response) {
                   
                   if(response.customClass == true) {
                     var addClass = 'talent_list';
                     console.log('blank checked');
                   } else {
                     var addClass = '';
                     // $('input:checkbox').removeAttr('checked');
                   
                   }
                   $("#talent_list").html(response.talnets).fadeIn(2000).addClass(addClass);
                   $("#talent_list").addClass(response.customClass);
                   $(".pagination").html(response.load_more);

                 }
              },
              error: function(data){
                  
              }
          });
     });
   });

   $(function()
   {

      $('.moreless-button').click(function() 
         {
            var moreless_id = $(this).data('id');
            console.log(moreless_id,"test");
           $('.moretext'+moreless_id).slideToggle();
           if ($('.moreless-button').text() == "Read more") 
           {
             $(this).text("Read less")
           } 
           else 
           {
             $(this).text("Read more")
           }
         });

      $(document).on('click', '.show_more', function() {
            var talent_id = $(this).attr('id');
            var price = $("#customRange1").val();
            var category = [];
            $('[id^="checkbox"]:checked').each(function() {
                  category.push($(this).data('cat-id'));
                  $('#list-checkbox'+$(this).data('cat-id')).addClass('custom-active-talent-li');
            }); 
            var star = [];
            $('[id^="star-check"]:checked').each(function() {
               star.push($(this).data('star'));
            }); 
            var url = '{!! route('show.more.talent') !!}';
            $('.show_more').hide();
            $('.loding').show();

            $.ajax({
                  type: "post",
                  url: url,
                  data: {
                     "_token" : "{{ csrf_token() }}",
                     "price" : price,  
                     "categories" : category,
                     "stars" : star,
                     'talent_id' : talent_id 
                  },
                  success: function(response) 
                  {
                      $('.loding').remove();
                      $(".show_more").remove();
                      if(response.customClass == true) 
                      {
                        var addClass = 'talent_list';
                      } 
                      else 
                      {
                        var addClass = '';
                      }
                      $("#talent_list").append(response.talnets);
                      $(".pagination").html(response.load_more);
                  }, 
                  error: function(error) 
                  {

                  }
            });
      });
   });
</script>
@stop
