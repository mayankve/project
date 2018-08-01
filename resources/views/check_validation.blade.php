@extends('layouts.home')
@section('title', 'AAT:Design your trip')
@section('content')

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

    /* Style the Tabs */
    a:hover,a:focus{
        text-decoration: none;
        outline: none;
    }
    .tab .nav-tabs{
        border: none;
        border-bottom: 2px solid #079fc9;
        margin: 0;
    }
    .tab .nav-tabs li a{
        padding: 10px 20px;
        margin: 0 10px -1px 0;
        font-size: 17px;
        font-weight: 600;
        color: #293241;
        text-transform: uppercase;
        border: 2px solid #e6e5e1;
        border-bottom: none;
        border-radius: 5px 5px 0 0;
        z-index: 1;
        position: relative;
        transition: all 0.3s ease 0s;
    }
    .tab .nav-tabs li a:hover,
    .tab .nav-tabs li.active a{
        background: #fff;
        color: #079fc9;
        border: 2px solid #079fc9;
        border-bottom-color: transparent;
    }
    .tab .nav-tabs li a:before{
        content: "";
        display: block;
        height: 2px;
        background: #fff;
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        transform: scaleX(0);
        transition: all 0.3s ease-in-out 0s;
    }
    .tab .nav-tabs li.active a:before,
    .tab .nav-tabs li a:hover:before{ transform: scaleX(1); }
    .tab .tab-content{
        padding: 10px;
        font-size: 17px;
        color: #6f6f6f;
        line-height: 30px;
        letter-spacing: 1px;
        position: relative;
    }
    @media only screen and (max-width: 479px){
        .tab .nav-tabs{ border: none; }
        .tab .nav-tabs li{
            width: 100%;
            text-align: center;
            margin-bottom: 15px;
        }
        .tab .nav-tabs li a{
            margin: 0;
            border-bottom: 2px solid transparent;
        }
        .tab .nav-tabs li a:before{
            content: "";
            width: 100%;
            height: 2px;
            background: #079fc9;
            position: absolute;
            bottom: -2px;
            left: 0;
        }
    }
</style>

<div class="pageContainer">
    <div class="dashboardHeader" style="margin-top: 150px;">
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
                        <a>  Design your Trip   </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">Welcome  {{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>
    <form method="post" action="{{url('setcartvalue')}}">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="tab" role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Section 1</a></li>
                            <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Section 2</a></li>
                            <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">Section 3</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs">
                            <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                                <h3>Design Your Trip</h3>
                                <p>
                                    <!-------------Design Your Trip Section-------------------------------->
                                    <!-- flight-land-------------------Start --------------------------------------->
                                    <input type="hidden" name="trip_id" id="trip_id"  value="{{$trip_id}}">
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
                                                                        <input type="radio" name="is_land_only" id="is_land_only" class="land_only" value="0" checked>Avaliable Flights
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
                                    <!-- Addons Panel -->
                                    <div class="panel panel-default">
                                        @include('designstrips.partials.design_trip_addons')
                                    </div>
                                    <br>
                                    <!-- Included Activities Panel -->
                                    <div class="panel panel-default">
                                        @include('designstrips.partials.design_trip_included_activity')
                                    </div>
                              
                                <!-----------------------Design  your Trip ends----------------------------------------->
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Section2">
                                <h3>Todo/Packing List</h3>
                            <p>
                                <!-- Trip Todo Panel -->
                                @include('designstrips.partials.design_trip_todo')
                            </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Section3">
                                <h3>Travelers</h3>
                                <p>
                                  <!-- Trip Travelers Panel -->
                                    @include('designstrips.partials.design_trip_traveler')
                                </p>
                            </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="traveler_count" name="travelercount" value="<?php echo count($tripdata['tripTravelers']); ?>"> 
                                <input type="hidden" class="trip_flight_id" name="trip_flight_id" value="">
                                <input type="hidden" class="trip_hotel_amount" name="trip_hotel_amount" value="">
                                <input type="hidden" class="trip_hotle_id" name="trip_hotle_id" value="">
                                <input type="hidden" class="final_add_amount" name="final_add_amount" value="">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="submit" name="button" id="cartbutton" value="Go to cart">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>

    $(document).ready(function () {
        //hide hotel and flight of addon//
        $(".addon_flight").hide();
        $(".addon_hotel").hide();
        // here end//
        // var addon_id=[];
        // var traveler_id=[];
        var final_price = 0;
        var add_on_price = 0;
        var add_flight_price = 0;
        var add_hotle_price = 0;

        //alert($('input[name="selected_hotel"]:checked').val());

        if ($('input[name="selected_hotel"]:checked').val() != '')
        {
            var travlercont = $('.traveler_count').val();
            //alert(travlercont);
            var reserveramount = $('input[name="selected_hotel"]:checked').parents('.parent').find('.reserver_amount').val();
            //alert(reserveramount);		
            $('.total_hotel_cost').html("$" + reserveramount * travlercont);
        }


        // $('input[name="flight_id"]').click(function(){
        //alert($( "input[type=radio][name=flight_id]:checked" ).val());
        // $('.trip_flight_id').val($( "input[type=radio][name=flight_id]:checked" ).val());	
        // });
        // $('input[name="selected_hotel"]').click(function(){
        // var travlercont=$('.traveler_count').val();
        // var reserveramount= $(this).parents('.parent').find('.reserver_amount').val();
        //alert(reserveramount);
        // $('.trip_hotel_amount').val(reserveramount*travlercont);
        // $('.trip_hotle_id').val($( "input[type=radio][name=selected_hotel]:checked" ).val());
        // $('.total_hotel_cost').html(reserveramount*travlercont);
        // });


        $('.selected_addons').click(function () {
            add_on_price = 0;
            //alert('Please select flight and hotels for addon');			
            $(this).parents('.parent').find('.addon_flight').toggle();
            $(this).parents('.parent').find('.addon_hotel').toggle();

            //var flightchecked=	$(this).parents('.parent').find('.addon_flight_name').attr('checked', true);
            $(".addon input[type=checkbox]:checked").each(function () {

                //addon_id.push($(this).parents('.parent').find('.selected_addons').val());										

                var add_on = $(this).parents('.parent').find('.add_on_cost').val();
                if (add_on != undefined) {
                    //alert(add_on);
                    add_on_price = parseInt(add_on_price) + parseInt(add_on);
                }

                // code add here//
                addfinalvalue();
                //end here//

            });

        });
        $('.addon_flight_name').click(function () {
            add_flight_price = 0;
            $(".parent input[type=radio]:checked").each(function () {
                var value = $(this).parents('.flightparent').find('.add_on_cost_flight').val(); //$(this).val();

                if (value != undefined) {
                    //alert(value+"sfdsdfds");
                    add_flight_price = parseInt(add_flight_price) + parseInt(value);
                }
                addfinalvalue();
            });
        });
        $('.selected_addon_hotel').click(function () {
            add_hotle_price = 0;

            $(".parent input[type=radio]:checked").each(function () {
                var hotel_price = $(this).parents('.hotleparent').find('.add_on_cost_hotel').val(); //$(this).val();

                if (hotel_price != undefined) {
                    //alert(hotel_price);
                    add_hotle_price = parseInt(add_hotle_price) + parseInt(hotel_price);
                }
                addfinalvalue();
            });
        });

        function addfinalvalue() {
            final_price = parseInt(add_on_price) + parseInt(add_flight_price) + parseInt(add_hotle_price);
            $('.total_addon_cost').html("$" + final_price);
            $('.final_add_amount').val(final_price);
        }


        //include activity/
        //land-only_activity
        $('.is_land_only_activity_flight').click(function () {

            if ($(this).val() == 1)
            {
                $('.land-only_activity').show();
            } else {
                $('.land-only_activity').hide();
            }
        });

        /*  $('.add_on_land-only').click(function () {
         if ($(this).val() == 1)
         {
         $('.add_on_land-onlydetail').show();
         } else {
         $('.add_on_land-onlydetail').hide();
         }
         });
         */
        //end here//


// form submit here//
//alert($( "input[type=radio][name=is_land_only_activity_flight]:checked" ).val());
//alert($( ".included_activity_hotel:checked" ).val());
        $('#cartbutton').click(function () {
            var ckbox = $('#selected_addons');
            //alert($( "input[type=checkbox][name=is_land_only]:checked" ).val());
            if ($("input[type=radio][name=is_land_only]:checked").val() == 0)
            {
                if ($("input[type=radio][name=flight_id]:checked").val() == undefined)
                {
                    alert('Please select Trip Flights');
                    return false;
                }
            }
            if ($("input[type=radio][name=is_land_only]:checked").val() == 1)
            {
                if ($("input[type=text][name=flight_name]").val() == '')
                {
                    alert('Please Enter Flight Name');
                    return false;
                }
                if ($("input[type=text][name=flight_number]").val() == '')
                {
                    alert('Please Enter Flight Number');
                    return false;
                }
                if ($("input[type=text][name=departure_date]").val() == '')
                {
                    alert('Please Enter Departure Date');
                    return false;
                }
                if ($("input[type=text][name=departure_time]").val() == '')
                {
                    alert('Please Enter Departure Time');
                    return false;
                }

            }
            //include activity//

            if ($("input[type=radio][name=is_land_only_activity_flight]:checked").val() == 0)
            {

                if ($(".included_activity_flight:checked").val() == undefined)
                {
                    alert('Please select activity flights');
                    return false;
                }
            }

            // if($( ".included_activity_hotel:checked" ).val()==undefined)
            // {
            // alert('Please select activity hotel');
            // return false;
            // }	


            if ($("input[type=radio][name=is_land_only_activity_flight]:checked").val() == 1)
            {
                if ($("input[type=text][name=activity_flight_name]").val() == '')
                {
                    alert('Please Enter Flight Name');
                    return false;
                }
                if ($("input[type=text][name=activity_flight_flight_number]").val() == '')
                {
                    alert('Please Enter Flight Number');
                    return false;
                }
                if ($("input[type=text][name=activity_flight_departure_date]").val() == '')
                {
                    alert('Please Enter Departure Date');
                    return false;
                }
                if ($("input[type=text][name=activity_flight_departure_time]").val() == '')
                {
                    alert('Please Enter Departure Time');
                    return false;
                }

            }

            if ($(".selected_todo:checked").val() == undefined)
            {
                alert('Please select Packing List');
                return false;
            }
            // end here//



            // if(ckbox.is(':checked'))
            // {
            // if($('.selected_addon_traveler').prop('checked')==false)
            // {
            // alert('Please Select Traveler..');
            // return false;
            // }


            // }



        });

    });

</script>




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