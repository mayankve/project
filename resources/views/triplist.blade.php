@extends('layouts.home')
@section('title', 'Trips')
@section('content')

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
                        <div class="col-md-2 text-right col-md-offset-4 trip-type active" id="trip-type">
                            Where We Are Going
                        </div>
                        <div class="col-md-2 trip-type" id="trip-type">
                            Where We've Been
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container trip-container">
            <div class="row no-gutter">
                <br/>
                @if(count($trips)>0)
                @foreach($trips AS $trip)
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
                @endif
            </div>
        </div>
        <div class="container trip-container" style="display: none;">

            <div class="row no-gutter">
                <br/>


                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 f">
                    <div><h4>Ghana, Togo, Benin & Morocco 2017</h4></div>
                    <video width="400"  controls>
                        <source src="/assets/passed_trip_videos/0ce814a3dfbd684ea9a3a6a8656b91f8.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                    <div><p>This trip video.This trip video.This trip video.This trip video.This trip video.This trip video.This trip video.This trip video.This trip video.This trip video.This trip video.This trip video.</p></div>
                </div>



                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 f">
                    <div><h4>Australia New Zealand 2018</h4></div>
                    <video width="400"  controls>
                        <source src="/assets/passed_trip_videos/0ce814a3dfbd684ea9a3a6a8656b91f8.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                    <div><p>This trip video.</p></div>
                </div>





            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            return confirm('Are you sure?');
        });
    </script>
</div>
</div>
@endsection