@extends('layouts.dashboard')
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

    #disabled_trip{
        opacity : .6;
    }
    /* Style the Tabs */
    .basic_info_view .panel-default {
        border: transparent;
        box-shadow: 0 0px 0px rgba(181,181,181,.3) !important;
    }
    .updown {
        float: right;
    }
    .deshboard_body .trip_detail_01 .tab {
        padding-bottom: 0px;
    }
    @media screen and (max-width:1400px){
        .deshboard_body .trip_detail_01 .tab {
            padding-bottom: 0px;
        }
    }
</style>

<div class="pageContainer trip_detail_01" id="trip_design_page">
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
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="tab" role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Design Your Trip</a></li>
                            <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Todo/Packing List</a></li>
                            <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">Travelers</a></li>
                        </ul>
                        
                        @if($tripDetails['adjustment_date'] < date('Y-m-d'))
                        <!-- Tab panes -->
                        <div class="tab-content tabs" id = "disabled_trip">
                            <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                                <p>
                                    <!-------------Design Your Trip Section-------------------------------->
                                    <!-- flight-land-------------------Start --------------------------------------->
                                <input type="hidden" name="trip_id" id="trip_id"  value="{{$trip_id}}">
								<input type="hidden" name="trip_date" id="trip_date"  value="$tripDetails['date']">
								<input type="hidden" name="trip_end_date" id="trip_end_date"  value="$tripDetails['end_date']">
								
                                <div class="panel panel-primary trip-design-flight">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Select flight or provide your flight's details</strong></h3>
                                        <div class="">
                                            <a href="#" class="updown">
                                                <span class="clickable"><i class="glyphicon glyphicon-chevron-up" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="basic_info_view">   
                                            <div class="form-horizontal">
                                               <!-- <div class="form-group pdrow-group">
                                                    <div class="col-sm-9">
                                                        <div class="row flights_heading">
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
                                                </div>-->
                                                <!-- Airline Panel -->
                                                
                                                <?php //echo "<pre>"; print_r($tripDetails['adjustment_date']);die;?>
                                                <div class="panel panel-default" id = "trip_airlines">
                                                    @include('designstrips.partials.design_trip_airlines')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!-- Hotel Panel -->
                                <div class="panel panel-default trip-design-hotel">
                                    @include('designstrips.partials.design_trip_hotels')
                                </div>
                                <br>
                                <!-- Included Activities Panel -->
                                <div class="panel panel-default trip-design-activity">
                                    @include('designstrips.partials.design_trip_included_activity')
                                </div>
                                <!-- Addons Panel -->
                                <div class="panel panel-default trip-design-addon">
                                    @include('designstrips.partials.design_trip_addons')
                                </div>
                                <br>
                                <!-----------------------Design  your Trip ends----------------------------------------->
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Section2">
                                <p>
                                    <!-- Trip Todo Panel -->
                                    @include('designstrips.partials.design_trip_todo')
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Section3">
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
                        @else
                         <div class="tab-content tabs">
                            <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                                <p>
                                    <!-------------Design Your Trip Section-------------------------------->
                                    <!-- flight-land-------------------Start --------------------------------------->
								 <input type="hidden" name="trip_id" id="trip_id"  value="{{$trip_id}}">
								<input type="hidden" name="trip_date" id="trip_date"  value="$tripDetails['date']">
                                <div class="panel panel-primary trip-design-flight">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Select flight or provide your flight's details</strong></h3>
                                        <div class="">
                                            <a href="#" class="updown">
                                                <span class="clickable"><i class="glyphicon glyphicon-chevron-up" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="basic_info_view">   
                                            <div class="form-horizontal">
                                                <!--<div class="form-group pdrow-group">
                                                    <div class="col-sm-9">
                                                        <div class="row flights_heading">
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
                                                </div>-->
                                                <!-- Airline Panel -->
                                                
                                                <?php //echo "<pre>"; print_r($tripDetails['adjustment_date']);die;?>
                                                <div class="panel panel-default" id = "trip_airlines">
                                                    @include('designstrips.partials.design_trip_airlines')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!-- Hotel Panel -->
                                <div class="panel panel-default trip-design-hotel">
                                    @include('designstrips.partials.design_trip_hotels')
                                </div>
                                <br>
                                  <!-- Included Activities Panel -->
                                <div class="panel panel-default trip-design-activity">
                                    @include('designstrips.partials.design_trip_included_activity')
                                </div>
                                  
                                <br>
                                <!-- Addons Panel -->
                                <div class="panel panel-default trip-design-addon">
                                    @include('designstrips.partials.design_trip_addons')
                                </div>
                                <!-----------------------Design  your Trip ends----------------------------------------->
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Section2">
                                <p>
                                    <!-- Trip Todo Panel -->
                                    @include('designstrips.partials.design_trip_todo')
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Section3">
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
                        @endif
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
		$(".addon_travler").hide();
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

			
        $('.selected_addons').click(function () {
            add_on_price = 0;
            $(this).parents('.parent').find('.addon_flight').toggle();
            $(this).parents('.parent').find('.addon_hotel').toggle();
			$(this).parents('.parent').find('.addon_travler').toggle();
			
            $(".addon input[type=checkbox]:checked").each(function () {
                var add_on = $(this).parents('.parent').find('.add_on_cost').val();
				//alert(add_on);
                if (add_on != undefined) {
                    //alert(add_on);
                    add_on_price = parseInt(add_on_price) + parseInt(add_on);
                }
                // code add here//
                addfinalvalue();
                //end here//

            });
				
			 if (this.checked) {
					//alert($('.addon_flight_name').parents('.flightparent').find('.add_on_cost_flight').val());
					}else{
						$(this).parents('.parent').find('.addon_flight_name').attr('checked',false);
						$(this).parents('.parent').find('.selected_addon_hotel').attr('checked',false);
						$(this).parents('.parent').find('.selected_addon_traveler').attr('checked',false);
					}
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
				$(this).parents('.includeactivity').find('.land-only_activity').show();
				$(this).parents('.includeactivity').find('.activity-available-flights').hide();
				$(this).parents('.includeactivity').find('.included_activity_flight').val("");
				$(this).parents('.includeactivity').find('.included_activity_flight').prop('checked', false);
            } else {
                $(this).parents('.includeactivity').find('.land-only_activity').hide();
                $(this).parents('.includeactivity').find('.activity-available-flights').show();
            }
        });
		
		$('.add_on_land-only').click(function () {
         if ($(this).val() == 1)
         {			
			$(this).parents('.addon_flight').find('.add_on_land-onlydetail').show();
			$(this).parents('.addon_flight').find('.addon-available-flights').hide();
			$(this).parents('.addon_flight').find('.addon_flight_name').val("");
			$(this).parents('.addon_flight').find('.addon_flight_name').prop('checked', false);
         } else {
			
			$(this).parents('.addon_flight').find('.add_on_land-onlydetail').hide();
			$(this).parents('.addon_flight').find('.addon-available-flights').show();
			
			}
         });
    
     
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
            //alert($("#is_land_only_activity_flight:checked").val());
            if ($("#is_land_only_activity_flight:checked").val() == 0)
            {

                if ($(".included_activity_flight:checked").val() == undefined)
                {
                    alert('Please select activity flights');
                    return false;
                }
            }
            if ($(".is_land_only_activity_flight:checked").val() == 1)
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
                 $('#Section2').focus();
                 alert('Please select Packing List');
                 return false;
             }
            // end here//
        });
		
	
	
// for customize functionality//
		
		$(".addon input[type=checkbox]:checked").each (function()
		{
				$(this).parents('.parent').find('.addon_flight').toggle();
				$(this).parents('.parent').find('.addon_hotel').toggle();
				$(this).parents('.parent').find('.addon_travler').toggle();
		});	
// end here//			
		
		
		

 });
		
		 // var trip_end_date = $('#trip_end_date').val();
		 // var trip_date = $('#trip_date').val();
		 // alert("trip date"+trip_end_date);
		 
		$('.flightdeparture').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
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
        //Disable trip after adjustment date
        $('#disabled_trip *').attr("disabled", "disabled");
        
		
	/*****Solo upgrade selection functionality for Trip Hotel starts*****/
		
        $('.trip-hotel #is_solo a').each(function () {
            if ($(this).hasClass('active')) {
                hotelCost($(this).data('title'));
            }
        });
		
        $('.trip-hotel #is_solo a').on('click', function () {
            $('.trip-hotel .selected_hotel').prop('checked', false);
            $('.trip-hotel .total_hotel_cost').text('$' + '0')
            var sel = $(this).data('title');
			//alert(sel);
			$('.trip-hotel #yesno').val(sel);
            var tog = $(this).data('toggle');
            $('#' + tog).prop('value', sel);
		    $('.trip-hotel a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
		    $('.trip-hotel a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
            hotelCost(sel);
            //console.log(hotelCost(sel));
        });
	
        $('.trip-hotel .selected_hotel').click(function () {
            var data = {hotel_id: $(this).val()};
            //saveData(data);
            hotelTotalCost($(this));

        });

        function hotelCost(sel) {
            if (sel == 'Y') {
                $('.trip-hotel .hotel_solo_cost').show();
                $('.trip-hotel .hotel_cost').hide();
                var data = {is_solo: '1'};
            } else {
                $('.trip-hotel .hotel_solo_cost').hide();
                $('.trip-hotel .hotel_cost').show();
                var data = {is_solo: '0'};
            }
            // saveData(data);
        }
		
        function hotelTotalCost($this) {
            var costLabel = 'cost';
            $('.trip-hotel #is_solo a').each(function () {
                if ($(this).hasClass('active')) {
                    if ($(this).data('title') == 'Y') {
                        costLabel = 'solo_cost';
                    }
					else {
                        costLabel = 'solo_cost';
                    }
                }
            });
            var cost = $this.closest(".row").find("." + costLabel).text();
            $('.trip-hotel .total_hotel_cost').text('$' + cost)
        }

		/*****Solo upgrade selection functionality for Trip Hotel ends****/
		
		
		/***Solo upgrade selection functionality for Addon Hotel starts*****/
		
		$('.addon_hotel #is_solo a').each(function () {
            if ($(this).hasClass('active')) {
                addonHotelCost($(this).data('title'));
            }
        });
		
		 $('.addon_hotel #is_solo a').on('click', function () {
            $('.addon_hotel .selected_hotel').prop('checked', false);
            $('.addon_hotel .total_hotel_cost').text('$' + '0')
            var sel = $(this).data('title');
            var tog = $(this).data('toggle');
            $('#' + tog).prop('value', sel);
			
			  $('.addon_hotel a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
		      $('.addon_hotel a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
		      addonHotelCost(sel);
			 
			 // $(this).closest($('.addon_hotel a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive'));
			 // $(this).closest($('.addon_hotel a[data-toggle="' + tog + '"][data-title="' + sel + '"]')).removeClass('notActive').addClass('active');
			 // addonHotelCost(sel);
        });
		
	   $('.addon_hotel .selected_hotel').click(function () {
            var data = {hotel_id: $(this).val()};
            //saveData(data);
            addonHotelTotalCost($(this));

        });
		
		 function addonHotelCost(sel) {
            if (sel == 'Y') {
                $('.addon_hotel .hotel_solo_cost').show();
                $('.addon_hotel .hotel_cost').hide();
                var data = {is_solo: '1'};
            } else {
                $('.addon_hotel .hotel_solo_cost').hide();
                $('.addon_hotel .hotel_cost').show();
                var data = {is_solo: '0'};
            }
            // saveData(data);
        }

		function addonHotelTotalCost($this) {
            var costLabel = 'cost';
            $('.addon_hotel #is_solo a').each(function () {
                if ($(this).hasClass('active')) {
                    if ($(this).data('title') == 'Y') {
                        costLabel = 'solo_cost';
                    } else {
                        costLabel = 'solo_cost';
                    }
                }
            });
            var cost = $this.closest(".row").find("." + costLabel).text();
            $('.addon_hotel .total_hotel_cost').text('$' + cost)
        }

		/*******Solo upgrade selection functionality for Addon Hotel ends*****/
		
		
		/***Solo upgrade selection functionality for Activity Hotel starts*****/
		
		$('.activity_hotel #is_solo a').each(function () {
            if ($(this).hasClass('active')) {
                activityHotelCost($(this).data('title'));
            }
        });
		
		 $('.activity_hotel #is_solo a').on('click', function () {
            $('.activity_hotel .selected_hotel').prop('checked', false);
            $('.activity_hotel .total_hotel_cost').text('$' + '0')
            var sel = $(this).data('title');
            var tog = $(this).data('toggle');
			
            $('#' + tog).prop('value', sel);
			$('.activity_hotel a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
			$('.activity_hotel a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
			activityHotelCost(sel);
			// $(this).closest($('.activity_hotel a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]')).removeClass('active').addClass('notActive');
			// $(this).closest($('.activity_hotel a[data-toggle="' + tog + '"][data-title="' + sel + '"]')).removeClass('notActive').addClass('active');
        });
	   $('.activity_hotel .selected_hotel').click(function () {
            var data = {hotel_id: $(this).val()};
            //saveData(data);
            activityHotelTotalCost($(this));

        });
		
		 function activityHotelCost(sel) {
            if (sel == 'Y') {
                $('.activity_hotel .hotel_solo_cost').show();
                $('.activity_hotel .hotel_cost').hide();
                var data = {is_solo: '1'};
            } else {
                $('.activity_hotel .hotel_solo_cost').hide();
                $('.activity_hotel .hotel_cost').show();
                var data = {is_solo: '0'};
            }
            // saveData(data);
        }

		function activityHotelTotalCost($this) {
            var costLabel = 'cost';
            $('.activity_hotel #is_solo a').each(function () {
                if ($(this).hasClass('active')) {
                    if ($(this).data('title') == 'Y') {
                        costLabel = 'solo_cost';
                    } else {
                        costLabel = 'solo_cost';
                    }
                }
            });
            var cost = $this.closest(".row").find("." + costLabel).text();
            $('.activity_hotel .total_hotel_cost').text('$' + cost)
        }

		/*******Solo upgrade selection functionality for Activity Hotel ends*****/
		
		
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
    })();

//To get the fromated date into 'yyyy-mm-dd'
    function formatDate(date) {
        var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }

    
</script>
@endsection