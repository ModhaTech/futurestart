@extends('admin.common')

@section('title', 'Create Blog')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header ch">
    <div class="container-fluid">
      <div class="row mb-2">


      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content post_new_blog">
    <div class="card">
      <div class="card-header mb-3" style="background-color: #DD0334">
        <h3 class="card-title" style="font-size: 30px !important; color: #FFFF">Create Blog Post</h3>
      </div>
      <!-- /.card-header -->
      
 
      <div class="card">
      <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
          <!-- left column -->
          <div class="col-sm-3 col-md-6">
            <!-- general form elements -->

            <div class="card-header">
              <!-- form start -->
              {{-- <h3 class="card-title">  Filter &nbsp &nbsp </h3> 
              <select class="form-control select2">
                <option selected="selected">Select All</option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
              </select>    --}}

            </div>
            
          </div>
          <!--/.col (left) -->
         
          <div class="col-sm-3 col-md-3" id="loader" style="display: none;">
            <!-- general form elements disabled -->

            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </button>
       
             <!-- /.card-body -->
           </div>
           <!-- /.card -->

           <!-- /.card -->
          </div>

          <div class="col-sm-3 col-md-3">
            <!-- general form elements disabled -->

            <!-- /.card-header -->
            <div class="card-body">
             <input type="submit" class="btn btn-primary sp hide-off" value="SAVE POST" name="draft">
       
             <!-- /.card-body -->
           </div>
           <!-- /.card -->

           <!-- /.card -->
         </div>

         <!-- right column -->
         <div class="col-sm-6 col-md-3">
          <!-- general form elements disabled -->

          <!-- /.card-header -->
          <div class="card-body">
           <input type="submit" class="btn btn-primary pp hide-off" name="publish" value="PUBLISH POST">  
      
           <!-- /.card-body -->
         </div>
         <!-- /.card -->

         <!-- /.card -->
       </div>

      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-9">
            <!-- general form elements -->

            <!-- form start -->
            <form role="form" class="mgt">
              <div class="card-body">
                <div class="form-group">  
                <!-- <div class="card-details mb-2">-->
                <!--   <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter Title here" name="title" value="{{ old('title') }}" > -->
                <!--        @error('title')-->
                <!--            <span class="invalid-feedback" role="alert">-->
                <!--                <strong>{{ $message }}</strong>-->
                <!--            </span>-->
                <!--        @enderror -->
                <!--</div>  -->

<div class="card-details mb-2">
                      <label for="seo_title"> SEO Title</label>
                   <input type="text" class="form-control @error('meta-tags') is-invalid @enderror"  placeholder="Enter Meta tag here" name="meta-tags" value="{{ old('meta-tags') }}"> 
                          @error('meta-tags')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                         @enderror 
                </div> 

                 <div class="card-details mb-2">
                       <label for="seo_title"> SEO Alt_teg</label>
                   <input type="text" class="form-control @error('alt-tags') is-invalid @enderror"  placeholder="Enter Alt tag here" name="alt-tags" value="{{ old('alt-tags') }}"> 
                          @error('alt-tags')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                         @enderror 
                </div>

                <div class="card-details mb-2">
                      <label for="seo_title"> SEO keywords</label>
                   <input type="text" class="form-control @error('meta-keywords') is-invalid @enderror"  placeholder="Enter Keyword here" name="meta-keywords" value="{{ old('meta-keywords') }}"> 
                       @error('meta-keywords')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                         @enderror
                </div> 

                <div class="card-details mb-2">
                      <label for="seo_title"> SEO description</label>
                  <textarea class="form-control @error('meta-description') is-invalid @enderror" rows="3" placeholder="Enter Description here" name="meta-description">{{ old('meta-description') }}</textarea>
                        @error('meta-description')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                         @enderror

                </div>  





                <div class="card-details mb-2">
<label for="seo_title"> feature Image</label>
                  <input id="fileid" type="file" name="feature_image" class="form-control  @error('feature_image') is-invalid @enderror" hidden />

                  <button type="button" class="btn btn-primary image" id="buttonid">
                   <i class="fa fa-picture-o" aria-hidden="true"></i>Feature image</button>

                    @error('feature_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                   @enderror

                   <img id="feature-image-preview" src="#" alt="author preview image" style="display: none; width: 300px; height: 250px;">

                </div>


                <div class="card-details mb-2">     

                  <div class="card card-outline card-info">
                    <div class="card-header">
                      <h3 class="card-title">
                        Text item
                        <small> Data</small>
                      </h3>
                      <!-- tools box -->
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                      </div>
                      <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pad">
                      <div class="mb-3">
                      <textarea name="content" id="textarea-mce" class="tiny-mce @error('content') is-invalid @enderror" placeholder="" rows="5" cols="5" >{{ old('content') }}</textarea>
                              @error('content')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                      <p class="text-sm mb-0">
                      </a>
                    </p>
                  </div>
                </div>
                
                <div class="card-details mb-2">
                  <label>Author Image:</label>
                  <input type="file" name="author_image"  id="upload_image" class="form-control  @error('author_image') is-invalid @enderror" >
                    @error('author_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                   @enderror

                  @error('encode_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                   @enderror

                    <div class="col-md-4 show-cropper" style="display:none;border-right:1px solid #ddd;">
                            <div id="image-preview"></div>
                            <button type="button" class="btn btn-success crop_image">Crop Image</button>
                    </div>
                     
                     <input type="hidden" name="encode_image" id="encode_image" val="">
                    <!-- <img id="blah" src="#" alt="author preview image"  style="width: 200px; height: 200px; border-radius: 50%; display: none;"/> -->
                  </div>
                   

   <!--                            
              <div class="row">
              <div class="col-md-4" style="border-right:1px solid #ddd;">
                <div id="image-preview"></div>
              </div>
              <div class="col-md-4" style="padding:75px; border-right:1px solid #ddd;">
                <p><label>Select Image</label></p>
                <input type="file" name="upload_image" id="upload_image" />
                <br />
                <br />
                <button class="btn btn-success crop_image">Crop & Upload Image</button>
              </div>
             
            </div>
 -->
            




                  <!--<div class="card-details mb-2">-->
                  <!-- <input type="text" class="form-control @error('author_first_name') is-invalid @enderror"  placeholder="Enter Author first name here" name="author_first_name" value="{{ old('author_first_name') }}" > -->
                  <!--   @error('author_first_name')-->
                  <!--          <span class="invalid-feedback" role="alert">-->
                  <!--              <strong>{{ $message }}</strong>-->
                  <!--          </span>-->
                  <!--     @enderror-->
                  <!--</div> -->

                  <div class="card-details mb-2">
                       <label for="seo_title"> Author Name</label>
                    @if(count($allAuthors) > 0)
                        <input type="text" list="authors" class="form-control @error('author_last_name') is-invalid @enderror" placeholder="Choose an author" name="author_last_name" value="{{ old('author_last_name') }}">
                        <datalist id="authors">
                            @foreach($allAuthors as $author)
                                <option value="{{ $author->author_name }}">
                            @endforeach
                        </datalist>
                    @endif
                       @error('author_last_name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                         @enderror
                  </div> 
                  

               
                

            
              </div>


            </div>

          </div>
          <!-- /.card-body -->


       

        <!-- /.card -->


      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-3">
        <!-- general form elements disabled -->

        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" class="mgt">
            <div class="row">
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <label>Categories</label><br/>
                    @if(count($talent_categories) > 0 )
                          @foreach($talent_categories  as $value )
                             <input id="checkbox-listing-{{ $value->id }}" type="checkbox" value="{{ $value->id }}" class="@error('category') is-invalid @enderror" name="category" > {{ $value->name }}<br/>
                          @endforeach
                        @endif

<!--                         <input type="checkbox"> Other <br/>
                        @error('category')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                         @enderror -->

                  </form>

                  <label>Tag</label><br/>
                  <span id="selected-tags" style="font-style: italic; font-weight: 500; color: #ff503f"></span>
                  <div class="form-group">   
                    <input type="text" class="form-control" id="search-tag" placeholder="" disabled required> 
                    <ul id="search-results">
                    </ul>
                    <input type="hidden" name="tags" value="" id="b-tags">
                  </div>

                </div>
              
              </div>
            </div>

          </div>
      </form>
</div>
</div>
</section>
</div>
  <script src="https://cdn.tiny.cloud/1/uhb9l6mh1feb4513ssvi59o8c2d03yj8s4ze1sflmzg1hrce/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
    tinymce.init({
      selector: 'textarea.tiny-mce',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>


@endsection