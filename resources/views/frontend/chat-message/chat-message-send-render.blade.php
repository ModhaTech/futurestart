<div class="direct-chat-msg right">
	<div class="direct-chat-info clearfix">
		<span class="direct-chat-name pull-right">&nbsp;</span>
		<span class="direct-chat-timestamp pull-left">{{ \Carbon\Carbon::parse($mess->created_at)->format('m/d/Y g:i A') }}</span>
	</div>
	<img class="direct-chat-img" src="{{ $mess->profile_pic ? asset($mess->profile_pic) : asset('/assets/images/buyer/b-acount.png') }}" onerror="this.onerror=null;this.src='/assets/images/buyer/b-acount.png';">
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