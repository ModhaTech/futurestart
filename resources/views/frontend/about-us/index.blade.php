@extends('layouts.talent') @section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url({{ asset('assets/images/read-more/welcome-banner.jpg')}});">
  <div class="opacity-medium"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
      
      </div>
    </div>
  </div>
</section>
  <div class="container about-us-container">
  <div class="row">
    <div class="col-sm-4">
      <img class="star-search-banner" src="assets/images/read-more/welcome.jpg"  alt="futurestarr artists"/>
    </div>
    <div class="col-sm-8">
      <div class="col-sm-12">
        <h1>Do you want to be successful? </h1>
        <p class="about-body">
          It is not enough to want success, you must be passionate about it, you must be determined and ready to make sacrifices
          to achieve what you want. Before we look at what successful celebrities have in common, let's take a look at what is
          stopping you from achieving the type of success you want.
        </p>
        <p class="about-body">
          Most people just want to be famous, they don't care how they achieve it thus, they dabble in whatever they dabble in
          whatever they think could bring them fame. Today , they claim they are actor, tomorrow, they claim to be model and singer
          thereafter. If you want to be successful, concentrate on what you want to be know for. Stop chasing everything that glitters,
          all of them are not gold.
        </p>
        <h4>Talent Can Become Successfully Driven with Future Starr</h4>
        <p>At the heart of the Talent Alliance is a standardized test that assesses a person's abilities and matches them with employers. The Talent Alliance started out as a sophisticated job bank in an economic downturn, enabling companies that had laid off highly skilled employees to market them to other employers. It has since expanded its charter and now provides standardized tests that evaluate people's abilities and match them with appropriate jobs.</p>
        <h4>Motivation</h4>
        <p>However, if you have the right talent, you can become successful by joining Future Starr. If you have a passion for cooking or photography, this website can help you to earn money from it. Future Starr is a marketplace for talent. You can upload your best photos and sell them through this website. To become a successful model, you will have to sign up.</p>
        <h4>Compensation</h4>
        <p>A new talent marketplace called Future Starr allows people to make money selling their photos online. This platform is perfect for those who want to showcase their talent without the hassle of contacting Modeling Agencies. Many people aren't aware of the many opportunities that they can have with this platform. It is a great opportunity for those looking to get their talent out into the world. Talent can become successfully driven with this service.</p>
        <h4>Retention</h4>
        <p>According to Jobvite, 30% of candidates leave their job within the first three months of employment. Many new hires leave because their expectations did not meet reality, or they had an unpleasant incident early on. A key factor in retaining top talent is nurturing candidates. Nurturing allows a candidate to learn more about the company before accepting an offer. This nurture process allows the candidate to become familiar with company culture, values, and job types.
        Many talent leaders hesitate to put their retention efforts at the forefront. However, investing in internal mobility and expectation management will help companies reduce gaps in staff experience and increase employee satisfaction. By implementing a talent retention program early, companies can reduce the cost of turnover while still retaining the best employees. If they find that employee engagement levels are dipping, they can adapt their retention program and increase employee satisfaction. This way, they can avoid costly mistakes that will cost them more in the long run.
        </p>
        <!-- <a class="generic-button" routerLink="/blog/detailed">Read More</a> -->
        <div class="about-action-button" >
           @if($authCheck ==true) 
               <a class="about-us-sm read-more-btn-onslider about-us-color" href="{{ route('buyer.dashboard')}}">BUY TALENT</a>
                <button class="about-us-sm read-more-btn-onslider about-us-color" (click)="sellTalent()">SELL YOUR TALENT</button>
           @else
              <button class="about-us-sm read-more-btn-onslider" data-toggle="modal" data-target="#register_my_model">BUY TALENT</button>
                <button class="about-us-sm read-more-btn-onslider" data-toggle="modal" data-target="#register_my_model">SELL YOUR TALENT</button>
           @endif
            <br/>
        </div>

      </div>

    </div>
  </div>
</div>
<div class="container">
   <!-- Modal -->
  <div id="register_my_model" class="modal  modal-m pop" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header mob-cls">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5 text-center login-back">

                            <h4 class="mo-sign-awe">
                    Awe, looks like you have not 
                </h4>
                            <h4 class="mo-sign-fr">signed up for Future Starr.</h4>
                            <p class="mo-now"><b>No worries, click the Register</b></p>
                            <p class="mo-now-fr"><b>button and sign up now for FREE!</b></p>

                            <!-- <button class="btn btn-danger btn-sm login-button" style="margin: 5% 0 0 21%;">REGISTER</button> -->
                            <a href="/register" class="btn btn-danger reg-mod"  (click)="model_toggle()">Register</a>
                        </div>
                        <div class="col-sm-7 text-center login-back-img">
                            <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
                           
                            <p class="closer-data"></p>
                            <h3 class="closer-data"></h3>
                            <p class="closer-data"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container">
   <!-- Modal -->
  <div id="register_my_model1" class="modal  modal-m pop" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header mob-cls">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5 text-center login-back">

                            <h4 class="mo-sign-awe">Awe, looks like you have not</h4>
                            <h4 class="mo-sign-fr">signed up for Future Starr.</h4>
                            <p class="mo-now"><b>No worries, click the Register</b></p>
                            <p class="mo-now-fr"><b>button and sign up now for FREE!</b></p>

                            <!-- <button class="btn btn-danger btn-sm login-button" style="margin: 5% 0 0 21%;">REGISTER</button> -->
                            <a href="/register" class="btn btn-danger reg-mod"  (click)="model_toggle()">Register</a>
                        </div>
                        <div class="col-sm-7 text-center login-back-img">
                            <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
                           
                            <p class="closer-data"></p>
                            <h3 class="closer-data"></h3>
                            <p class="closer-data"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection