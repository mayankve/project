@extends('admin.layouts.dashboard')
@section('title', 'Dashboard')
@section('content')

<style type="text/css">
    .form-title {
        background-color: #e3e3e3;
        /* margin-bottom: 40px; */
        text-transform: uppercase;
    }
</style>

<div class="pageContainer">
    <div class="dashboardHeader">
        <div class="row">
            <div class="col-sm-6 text-left">
                <div class="sidebar_toggle">
                    <i class="fa fa-chevron-right" data-unicode="f00a"></i>
                </div>
                <ol class="breadcrumb">
                    <li>
                        <a class="desh-title" href="#">Dashboard</a>
                    </li>
                    <li class="active">
                        <a>
                            Trip Listing    </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">
                    Welcome Vaishnavash Shukla
                </h3>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="panel panel-primary" style="border-bottom:none;">
            <div class="panel-heading">
                <h3 class="panel-title">List Trip</h3>
                <div class="panel-tools">
                </div>
            </div>
        </div>
        <div class="col-md-11">
            <div class="row no-gutter">
                <br/>
                @if(count($trips)>0)
                @foreach($trips AS $trip)
                <div class="gallery_product view view-tenth col-lg-4 col-md-4 col-sm-4 col-xs-6 filter trip">
                    <img src="{{ url('/') . '/trip_banner/' . $trip->banner_image }}" alt="trip-01" class="img-responsive" style="min-height: 289px;min-width: 387px;">
                    <div class="text-overlay">
                        <a href="#">{{$trip->name}} </a>
                        <a href="{{ url('/').'/admin/deletetrip/'.$trip->id }}" class="info confirmation"><span><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i></span></a>
                        <a href="#" class="info"><span><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></span></a>

                    </div>

                    <div class="mask">
                        <h2>{{$trip->name}}</h2>
                        <p>{{$trip->about_trip}}</p>
                        <a href="#" class="info">Book</a>


                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            return confirm('Are you sure?');
        });
    </script>
</div>

@endsection