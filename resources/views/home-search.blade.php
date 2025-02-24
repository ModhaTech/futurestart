<li class="search-results-heading">Seller
  <span class="search-result-counts">({{ $sellersCount }})</span>
</li>

@if(count($sellers))
  @foreach($sellers as $user)
  
	
  
    <li class="search-results-items seller-search col-sm-12" > 
	<div class="">
		<a href="{{ route('seller-public-profile', $user['public_profile'])  }}" target="_blank" style="line-height: 50px!important; font-size: 20px!important; padding:0px;">
			         {{ $user->first_name." ".$user->last_name  }}              
          </a> 
	</div>
          
	<div class="">
		@if($user->profile_pic && file_exists($user->profile_pic))
               <span class="search-result-counts"><img style="width:50px!important; height:50px!important" src="{{ asset($user->profile_pic) }}"  onerror="this.onerror=null;this.src='/assets/images/buyer/b-acount.png';"></span>
			   @else
				<span class="search-result-counts"><img style="width:50px!important;height:50px!important" src="{{ asset('assets/images/buyer/b-acount.png') }}"></span>
				@endif
	</div>
      </li>
	  
	  
	
  @endforeach
@endif

<li class="search-results-heading">Buyer
  <span class="search-result-counts">({{ $buyersCount }})</span>
</li>

@if(count($buyers))
  @foreach($buyers as $user)
  
  
  
    <li class="search-results-items seller-search col-sm-12" > 
  <div class="">
    <a href="{{ route('buyer-public-profile', $user['public_profile'])  }}" target="_blank" style="line-height: 50px!important; font-size: 20px!important; padding:0px;">
               {{ $user->first_name." ".$user->last_name  }}              
          </a> 
  </div>
          
  <div class="">
    @if($user->profile_pic && file_exists($user->profile_pic))
               <span class="search-result-counts"><img style="width:50px!important; height:50px!important" src="{{ asset($user->profile_pic) }}"  onerror="this.onerror=null;this.src='/assets/images/buyer/b-acount.png';"></span>
         @else
        <span class="search-result-counts"><img style="width:50px!important; height:50px!important" src="{{ asset('assets/images/buyer/b-acount.png') }}"></span>
        @endif
  </div>
      </li>
    
    
  
  @endforeach
@endif

	
<li class="search-results-heading">Talents 
  <span class="search-result-counts">({{ $talentCount }})</span>
</li>
@if(count($talents) > 0) 
    @foreach($talents as $talent) 
    
        <li class="search-results-items" > 
          <a href="{{ route('talent.productInfo',$talent->slug) }}" target="_blank" style="line-height: 50px!important; font-size: 20px!important; padding:0px;">
            {{ $talent->title }} 
          </a> 
        </li>

    @endforeach
    @else
       <li class="search-results-error">No results found.</li>
@endif

<li class="search-results-heading Categories">Categories 
   <span class="search-result-counts">({{ $categoriescount }})</span>
</li>

@if(count($categories) > 0) 
    @foreach($categories as $category)
       
          
         <li class="search-results-items">
            <a target="_blank" href="{{ route('talent.show',$category->slug) }}" style="line-height: 50px!important; font-size: 20px!important; padding:0px;">{{ $category->name }} </a>
         </li> <br>
          
    @endforeach
    @else
        <li class="search-results-error">No results found.</li>
@endif