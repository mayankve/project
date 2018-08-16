@extends('admin.layouts.home')
@section('title', 'View Trip')
@section('content')

<style type="text/css">
    .form-title {
        background-color: #e3e3e3;
        /* margin-bottom: 40px; */
        text-transform: uppercase;
    }
</style>
<div class="row">
    <br>
    <br>
    <!---- trip-view-banner --->
<div class="trip-view-banner">
    <img src="/aat_zend/public/assets/trip_banner/09c8158b6ace388bd76a7355ccb8ab9f.jpg" class="img-responsive" alt="" style="min-width: 100%">
  <div class="parallax banner-title">
    <div class="container">
      <div class="content text-center">
          <h1 style="font-size:30px;">{{$tripdata->name}}</h1>
      </div>
    </div>
  </div>
</div>

<!---  About Trip view --->

<div class="container">
<div class="descp-pera">
<h2>About <span>Trip</span></h2>
<p>{{ $tripdata->about_trip }}</p>
<p><em>{{ $tripdata->date }}</em></p>
<!--<h3><a class="book-btn" href="{{url('book').'/'.$tripdata->id}}">Book</a></h3>-->
</div>
</div>


<!--- Video section --->

<div class="section section-header">
    <div class="parallax pattern-image">
        <video poster="/assets/img/video-poster.jpg" id="bgvid" playsinline="" autoplay="" muted="" loop="">
            <source src="/assets/aat_panama2017.mp4" type="video/mp4">
        </video>
        <div class="container">
            <div class="content">
                
            </div>
        </div>
    </div>
    <a href="#" data-scroll="true" data-id="#about" class="scroll-arrow hidden-xs hidden-sm">
        <img src="/aat_zend/public/assets/img/scroll-icon.png" alt="scroll"> </a>
</div>            <hr>
</div>

@endsection