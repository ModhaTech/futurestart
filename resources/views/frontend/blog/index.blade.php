@extends('layouts.talent') 
@section('content')

<style>
.color:hover {
  color: black !important; /* Text color on hover */
  background-color: lightgray !important; /* Background color on hover */
}


</style>
<!-- banner start -->

<section class="wow fadeIn blog-sec cover-background background-position-top top-space" style="background-image:url(https://futurestarr.com/public/assets/images/blog-list-banner.jpg);">
	<div class="opacity-medium bg-extra-dark-gray" style="opacity: 0.1;"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
				<div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End banner  -->
<!-- Start Content  --> 
<section>
	<div class="container">
		<div class="row">
			<main class="col-md-12 blog-sectionss" style="margin-bottom: -40px;">
				<div class="col-md-8 col-sm-8 col-xs-12 blog-post-content blog-first-sec margin-10px-bottom xs-margin-10px-bottom xs-text-center">
				  <h1   class="text-extra-dark-gray text-uppercase alt-font text-large font-weight-600 margin-15px-bottom display-block"> Latest Blogs {{$catid->name ?? ''}}</h1>
			    </div>
			    <div class="col-md-4 col-sm-4 col-xs-12 blog-post-content blog-first-sec margin-10px-bottom xs-margin-10px-bottom xs-text-center">
					
				{{-- Buy Guest Post Button Create --}}
				@if(Auth::check())
				  @if(Auth::user()->role_id == 3)
					<button type="button" style="width: 100%;outline: 10px solid #de8596;padding: 10px;color: white; font-size: 16px;" class="mb-4 margin-15px-top btn btn-very-small btn-dark-gray text-uppercase color" data-toggle="modal" data-target="#buyguestpostModal">Submit Guest Post Button</button>
	

				  @endif
				@else
				<button type="button" style="width: 100%;outline: 10px solid #de8596;padding: 10px;color: white; font-size: 16px;" class=" color mb-4 margin-15px-top btn btn-very-small btn-dark-gray text-uppercase" data-toggle="modal" data-target="#register_my_model">Submit Guest Post Button</button>
				@endif
				{{-- Buty Guest Post Button Create --}}
				    
					<li class="dropdown ddho mb-4">
						@if(!empty($catid->id))
						<a href="#" class="dropdown-toggle text-extra-dark-gray text-uppercase alt-font font-weight-600 margin-15px-bottom " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {!! $catid->name !!}  </a>
						@else
						<a href="#" class="dropdown-toggle text-extra-dark-gray text-uppercase alt-font font-weight-600 margin-15px-bottom " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Categories  </a>
						@endif
						<ul class="dropdown-menu dropdown-menu1">

							@if(count($talentCategories) > 0)
							@foreach($talentCategories as $category)

							@if($category->slug == Request::segment(2))
							@php $activeClass = 'selected' @endphp
							@elseif(Request::segment(2) == '')
							@if($category->slug =='author')
							@php $activeClass = 'selected' @endphp
							@else
							@php $activeClass = '' @endphp
							@endif
							@else 
							@php $activeClass = '' @endphp
							@endif
							<li><a href="{{ route('blog.index', $category->slug) }}" class="{{  $activeClass }}">{{ $category->name }}</a></li>

							@endforeach
							@else
							<li>No Categories Found!!</li>
							@endif
						</ul>
					</li>

				</div> 

				<!-- start post item -->
				@if(!empty($latestBlog))
				<div class="col-md-12 border-all col-sm-12 col-xs-12 blog-post-content blog-first-sec margin-60px-bottom xs-margin-30px-bottom xs-text-center blog-category">

					<div class="blog-image pt-4 text-center">  
						<a href="{{ route('blog.detailed', [$latestBlog['getBlogCatagories']['slug'] ,$latestBlog['slug'] ]) }}">
							@if(!empty($latestBlog['blog_img'])) 
							<img src="{{ asset($latestBlog['blog_img'])}}" style="width: 50%;object-fit: cover;" alt="Blog Banner"/>
							@else 
							<img src="{{ asset('assets/images/defaultblog.png')}}" alt="Blog Banner"/>
							@endif
						</a>

					</div>
					<br/>

					<div class="col-md-12 col-sm-12 col-xs-12 blog-post-content blog-first-sec xs-text-center pb-4">
						<div class="blog-text display-inline-block width-10">
				     		<div class="content">
				               <img class="au-img-au-t"  src="{{asset(str_replace(' ', '%20', $latestBlog['author_image']))}}" alt="Profile Image Author"/>
				            </div>
				        </div>
				        <div class="blog-text blog-text-content float-right">
				        	<div class="content pt-4">
				        	   <div class="text-medium-gray text-extra-small margin-5px-bottom text-uppercase alt-font">
     				             <img class="au-img-au-shape"  src="{{ asset('assets/images/Shape 1.png')}}" alt="Author Profile Image2"/>
					             <span>
					             	<h2 style="color: #000 !important;" class="pb-2"> {{ $latestBlog['meta_tags'] }} </h2>
					             </span>
					             <span>Posted on {{\Carbon\Carbon::parse($latestBlog['date'])->format('F d, Y')}} </span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					             <span>
					             	<a href="javascript:void(0);" class="text-medium-gray"> {{ $latestBlog['author_first_name'] }} </a> 
					             	<a href="javascript:void(0);" class="text-medium-gray"> {{ $latestBlog['author_last_name'] }} </a>  
					             </span>
					            </div>
					            <p class="no-margin padd-0">
     				{!! Str::limit(strip_tags($latestBlog['content']), 485) !!}
     			                </p>
     			            </div>
     		<a style="" class="mb-4 margin-15px-top btn btn-very-small btn-dark-gray text-uppercase" href="{{ route('blog.detailed',[ $latestBlog['getBlogCatagories']['slug'], $latestBlog['slug'] ]) }}">Explore</a>
     	</div>

     </div>
 </div>

 @else
 <div class="no-blogs col-md-12 col-sm-12 col-xs-12 blog-post-content margin-60px-bottom xs-margin-30px-bottom xs-text-center">
 	<h5 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">
 		Sorry, no blogs available for this category!
 	</h5>
 </div>
 @endif
 <!-- end post item --> 
</main>
<!--- for article 3 rows -->

<main class="col-md-12 blog-sectionss">

	<div class="demo">
			<div class="container">
			@if(count($blogs) > 0)
			@foreach($blogs as $key => $blog)
				<div class="col-md-6 col-sm-12 blog-rela">
					<div class="card mb-2">
					  <img style="width: 100%;height: 300px;object-fit: cover;" class="p-4" src="{{asset( !empty($blog->blog_img) && file_exists($blog->blog_img) ? asset($blog->blog_img) :'assets/images/default-ad-banner.png')}}" alt="Futurestarr Banner"/>

						<div class="card-body">
							<h2 class="card-title">{{ $blog->meta_tags ?: '' }}</h2>
							<p class="card-text">{!! Str::limit(strip_tags($blog->content), 105) !!}</p>
				
							<a href="{{ route('blog.detailed', [ $blog->getBlogCatagories['slug'], $blog->slug] ) }}" class="btn btn-primary">Explore</a>
						</div>  

						<div class="border-top padd-15">
							<div class="dt-au-lestar star-author text-medium-gray text-extra-small text-uppercase alt-font">
                              <img class="au-img-au" src="{{ asset( !empty($blog->author_image) && file_exists($blog->author_image) ? str_replace(' ', '%20', $blog->author_image):'assets/images/aside-image-4.jpg')}}"  alt="Author Profile Image">	
                            </div>

							<div class="dt-au-le txt-sm-f pt-5  text-left text-medium-gray text-extra-small text-uppercase alt-font">{{ \Carbon\Carbon::parse($blog->date)->format('F d, Y')}} &nbsp &nbsp  | &nbsp &nbsp <a href="javascript:void(0);" class="text-medium-gray margin-15px-top"> {{ $blog->author_first_name ?: '' }}  </a>  <a href="javascript:void(0);" class="text-medium-gray margin-15px-top"> {{ $blog->author_last_name ?: ''  }} </a>
							</div>
						</div>
					</div>
				</div>
			@endforeach

			@else
			<p class="color-danger text-center">
				Sorry, no blogs available for this category!
			</p>
			@endif
			</div>
		<div style="text-align: center;margin:40px auto 0 auto;display: table;">
			{{ $blogs->links() }}
		</div>
		<!--<div class="row">-->
		<!--	<div class="col-xs-12 pt-5">-->
		<!--		<div class="border-top border-light pt-4 mb-4">-->
		<!--			<div class="text-center">-->
		<!--				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal-subscibed"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp Subscribe</button>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--	</div>-->
		<!--</div>-->
	</div>

	<style>
	.dt-au-lestar{
			margin-left:-20px;
		}
	</style>
	<!-- Modal -->
	<div id="myModal-subscibed" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Subscribe to new trendy updates</h5>        
				</div>
				<div class="modal-body">
					<span class="text-danger" id="validation_error"></span>
					<form class="pt-4">
						<div class="form-group">
							<label for="exampleInputPassword1">First Name</label>
							<input type="text" class="form-control" id="subscribe-first-name" placeholder="First Name" name="first_name" value="{{ !empty(Auth::user()->first_name) ? Auth::user()->first_name : '' }}" required>
						</div>

						<div class="form-group">
							<label for="exampleInputPassword1">Last Name</label>
							<input type="text" class="form-control" id="subscribe-last-name" placeholder="Last Name" name="last_name" value="{{ !empty(Auth::user()->last_name) ? Auth::user()->last_name : '' }}" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" class="form-control" id="subscribe-email" aria-describedby="emailHelp" name="email" value="{{ !empty(Auth::user()->email) ? Auth::user()->email : '' }}" placeholder="Enter email" required>
						</div>
						<small id="emailHelp" class="form-text text-muted">We may communicate with you about the information you’ve requested and other FutureStarr services. The use of your information is governed by FutureStarr privacy policy.
					    </small>
				 </form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" id="subscribe" class="btn btn-primary" >Save</button>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- end post item --> 
</main>

</div>
</div>
</section>
<!-- End content -->
<!-- Button trigger modal -->

<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;">
	<i  class="ti-arrow-up"></i></a>

<script type="text/javascript">
	$(document).ready(function() 
	{
		$(".blog-popup .popup-inner .close-btn").click(function(){
			$(".blog-popup").hide();
		});
         $("#subscribe").click(function(e)
         {
         	  e.preventDefault(); 
            $("#validation_error").text('');
		     var url  = '{!! route("blog.subscribe.store") !!}';
		     var first_name = $("#subscribe-first-name").val();
		     var last_name = $("#subscribe-last-name").val();
		     var email = $("#subscribe-email").val();
		     var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			 if(!regex.test(email))
			 {
				toastr.error('','You have entered an invalid email address');
				return false;
			 }

         $("#subscribe").prop('disabled',true);

		     $.ajax({
		     	 type: 'POST',
                 url: url,
		             data: {
		                  "_token": "{{ csrf_token() }}",
		                  "first_name":first_name,
		                  "last_name":last_name,
		                  "email":email
		            },
	            success:function(response) 
	            {
	            	console.log(response);
	               $("#subscribe").prop('disabled',false);
                   if(response.success) 
                   {
	                   toastr.success(response.success);
	                  }
	               if(response.error) 
	               {
	               	    $("#subscribe").prop('disabled',false);
	                    toastr.error(response.error);
	                    if(response.status) 
	                    {
	                    	$("#validation_error").text(response.error);
	                    }
	                }
	               if(response.info) 
	               {
	               	  toastr.info(response.info);
	                }
		        },
		        complete:function(data)
		        {
		        	 $("#subscribe").prop('disabled',false);
                     $("#loader").hide();
            },
	
		     });

        });
    });
</script>

{{-- Buy Guest Post Model Open --}}
<!-- Modal -->
<div class="modal fade" id="buyguestpostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 425px;">
      <div class="modal-header">
        <h5 style="text-align: center;" class="modal-title" id="exampleModalLabels">Purchase & Start Posting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div id="donate-button-container">
			<img style="max-height: 75px;" src="{{ asset('assets/images/futurestarr_logo.jpg')}}" alt="Blog Banner"/>
			<h5 style="text-align: center;padding: 24px;font-size: 18px;">Donate to Future Starr</h5>
			<p style="font-size: 14px!important;text-align: center;" class="buy_post_para">Please Donate No Less than $20 to help keep our site up and running.</p>
			<p style="font-size: 13px!important; text-align: center;" class="buy_post_para">Login access will be Emailed within 24hrs or less after purchase.</p>
			<p style="font-size: 13px!important;text-align: center;" class="buy_post_para">You will have access to account for up to 24hrs. Thank You! </p>
			<div id="donate-button"></div>
			<p style="font-size: 14px!important;text-align: center; margin-top: 40px;">Notice : We do not accept blogs that has discrimination, porn, casino or illegal related content.</p>
			<script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8">
			</script>

		<!--	 <script>
          document.addEventListener('DOMContentLoaded', function() {
              PayPal.Donation.Button({
                  env: 'sandbox', // Change to 'sandbox' for testing
                  hosted_button_id: 'WU3UD92YNGZZ4', // Replace with sandbox button ID
                  image: {
                      src: 'https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif',
                      alt: 'Donate with PayPal button',
                      title: 'PayPal - The safer, easier way to pay online!',
                  }
              }).render('#donate-button');
          });
        </script> -->

	<script>
				PayPal.Donation.Button({
				env:'production',
				hosted_button_id:'24DYFDVH327KG',
				image: {
				src:'https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif',
				alt:'Donate with PayPal button',
				title:'PayPal - The safer, easier way to pay online!',
				}
				}).render('#donate-button');
			</script>
		</div> 

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

{{-- Buy Guest Post Model Open --}}

<!-- Register Modal open  -->
<div class="container">
   <!-- Modal -->
   
</div>
<!-- Register Modal open -->
@endsection
