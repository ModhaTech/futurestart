@extends('admin.common')

@section('title', 'Notification Send')

@section('content')
  <!-- Content Wrapper. Contains page content -->
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
    <section class="content">	
           
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
		 <p class="dash-t">All User Notification Send</p>
         <div class="row pl-4 pb-4 pr-4">		
    
          <div class="col-lg-12 col-12 pr-4">

          	<form action="{{ route('admin.notification.create') }}" method="POST">
          		@csrf

          		<div class="form-group col-md-6">
          			<label>Title</label>
          			<input type="text" name="notification_title" id="old_password"  class="form-control @error('old_password') is-invalid @enderror">
          			 @if ($errors->has('old_password'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('old_password') }}</strong>
                          </span>
                     @endif
          		</div>


          		<div class="form-group col-md-6">
          			<label>Message</label>
          			<textarea type="text" name="notification_message" id="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror"></textarea>
          		</div>

          		<button type="submit" class="btn btn-primary">Send</button>
          		
          	</form>
         
          </div>
         
        </div>
        <!-- /.row -->
        <!-- Main row -->
		
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection