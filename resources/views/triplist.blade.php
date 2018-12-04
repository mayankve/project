@extends('layouts.home')
@section('title', 'Trips')
@section('content')

<?php //echo "hello"; die; ?>
<style type="text/css">
    .form-title {
        background-color: #e3e3e3;
        /* margin-bottom: 40px; */
        text-transform: uppercase;
    }
</style>

    <div style=" margin-top: 100px; min-height: 400px">
    <div class="section section-we-are-2">
        <div class="row">
            <div class="text-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 text-right col-md-offset-4 trip-type active trip-banner" id="trip-type">
                            Where We Are Going
                        </div>
                        <div class="col-md-2 trip-type trip-video" id="trip-type">
                            Where We've Been
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container trip-container banner-container">
            <div class="row no-gutter">
                <br/>
                <?php 
                 //$trips['pictures'] = [];
                 //  echo count($trips['pictures']); die;?>
                @if(count($trips['pictures'])>0)
                @foreach($trips['pictures'] AS $trip)
                <div class="gallery_product view view-tenth col-lg-4 col-md-4 col-sm-4 col-xs-6 filter trip">
                    <img src="{{ url('/') . '/uploads/trip/' . $trip->banner_image }}" alt="trip-01" class="img-responsive" style="min-height: 289px;min-width: 387px;">
                    <div class="text-overlay">
                        <a href="{{url('tripview').'/'.$trip->id}}">{{$trip->name}} </a> 
                    </div>
                    <div class="mask">
                        <h2>{{$trip->name}}</h2>
                        <p><?php echo strip_tags($trip->about_trip);?></p>
                        <!--<a href="{{url('book').'/'.$trip->id}}" class="info">Book</a>-->
                    </div>
                </div>
                @endforeach
                @else
                 <div class="container trip-container banner-container">
                     <center>There is no upcoming Trip.</center>
                 </div>
                @endif
                
            </div>
        </div>
        <div class="container trip-container video-container" style="display:none">
            <div class="row no-gutter">
                <br/>
                @if(count($trips['videos'])>0)
                @foreach($trips['videos'] AS $trip)
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 f">
                    <div><h4></h4></div>
                    <video width="400"  controls>
                        <source src="{{ url('/') . '/uploads/trip/' . $trip->video_name }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                    <div><p>{{$trip->about_video}}</p></div>
                </div>
                @endforeach
                @else
                 <div class="container trip-container banner-container">
                     <center>There is no past Trip.</center>
                 </div>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.trip-video').on('click', function () {
			$('.banner-container').hide();
			$('.video-container').show();
			$(this).addClass('active');
			$('.trip-banner').removeClass('active');
        });
		$('.trip-banner').on('click', function () {
			$('.banner-container').show();
			$('.video-container').hide();
			$(this).addClass('active');
			$('.trip-video').removeClass('active');
           // return confirm('Are you sure?');
        });

		
    </script>
</div>

@endsection