@foreach($messages as $mess)
	@if($mess->received_by == Auth::id())
		<div class="direct-chat-msg">
			<div class="direct-chat-info clearfix">
				<span class="direct-chat-name pull-left">{{ $receiver->username }}</span>
				<span class="direct-chat-timestamp pull-right">{{ \Carbon\Carbon::parse($mess->created_at)->format('m/d/Y g:i A') }}</span>
			</div>
			<?php $role = $receiver->role_id == 3 ? 'buyer' : 'seller'; ?>
			<a style="display: initial; padding: 0; border: none;" target="_blank" href="{{ url($role.'/'.$receiver->public_profile) }}" data-turbolinks="false">			
				<img class="direct-chat-img" src="{{ $receiver->profile_pic ? asset($receiver->profile_pic) : asset('assets/images/buyer/b-acount.png') }}" onerror="this.onerror=null;this.src='/assets/images/buyer/b-acount.png';">
			</a>
			<div class="direct-chat-text">
				<span style="display: block;">{{ $mess->message }}</span>
				@if($mess->message_media)
					@php
						$type = explode('.', $mess->message_media);
					@endphp
					@if(isset($type[1]))
						<?php $type = $type[1]; ?>
						@if($type == 'jpg' || $type == 'jpeg' || $type == 'png' || $type == 'JPG' || $type == 'JPEG' || $type == 'PNG')
							<img src="{{ asset($mess->message_media) }}" style="width: 200px;" onerror="this.onerror=null;this.src='/assets/images/buyer/b-acount.png';"/>
						@else
							<video width="200" height="160" controls style="width: 200px; height: 160px; min-height: 160px;">
							  	<source src="{{ asset($mess->message_media) }}" type="video/mp4">
							</video>
						@endif
					@endif

				@endif
			</div>
		</div>			
	@else
		<div class="direct-chat-msg right">
			<div class="direct-chat-info clearfix">
				<span class="direct-chat-name pull-right"></span>
				<span class="direct-chat-timestamp pull-left">{{ \Carbon\Carbon::parse($mess->created_at)->format('m/d/Y g:i A') }}</span>
			</div>
			<?php $role = Auth::user()->role_id == 3 ? 'buyer' : 'seller'; ?>
			<a style="display: initial; padding: 0; border: none;" target="_blank" href="{{ url($role.'/'.Auth::user()->public_profile) }}" data-turbolinks="false">
				<img class="direct-chat-img" src="{{ $receiver->profile_pic ? asset(Auth::user()->profile_pic) : asset('/assets/images/buyer/b-acount.png') }}" onerror="this.onerror=null;this.src='/assets/images/buyer/b-acount.png';">
			</a>
			<div class="direct-chat-text">
				<span style="display: block;">{{ $mess->message }}</span>
				@if($mess->message_media)
					@php
						$type = explode('.', $mess->message_media)[1];
					@endphp

					@if($type == 'jpg' || $type == 'jpeg' || $type == 'png' || $type == 'JPG' || $type == 'JPEG' || $type == 'PNG')
						<img src="{{ asset($mess->message_media) }}" style="width: 200px;" onerror="this.onerror=null;this.src='/assets/images/buyer/b-acount.png';"/>
					@else
						<video width="200" height="160" controls style="width: 200px; height: 160px; min-height: 160px;">
						  	<source src="{{ asset($mess->message_media) }}" type="video/mp4">
						</video>
					@endif

				@endif
			</div>
		</div>	
	@endif
@endforeach