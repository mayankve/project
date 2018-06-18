
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
                    {!! Form::open(['url' => '/designtrip', 'id' => 'trip-design' , 'method'=>'post']) !!}
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
                                                    <label>
                                                        <input type="radio" name="is_land_only" id="is_land_only" class="land_only" value="0" checked="checked">Avaliable Flights
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="is_land_only" class="land_only" value="1">Land only
                                                    </label>
                                                </div>
                                                <div class="col-sm-6">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Airline Panel -->
                                    <div class="panel panel-default">
                                        @include('designstrips.partials.design_trip_airlines')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br> 
                    <!-- Hotel Panel -->
                    <div class="panel panel-default">
                        @include('designstrips.partials.design_trip_hotels')
                    </div>
                    <br>
                    <div class="panel panel-default">
                        @include('designstrips.partials.design_trip_addons')
                    </div>
                    <div class="panel panel-default">
                        @include('designstrips.partials.design_trip_todo')
                    </div>
                    <div class="panel panel-default">
                        @include('designstrips.partials.design_trip_traveler')
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    {!! Form::close() !!}         
</div>  
<script>
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
//            saveData(data);
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
            // saveData(data);
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

        //to do
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
    $(window).on('load', function () {
        $('.trip_collection fieldset > label, .cust-input-group fieldset.trip_collection > fieldset label').each(function () {
            var newDiv = $('<div/>').addClass('action-price');
            //$(this).before(newDiv);
            var next = $(this).next(".trip_collection fieldset > ul");
            $(this).append(next);
            //newDiv.append(this).append(next);
        });
    });

/// Cart btn

    (function () {
        $("#cart").on("click", function () {
            $(".shopping-cart").fadeToggle("fast");
        });
    })
            ();

</script>
@endsection