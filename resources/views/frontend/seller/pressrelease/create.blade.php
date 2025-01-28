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
                       <h1 class="seller-add-product-h1">Add Post</h1>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('seller.my-product')}}" class="pull-right back-btn ap-back-btn" title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
                  </div>
               </div>
               <div class="well panel panel-danger panel-m">
                  <div class="panel-body">
                     <form method="POST" action="{{route('seller.press-realease-store')}}" enctype="multipart/form-data">
                        @csrf                    
                       
                        <div class="form-group">
                           <label for="title">Title</label>
                           <input type="text" class="form-control" name="title" id="title" placeholder="Title">

                          {{--  {!! Form::label('title','Title') !!}
                           {!! Form::text('title', old('title') , ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),'placeholder'=>'Title' ]) !!}
                           {!! $errors->first('title', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}

                          @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                          @endif
                        </div>
                       

                        <div class="form-group p-b-upload">
                        
                           <label>Sample Post section - <span class="text-danger"> Upload Audio, Jpeg/png images or Video&nbsp;(Note: Image should be water marked)</span></label>
                           <div class="file-upload">
                              <div class="file-select">
                                 <div class="file-select-button" id="fileName1">Browse</div>
                                 <div class="file-select-name" id="selected-video-file">No file selected </div>
                                 <input type="file" name="video" id="video">
                                {{--  {!! Form::file('video', ['id' => 'video']) !!} --}}
                              </div>
                           </div>
                          @if ($errors->has('video'))
                            <span class="text-danger">{{ $errors->first('video') }}</span>
                          @endif
                        </div>
                       
                        
                        <div class="form-group">
                          <label for="description">Post Information of Seller</label>
                          <textarea class="form-control" name="description" id="description" rows="4" cols="50" placeholder="Post Information of Seller"></textarea>
                           {{-- {!! Form::label('description','Post Information of Seller') !!}
                           {!! Form::textarea('description', old('description') , ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),'placeholder'=>'Post Information of Seller','rows'=>'4' ]) !!}
                           {!! $errors->first('description', '<span class="alert alert-danger" role="alert">:message</span>') !!} --}}
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        </div>

                        <!--<br>-->
                      
                        <br>
                       

                          <button type="submit" class="btn hide-off" style="background-color: green; color: #fff; font-size: 14px; padding: 0 25px;height: 40px; line-height: 40px;">Save</button>
                        
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
  
</section>


@endsection