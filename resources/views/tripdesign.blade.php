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
                        <a>  Design your Trip    </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">Welcome  {{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>
<!--    <svg class="hidden">
    <defs>
    <path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"></path>
    </defs>
    </svg>-->

<!--    <input type="hidden" id="ajax_url" name="ajax_url" value="/dashboard/my-trips/ajax/12">
    <input type="hidden" id="ajax_todo_url" name="ajax_todo_url" value="/dashboard/my-trips/ajax-todo/12">-->

    <div class="row text-right">
        <h4><a href="{{url('cart')}}">Checkout this trip</a></h4>
    </div>
	<form method="post" action="{{url('setcartvalue')}}">
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
                </div>
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" class="traveler_count" name="travelercount" value="<?php echo count($tripdata['tripTravelers']);?>"> 
					<input type="hidden" class="trip_flight_id" name="trip_flight_id" value="">
					<input type="hidden" class="trip_hotel_amount" name="trip_hotel_amount" value="">
					<input type="hidden" class="trip_hotle_id" name="trip_hotle_id" value="">
					<input type="hidden" class="final_add_amount" name="final_add_amount" value="">
					<div class="row">
					<div class="col-sm-12">
					<input type="submit" name="button" id="cartbutton" value="save">
					</div>
					</div>
				</form>
                <div role="tabpanel">
                    <!-- Trip Todo Panel -->
                    <div class="panel panel-default">
                        @include('designstrips.partials.design_trip_todo')
                    </div> 
                </div>
                <div role="tabpanel">
                     <!-- Trip Travelers Panel -->
                    <div class="panel panel-default">
                        @include('designstrips.partials.design_trip_traveler')
                    </div> 
                </div>
            </div>
        </div>
    </div>


	
</div>



<script>
$(document).ready(function(){
	
	//hide hotel and flight of addon//
	$(".addon_flight").hide();
	$(".addon_hotel").hide();
	// here end//
	// var addon_id=[];
	// var traveler_id=[];
	var final_price=0;
	var add_on_price=0;
	var add_flight_price=0;
	var add_hotle_price=0;
	
	if($('input[name="selected_hotel"]:checked').val()!='')
	{
		var travlercont=$('.traveler_count').val();
		//alert(travlercont);
		var reserveramount= $('input[name="selected_hotel"]:checked').parents('.parent').find('.reserver_amount').val();		
		$('.total_hotel_cost').html("$" +reserveramount*travlercont);
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
			

	$('.selected_addons').click(function(){
		 add_on_price=0;
			//alert('Please select flight and hotels for addon');			
			$(this).parents('.parent').find('.addon_flight').toggle();
			$(this).parents('.parent').find('.addon_hotel').toggle();	
			
			//var flightchecked=	$(this).parents('.parent').find('.addon_flight_name').attr('checked', true);
				 $(".addon input[type=checkbox]:checked").each(function() {
						
							//addon_id.push($(this).parents('.parent').find('.selected_addons').val());										
						
						var add_on = $(this).parents('.parent').find('.add_on_cost').val();						
						if(add_on!=undefined){
							//alert(add_on);
							add_on_price=parseInt(add_on_price)+parseInt(add_on);
						}
						
						// code add here//
						addfinalvalue();
						//end here//
						
					});				
				
		});		
		 $('.addon_flight_name').click(function(){			 
				add_flight_price=0;
				 $(".parent input[type=radio]:checked").each(function() {
						var value = $(this).parents('.flightparent').find('.add_on_cost_flight').val(); //$(this).val();
						
						if(value!=undefined){
							//alert(value+"sfdsdfds");
							add_flight_price=parseInt(add_flight_price)+parseInt(value);
						}
					addfinalvalue();	
					});	
		 });				
		$('.selected_addon_hotel').click(function(){
				add_hotle_price=0;
				
				 $(".parent input[type=radio]:checked").each(function() {
						var hotel_price = $(this).parents('.hotleparent').find('.add_on_cost_hotel').val(); //$(this).val();
						
						if(hotel_price!=undefined){
							//alert(hotel_price);
							add_hotle_price=parseInt(add_hotle_price)+parseInt(hotel_price);
						}
					addfinalvalue();	
					});
		});	
		
function addfinalvalue(){	
	final_price=parseInt(add_on_price)+parseInt(add_flight_price)+parseInt(add_hotle_price);
	$('.total_addon_cost').html("$"+final_price);
	$('.final_add_amount').val(final_price);	
}

// form submit here//

$('#cartbutton').click(function(){
	var ckbox= $('#selected_addons');
	//alert($( "input[type=checkbox][name=is_land_only]:checked" ).val());
	if($( "input[type=radio][name=is_land_only]:checked" ).val()==0)
	{		
		if($( "input[type=radio][name=flight_id]:checked" ).val()==undefined)
		{
			alert('Please select Flights');
			return false;
		}		
	}if($( "input[type=radio][name=is_land_only]:checked" ).val()==1)
	{		
		if($( "input[type=text][name=flight_name]" ).val()=='')
		{
			alert('Please Enter Flight Name');
			return false;
		}
		if($( "input[type=text][name=flight_number]" ).val()=='')
		{
			alert('Please Enter Flight Number');
			return false;
		}
		if($( "input[type=text][name=departure_date]" ).val()=='')
		{
			alert('Please Enter Departure Date');
			return false;
		}
		if($( "input[type=text][name=departure_time]" ).val()=='')
		{
			alert('Please Enter Departure Time');
			return false;
		}
		
	}
	
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