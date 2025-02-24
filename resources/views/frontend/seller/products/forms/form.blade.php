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
            <div class="">
                <div class="row">
                  <div class="col-md-6">
                       <h1 class="seller-add-product-h1">Add Product</h1>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('seller.my-product')}}" class="pull-right back-btn ap-back-btn" title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
                  </div>
               </div>
               <div class="well panel panel-danger panel-m">
                  <div class="panel-body">
                     <form id="add-product-form" method="POST" action="{{route('seller.store-product')}}" enctype="multipart/form-data">
                        @csrf                    
                        <div class="form-group">
                          <label for="category">Category</label>
                          {{--  {!! Form::label('category','Category') !!} --}}
                           <select required="" name="category" id="category" class="form-control b-select">
                              <option value="">Select category of product</option>
                              @if(!empty($catagories)) 
                              @foreach($catagories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                              @endif
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="title">Title</label>
                           <input type="text" class="form-control" required="" name="title" id="title" placeholder="Title">

                          {{--  {!! Form::label('title','Title') !!}
                           {!! Form::text('title', old('title') , ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),'placeholder'=>'Title' ]) !!}
                           {!! $errors->first('title', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}
                        </div>
                        <div class="form-group p-b-upload">
                          
                           <label>Product Logo/Commercial Section - <span class="text-danger">Upload Audio, Jpeg,Png Image or Video&nbsp;(1-2 min limit)</span></label>
                           <div class="file-upload">
                              <div class="file-select">
                                 <div class="file-select-button" id="fileName">Browse</div>
                                 <div  class="file-select-name" id="selected-commercial-file">No file selected</div>
                                 {{-- {!! Form::file('commercial',['id' => 'commercial']) !!} --}}
                                 <input type="file" required="" name="commercial" id="commercial">
                                 <!-- file list -->
                              </div>
                           </div>
                          {{--  {!! $errors->first('image', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}
                        </div>
                        <div class="form-group p-b-upload">
                        
                           <label>Sample Product section - <span class="text-danger"> Upload Audio, Jpeg/png images or Video&nbsp;(Note: Image should be water marked)</span></label>
                           <div class="file-upload">
                              <div class="file-select">
                                 <div class="file-select-button" id="fileName1">Browse</div>
                                 <div class="file-select-name" id="selected-video-file">No file selected </div>
                                 <input type="file" name="video" required="" id="video">
                                {{--  {!! Form::file('video', ['id' => 'video']) !!} --}}
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                          <label for="product_info">Bio Information of Product</label>
                        {{--    {!! Form::label('product_info','Bio Information of Product') !!} --}}
                        <textarea class="form-control" required="" placeholder="Bio Information of Product" rows="4" name="product_info" cols="50" id="product_info"></textarea>

                           {{-- {!! Form::textarea('product_info', old('product_info') , ['class' => 'form-control' . ($errors->has('product_info') ? ' is-invalid' : ''),'placeholder'=>'Bio Information of Product','rows'=>'4' ]) !!}
                           {!! $errors->first('product_info', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}
                        </div>
                        <div class="form-group">
                          <label for="description">Bio Information of Seller</label>
                          <textarea class="form-control" required="" name="description" id="description" rows="4" cols="50" placeholder="Bio Information of Seller"></textarea>
                           {{-- {!! Form::label('description','Bio Information of Seller') !!}
                           {!! Form::textarea('description', old('description') , ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),'placeholder'=>'Bio Information of Seller','rows'=>'4' ]) !!}
                           {!! $errors->first('description', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}
                        </div>
                        <!--<br>-->
                        <label for="description">Price of Product</label>
                        {{-- {!! Form::label('description','Price of Product') !!} --}}
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fas fa-usd" aria-hidden="true"></i></span>
                           <input type="text" name="price" required="" id="price" class="form-control price" placeholder="Price">
                           {{-- {!! Form::text('price', old('price') , ['class' => 'form-control price' . ($errors->has('price') ? ' is-invalid' : ''),'placeholder'=>'Price' ,]) !!} --}}
                        </div>
                        {!! $errors->first('price', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        <span class="alert alert-danger" role="alert" id="digit-only"></span>
                        <br>
                        <div class="form-group">
                           <label>Upload Product For Sale <span class="text-danger">
                           (Mp3,jpeg,video,pdf)</span></label>
                           <div class="file-upload">
                              <div class="file-select">
                                 <div class="file-select-button" id="fileName2">Browse</div>
                                 <div class="file-select-name" id="selected-pdf-file">No file selected</div>
                                 {{-- {!! Form::file('pdf[]', ['id' => 'pdf','files' => true,'multiple' => 'multiple']) !!} --}}
                                <input type="file" required="" multiple id="pdf" name="pdf[]">
                             </div>
                             <div class="container">
                             	<div class="row gallery">
                             		
                             	</div>
                             </div>
                           </div>
                           {{--  {!! $errors->first('pdf', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}
                        </div>
                        <div class="upload-products social-media-icons">
                           <div class="row">
                              <div class="col-sm-12">
                                <label for="facebookLink">Social media links</label>
                                {{--  {!! Form::label('facebookLink','Social media links') !!} --}}
                                 <div class="form-group">
                                    <div class="col-sm-1 icon">
                                       <i class="fa fa-facebook-f facebook-icon-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="input-group col-sm-11">
                                      <input required="" class="placeholder" type="text" name="facebookLink" placeholder="facebook link" id="facebookLink">
                                      {{--  {!! Form::text('facebookLink', old('facebookLink') , ['class' => 'form-control' . ($errors->has('facebookLink') ? ' is-invalid' : ''),'placeholder'=>'facebook link' ]) !!}
                                       {!! $errors->first('facebookLink', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <div class="col-sm-1 icon">
                                       <i class="fa fa-instagram facebook-icon-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="input-group col-sm-11">
                                      <input required="" type="text" name="instagramLink" placeholder="instagram link" class="form-control" id="instagramLink">
                                       {{-- {!! Form::text('instagramLink', old('instagramLink') , ['class' => 'form-control' . ($errors->has('instagramLink') ? ' is-invalid' : ''),'placeholder'=>'instagram link' ]) !!}
                                       {!! $errors->first('instagramLink', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <div class="col-sm-1 icon">
                                       <i class="fa fa-twitter facebook-icon-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="input-group col-sm-11">
                                      <input required="" type="text" name="twitterLink" class="form-control" placeholder="twitter link" id="twitterLink">
                                       {{-- {!! Form::text('twitterLink', old('twitterLink') , ['class' => 'form-control' . ($errors->has('twitterLink') ? ' is-invalid' : ''),'placeholder'=>'twitter link' ]) !!}
                                       {!! $errors->first('twitterLink', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                            <div class="col-sm-12">
                               <div class="form-group">
                                <div class="checkbox">
                                  <label><input type="checkbox" name="productright" value="1">You agree that you are the original owner and have full rights to this product</label>
                                  {!! $errors->first('productright', '<span class="alert alert-danger display-block" role="alert">checkbox field is required.</span>') !!}
                                </div>
                               </div>
                             </div>
                           </div>
                        </div>
                        <!-- <input class="submit-add-product" type="submit" name="submit" value="save"> -->

                          <button type="submit" class="btn hide-off" id="upload-product" style="background-color: green; color: #fff; font-size: 14px; padding: 0 25px;height: 40px; line-height: 40px;">Save</button>
                        
                         <div class="form-group col-md-12" id="loader-product" style="display: none;">
                              <button class="btn btn-primary" type="button" disabled>
                               <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                  Please wait! we are processing your request.
                             </button>
                          </div>

                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="error-pop upload-limit-10">
     <div class="error-pop-inner">
       <btn class="close-error-pop-btn">
         <i class="fa fa-times" aria-hidden="true"></i>
       </btn>
       <div class="error-content">
          <div class="center-img">
            <img src="{{ asset('assets/images/uploadlimit10mb.png') }}">
          </div>
          <p class="pop-text-1">Please upload MP4/MP3 video or music length 1-2 mins long.</p>
          <p class="pop-text-2">File size no larger than 10MB</p>
       </div>
     </div>
  </div>
    <div class="error-pop send-to-approval">
     <div class="error-pop-inner">
       <btn class="close-error-pop-btn">
         <i class="fa fa-times" aria-hidden="true"></i>
       </btn>
       <div class="error-content">
          <div class="center-img">
            <img src="{{ asset('assets/images/sendtoapproval.png') }}">
          </div>
          <p class="pop-text-3">Your product has been sent to</p>
          <p class="pop-text-3">admin for approval</p>
       </div>
     </div>
   </div>
   <div class="error-pop upload-process">
     <div class="error-pop-inner">
       <div class="error-content">
          <div class="center-img">
          	<div class="upload-percentage">
          		<div class="c100 p9 green">
                    <span>50%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
          	</div>
          </div>
          <p class="pop-text-3">Product is uploading</p>
          <p class="pop-text-3">Please wait...</p>
       </div>
     </div>
   </div>
</section>

<script type="text/javascript">
      

    $(document).ready(function()
    {

    // Multiple Video Preview Code

         function videoPreview(input)
        {
          var files = event.target.files;
          console.log(files);
          for (var i = 0; i < files.length; i++) 
          {
            var f = files[i];
            var source = document.createElement('video'); //added now
			source.controls = true;

            source.src = URL.createObjectURL(files[i]);

            // Add remove cod
            var rem = document.createElement('span');
            // Add remove code
            $('.gallery').append(source);
            $('.gallery').append(rem);
           
          
            $('.gallery').children('span').attr('class','removevideo').html('<i class="fas fa-times videoremovefa"></i>');
             $(".removevideo").click(function(){
                        $(this).prev().remove();
                        $(this).remove();
               })
          }
        } 

    // Multiple images preview in browser
      function imagesPreview(input, placeToInsertImagePreview) 
    {
      if (input.files) 
      {
              var filesAmount = input.files.length;
              for (i = 0; i < filesAmount; i++) 
              {
                  var reader = new FileReader();
                  reader.onload = function(event) 
                  {
                      $($.parseHTML('<img>')).attr('src', event.target.result).attr('class','pip').appendTo(placeToInsertImagePreview);
                      $($.parseHTML('<span>')).attr('class', "removeimage").html('<i class="fas fa-times imageremovefa"></i>').appendTo(placeToInsertImagePreview);
                      $(".removeimage").click(function(){
                        $(this).prev().remove();
                        $(this).remove();
                      })
                  }
                  reader.readAsDataURL(input.files[i]);
              }
       }
     };

    $('#pdf').on('change', function() 
    {
      var src_file_name = $(this).val().split('.').pop().toLowerCase();
          if($.inArray(src_file_name, ['gif','png','jpg','jpeg','bmp']) == -1) 
          {
            videoPreview(this);
          }
          else
          {
            imagesPreview(this, 'div.gallery');
          }
    });
});
   
</script>
<style type="text/css">
  .removeimage{
    position: relative;
  }
  video{
  	width: 194px;
  	border:none;

  }
  .pip{
  	height: 175px;
  	width: 188px;
  	margin-top: 70px;
  }
   .gallery .removevideo{
   	position: relative;
   	margin-top: 70px;
   	padding-left: 10px;
   }
  .gallery .removevideo .videoremovefa{
    position: absolute;
    font-size: 25px;
    right: 10px;
    color: #a09494;
    cursor: pointer;
  }
  .removeimage .imageremovefa{
    position: absolute;
    right: 1px;
    color: #a09494;
    font-size: 25px;
    margin-top: 70px;
    cursor: pointer;
  }
  .error-pop{
    display: none;
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background: #0000008f;
    z-index: 999;
  }

  .error-pop .error-pop-inner{
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    margin-top: 120px;
    background: #fff;
    width: 600px;
    box-shadow: 0px 0px 6px 2px #555555;
    border-radius: 3px;
  }
  .error-pop .close-error-pop-btn{
    display: block;
    margin-left: auto;
    position: absolute;
    right: 10px;
    top: 5px;
    cursor: pointer;
  }
  .error-pop .error-content{
    margin: 50px 30px;
    text-align: center;
  } 
  .error-pop .error-content .upload-percentage{
  	font-size: 50px !important;
  }
  .error-pop .error-content .center-img{
    margin-bottom: 30px;
    margin-top: 30px;
  }
  .error-pop .error-content .center-img img{
    width: 150px;
  }
  .error-pop .error-content .pop-text-1{
    font-size: 17px !important;
    font-weight: 500 !important;
    margin-bottom: 6px;
  }
  .error-pop .error-content .pop-text-2{
    font-size: 20px !important;
    color: #da0f0f !important;
  }
  .error-pop .error-content .pop-text-3{
    font-size: 20px !important;
  }

  .rect-auto,
.c100.p51 .slice,
.c100.p52 .slice,
.c100.p53 .slice,
.c100.p54 .slice,
.c100.p55 .slice,
.c100.p56 .slice,
.c100.p57 .slice,
.c100.p58 .slice,
.c100.p59 .slice,
.c100.p60 .slice,
.c100.p61 .slice,
.c100.p62 .slice,
.c100.p63 .slice,
.c100.p64 .slice,
.c100.p65 .slice,
.c100.p66 .slice,
.c100.p67 .slice,
.c100.p68 .slice,
.c100.p69 .slice,
.c100.p70 .slice,
.c100.p71 .slice,
.c100.p72 .slice,
.c100.p73 .slice,
.c100.p74 .slice,
.c100.p75 .slice,
.c100.p76 .slice,
.c100.p77 .slice,
.c100.p78 .slice,
.c100.p79 .slice,
.c100.p80 .slice,
.c100.p81 .slice,
.c100.p82 .slice,
.c100.p83 .slice,
.c100.p84 .slice,
.c100.p85 .slice,
.c100.p86 .slice,
.c100.p87 .slice,
.c100.p88 .slice,
.c100.p89 .slice,
.c100.p90 .slice,
.c100.p91 .slice,
.c100.p92 .slice,
.c100.p93 .slice,
.c100.p94 .slice,
.c100.p95 .slice,
.c100.p96 .slice,
.c100.p97 .slice,
.c100.p98 .slice,
.c100.p99 .slice,
.c100.p100 .slice {
  clip: rect(auto, auto, auto, auto);
}
.pie,
.c100 .bar,
.c100.p51 .fill,
.c100.p52 .fill,
.c100.p53 .fill,
.c100.p54 .fill,
.c100.p55 .fill,
.c100.p56 .fill,
.c100.p57 .fill,
.c100.p58 .fill,
.c100.p59 .fill,
.c100.p60 .fill,
.c100.p61 .fill,
.c100.p62 .fill,
.c100.p63 .fill,
.c100.p64 .fill,
.c100.p65 .fill,
.c100.p66 .fill,
.c100.p67 .fill,
.c100.p68 .fill,
.c100.p69 .fill,
.c100.p70 .fill,
.c100.p71 .fill,
.c100.p72 .fill,
.c100.p73 .fill,
.c100.p74 .fill,
.c100.p75 .fill,
.c100.p76 .fill,
.c100.p77 .fill,
.c100.p78 .fill,
.c100.p79 .fill,
.c100.p80 .fill,
.c100.p81 .fill,
.c100.p82 .fill,
.c100.p83 .fill,
.c100.p84 .fill,
.c100.p85 .fill,
.c100.p86 .fill,
.c100.p87 .fill,
.c100.p88 .fill,
.c100.p89 .fill,
.c100.p90 .fill,
.c100.p91 .fill,
.c100.p92 .fill,
.c100.p93 .fill,
.c100.p94 .fill,
.c100.p95 .fill,
.c100.p96 .fill,
.c100.p97 .fill,
.c100.p98 .fill,
.c100.p99 .fill,
.c100.p100 .fill {
  position: absolute;
  border: 0.08em solid #307bbb;
  width: 0.84em;
  height: 0.84em;
  clip: rect(0em, 0.5em, 1em, 0em);
  border-radius: 50%;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -ms-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
}
.pie-fill,
.c100.p51 .bar:after,
.c100.p51 .fill,
.c100.p52 .bar:after,
.c100.p52 .fill,
.c100.p53 .bar:after,
.c100.p53 .fill,
.c100.p54 .bar:after,
.c100.p54 .fill,
.c100.p55 .bar:after,
.c100.p55 .fill,
.c100.p56 .bar:after,
.c100.p56 .fill,
.c100.p57 .bar:after,
.c100.p57 .fill,
.c100.p58 .bar:after,
.c100.p58 .fill,
.c100.p59 .bar:after,
.c100.p59 .fill,
.c100.p60 .bar:after,
.c100.p60 .fill,
.c100.p61 .bar:after,
.c100.p61 .fill,
.c100.p62 .bar:after,
.c100.p62 .fill,
.c100.p63 .bar:after,
.c100.p63 .fill,
.c100.p64 .bar:after,
.c100.p64 .fill,
.c100.p65 .bar:after,
.c100.p65 .fill,
.c100.p66 .bar:after,
.c100.p66 .fill,
.c100.p67 .bar:after,
.c100.p67 .fill,
.c100.p68 .bar:after,
.c100.p68 .fill,
.c100.p69 .bar:after,
.c100.p69 .fill,
.c100.p70 .bar:after,
.c100.p70 .fill,
.c100.p71 .bar:after,
.c100.p71 .fill,
.c100.p72 .bar:after,
.c100.p72 .fill,
.c100.p73 .bar:after,
.c100.p73 .fill,
.c100.p74 .bar:after,
.c100.p74 .fill,
.c100.p75 .bar:after,
.c100.p75 .fill,
.c100.p76 .bar:after,
.c100.p76 .fill,
.c100.p77 .bar:after,
.c100.p77 .fill,
.c100.p78 .bar:after,
.c100.p78 .fill,
.c100.p79 .bar:after,
.c100.p79 .fill,
.c100.p80 .bar:after,
.c100.p80 .fill,
.c100.p81 .bar:after,
.c100.p81 .fill,
.c100.p82 .bar:after,
.c100.p82 .fill,
.c100.p83 .bar:after,
.c100.p83 .fill,
.c100.p84 .bar:after,
.c100.p84 .fill,
.c100.p85 .bar:after,
.c100.p85 .fill,
.c100.p86 .bar:after,
.c100.p86 .fill,
.c100.p87 .bar:after,
.c100.p87 .fill,
.c100.p88 .bar:after,
.c100.p88 .fill,
.c100.p89 .bar:after,
.c100.p89 .fill,
.c100.p90 .bar:after,
.c100.p90 .fill,
.c100.p91 .bar:after,
.c100.p91 .fill,
.c100.p92 .bar:after,
.c100.p92 .fill,
.c100.p93 .bar:after,
.c100.p93 .fill,
.c100.p94 .bar:after,
.c100.p94 .fill,
.c100.p95 .bar:after,
.c100.p95 .fill,
.c100.p96 .bar:after,
.c100.p96 .fill,
.c100.p97 .bar:after,
.c100.p97 .fill,
.c100.p98 .bar:after,
.c100.p98 .fill,
.c100.p99 .bar:after,
.c100.p99 .fill,
.c100.p100 .bar:after,
.c100.p100 .fill {
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}
.c100 {
  position: relative;
  font-size: 140px;
  width: 1em;
  height: 1em;
  border-radius: 50%;
  /*float: left;*/
  margin: auto;
  background-color: #cccccc;
}
.c100 *,
.c100 *:before,
.c100 *:after {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
}
.c100.center {
  float: none;
  margin: 0 auto;
}
.c100.big {
  font-size: 240px;
}
.c100.small {
  font-size: 80px;
}
.c100 > span {
  position: absolute;
  width: 100%;
  z-index: 1;
  left: 0;
  top: 0;
  width: 5em;
  line-height: 5em;
  font-size: 0.2em;
  color: #cccccc;
  display: block;
  text-align: center;
  white-space: nowrap;
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -webkit-transition-timing-function: ease-out;
  -moz-transition-timing-function: ease-out;
  -o-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.c100:after {
  position: absolute;
  top: 0.08em;
  left: 0.08em;
  display: block;
  content: " ";
  border-radius: 50%;
  background-color: #f5f5f5;
  width: 0.84em;
  height: 0.84em;
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -webkit-transition-timing-function: ease-in;
  -moz-transition-timing-function: ease-in;
  -o-transition-timing-function: ease-in;
  transition-timing-function: ease-in;
}
.c100 .slice {
  position: absolute;
  width: 1em;
  height: 1em;
  clip: rect(0em, 1em, 1em, 0.5em);
}
.c100.p1 .bar {
  -webkit-transform: rotate(3.6deg);
  -moz-transform: rotate(3.6deg);
  -ms-transform: rotate(3.6deg);
  -o-transform: rotate(3.6deg);
  transform: rotate(3.6deg);
}
.c100.p2 .bar {
  -webkit-transform: rotate(7.2deg);
  -moz-transform: rotate(7.2deg);
  -ms-transform: rotate(7.2deg);
  -o-transform: rotate(7.2deg);
  transform: rotate(7.2deg);
}
.c100.p3 .bar {
  -webkit-transform: rotate(10.8deg);
  -moz-transform: rotate(10.8deg);
  -ms-transform: rotate(10.8deg);
  -o-transform: rotate(10.8deg);
  transform: rotate(10.8deg);
}
.c100.p4 .bar {
  -webkit-transform: rotate(14.4deg);
  -moz-transform: rotate(14.4deg);
  -ms-transform: rotate(14.4deg);
  -o-transform: rotate(14.4deg);
  transform: rotate(14.4deg);
}
.c100.p5 .bar {
  -webkit-transform: rotate(18deg);
  -moz-transform: rotate(18deg);
  -ms-transform: rotate(18deg);
  -o-transform: rotate(18deg);
  transform: rotate(18deg);
}
.c100.p6 .bar {
  -webkit-transform: rotate(21.6deg);
  -moz-transform: rotate(21.6deg);
  -ms-transform: rotate(21.6deg);
  -o-transform: rotate(21.6deg);
  transform: rotate(21.6deg);
}
.c100.p7 .bar {
  -webkit-transform: rotate(25.2deg);
  -moz-transform: rotate(25.2deg);
  -ms-transform: rotate(25.2deg);
  -o-transform: rotate(25.2deg);
  transform: rotate(25.2deg);
}
.c100.p8 .bar {
  -webkit-transform: rotate(28.8deg);
  -moz-transform: rotate(28.8deg);
  -ms-transform: rotate(28.8deg);
  -o-transform: rotate(28.8deg);
  transform: rotate(28.8deg);
}
.c100.p9 .bar {
  -webkit-transform: rotate(32.4deg);
  -moz-transform: rotate(32.4deg);
  -ms-transform: rotate(32.4deg);
  -o-transform: rotate(32.4deg);
  transform: rotate(32.4deg);
}
.c100.p10 .bar {
  -webkit-transform: rotate(36deg);
  -moz-transform: rotate(36deg);
  -ms-transform: rotate(36deg);
  -o-transform: rotate(36deg);
  transform: rotate(36deg);
}
.c100.p11 .bar {
  -webkit-transform: rotate(39.6deg);
  -moz-transform: rotate(39.6deg);
  -ms-transform: rotate(39.6deg);
  -o-transform: rotate(39.6deg);
  transform: rotate(39.6deg);
}
.c100.p12 .bar {
  -webkit-transform: rotate(43.2deg);
  -moz-transform: rotate(43.2deg);
  -ms-transform: rotate(43.2deg);
  -o-transform: rotate(43.2deg);
  transform: rotate(43.2deg);
}
.c100.p13 .bar {
  -webkit-transform: rotate(46.800000000000004deg);
  -moz-transform: rotate(46.800000000000004deg);
  -ms-transform: rotate(46.800000000000004deg);
  -o-transform: rotate(46.800000000000004deg);
  transform: rotate(46.800000000000004deg);
}
.c100.p14 .bar {
  -webkit-transform: rotate(50.4deg);
  -moz-transform: rotate(50.4deg);
  -ms-transform: rotate(50.4deg);
  -o-transform: rotate(50.4deg);
  transform: rotate(50.4deg);
}
.c100.p15 .bar {
  -webkit-transform: rotate(54deg);
  -moz-transform: rotate(54deg);
  -ms-transform: rotate(54deg);
  -o-transform: rotate(54deg);
  transform: rotate(54deg);
}
.c100.p16 .bar {
  -webkit-transform: rotate(57.6deg);
  -moz-transform: rotate(57.6deg);
  -ms-transform: rotate(57.6deg);
  -o-transform: rotate(57.6deg);
  transform: rotate(57.6deg);
}
.c100.p17 .bar {
  -webkit-transform: rotate(61.2deg);
  -moz-transform: rotate(61.2deg);
  -ms-transform: rotate(61.2deg);
  -o-transform: rotate(61.2deg);
  transform: rotate(61.2deg);
}
.c100.p18 .bar {
  -webkit-transform: rotate(64.8deg);
  -moz-transform: rotate(64.8deg);
  -ms-transform: rotate(64.8deg);
  -o-transform: rotate(64.8deg);
  transform: rotate(64.8deg);
}
.c100.p19 .bar {
  -webkit-transform: rotate(68.4deg);
  -moz-transform: rotate(68.4deg);
  -ms-transform: rotate(68.4deg);
  -o-transform: rotate(68.4deg);
  transform: rotate(68.4deg);
}
.c100.p20 .bar {
  -webkit-transform: rotate(72deg);
  -moz-transform: rotate(72deg);
  -ms-transform: rotate(72deg);
  -o-transform: rotate(72deg);
  transform: rotate(72deg);
}
.c100.p21 .bar {
  -webkit-transform: rotate(75.60000000000001deg);
  -moz-transform: rotate(75.60000000000001deg);
  -ms-transform: rotate(75.60000000000001deg);
  -o-transform: rotate(75.60000000000001deg);
  transform: rotate(75.60000000000001deg);
}
.c100.p22 .bar {
  -webkit-transform: rotate(79.2deg);
  -moz-transform: rotate(79.2deg);
  -ms-transform: rotate(79.2deg);
  -o-transform: rotate(79.2deg);
  transform: rotate(79.2deg);
}
.c100.p23 .bar {
  -webkit-transform: rotate(82.8deg);
  -moz-transform: rotate(82.8deg);
  -ms-transform: rotate(82.8deg);
  -o-transform: rotate(82.8deg);
  transform: rotate(82.8deg);
}
.c100.p24 .bar {
  -webkit-transform: rotate(86.4deg);
  -moz-transform: rotate(86.4deg);
  -ms-transform: rotate(86.4deg);
  -o-transform: rotate(86.4deg);
  transform: rotate(86.4deg);
}
.c100.p25 .bar {
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
.c100.p26 .bar {
  -webkit-transform: rotate(93.60000000000001deg);
  -moz-transform: rotate(93.60000000000001deg);
  -ms-transform: rotate(93.60000000000001deg);
  -o-transform: rotate(93.60000000000001deg);
  transform: rotate(93.60000000000001deg);
}
.c100.p27 .bar {
  -webkit-transform: rotate(97.2deg);
  -moz-transform: rotate(97.2deg);
  -ms-transform: rotate(97.2deg);
  -o-transform: rotate(97.2deg);
  transform: rotate(97.2deg);
}
.c100.p28 .bar {
  -webkit-transform: rotate(100.8deg);
  -moz-transform: rotate(100.8deg);
  -ms-transform: rotate(100.8deg);
  -o-transform: rotate(100.8deg);
  transform: rotate(100.8deg);
}
.c100.p29 .bar {
  -webkit-transform: rotate(104.4deg);
  -moz-transform: rotate(104.4deg);
  -ms-transform: rotate(104.4deg);
  -o-transform: rotate(104.4deg);
  transform: rotate(104.4deg);
}
.c100.p30 .bar {
  -webkit-transform: rotate(108deg);
  -moz-transform: rotate(108deg);
  -ms-transform: rotate(108deg);
  -o-transform: rotate(108deg);
  transform: rotate(108deg);
}
.c100.p31 .bar {
  -webkit-transform: rotate(111.60000000000001deg);
  -moz-transform: rotate(111.60000000000001deg);
  -ms-transform: rotate(111.60000000000001deg);
  -o-transform: rotate(111.60000000000001deg);
  transform: rotate(111.60000000000001deg);
}
.c100.p32 .bar {
  -webkit-transform: rotate(115.2deg);
  -moz-transform: rotate(115.2deg);
  -ms-transform: rotate(115.2deg);
  -o-transform: rotate(115.2deg);
  transform: rotate(115.2deg);
}
.c100.p33 .bar {
  -webkit-transform: rotate(118.8deg);
  -moz-transform: rotate(118.8deg);
  -ms-transform: rotate(118.8deg);
  -o-transform: rotate(118.8deg);
  transform: rotate(118.8deg);
}
.c100.p34 .bar {
  -webkit-transform: rotate(122.4deg);
  -moz-transform: rotate(122.4deg);
  -ms-transform: rotate(122.4deg);
  -o-transform: rotate(122.4deg);
  transform: rotate(122.4deg);
}
.c100.p35 .bar {
  -webkit-transform: rotate(126deg);
  -moz-transform: rotate(126deg);
  -ms-transform: rotate(126deg);
  -o-transform: rotate(126deg);
  transform: rotate(126deg);
}
.c100.p36 .bar {
  -webkit-transform: rotate(129.6deg);
  -moz-transform: rotate(129.6deg);
  -ms-transform: rotate(129.6deg);
  -o-transform: rotate(129.6deg);
  transform: rotate(129.6deg);
}
.c100.p37 .bar {
  -webkit-transform: rotate(133.20000000000002deg);
  -moz-transform: rotate(133.20000000000002deg);
  -ms-transform: rotate(133.20000000000002deg);
  -o-transform: rotate(133.20000000000002deg);
  transform: rotate(133.20000000000002deg);
}
.c100.p38 .bar {
  -webkit-transform: rotate(136.8deg);
  -moz-transform: rotate(136.8deg);
  -ms-transform: rotate(136.8deg);
  -o-transform: rotate(136.8deg);
  transform: rotate(136.8deg);
}
.c100.p39 .bar {
  -webkit-transform: rotate(140.4deg);
  -moz-transform: rotate(140.4deg);
  -ms-transform: rotate(140.4deg);
  -o-transform: rotate(140.4deg);
  transform: rotate(140.4deg);
}
.c100.p40 .bar {
  -webkit-transform: rotate(144deg);
  -moz-transform: rotate(144deg);
  -ms-transform: rotate(144deg);
  -o-transform: rotate(144deg);
  transform: rotate(144deg);
}
.c100.p41 .bar {
  -webkit-transform: rotate(147.6deg);
  -moz-transform: rotate(147.6deg);
  -ms-transform: rotate(147.6deg);
  -o-transform: rotate(147.6deg);
  transform: rotate(147.6deg);
}
.c100.p42 .bar {
  -webkit-transform: rotate(151.20000000000002deg);
  -moz-transform: rotate(151.20000000000002deg);
  -ms-transform: rotate(151.20000000000002deg);
  -o-transform: rotate(151.20000000000002deg);
  transform: rotate(151.20000000000002deg);
}
.c100.p43 .bar {
  -webkit-transform: rotate(154.8deg);
  -moz-transform: rotate(154.8deg);
  -ms-transform: rotate(154.8deg);
  -o-transform: rotate(154.8deg);
  transform: rotate(154.8deg);
}
.c100.p44 .bar {
  -webkit-transform: rotate(158.4deg);
  -moz-transform: rotate(158.4deg);
  -ms-transform: rotate(158.4deg);
  -o-transform: rotate(158.4deg);
  transform: rotate(158.4deg);
}
.c100.p45 .bar {
  -webkit-transform: rotate(162deg);
  -moz-transform: rotate(162deg);
  -ms-transform: rotate(162deg);
  -o-transform: rotate(162deg);
  transform: rotate(162deg);
}
.c100.p46 .bar {
  -webkit-transform: rotate(165.6deg);
  -moz-transform: rotate(165.6deg);
  -ms-transform: rotate(165.6deg);
  -o-transform: rotate(165.6deg);
  transform: rotate(165.6deg);
}
.c100.p47 .bar {
  -webkit-transform: rotate(169.20000000000002deg);
  -moz-transform: rotate(169.20000000000002deg);
  -ms-transform: rotate(169.20000000000002deg);
  -o-transform: rotate(169.20000000000002deg);
  transform: rotate(169.20000000000002deg);
}
.c100.p48 .bar {
  -webkit-transform: rotate(172.8deg);
  -moz-transform: rotate(172.8deg);
  -ms-transform: rotate(172.8deg);
  -o-transform: rotate(172.8deg);
  transform: rotate(172.8deg);
}
.c100.p49 .bar {
  -webkit-transform: rotate(176.4deg);
  -moz-transform: rotate(176.4deg);
  -ms-transform: rotate(176.4deg);
  -o-transform: rotate(176.4deg);
  transform: rotate(176.4deg);
}
.c100.p50 .bar {
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}
.c100.p51 .bar {
  -webkit-transform: rotate(183.6deg);
  -moz-transform: rotate(183.6deg);
  -ms-transform: rotate(183.6deg);
  -o-transform: rotate(183.6deg);
  transform: rotate(183.6deg);
}
.c100.p52 .bar {
  -webkit-transform: rotate(187.20000000000002deg);
  -moz-transform: rotate(187.20000000000002deg);
  -ms-transform: rotate(187.20000000000002deg);
  -o-transform: rotate(187.20000000000002deg);
  transform: rotate(187.20000000000002deg);
}
.c100.p53 .bar {
  -webkit-transform: rotate(190.8deg);
  -moz-transform: rotate(190.8deg);
  -ms-transform: rotate(190.8deg);
  -o-transform: rotate(190.8deg);
  transform: rotate(190.8deg);
}
.c100.p54 .bar {
  -webkit-transform: rotate(194.4deg);
  -moz-transform: rotate(194.4deg);
  -ms-transform: rotate(194.4deg);
  -o-transform: rotate(194.4deg);
  transform: rotate(194.4deg);
}
.c100.p55 .bar {
  -webkit-transform: rotate(198deg);
  -moz-transform: rotate(198deg);
  -ms-transform: rotate(198deg);
  -o-transform: rotate(198deg);
  transform: rotate(198deg);
}
.c100.p56 .bar {
  -webkit-transform: rotate(201.6deg);
  -moz-transform: rotate(201.6deg);
  -ms-transform: rotate(201.6deg);
  -o-transform: rotate(201.6deg);
  transform: rotate(201.6deg);
}
.c100.p57 .bar {
  -webkit-transform: rotate(205.20000000000002deg);
  -moz-transform: rotate(205.20000000000002deg);
  -ms-transform: rotate(205.20000000000002deg);
  -o-transform: rotate(205.20000000000002deg);
  transform: rotate(205.20000000000002deg);
}
.c100.p58 .bar {
  -webkit-transform: rotate(208.8deg);
  -moz-transform: rotate(208.8deg);
  -ms-transform: rotate(208.8deg);
  -o-transform: rotate(208.8deg);
  transform: rotate(208.8deg);
}
.c100.p59 .bar {
  -webkit-transform: rotate(212.4deg);
  -moz-transform: rotate(212.4deg);
  -ms-transform: rotate(212.4deg);
  -o-transform: rotate(212.4deg);
  transform: rotate(212.4deg);
}
.c100.p60 .bar {
  -webkit-transform: rotate(216deg);
  -moz-transform: rotate(216deg);
  -ms-transform: rotate(216deg);
  -o-transform: rotate(216deg);
  transform: rotate(216deg);
}
.c100.p61 .bar {
  -webkit-transform: rotate(219.6deg);
  -moz-transform: rotate(219.6deg);
  -ms-transform: rotate(219.6deg);
  -o-transform: rotate(219.6deg);
  transform: rotate(219.6deg);
}
.c100.p62 .bar {
  -webkit-transform: rotate(223.20000000000002deg);
  -moz-transform: rotate(223.20000000000002deg);
  -ms-transform: rotate(223.20000000000002deg);
  -o-transform: rotate(223.20000000000002deg);
  transform: rotate(223.20000000000002deg);
}
.c100.p63 .bar {
  -webkit-transform: rotate(226.8deg);
  -moz-transform: rotate(226.8deg);
  -ms-transform: rotate(226.8deg);
  -o-transform: rotate(226.8deg);
  transform: rotate(226.8deg);
}
.c100.p64 .bar {
  -webkit-transform: rotate(230.4deg);
  -moz-transform: rotate(230.4deg);
  -ms-transform: rotate(230.4deg);
  -o-transform: rotate(230.4deg);
  transform: rotate(230.4deg);
}
.c100.p65 .bar {
  -webkit-transform: rotate(234deg);
  -moz-transform: rotate(234deg);
  -ms-transform: rotate(234deg);
  -o-transform: rotate(234deg);
  transform: rotate(234deg);
}
.c100.p66 .bar {
  -webkit-transform: rotate(237.6deg);
  -moz-transform: rotate(237.6deg);
  -ms-transform: rotate(237.6deg);
  -o-transform: rotate(237.6deg);
  transform: rotate(237.6deg);
}
.c100.p67 .bar {
  -webkit-transform: rotate(241.20000000000002deg);
  -moz-transform: rotate(241.20000000000002deg);
  -ms-transform: rotate(241.20000000000002deg);
  -o-transform: rotate(241.20000000000002deg);
  transform: rotate(241.20000000000002deg);
}
.c100.p68 .bar {
  -webkit-transform: rotate(244.8deg);
  -moz-transform: rotate(244.8deg);
  -ms-transform: rotate(244.8deg);
  -o-transform: rotate(244.8deg);
  transform: rotate(244.8deg);
}
.c100.p69 .bar {
  -webkit-transform: rotate(248.4deg);
  -moz-transform: rotate(248.4deg);
  -ms-transform: rotate(248.4deg);
  -o-transform: rotate(248.4deg);
  transform: rotate(248.4deg);
}
.c100.p70 .bar {
  -webkit-transform: rotate(252deg);
  -moz-transform: rotate(252deg);
  -ms-transform: rotate(252deg);
  -o-transform: rotate(252deg);
  transform: rotate(252deg);
}
.c100.p71 .bar {
  -webkit-transform: rotate(255.6deg);
  -moz-transform: rotate(255.6deg);
  -ms-transform: rotate(255.6deg);
  -o-transform: rotate(255.6deg);
  transform: rotate(255.6deg);
}
.c100.p72 .bar {
  -webkit-transform: rotate(259.2deg);
  -moz-transform: rotate(259.2deg);
  -ms-transform: rotate(259.2deg);
  -o-transform: rotate(259.2deg);
  transform: rotate(259.2deg);
}
.c100.p73 .bar {
  -webkit-transform: rotate(262.8deg);
  -moz-transform: rotate(262.8deg);
  -ms-transform: rotate(262.8deg);
  -o-transform: rotate(262.8deg);
  transform: rotate(262.8deg);
}
.c100.p74 .bar {
  -webkit-transform: rotate(266.40000000000003deg);
  -moz-transform: rotate(266.40000000000003deg);
  -ms-transform: rotate(266.40000000000003deg);
  -o-transform: rotate(266.40000000000003deg);
  transform: rotate(266.40000000000003deg);
}
.c100.p75 .bar {
  -webkit-transform: rotate(270deg);
  -moz-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  -o-transform: rotate(270deg);
  transform: rotate(270deg);
}
.c100.p76 .bar {
  -webkit-transform: rotate(273.6deg);
  -moz-transform: rotate(273.6deg);
  -ms-transform: rotate(273.6deg);
  -o-transform: rotate(273.6deg);
  transform: rotate(273.6deg);
}
.c100.p77 .bar {
  -webkit-transform: rotate(277.2deg);
  -moz-transform: rotate(277.2deg);
  -ms-transform: rotate(277.2deg);
  -o-transform: rotate(277.2deg);
  transform: rotate(277.2deg);
}
.c100.p78 .bar {
  -webkit-transform: rotate(280.8deg);
  -moz-transform: rotate(280.8deg);
  -ms-transform: rotate(280.8deg);
  -o-transform: rotate(280.8deg);
  transform: rotate(280.8deg);
}
.c100.p79 .bar {
  -webkit-transform: rotate(284.40000000000003deg);
  -moz-transform: rotate(284.40000000000003deg);
  -ms-transform: rotate(284.40000000000003deg);
  -o-transform: rotate(284.40000000000003deg);
  transform: rotate(284.40000000000003deg);
}
.c100.p80 .bar {
  -webkit-transform: rotate(288deg);
  -moz-transform: rotate(288deg);
  -ms-transform: rotate(288deg);
  -o-transform: rotate(288deg);
  transform: rotate(288deg);
}
.c100.p81 .bar {
  -webkit-transform: rotate(291.6deg);
  -moz-transform: rotate(291.6deg);
  -ms-transform: rotate(291.6deg);
  -o-transform: rotate(291.6deg);
  transform: rotate(291.6deg);
}
.c100.p82 .bar {
  -webkit-transform: rotate(295.2deg);
  -moz-transform: rotate(295.2deg);
  -ms-transform: rotate(295.2deg);
  -o-transform: rotate(295.2deg);
  transform: rotate(295.2deg);
}
.c100.p83 .bar {
  -webkit-transform: rotate(298.8deg);
  -moz-transform: rotate(298.8deg);
  -ms-transform: rotate(298.8deg);
  -o-transform: rotate(298.8deg);
  transform: rotate(298.8deg);
}
.c100.p84 .bar {
  -webkit-transform: rotate(302.40000000000003deg);
  -moz-transform: rotate(302.40000000000003deg);
  -ms-transform: rotate(302.40000000000003deg);
  -o-transform: rotate(302.40000000000003deg);
  transform: rotate(302.40000000000003deg);
}
.c100.p85 .bar {
  -webkit-transform: rotate(306deg);
  -moz-transform: rotate(306deg);
  -ms-transform: rotate(306deg);
  -o-transform: rotate(306deg);
  transform: rotate(306deg);
}
.c100.p86 .bar {
  -webkit-transform: rotate(309.6deg);
  -moz-transform: rotate(309.6deg);
  -ms-transform: rotate(309.6deg);
  -o-transform: rotate(309.6deg);
  transform: rotate(309.6deg);
}
.c100.p87 .bar {
  -webkit-transform: rotate(313.2deg);
  -moz-transform: rotate(313.2deg);
  -ms-transform: rotate(313.2deg);
  -o-transform: rotate(313.2deg);
  transform: rotate(313.2deg);
}
.c100.p88 .bar {
  -webkit-transform: rotate(316.8deg);
  -moz-transform: rotate(316.8deg);
  -ms-transform: rotate(316.8deg);
  -o-transform: rotate(316.8deg);
  transform: rotate(316.8deg);
}
.c100.p89 .bar {
  -webkit-transform: rotate(320.40000000000003deg);
  -moz-transform: rotate(320.40000000000003deg);
  -ms-transform: rotate(320.40000000000003deg);
  -o-transform: rotate(320.40000000000003deg);
  transform: rotate(320.40000000000003deg);
}
.c100.p90 .bar {
  -webkit-transform: rotate(324deg);
  -moz-transform: rotate(324deg);
  -ms-transform: rotate(324deg);
  -o-transform: rotate(324deg);
  transform: rotate(324deg);
}
.c100.p91 .bar {
  -webkit-transform: rotate(327.6deg);
  -moz-transform: rotate(327.6deg);
  -ms-transform: rotate(327.6deg);
  -o-transform: rotate(327.6deg);
  transform: rotate(327.6deg);
}
.c100.p92 .bar {
  -webkit-transform: rotate(331.2deg);
  -moz-transform: rotate(331.2deg);
  -ms-transform: rotate(331.2deg);
  -o-transform: rotate(331.2deg);
  transform: rotate(331.2deg);
}
.c100.p93 .bar {
  -webkit-transform: rotate(334.8deg);
  -moz-transform: rotate(334.8deg);
  -ms-transform: rotate(334.8deg);
  -o-transform: rotate(334.8deg);
  transform: rotate(334.8deg);
}
.c100.p94 .bar {
  -webkit-transform: rotate(338.40000000000003deg);
  -moz-transform: rotate(338.40000000000003deg);
  -ms-transform: rotate(338.40000000000003deg);
  -o-transform: rotate(338.40000000000003deg);
  transform: rotate(338.40000000000003deg);
}
.c100.p95 .bar {
  -webkit-transform: rotate(342deg);
  -moz-transform: rotate(342deg);
  -ms-transform: rotate(342deg);
  -o-transform: rotate(342deg);
  transform: rotate(342deg);
}
.c100.p96 .bar {
  -webkit-transform: rotate(345.6deg);
  -moz-transform: rotate(345.6deg);
  -ms-transform: rotate(345.6deg);
  -o-transform: rotate(345.6deg);
  transform: rotate(345.6deg);
}
.c100.p97 .bar {
  -webkit-transform: rotate(349.2deg);
  -moz-transform: rotate(349.2deg);
  -ms-transform: rotate(349.2deg);
  -o-transform: rotate(349.2deg);
  transform: rotate(349.2deg);
}
.c100.p98 .bar {
  -webkit-transform: rotate(352.8deg);
  -moz-transform: rotate(352.8deg);
  -ms-transform: rotate(352.8deg);
  -o-transform: rotate(352.8deg);
  transform: rotate(352.8deg);
}
.c100.p99 .bar {
  -webkit-transform: rotate(356.40000000000003deg);
  -moz-transform: rotate(356.40000000000003deg);
  -ms-transform: rotate(356.40000000000003deg);
  -o-transform: rotate(356.40000000000003deg);
  transform: rotate(356.40000000000003deg);
}
.c100.p100 .bar {
  -webkit-transform: rotate(360deg);
  -moz-transform: rotate(360deg);
  -ms-transform: rotate(360deg);
  -o-transform: rotate(360deg);
  transform: rotate(360deg);
}
.c100:hover {
  cursor: default;
}
.c100:hover > span {
  width: 3.33em;
  line-height: 3.33em;
  font-size: 0.3em;
  color: #307bbb;
}
.c100:hover:after {
  top: 0.04em;
  left: 0.04em;
  width: 0.92em;
  height: 0.92em;
}
.c100.dark {
  background-color: #777777;
}
.c100.dark .bar,
.c100.dark .fill {
  border-color: #c6ff00 !important;
}
.c100.dark > span {
  color: #777777;
}
.c100.dark:after {
  background-color: #666666;
}
.c100.dark:hover > span {
  color: #c6ff00;
}
.c100.green .bar,
.c100.green .fill {
  border-color: #4db53c !important;
}
.c100.green:hover > span {
  color: #4db53c;
}
.c100.green.dark .bar,
.c100.green.dark .fill {
  border-color: #5fd400 !important;
}
.c100.green.dark:hover > span {
  color: #5fd400;
}
.c100.orange .bar,
.c100.orange .fill {
  border-color: #dd9d22 !important;
}
.c100.orange:hover > span {
  color: #dd9d22;
}
.c100.orange.dark .bar,
.c100.orange.dark .fill {
  border-color: #e08833 !important;
}
.c100.orange.dark:hover > span {
  color: #e08833;
}

</style>
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>-->
<!--<script src="https://futurestarr.b-cdn.net/jquery.form.min.js"></script>-->
@endsection
@section('javascript')

<script type="text/javascript">  

   // $(function(){
      // $('#add-product-form').submit(function() {
      //     $("#loader-product").css('display', 'block');
      //     $("#upload-product").hide();
      //     return true;
      // });

      // $('.price').keypress(function(event) {
      //    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
      //      event.preventDefault();
      //      $("#digit-only").text('Only digit and floart value are allowed.')
      //    }
      //  });
    // }); 

</script>
@stop

