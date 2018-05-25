
@extends('layouts.dashboard')
@section('title', 'AAT:Design your trip')
@section('content')


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
                            Design your Trip    </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">
                    Welcome{{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>

    <svg class="hidden">
    <defs>
    <path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"></path>
    </defs>
    </svg>

    <input type="hidden" id="ajax_url" name="ajax_url" value="/dashboard/my-trips/ajax/12">
    <input type="hidden" id="ajax_todo_url" name="ajax_todo_url" value="/dashboard/my-trips/ajax-todo/12">
    <div class="row text-right">
        <h4><a href="#">Checkout this trip</a></h4>
    </div>
    <div class="" id="pageWrapper">
        <div id="" class="customtab">

            <!-- Nav tabs -->
            <section>
                <div class="tabs tabs-style-shape">
                    <nav>
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="#DesignTrip" aria-controls="DesignTrip" role="tab" data-toggle="tab">
                                    <span>Design Your Trip</span>
                                </a>
                            </li>
                            <li role="presentation"><a href="#todo" aria-controls="todo" role="tab" data-toggle="tab">
                                    <span>Todo/Packing List</span>
                                </a>
                            </li>
                            <li role="presentation"><a href="#traveler" aria-controls="traveler" role="tab" data-toggle="tab">
                                    <span>Travelers</span>
                                </a>
                            </li>
                            <li role="presentation"><a href="#roommates" aria-controls="roommates" role="tab" data-toggle="tab">

                                    <span>Roommates/Referrals</span>
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div><!-- /tabs -->
            </section>
            <div class="tab-content">

                <!-- flight-land-------------------Start --------------------------------------->
                <div role="tabpanel" class="tab-pane active" id="DesignTrip">
                    <!--<form method="POST" name="trip-land-flight" action="/book/" id="trip-land-flight">-->

                    {!! Form::open(['url' => '/designtrip', 'id' => 'trip-land-flight' , 'method'=>'post']) !!}
                    <div class="panel panel-primary trip-design-flight">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Select flight or provide your flight's details</strong></h3>
                            <div class="panel-tools">
                                <a href="#" class="updown">
                                    <span class="clickable"><i class="glyphicon glyphicon-chevron-up" aria-hidden="true"></i></span></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="basic_info_view">   

                                <div class="form-horizontal">
                                    <div class="form-group pdrow-group">
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-6 pr-3">
                                                    <label><input type="radio" name="is_land_only" id="is_land_only" class="land_only" value="0" checked="checked">Avaliable Flights</label><label><input type="radio" name="is_land_only" class="land_only" value="1">Land only</label>                            </div>
                                                <div class="col-sm-6">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="available-flights">
                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        <b>SN</b>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <b>Airline Name</b>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <b>Departure Location</b>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <b>Departure Date</b>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <b>Departure Time</b>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <b>Reserve Amount</b>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <b>Cost</b>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <b>Book</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        1                                </div>
                                                    <div class="col-sm-3">
                                                        United Airlines                                </div>
                                                    <div class="col-sm-2">
                                                        Accra                                </div>
                                                    <div class="col-sm-2">
                                                        2017-09-29                                </div>
                                                    <div class="col-sm-1">
                                                        14:55:00                                </div>
                                                    <div class="col-sm-1">
                                                        $20                                </div>
                                                    <div class="col-sm-1">
                                                        $120                                </div>
                                                    <div class="col-sm-1">
                                                        <label><input type="radio" name="flight_id" class="flight_id" id="flight_id" value="10" checked="checked"></label>                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        2                                </div>
                                                    <div class="col-sm-3">
                                                        Delta Air Lines                                </div>
                                                    <div class="col-sm-2">
                                                        Kumasi                                </div>
                                                    <div class="col-sm-2">
                                                        2017-09-30                                </div>
                                                    <div class="col-sm-1">
                                                        11:40:00                                </div>
                                                    <div class="col-sm-1">
                                                        $30                                </div>
                                                    <div class="col-sm-1">
                                                        $150                                </div>
                                                    <div class="col-sm-1">
                                                        <label><input type="radio" name="flight_id" class="flight_id" id="flight_id" value="4"></label>                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        3                                </div>
                                                    <div class="col-sm-3">
                                                        American Airlines                                </div>
                                                    <div class="col-sm-2">
                                                        Sunyani                                </div>
                                                    <div class="col-sm-2">
                                                        2017-09-30                                </div>
                                                    <div class="col-sm-1">
                                                        18:10:00                                </div>
                                                    <div class="col-sm-1">
                                                        $75                                </div>
                                                    <div class="col-sm-1">
                                                        $300                                </div>
                                                    <div class="col-sm-1">
                                                        <label><input type="radio" name="flight_id" class="flight_id" id="flight_id" value="3"></label>                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="land-only" style="display: none;">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 custom-lbl">Flight Name</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="user-edit col-sm-6">
                                                        <input type="text" name="flight_name" class="form-control" value="">                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 custom-lbl">Flight Number</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="user-edit col-sm-6">
                                                        <input type="text" name="flight_number" class="form-control" value="">                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 custom-lbl">Departure Date</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="user-edit col-sm-6">
                                                        <input type="text" name="departure_date" class="form-control" value="">                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3 custom-lbl">Departure Time</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="user-edit col-sm-6">
                                                        <input type="text" name="departure_time" class="form-control" value="">                                </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                            </div>

                        </div>
                    </div>

                    <script>
                        $('document').ready(function () {
                            flightLandDivs();
                            $('.land_only').click(function () {
                                flightLandDivs();
                                var valuses = $('input[name=is_land_only]:checked').val()
                                var data = {is_land_only: valuses};
                                saveData(data);

                            });
                            $('.flight_id').click(function () {
                                flightLandDivs();
                                var valuses = $(this).val()
                                var data = {flight_id: valuses};
                                saveData(data);

                            });

                            function flightLandDivs() {
                                var valuses = $('input[name=is_land_only]:checked').val()
                                if (valuses == '0') {
                                    $('.available-flights').show();
                                    $('.land-only').hide();
                                } else {
                                    $('.available-flights').hide();
                                    $('.land-only').show();
                                }
                            }

                        });

                    </script>

                    <script type="text/javascript">
                        $(document).on('click', '.panel-heading span.clickable', function (e) {
                            var $this = $(this);
                            if (!$this.hasClass('panel-collapsed')) {
                                $this.parents('.panel').find('.panel-body').slideUp();
                                $this.addClass('panel-collapsed');
                                $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                            } else {
                                $this.parents('.panel').find('.panel-body').slideDown();
                                $this.removeClass('panel-collapsed');
                                $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                            }
                        });
                        $(function () {
                            $('head').append('<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">');
                        });
                    </script>


                    <br><div class="panel panel-primary trip-design-hotel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Hotels</strong></h3>
                            <div class="panel-tools">
                                <label style="color: black">Total Cost: </label> <label class="total_hotel_cost" style="color: black">$90</label>
                                <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
                        <!--<a href="#"><span class="basic_info"><i class="fa fa-edit" aria-hidden="true" ></i></span></a>
                                <a href="#"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
                            </div>

                        </div>

                        <div class="panel-body">
                            <div class="basic_info_view">   
                                <div class="form-horizontal">
                                    <div class="trip-addons">

                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <label>Upgrade solo room </label>
                                                    </div>
                                                    <div class="col-sm-3 text-right">
                                                        <div id="is_solo" class="btn-group" hot="1">
                                                            <a class="btn btn-primary btn-sm active" data-toggle="happy" data-title="Y">YES</a>
                                                            <a class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="N">NO</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        <b>SN</b>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <b>Hotel Name</b>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <b>Type</b>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <b>Due Date</b>
                                                    </div>
                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                        <b>Reserve Amount</b>
                                                    </div>
                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                        <b>Cost</b>
                                                    </div>

                                                    <div class="col-sm-1 hotel_solo_cost">
                                                        <b>Reserve Amount</b>
                                                    </div>
                                                    <div class="col-sm-1 hotel_solo_cost">
                                                        <b>Solo Cost</b>
                                                    </div>

                                                    <div class="col-sm-1 text">
                                                        <b>Book</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        1                                </div>
                                                    <div class="col-sm-3">
                                                        Blue                                </div>
                                                    <div class="col-sm-2">
                                                        Five Star                                </div>
                                                    <div class="col-sm-2">
                                                        2017-10-21                                </div>
                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                        <label>$</label> <label class="cost">
                                                            50                                    </label>
                                                    </div>
                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                        <label>$</label> <label class="cost">100</label>
                                                    </div>

                                                    <div class="col-sm-1 hotel_solo_cost">
                                                        <label>$</label> <label class="cost">
                                                            50                                    </label>
                                                    </div>
                                                    <div class="col-sm-1 hotel_solo_cost">
                                                        <label>$</label> <label class="solo_cost">180</label>
                                                    </div>

                                                    <div class="col-sm-1 text">
                                                        <label><input type="radio" name="selected_hotel" class="selected_hotel" id="selected_hotel" value="42"></label>                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        2                                </div>
                                                    <div class="col-sm-3">
                                                        Taj                                </div>
                                                    <div class="col-sm-2">
                                                        Three Star                                </div>
                                                    <div class="col-sm-2">
                                                        2017-10-28                                </div>
                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                        <label>$</label> <label class="cost">
                                                            10                                    </label>
                                                    </div>
                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                        <label>$</label> <label class="cost">60</label>
                                                    </div>

                                                    <div class="col-sm-1 hotel_solo_cost">
                                                        <label>$</label> <label class="cost">
                                                            10                                    </label>
                                                    </div>
                                                    <div class="col-sm-1 hotel_solo_cost">
                                                        <label>$</label> <label class="solo_cost">90</label>
                                                    </div>

                                                    <div class="col-sm-1 text">
                                                        <label><input type="radio" name="selected_hotel" class="selected_hotel" id="selected_hotel" value="41" checked="checked"></label>                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12 text-right">
                                            <div class="update-btn">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <style>
                        #is_solo .notActive{
                            color: black;
                            background-color: #e4b068;
                        }
                        .btn-primary,
                        .btn-primary:hover,
                        .btn-primary:active,
                        .btn-primary:visited,
                        .btn-primary:focus {
                            background-color: #e4b068;
                            border-color: #8064A2;
                        }

                        .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
                            background-color: #e4b068 !important;
                            background-image:-webkit-linear-gradient(top,white 0,white 100%);
                        }
                    </style>

                    <script>
                        $('document').ready(function () {
                            $('#is_solo a').each(function () {
                                if ($(this).hasClass('active')) {
                                    hotelCost($(this).data('title'));
                                }
                            });

                            $('#is_solo a').on('click', function () {
                                $('.selected_hotel').prop('checked', false);
                                $('.total_hotel_cost').text('$' + '0')

                                var sel = $(this).data('title');
                                var tog = $(this).data('toggle');
                                $('#' + tog).prop('value', sel);

                                $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
                                $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
                                hotelCost(sel);
                            });
                            $('.selected_hotel').click(function () {
                                var data = {hotel_id: $(this).val()};
                                saveData(data);
                                hotelTotalCost($(this));

                            });

                            function hotelCost(sel) {


                                if (sel == 'Y') {
                                    $('.hotel_solo_cost').show();
                                    $('.hotel_cost').hide();
                                    var data = {is_solo: '1'};
                                } else {
                                    $('.hotel_solo_cost').hide();
                                    $('.hotel_cost').show();
                                    var data = {is_solo: '0'};
                                }
                                saveData(data);
                            }
                            function hotelTotalCost($this) {
                                var costLabel = 'cost';
                                $('#is_solo a').each(function () {
                                    if ($(this).hasClass('active')) {
                                        if ($(this).data('title') == 'Y') {
                                            costLabel = 'solo_cost';
                                        }
                                    }
                                });
                                var cost = $this.closest(".row").find("." + costLabel).text();
                                $('.total_hotel_cost').text('$' + cost)
                            }


                        });

                    </script>
                    <br><div class="panel panel-primary addon-main">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Add Ons</strong></h3>
                            <div class="panel-tools">
                                <label style="color: black">Total Cost: </label> <label class="total_addon_cost" style="color: black">$0</label>
                                <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>

                            </div>

                        </div>
                        <div class="panel-body">
                            <div class="basic_info_view">   
                                <div class="form-horizontal">
                                    <div class="trip-addons">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="row number-group-row">
                                                    <div class="col-sm-1">
                                                        1                                </div>
                                                    <div class="col-sm-3">
                                                        3 Day Mole Park Safari &amp; Larabanga Mosque                                </div>
                                                    <div class="col-sm-3">
                                                        3 Day Mole Park Safari &amp; Larabanga Mosque                                </div>
                                                    <div class="col-sm-3">
                                                        <label>$</label><label class="addon_cost">600</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label><input type="checkbox" name="selected_addons[]" class="selected_addons" id="selected_addons" value="3 Day Mole Park Safari &amp; Larabanga Mosque"></label>                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="panel panel-primary traveler-list">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><strong>Travelers list</strong></h3>
                                                            <div class="panel-tools">
                                                                <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>

                                                            </div>

                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="basic_info_view">   
                                                                <div class="form-horizontal">
                                                                    <div class="trip-addons">
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        <label>SN.</label>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <label>Name</label>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <label>Gender</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        1                                </div>
                                                                                    <div class="col-sm-5">
                                                                                        Vaishnavesh2 Shukla                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        Male                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <script>
                                                        $('document').ready(function () {

                                                        });

                                                    </script>
                                                </div>
                                                <div class="row">
                                                    <div class="panel panel-primary trip-design-flight">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><strong>Select flight or provide your flight's details</strong></h3>
                                                            <div class="panel-tools">
                                                                <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up" aria-hidden="true"></i></span></a>
                                                        <!--<a href="#"><span class="basic_info"><i class="fa fa-edit" aria-hidden="true" ></i></span></a>
                                                                <a href="#"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
                                                            </div>

                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="basic_info_view">   
                                                                <div class="form-horizontal">
                                                                    <div class="form-group pdrow-group">
                                                                        <div class="col-sm-9">
                                                                            <div class="row">
                                                                                <div class="col-sm-6 pr-3">
                                                                                    <label><input type="radio" name="is_land_only" id="is_land_only" class="land_only" value="0" checked="checked">Avaliable Flights</label><label><input type="radio" name="is_land_only" class="land_only" value="1">Land only</label>                            </div>
                                                                                <div class="col-sm-6">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="available-flights">
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        <b>SN</b>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <b>Airline Name</b>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <b>Departure Location</b>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <b>Departure Date</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <b>Departure Time</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <b>Reserve Amount</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <b>Cost</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <b>Book</b>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        1                                </div>
                                                                                    <div class="col-sm-3">
                                                                                        Virgin America                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        D                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        2017-10-31                                </div>
                                                                                    <div class="col-sm-1">
                                                                                        00:55:00                                </div>
                                                                                    <div class="col-sm-1">
                                                                                        $100                                </div>
                                                                                    <div class="col-sm-1">
                                                                                        $170                                </div>
                                                                                    <div class="col-sm-1">
                                                                                        <label><input type="radio" name="flight_id" class="flight_id" id="flight_id" value="11"></label>                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="land-only" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="flight_name" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="flight_number" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="departure_date" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="departure_time" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>




                                                    <script>
                                                        $('document').ready(function () {
                                                            flightLandDivs();
                                                            $('.land_only').click(function () {
                                                                flightLandDivs();
                                                                var valuses = $('input[name=is_land_only]:checked').val()
                                                                var data = {is_land_only: valuses};
                                                                saveData(data);

                                                            });
                                                            $('.flight_id').click(function () {
                                                                flightLandDivs();
                                                                var valuses = $(this).val()
                                                                var data = {flight_id: valuses};
                                                                saveData(data);

                                                            });

                                                            function flightLandDivs() {
                                                                var valuses = $('input[name=is_land_only]:checked').val()
                                                                if (valuses == '0') {
                                                                    $('.available-flights').show();
                                                                    $('.land-only').hide();
                                                                } else {
                                                                    $('.available-flights').hide();
                                                                    $('.land-only').show();
                                                                }
                                                            }

                                                        });

                                                    </script>

                                                    <script type="text/javascript">
                                                        $(document).on('click', '.panel-heading span.clickable', function (e) {
                                                            var $this = $(this);
                                                            if (!$this.hasClass('panel-collapsed')) {
                                                                $this.parents('.panel').find('.panel-body').slideUp();
                                                                $this.addClass('panel-collapsed');
                                                                $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                                                            } else {
                                                                $this.parents('.panel').find('.panel-body').slideDown();
                                                                $this.removeClass('panel-collapsed');
                                                                $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                                                            }
                                                        });
                                                        $(function () {
                                                            $('head').append('<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">');
                                                        });
                                                    </script>


                                                </div>
                                                <div class="row">
                                                    <div class="panel panel-primary trip-design-hotel">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><strong>Hotels</strong></h3>
                                                            <div class="panel-tools">
                                                                <label style="color: black">Total Cost: </label> <label class="total_hotel_cost" style="color: black">$400</label>
                                                                <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>

                                                            </div>

                                                        </div>

                                                        <div class="panel-body">
                                                            <div class="basic_info_view">   
                                                                <div class="form-horizontal">
                                                                    <div class="trip-addons">

                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-9">
                                                                                        <label>Upgrade solo room </label>
                                                                                    </div>
                                                                                    <div class="col-sm-3 text-right">
                                                                                        <div id="is_solo" class="btn-group" hot="1">
                                                                                            <a class="btn btn-primary btn-sm active" data-toggle="happy" data-title="Y">YES</a>
                                                                                            <a class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="N">NO</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        <b>SN</b>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <b>Hotel Name</b>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <b>Type</b>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <b>Due Date</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <b>Reserve Amount</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <b>Cost</b>
                                                                                    </div>

                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <b>Reserve Amount</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <b>Solo Cost</b>
                                                                                    </div>

                                                                                    <div class="col-sm-1 text">
                                                                                        <b>Book</b>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        1                                </div>
                                                                                    <div class="col-sm-3">
                                                                                        CC                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        4 Star                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        2017-10-28                                </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <label>$</label> <label class="cost">
                                                                                            100                                    </label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <label>$</label> <label class="cost">200</label>
                                                                                    </div>

                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <label>$</label> <label class="cost">
                                                                                            200                                    </label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <label>$</label> <label class="solo_cost">400</label>
                                                                                    </div>

                                                                                    <div class="col-sm-1 text">
                                                                                        <label><input type="radio" name="selected_hotel" class="selected_hotel" id="selected_hotel" value="0"></label>                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 text-right">
                                                                            <div class="update-btn">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <style>
                                                        #is_solo .notActive{
                                                            color: black;
                                                            background-color: #e4b068;
                                                        }
                                                        .btn-primary,
                                                        .btn-primary:hover,
                                                        .btn-primary:active,
                                                        .btn-primary:visited,
                                                        .btn-primary:focus {
                                                            background-color: #e4b068;
                                                            border-color: #8064A2;
                                                        }

                                                        .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
                                                            background-color: #e4b068 !important;
                                                            background-image:-webkit-linear-gradient(top,white 0,white 100%);
                                                        }
                                                    </style>

                                                    <script>
                                                        $('document').ready(function () {
                                                            $('#is_solo a').each(function () {
                                                                if ($(this).hasClass('active')) {
                                                                    hotelCost($(this).data('title'));
                                                                }
                                                            });

                                                            $('#is_solo a').on('click', function () {
                                                                $('.selected_hotel').prop('checked', false);
                                                                $('.total_hotel_cost').text('$' + '0')

                                                                var sel = $(this).data('title');
                                                                var tog = $(this).data('toggle');
                                                                $('#' + tog).prop('value', sel);

                                                                $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
                                                                $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
                                                                hotelCost(sel);
                                                            });
                                                            $('.selected_hotel').click(function () {
                                                                var data = {hotel_id: $(this).val()};
                                                                saveData(data);
                                                                hotelTotalCost($(this));

                                                            });

                                                            function hotelCost(sel) {


                                                                if (sel == 'Y') {
                                                                    $('.hotel_solo_cost').show();
                                                                    $('.hotel_cost').hide();
                                                                    var data = {is_solo: '1'};
                                                                } else {
                                                                    $('.hotel_solo_cost').hide();
                                                                    $('.hotel_cost').show();
                                                                    var data = {is_solo: '0'};
                                                                }
                                                                saveData(data);
                                                            }
                                                            function hotelTotalCost($this) {
                                                                var costLabel = 'cost';
                                                                $('#is_solo a').each(function () {
                                                                    if ($(this).hasClass('active')) {
                                                                        if ($(this).data('title') == 'Y') {
                                                                            costLabel = 'solo_cost';
                                                                        }
                                                                    }
                                                                });
                                                                var cost = $this.closest(".row").find("." + costLabel).text();
                                                                $('.total_hotel_cost').text('$' + cost)
                                                            }


                                                        });

                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="row number-group-row">
                                                    <div class="col-sm-1">
                                                        2                                </div>
                                                    <div class="col-sm-3">
                                                        Room Upgrade                                </div>
                                                    <div class="col-sm-3">
                                                        Single Room Upgrade Throughout                                 </div>
                                                    <div class="col-sm-3">
                                                        <label>$</label><label class="addon_cost">600</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label><input type="checkbox" name="selected_addons[]" class="selected_addons" id="selected_addons" value="Room Upgrade"></label>                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="panel panel-primary traveler-list">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><strong>Travelers list</strong></h3>
                                                            <div class="panel-tools">
                                                                <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>

                                                            </div>

                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="basic_info_view">   
                                                                <div class="form-horizontal">
                                                                    <div class="trip-addons">
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        <label>SN.</label>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <label>Name</label>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <label>Gender</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        1                                </div>
                                                                                    <div class="col-sm-5">
                                                                                        Vaishnavesh2 Shukla                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        Male                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <script>
                                                        $('document').ready(function () {

                                                        });

                                                    </script>
                                                </div>
                                                <div class="row">
                                                    <div class="panel panel-primary trip-design-flight">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><strong>Select flight or provide your flight's details</strong></h3>
                                                            <div class="panel-tools">
                                                                <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up" aria-hidden="true"></i></span></a>
                                                        <!--<a href="#"><span class="basic_info"><i class="fa fa-edit" aria-hidden="true" ></i></span></a>
                                                                <a href="#"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
                                                            </div>

                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="basic_info_view">   

                                                                <div class="form-horizontal">
                                                                    <div class="form-group pdrow-group">
                                                                        <div class="col-sm-9">
                                                                            <div class="row">
                                                                                <div class="col-sm-6 pr-3">
                                                                                    <label><input type="radio" name="is_land_only" id="is_land_only" class="land_only" value="0" checked="checked">Avaliable Flights</label><label><input type="radio" name="is_land_only" class="land_only" value="1">Land only</label>                            </div>
                                                                                <div class="col-sm-6">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="available-flights">
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        <b>SN</b>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <b>Airline Name</b>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <b>Departure Location</b>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <b>Departure Date</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <b>Departure Time</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <b>Reserve Amount</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <b>Cost</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <b>Book</b>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        1                                </div>
                                                                                    <div class="col-sm-3">
                                                                                        Hawaiian Airlines                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        E                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        2017-10-31                                </div>
                                                                                    <div class="col-sm-1">
                                                                                        00:45:00                                </div>
                                                                                    <div class="col-sm-1">
                                                                                        $100                                </div>
                                                                                    <div class="col-sm-1">
                                                                                        $500                                </div>
                                                                                    <div class="col-sm-1">
                                                                                        <label><input type="radio" name="flight_id" class="flight_id" id="flight_id" value="6"></label>                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="land-only" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="flight_name" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="flight_number" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="departure_date" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="departure_time" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>




                                                    <script>
                                                        $('document').ready(function () {
                                                            flightLandDivs();
                                                            $('.land_only').click(function () {
                                                                flightLandDivs();
                                                                var valuses = $('input[name=is_land_only]:checked').val()
                                                                var data = {is_land_only: valuses};
                                                                saveData(data);

                                                            });
                                                            $('.flight_id').click(function () {
                                                                flightLandDivs();
                                                                var valuses = $(this).val()
                                                                var data = {flight_id: valuses};
                                                                saveData(data);

                                                            });

                                                            function flightLandDivs() {
                                                                var valuses = $('input[name=is_land_only]:checked').val()
                                                                if (valuses == '0') {
                                                                    $('.available-flights').show();
                                                                    $('.land-only').hide();
                                                                } else {
                                                                    $('.available-flights').hide();
                                                                    $('.land-only').show();
                                                                }
                                                            }

                                                        });

                                                    </script>

                                                    <script type="text/javascript">
                                                        $(document).on('click', '.panel-heading span.clickable', function (e) {
                                                            var $this = $(this);
                                                            if (!$this.hasClass('panel-collapsed')) {
                                                                $this.parents('.panel').find('.panel-body').slideUp();
                                                                $this.addClass('panel-collapsed');
                                                                $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                                                            } else {
                                                                $this.parents('.panel').find('.panel-body').slideDown();
                                                                $this.removeClass('panel-collapsed');
                                                                $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                                                            }
                                                        });
                                                        $(function () {
                                                            $('head').append('<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">');
                                                        });
                                                    </script>


                                                </div>
                                                <div class="row">
                                                    <div class="panel panel-primary trip-design-hotel">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><strong>Hotels</strong></h3>
                                                            <div class="panel-tools">
                                                                <label style="color: black">Total Cost: </label> <label class="total_hotel_cost" style="color: black">$200</label>
                                                                <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
                                                        <!--<a href="#"><span class="basic_info"><i class="fa fa-edit" aria-hidden="true" ></i></span></a>
                                                                <a href="#"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
                                                            </div>

                                                        </div>

                                                        <div class="panel-body">
                                                            <div class="basic_info_view">   
                                                                <div class="form-horizontal">
                                                                    <div class="trip-addons">

                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-9">
                                                                                        <label>Upgrade solo room </label>
                                                                                    </div>
                                                                                    <div class="col-sm-3 text-right">
                                                                                        <div id="is_solo" class="btn-group" hot="1">
                                                                                            <a class="btn btn-primary btn-sm active" data-toggle="happy" data-title="Y">YES</a>
                                                                                            <a class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="N">NO</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        <b>SN</b>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        <b>Hotel Name</b>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <b>Type</b>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <b>Due Date</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <b>Reserve Amount</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <b>Cost</b>
                                                                                    </div>

                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <b>Reserve Amount</b>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <b>Solo Cost</b>
                                                                                    </div>

                                                                                    <div class="col-sm-1 text">
                                                                                        <b>Book</b>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        1                                </div>
                                                                                    <div class="col-sm-3">
                                                                                        AA                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        1 Star                                </div>
                                                                                    <div class="col-sm-2">
                                                                                        2017-10-31                                </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <label>$</label> <label class="cost">
                                                                                            100                                    </label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <label>$</label> <label class="cost">100</label>
                                                                                    </div>

                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <label>$</label> <label class="cost">
                                                                                            100                                    </label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <label>$</label> <label class="solo_cost">200</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 text">
                                                                                        <label><input type="radio" name="selected_hotel" class="selected_hotel" id="selected_hotel" value="0"></label>                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 text-right">
                                                                            <div class="update-btn">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <style>
                                                        #is_solo .notActive{
                                                            color: black;
                                                            background-color: #e4b068;
                                                        }
                                                        .btn-primary,
                                                        .btn-primary:hover,
                                                        .btn-primary:active,
                                                        .btn-primary:visited,
                                                        .btn-primary:focus {
                                                            background-color: #e4b068;
                                                            border-color: #8064A2;
                                                        }

                                                        .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
                                                            background-color: #e4b068 !important;
                                                            background-image:-webkit-linear-gradient(top,white 0,white 100%);
                                                        }
                                                    </style>
                                                    <script>
                                                        $('document').ready(function () {
                                                            $('#is_solo a').each(function () {
                                                                if ($(this).hasClass('active')) {
                                                                    hotelCost($(this).data('title'));
                                                                }
                                                            });

                                                            $('#is_solo a').on('click', function () {
                                                                $('.selected_hotel').prop('checked', false);
                                                                $('.total_hotel_cost').text('$' + '0')

                                                                var sel = $(this).data('title');
                                                                var tog = $(this).data('toggle');
                                                                $('#' + tog).prop('value', sel);

                                                                $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
                                                                $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
                                                                hotelCost(sel);
                                                            });
                                                            $('.selected_hotel').click(function () {
                                                                var data = {hotel_id: $(this).val()};
                                                                saveData(data);
                                                                hotelTotalCost($(this));

                                                            });

                                                            function hotelCost(sel) {


                                                                if (sel == 'Y') {
                                                                    $('.hotel_solo_cost').show();
                                                                    $('.hotel_cost').hide();
                                                                    var data = {is_solo: '1'};
                                                                } else {
                                                                    $('.hotel_solo_cost').hide();
                                                                    $('.hotel_cost').show();
                                                                    var data = {is_solo: '0'};
                                                                }
                                                                saveData(data);
                                                            }
                                                            function hotelTotalCost($this) {
                                                                var costLabel = 'cost';
                                                                $('#is_solo a').each(function () {
                                                                    if ($(this).hasClass('active')) {
                                                                        if ($(this).data('title') == 'Y') {
                                                                            costLabel = 'solo_cost';
                                                                        }
                                                                    }
                                                                });
                                                                var cost = $this.closest(".row").find("." + costLabel).text();
                                                                $('.total_hotel_cost').text('$' + cost)
                                                            }


                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 text-right">
                                            <div class="update-btn">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <script>
                        $('document').ready(function () {
                            $('.selected_addons').click(function () {
                                var cost = 0;
                                $('.total_addon_cost').text('$' + cost);
                                $(".selected_addons:checked").each(function () {
                                    cost = cost + parseFloat($(this).closest(".row").find("." + 'addon_cost').text());
                                    $('.total_addon_cost').text('$' + cost);
                                });
                            });
                        });

                    </script>
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <div class="update-btn">
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}         
                </div>
                <!-- flight-land-------------------End ----------------------------------------->
                <!-- todo-------------------Start ---------------------------------------------->
                <div role="tabpanel" class="tab-pane" id="todo">
                    <form method="POST" name="trip-land-flight" action="/book/" id="trip-land-flight">                <br>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Do/Packing list</strong></h3>
                                <div class="panel-tools">
                                    <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
                            <!--<a href="#"><span class="basic_info"><i class="fa fa-edit" aria-hidden="true" ></i></span></a>
                                    <a href="#"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="basic_info_view">   
                                    <div class="form-horizontal">
                                        <div class="trip-addons">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-1">
                                                            1                                </div>
                                                        <div class="col-sm-9">
                                                            Packing3                                </div>

                                                        <div class="col-sm-2">
                                                            <label><input type="checkbox" name="selected_todo[]" class="selected_todo" id="selected_todo" value="54"></label>                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-1">
                                                            2                                </div>
                                                        <div class="col-sm-9">
                                                            Packing2                                </div>

                                                        <div class="col-sm-2">
                                                            <label><input type="checkbox" name="selected_todo[]" class="selected_todo" id="selected_todo" value="53"></label>                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-1">
                                                            3                                </div>
                                                        <div class="col-sm-9">
                                                            Packing1                                </div>

                                                        <div class="col-sm-2">
                                                            <label><input type="checkbox" name="selected_todo[]" class="selected_todo" id="selected_todo" value="52"></label>                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-12 text-right">
                                                <div class="update-btn">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>Note: All is required to check them off as done before they register.</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <script>
                            $('document').ready(function () {
                                $('.selected_todo').click(function () {
                                    var dataArray = [];
                                    $('.selected_todo:checked').each(function () {
                                        dataArray.push($(this).val());
                                    });
                                    var data = {todo_ids: dataArray};
                                    saveTodoData(data);
                                    console.log(data);

                                });
                            });

                        </script>
                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <div class="update-btn">
                                </div>
                            </div>
                        </div>
                    </form>            </div>
                <!-- todo-------------------End ------------------------------------------------>
                <!-- traveler-------------------Start ------------------------------------------>
                <div role="tabpanel" class="tab-pane" id="traveler">
                    <form method="POST" name="trip-land-flight" action="/book/" id="trip-land-flight">                <br>
                        <div class="panel panel-primary traveler-list">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Travelers list</strong></h3>
                                <div class="panel-tools">
                                    <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
                            <!--<a href="#"><span class="basic_info"><i class="fa fa-edit" aria-hidden="true" ></i></span></a>
                                    <a href="#"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="basic_info_view">   
                                    <div class="form-horizontal">
                                        <div class="trip-addons">
                                            <div class="form-group pdrow-group">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-1">
                                                            <label>SN.</label>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <label>Name</label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label>Gender</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group pdrow-group">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-1">
                                                            1                                </div>
                                                        <div class="col-sm-5">
                                                            Vaishnavesh2 Shukla                                </div>
                                                        <div class="col-sm-2">
                                                            Male                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="form-group pdrow-group">
                                            <div class="col-sm-12 text-right">
                                                <div class="update-btn">
                                                                            </div>
                                            </div>
                                        </div>-->

                                        <!--<div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('document').ready(function () {

                            });

                        </script>

                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <div class="update-btn">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- traveler-------------------End ---------------------------------------------->

                <div role="tabpanel" class="tab-pane" id="roommates">Roommates</div>
                <div role="tabpanel" class="tab-pane" id="insurance">Insurance</div>
            </div>
            <br>
        </div>
        <div id="my_trip_container" class="tabcontent">
            <h3>My Trip</h3>
        </div>	  

    </div>
    <script type="text/javascript">
        function saveData($data) {
            var url = $('#ajax_url').val();
            $.ajax({
                type: "POST",
                url: url,
                data: $data,
                success: function (responseData) {

                }
            });
        }
        function saveTodoData($data) {
            console.log('data-----');
            console.log($data);
            var url = $('#ajax_todo_url').val();
            $.ajax({
                type: "POST",
                url: url,
                data: $data,
                success: function (responseData) {

                }
            });
        }
    </script>
</div>