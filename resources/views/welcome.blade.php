@extends('layouts.home')
@section('title', 'AAT')
@section('content')
<div class="section section-header">
    <div class="parallax pattern-image">
	    <video poster="{{ url('images/video-poster.jpg') }}" id="bgvid" playsinline autoplay muted loop>
	    <!--            <source src="/aat/public/assets/aat_cuba_2017.mov" type="video/mp4">-->
	    <source src="{{ url('videos/aat_cuba_2017.mov') }}" type="video/mp4">
	    </video>

    	<!-- <img src="/assets/img/header6.jpg"/> -->
	    <div class="container">
		    <div class="content">
		        <h1>AFRICAN AMERICAN TRAVELERS</h1>
		        <!--<div class="separator-container">
		            <div class="separator line-separator">âˆŽ</div>
		        </div>-->
		        <h5>The Gold Standard of Group Travel</h5>
		        <p> <a href="#"><i class="fa fa-play-circle" aria-hidden="true"></i> watch our reel</a></p>
		    </div>
	    </div>
    </div>
	<a href="javascript:void(0);" data-scroll="true" data-id="#about" class="scroll-arrow hidden-xs hidden-sm">
	<img src="{{ url('images/scroll-icon.png') }}" alt="scroll"> </a>
</div>
<!-- about -->
<div class="section section-we-are-1" id="about">
    <div class="text-area about-text">
	    <div class="container">
		    <div class="row">
		        <p>An affordable and unique international travel experience catered to US, all the while, creating an environment that is conducive to building lifelong bonds and friendships amongst our members. </p>
		        <p>Sed id porta lectus, sed placerat urna. Vestibulum vitae porttitor magna. Vivamus justo lorem, elementum in tellus a, mollis eleifend ex. Donec ipsum turpis, rutrum nec elementum vel, luctus in enim. Aliquam ac neque pretium, sollicitudin mauris id, euismod nisi. Sed euismod varius urna, et placerat nisl placerat eget. Vivamus semper, risus eget porta rhoncus, nisl orci mollis ipsumin accumsan libero nunc blandit justo. Duis eu turpis nec urna finibus gravida.</p>
		    </div>
	    </div>
    </div>
</div>
<!-- trips -->
<div class="section section-we-are-2">
    <div class="text-area">
	    <div class="container">
		    <div class="row">
		        <div class="title add-animation" id="animationTest">
		            <h2>UPCOMING TRIPS</h2>
		        </div>
		    </div>
	    </div>
    </div>
    <div class="container">
	    <div class="row no-gutter">
            @foreach($trips as $trip)
            <div class="gallery_product view view-tenth col-lg-4 col-md-4 col-sm-4 col-xs-6 filter trip">
		        <img src="{{ url('trip_banner/140b4f357977d4bc54ec15721cf0afe6.jpg') }}" alt="trip-01" class="img-responsive" style="min-height: 289px;min-width: 387px;">
		        <div class="text-overlay">
		            <a href="{{ url('/tripview/' . $trip->id) }}">{{ ucwords( strtolower( $trip->name ) ) }} <span><i class="fa fa-plus" aria-hidden="true"></i></span></a>
		        </div>
		        <div class="mask">
		            <h2>{{ ucwords( strtolower( $trip->name ) ) }} </h2>
		            <p>{{ strip_tags($trip->about_trip)}}</p>
		            <a href="#" class="info">Book</a>
		        </div>
		    </div> 
           @endforeach
        </div>
        <div class="clearfix"></div>
        <div style="float:right">trip link here</div>
    </div>
    
<!-- testimonial slider -->
<div class="section section-we-do-222">
    <div class="container">
	    <div class="row">
		    <div class="title  text-area  add-animation">
		        <h2>A humble Team we are</h2>
		        <p>We all some of us anyways</p>
		    </div>
	    </div>
	    <div class="row">
	    	<!-- Item slider-->
		    <div class="container-fluid">
		        <div class="row">
		            <div class="col-xs-12 col-sm-12 col-md-12">
		                <div class="carousel carousel-showmanymoveone slide" id="itemslider">
		                    <div class="carousel-inner">

		                        <div class="item active">
		                            <div class="col-xs-12 col-sm-6 col-md-3">
		                                <a href="#"><img src="{{ url('images/tm-01.png') }}" alt="tm-01" class="img-responsive center-block"></a>
		                                <h4 class="text-center">Remon Nabil</h4>
		                                <h5 class="text-center">Founder &amp; CEO</h5>
		                            </div>
		                        </div>

		                        <div class="item">
		                            <div class="col-xs-12 col-sm-6 col-md-3">
		                                <a href="#"><img src="{{ url('images/tm-02.png') }}" alt="tm-01" class="img-responsive center-block"></a>
		                                <h4 class="text-center">Josh Jansen</h4>
		                                <h5 class="text-center">Director of Lifestyle</h5>
		                            </div>
		                        </div>

		                        <div class="item">
		                            <div class="col-xs-12 col-sm-6 col-md-3">
		                                <a href="#"><img src="{{ url('images/tm-03.png') }}" alt="tm-01" class="img-responsive center-block"></a>
		                                <h4 class="text-center">Josh Buck</h4>
		                                <h5 class="text-center">Director of Communications</h5>

		                            </div>
		                        </div>

		                        <div class="item">
		                            <div class="col-xs-12 col-sm-6 col-md-3">
		                                <a href="#"><img src="{{ url('images/tm-04.png') }}" alt="tm-01" class="img-responsive center-block"></a>
		                                <h4 class="text-center">Anny Marie</h4>
		                                <h5 class="text-center">Director of Marketing</h5>
		                            </div>
		                        </div>

		                        <div class="item">
		                            <div class="col-xs-12 col-sm-6 col-md-3">
		                                <a href="#"><img src="{{ url('images/tm-01.png') }}" alt="tm-01" class="img-responsive center-block"></a>
		                                <h4 class="text-center">Remon Nabil</h4>
		                                <h5 class="text-center">Founder &amp; CEO</h5>
		                            </div>
		                        </div>

		                        <div class="item">
		                            <div class="col-xs-12 col-sm-6 col-md-3">
		                                <a href="#"><img src="{{ url('images/tm-02.png') }}" alt="tm-01" class="img-responsive center-block"></a>
		                                <h4 class="text-center">Josh Jansen</h4>
		                                <h5 class="text-center">Director of Lifestyle</h5>
		                            </div>
		                        </div>

		                    </div>

		                    <!--<div id="slider-control">
		                    <a class="left carousel-control" href="#itemslider" data-slide="prev"><img src="https://s12.postimg.org/uj3ffq90d/arrow_left.png" alt="Left" class="img-responsive"></a>
		                    <a class="right carousel-control" href="#itemslider" data-slide="next"><img src="https://s12.postimg.org/djuh0gxst/arrow_right.png" alt="Right" class="img-responsive"></a>
		                  </div>-->
		                </div>
		            </div>
		        </div>
		    </div>  
	    </div>
    </div>
</div>
@endsection