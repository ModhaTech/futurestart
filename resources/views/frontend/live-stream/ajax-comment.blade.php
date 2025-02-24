    @foreach($view_comment as $view_comm)
    <div class="container">
    	<div class="row">
    		<div class="col-lg-5" style="padding:5px;">
    			<p style="display: flex;"><img style="border-radius: 50%; height: 45px; width: 45px;" src="{{asset($view_comm->profile_pic)}}"><span style="font-weight: 600;padding: 10px;font-size: 12px;">{{$view_comm->username}}</span></p>
    		</div>
    		<div class="col-lg-7" style="padding: 5px;">
    			<p style="text-align: center;">{{$view_comm->comment}}</p>
    		</div>
    	</div>
    </div>
	
	@endforeach

