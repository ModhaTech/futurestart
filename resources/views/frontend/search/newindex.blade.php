@extends('layouts.talent')

@section('content')
<!-- Importing Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Play:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rowdies&display=swap" rel="stylesheet">

<!-- Inline CSS for styling -->
<style>

.star-search nav.navbar.navbar-inverse.fixed-top {
    background-color: rgba(0, 0, 0, 0.9) !important; 
}

/* Ensure the search results start below the input */

.search-container {
    position: relative; /* Ensure container holds absolute children */
    width: 100%; /* Set the container width */
}

.search-results {
    position: absolute;
    top: 100%; /* Makes the list appear right below the search bar */
 width:100%
    background-color: #fff;
    z-index: 1000;
    border: 1px solid #ccc; 
    max-height: 300px;
    overflow-y: auto; 
    overflow-x: hidden;
    list-style-type: none; 
    padding: 0;
    margin: 0;
       width: calc(100% - 10px) !important;
    /* scrollbar-width: thin;  */
}

/* Style individual search results */
.search-results li {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #ddd;
}

.search-results li:hover {
    background-color: #f0f0f0;
}

/* Hide scrollbar until needed (for Chrome, Edge, Safari) */
.search-results::-webkit-scrollbar {
    width: 0px;
    background: transparent; 
}

/* Show scrollbar when hovering over the list */
.search-results:hover::-webkit-scrollbar {
    width: 5px;
}

.search-results::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 5px;
}


 #search::placeholder {
    color: #000; /* Set the color to dark (black) */
    font-weight: bold; /* Set the font weight to bold */
    opacity: 1;  /* Ensure the color is fully opaque */
}

@media (max-width: 768px) {
    .footer .col-sm-3 {
        width: 25%; /* 4 columns (25% width each) on mobile */
        flex: 0 0 25%;
        max-width: 25%;
    }

    .footer .row {
        display: flex;
        flex-wrap: wrap;
    }
}


.s1 {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #000; /* Set background color to black */
}

.custom-card {
    background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
    padding: 35px;
    border-radius: 10px;
    text-align: center; /* Center align content */
    max-width: 100%; /* Responsive width */
    margin: 0 auto; /* Center the card horizontally */
}

.card-body1 {
    color: white;
}

.img-fluid {
    max-width: 100%;
    height: auto;
}

.search-container {
    margin-top: 20px;
    position: relative;
    display: flex;
    justify-content: center;
        margin-bottom: 20px;
    
}

.search-container input {
    /* width: 80%;
    padding: 10px 40px 10px 10px; 
    border-radius: 25px;
    border: none;
    box-shadow: none; */


    width: 100%;
    padding: 6px 20px 5px 10px;
    border-radius: 25px;
    border: none;
    box-shadow: none;
}

.search-container i {
    position: absolute;
    right: 0%;
    top: 50%;
    transform: translateY(-50%);
    color: #000;
    background-color: yellow; /* Set background color to yellow */
    padding: 10px;
    border-radius: 0 20px 17px 0; /* Rounded corners on the right side */
}

.card-text {
    margin-top: 20px;
    font-size: 20px !important;
    line-height: 23px !important;
    word-break: break-word; /* Allows words to break in half */
    hyphens: auto; /* Adds hyphenation to broken words */
}



/* Background image for the section */
 .hpfs01 {
            width: 100%;
            height: 100vh;
            background: url('{{ asset('assets/images/star-search/bg.jpg') }}');
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }




   .card {
            margin-bottom: 20px;
            border: 2px solid yellow; /* Yellow border */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
            height: 300px; /* Fixed height for the card */
            display: flex;
            flex-direction: column;
            border-radius : 0px !important;
        }

        .card-img-top {
            height: 50%; /* Fixed height for images (50% of the card height) */
            object-fit: cover; /* Ensure image covers the space */
        }

        .card-body {
            background-color: #151829; /* Dark blue background for the card body */
            color: white; /* White text color */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
            align-items: center; /* Center content horizontally */
            text-align: center; /* Center content horizontally */
            height: 50%; /* Fixed height for the card body (50% of the card height) */
            padding: 15px; /* Padding inside the card body */
        }

        .card-title {
            margin-top: 10px; /* Space between the top of the card body and the title */
          
            color: white; /* White text color */
        }

        .btn-view-profile {
            background-color: white; /* White background for the button */
            color: #151829; /* Dark text color to match card body */
            border-radius: 20px; /* Rounded corners */
            border: none; /* Remove border */
            padding: 2px 10px; /* Smaller padding for a smaller button */
            font-size: 14px; /* Smaller font size for the button */
          text-transform: lowercase;

            font-weight: bold; /* Bold text */
        }

        .btn-view-profile:hover {
            background-color: #f0f0f0; /* Light grey background on hover */
            color: #151829; /* Dark text color on hover */
            text-decoration: none; /* Remove underline on hover */
        }
 
@media (max-width: 768px) {
    
    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .col-md-2 {
        flex: 0 0 100%;
        max-width: 60%;
        padding-left: 0;
        padding-right: 0;
        margin-bottom: 20px;
    }

   .card {
    margin-left: 10px;
    margin-right: 10px;
    border-radius: 5px !important; /* Set the border-radius */
    border: 1px solid rgba(0, 0, 0, 0.5); /* Black border with reduced opacity */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: add a subtle shadow to cards */
    overflow: hidden; /* Ensure rounded corners work properly */
}

   

    .btn-view-profile {
        margin-top: 10px;
    }
}

i.fa.fa-search {
    font-size: 17px !important;
    color: #4a3629;
    }

</style>

<!-- Main Content -->
<section class="s1 p-0 parallax mobile-height wow fadeIn hpfs01" data-stellar-background-ratio="0.5">
    <div class="custom-card">
        <div class="card-body1">
            <img src="{{ asset('assets/images/star-search/StarR_TEXT.svg') }}" alt="FutureStarr" class="card-title img-fluid"><br>
            <img src="{{ asset('assets/images/star-search/SEARCH_text.svg') }}" alt="FutureStarr" class="card-title img-fluid">
            <div class="search-container">
                <input class="mb-0 bg-search-theme-light text-dark" name="name" id="search" placeholder="Search" type="text" autocomplete="off">
                <i class="fa fa-search" aria-hidden="true"></i>
                 <ul class="search-results list-unstyled"></ul>
            </div>
          <h4 class="text-white mt-3" style="text-transform: uppercase;">
    The ultimate Atlanta Talent Marketplace 
</h4>

        </div>
    </div>
</section>


  <section class="container-fluid" style="padding: 33px 0 !important" >
    <div class="row justify-content-center ">
        <div class="col-md-2">
            <div class="card">
                <img src="assets/images/Layer 8.png" alt="Actors" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title" style="margin-bottom: 10px !important;">Actors</h5>
                    <a href="#" class="btn btn-view-profile">View Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="assets/images/Layer 3.png" alt="Musicians" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title" style="margin-bottom: 10px !important;">Musicians</h5>
                    <a href="#" class="btn btn-view-profile">View Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="assets/images/model.jpeg" alt="Models" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title" style="margin-bottom: 10px !important;">Models</h5>
                    <a href="#" class="btn btn-view-profile">View Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="assets/images/Layer 5.png" alt="Authors" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title" style="margin-bottom: 10px !important;">Authors</h5>
                    <a href="#" class="btn btn-view-profile">View Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="assets/images/Layer 7.png" alt="Teachers" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title" style="margin-bottom: 10px !important;">Teachers</h5>
                    <a href="#" class="btn btn-view-profile">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</section> 


<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;">
    <i class="ti-arrow-up"></i>
</a>

<!-- Buy Your Talent Modal -->
<div class="modal-ask-to-login fade" id="askToJoinAsBuyer" role="dialog">
    <div class="modal-dialog">
        <form>
            <div class="ask-to-login">
                <div class="modal-body">
                    <h3 class="ask-register">To use this feature please register as Buyer or Seller. <br /> <small>By clicking Register, you will be logged out from your current account.</small></h3>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal">REGISTER</button>
                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Ask to Login Modal -->
<div class="modal-ask-to-login fade" id="askToLogin" role="dialog">
    <div class="modal-dialog">
        <form>
            <div class="ask-to-login">
                <div class="modal-body">
                    <div class="form-group text-spinner">
                        <h3 class="deleteConfirmation">Please login to use this feature!</h3>
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    var timeout;
    $(window).scroll(function() {
        if (typeof timeout === "number") {
            window.clearTimeout(timeout);
            delete timeout;
        }
        timeout = window.setTimeout(loadMoreData, 100);
    });

    function loadMoreData() {
        if ($(window).scrollTop() >= ($(document).height() - $(window).height() - 200)) {
            var last_id = $(".post-id:last").attr("id");
            var div_even_odd = $(".post-id:last").data('even-odd');
            
            $.ajax({
                url: "{!! route('search.index') !!}/" + last_id,
                type: "GET",
                data: { event: div_even_odd },
                beforeSend: function() {
                    $('.ajax-loading').show();
                },
                success: function(response) {
                    if (response.state === 1) {
                        $(".starr-search-area").append(response.messages);
                    }
                },
                error: function(data) {
                    console.log('error', data);
                }
            });
        }
    }
</script>

 <!--<script>
    var navbar = document.getElementById("navbar");
    if (window.location.href === "https://www.futurestarr.com/starr") {
        if (navbar) {
            navbar.style.display = "none";
        }
    }
</script> -->
@endsection
