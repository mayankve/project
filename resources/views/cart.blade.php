@extends('layouts.dashboard')

@section('title', 'Cart')

@section('content')



<?php

$tavelerearray = array();

$addonfinal_price = 0;

$addonfinal_price_cost = 0;



//echo $trip_only_amount;											

?>



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

                        <a> Cart    </a>

                    </li>

                </ol>

            </div>

            <div class="col-sm-6 text-right">

                <h3 class="userName">Welcome  {{ Auth::user()->name }}</h3>

            </div>

        </div>

    </div>



    <div class="row text-right">

        <!--<h4><a href="{{url('cart')}}">Checkout this trip</a></h4>-->

    </div>



  

	@if (!empty(session()->get('card_item')))

        <form method="post" id="myForm" >

            <div class="" id="pageWrapper">

                <div id="" class="customtab">

                    <!-- Nav tabs -->



                    <div class="tab-content">

                        <!-- flight-land-------------------Start --------------------------------------->

                        <div role="tabpanel" class="tab-pane active" id="DesignTrip">

                            <input type="hidden" name="trip_id" id="trip_id"  value="<?php echo (!empty(session()->get('card_item'))) ? session()->get('card_item')['trip_id'] : ''; ?>">

                            <div class="panel panel-primary trip-design-flight">

                                <div class="panel-heading">

                                    <h3 class="panel-title"><strong>Trip Flight</strong></h3>

                                    <div class="panel-tools">



                                    </div>

                                </div>

                                <div class="panel-body">

                                    <div class="basic_info_view">   

                                        <div class="form-horizontal">

                                            <div class="form-group pdrow-group">

                                                <div class="col-sm-9">

                                                    <div class="row">



                                                    </div>

                                                </div>

                                            </div>

                                            <!-- Airline Panel -->

                                            <div class="panel panel-default">

                                                <div class="available-flights">

                                                    <div class="form-group pdrow-group">

                                                        <div class="col-sm-12">

                                                            <div class="row">



                                                                <div class="col-sm-2">

                                                                    <b>Airline Name</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Departure Location</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Departure Date</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Departure Time</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Reserve Amount</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Cost</b>

                                                                </div>



                                                            </div>

                                                        </div>

                                                    </div>



                                                    <div class="form-group pdrow-group parent">

                                                        <div class="col-sm-12">

                                                            <div class="row">

                                                                <div class="col-sm-2">

                                                                    <?php echo (count($tripdata['tripAirlines']) > 0) ? $tripdata['tripAirlines'][0]->name : session()->get('card_item')['flight_name']; ?>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <?php echo (count($tripdata['tripAirlines']) > 0) ? $tripdata['tripAirlines'][0]->airline_departure_location : session()->get('card_item')['flight_number']; ?>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <?php echo (count($tripdata['tripAirlines']) > 0) ? $tripdata['tripAirlines'][0]->airline_departure_date : session()->get('card_item')['departure_date']; ?>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <?php echo (count($tripdata['tripAirlines']) > 0) ? $tripdata['tripAirlines'][0]->airline_departure_time : session()->get('card_item')['departure_time']; ?>

                                                                </div>

																<?php  if (count($tripdata['tripAirlines']) > 0){

																	if($tripdata['tripAirlines'][0]->airline_reserve_type==1)

																	{

																	?>

                                                                <div class="col-sm-2">

                                                                    <?php echo (count($tripdata['tripAirlines']) > 0) ? $tripdata['tripAirlines'][0]->airline_reserve_amount*$tripdata['tripAirlines'][0]->airline_our_cost/100 : ''; ?>

                                                                </div>

																<?php }else{?>

																 <div class="col-sm-2">

                                                                    <?php echo (count($tripdata['tripAirlines']) > 0) ? $tripdata['tripAirlines'][0]->airline_reserve_amount : ''; ?>

                                                                </div>

																<?php } } ?>

                                                                <div class="col-sm-2">

                                                                    <?php echo (count($tripdata['tripAirlines']) > 0) ? $tripdata['tripAirlines'][0]->airline_our_cost : ''; ?>

                                                                </div>



                                                                <input type="hidden" name="trip_flight_id" value="<?php echo (count($tripdata['tripAirlines']) > 0) ? $tripdata['tripAirlines'][0]->id : ''; ?>">

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>                                        

                                            </div>                                   

                                        </div>

                                    </div>

                                </div>

                            </div>                  

                        </div>





                        <!-- trip hotel here -->



                        <div role="tabpanel" class="tab-pane active" id="DesignTrip">

                            <div class="panel panel-primary trip-design-flight">

                                <div class="panel-heading">

                                    <h3 class="panel-title"><strong>Trip Hotel</strong></h3>

                                    <div class="panel-tools">



                                    </div>

                                </div>

                                <div class="panel-body">

                                    <div class="basic_info_view">   

                                        <div class="form-horizontal">

                                            <div class="form-group pdrow-group">

                                                <div class="col-sm-9">

                                                    <div class="row">



                                                    </div>

                                                </div>

                                            </div>

                                            <!-- Airline Panel -->

												<?php

                                                    if (count($tripdata['tripHotels']) > 0) {

														//echo session()->get('card_item')['is_solo'];die;

														if(session()->get('card_item')['is_solo']=='Y')

														{															

															$costdisplay='style="display: none;"';

															$solocostdisplay='';

														$is_solo_cost= $tripdata['tripHotels'][0]->hotel_our_solo_cost;

														}else{

															$costdisplay='';

															$solocostdisplay='style="display: none;"';

															$is_solo_cost= $tripdata['tripHotels'][0]->hotel_our_cost;

														}

                                                        ?>

                                            <div class="panel panel-default">

                                                <div class="available-flights">

                                                    <div class="form-group pdrow-group">

                                                        <div class="col-sm-12">

                                                            <div class="row">

                                                                <div class="col-sm-2">

                                                                    <b>Hotel Name</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Type</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Due Date</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Reserve Amount</b>

                                                                </div>

																

                                                                <div class="col-sm-2" <?php echo !empty($costdisplay)?$costdisplay:'';?>>

                                                                    <b>Cost</b>

                                                                </div>



                                                                <div class="col-sm-2" <?php echo !empty($solocostdisplay)?$solocostdisplay:'';?>>

                                                                    <b>Solo Cost</b>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                                                        

                                                        <div class="form-group pdrow-group parent">

                                                            <div class="col-sm-12">

                                                                <div class="row">

                                                                    <div class="col-sm-2">

                                                                        <?php echo!empty($tripdata['tripHotels']) ? $tripdata['tripHotels'][0]->hotel_name : ''; ?>

                                                                    </div>

                                                                    <div class="col-sm-2">

                                                                        <?php echo!empty($tripdata['tripHotels']) ? $tripdata['tripHotels'][0]->hotel_type : ''; ?>

                                                                    </div>

                                                                    <div class="col-sm-2">

                                                                        <?php echo!empty($tripdata['tripHotels']) ? $tripdata['tripHotels'][0]->hotel_due_date : ''; ?>

                                                                    </div>

																	

																	<?php

																	if(!empty($tripdata['tripHotels']))

																	{

																		if($tripdata['tripHotels'][0]->hotel_reserve_type==1)

																		{

																	?>																	

                                                                    <div class="col-sm-2">

                                                                        <?php echo!empty($tripdata['tripHotels']) ? $tripdata['tripHotels'][0]->hotel_reserve_amount*$tripdata['tripHotels'][0]->hotel_our_solo_cost/100 : ''; ?>

                                                                    </div>

																		<?php }else{ ?>

																		 <div class="col-sm-2">

																		<?php echo !empty($tripdata['tripHotels']) ? $tripdata['tripHotels'][0]->hotel_reserve_amount:''; } ?>

																		 </div>

																		 

                                                                    <div class="col-sm-2" <?php echo !empty($costdisplay)?$costdisplay:'';?>>

                                                                        <?php echo !empty($tripdata['tripHotels']) ? $tripdata['tripHotels'][0]->hotel_our_cost : ''; ?>

                                                                    </div>

																	

                                                                    <div class="col-sm-2" <?php echo !empty($solocostdisplay)?$solocostdisplay:'';?>>

                                                                        <?php echo $tripdata['tripHotels'][0]->hotel_our_solo_cost; ?>

                                                                    </div>

																	

																	<?php } ?>

                                                                    <input type="hidden" name="trip_hotel_id" value="<?php echo (count($tripdata['tripHotels']) > 0) ? $tripdata['tripHotels'][0]->id : ''; ?>">

                                                                </div>

                                                            </div>

                                                        </div>

                                                </div>                                        

                                            </div><?php } ?> 

											

                                        </div>

                                    </div>

                                </div>

                            </div>                  

                        </div>



                        <!-- trip hotel here -->

                        <?php  if (!empty($final)) { ?>

                            <div class="panel panel-primary addon-main">

                                <div class="panel-heading">

                                    <h3 class="panel-title"><strong>Add Ons</strong></h3>

                                    <div class="panel-tools">

                                       <!-- <label style="color: black">Total Cost: </label> <label class="total_addon_cost" style="color: black">$<?php //echo $finaladd_on_amount;  ?></label>

                                        <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->

                                    </div>

                                </div>

                                <div class="panel-body">

                                    <div class="basic_info_view">   

                                        <div class="form-horizontal">

                                            <div class="trip-addons">

                                                <div class="form-group">



                                                    <?php

                                                  

                                                    $i = 1;

													//echo '<pre>';print_r($final);die;

                                                    foreach ($final as $key => $value) {

                                                        $addonprice = !empty($value['add_on_detail'])?$value['add_on_detail']->addons_our_cost:'';

														if(is_array($value['flight_data'])){

															$addonflight_price='0';

														}elseif(!empty($value['flight_data']) && $value['flight_data']->airline_reserve_type==1){

															$addonflight_price= $value['flight_data']->airline_reserve_amount*$value['flight_data']->airline_our_cost/100;

														}else{

															$addonflight_price=$value['flight_data']->airline_reserve_amount;

														}

                                                      

														if(!empty($value['hote_data']))

														{
																//echo '<pre>';print_r(session()->get('card_item')['is_solo_addon']);die;	

															if(array_key_exists($value['add_on_detail']->id,session()->get('card_item')['is_solo_addon']))

															{

																//echo 'sfd';die;

																if(session()->get('card_item')['is_solo_addon'][$value['add_on_detail']->id]=='Y')

																{

																	$hotelsolocost=$value['hote_data']->hotel_our_solo_cost;

																	$displayhotel_solo_cost='';

																	$displayhotel_cost='style="display: none;"';

																}else{

																	$hotelsolocost=$value['hote_data']->hotel_our_cost;

																	$displayhotel_solo_cost='style="display: none;"';

																	$displayhotel_cost='';

																}

																

															if($value['hote_data']->hotel_reserve_type==1){

																$addonhote_price = $value['hote_data']->hotel_reserve_amount* $hotelsolocost/100;}else{

																		$addonhote_price=$value['hote_data']->hotel_reserve_amount;

																}

															}

															

														}else{

															$addonhote_price='0';

														}

														

														$addontravler = !empty($value['travler_info']) ? count($value['travler_info']) : '0';

                                                        $addonfinal_price = $addonfinal_price + ($addonprice + $addonflight_price + $addonhote_price) * $addontravler;

                                                        // trip cost detail//

                                                        $addonflight_price_cost = (is_array($value['flight_data'])) ? '0' : !empty($value['flight_data']) ? $value['flight_data']->airline_our_cost : '0';

                                                        $addonhote_price_cost = !empty($value['hote_data']) ? $hotelsolocost : '';

                                                        $addonfinal_price_cost = $addonfinal_price_cost + ($addonprice + $addonflight_price_cost + $addonhote_price_cost) * $addontravler;

                                                        ?> 

                                                        <div class="col-sm-12">

                                                            <div class="row number-group-row parent">

                                                                <div class="addon">



                                                                    <div class="col-sm-3">

                                                                        <?php echo $i; ?>

                                                                    </div>



                                                                    <div class="col-sm-3">

                                                                        <?php echo (!empty($value['add_on_detail'])) ? $value['add_on_detail']->addons_name : ''; ?>

                                                                    </div>

                                                                    <div class="col-sm-3">

                                                                        <?php echo (!empty($value['add_on_detail'])) ? $value['add_on_detail']->addons_detail : ''; ?>

                                                                    </div>

                                                                    <div class="col-sm-3">

                                                                        $<?php echo (!empty($value['add_on_detail'])) ? $value['add_on_detail']->addons_our_cost : ''; ?>

                                                                    </div>

                                                                    <input type="hidden" name="add_on_id[{{$i}}]" value="<?php echo !empty($value['add_on_detail'])?$value['add_on_detail']->id:''; ?>">                  

                                                                </div>

                                                                <div class="row">





                                                                    <div class="panel panel-primary traveler-list">

                                                                        <div class="panel-heading">

                                                                            <h3 class="panel-title"><strong>Travelers list</strong></h3>

                                                                            <div class="panel-tools">                                   

                                                                            </div>

                                                                        </div>

                                                                        <div class="panel-body">

                                                                            <div class="basic_info_view">   

                                                                                <div class="form-horizontal">

                                                                                    <div class="trip-addons">

                                                                                        <div class="form-group pdrow-group">

                                                                                            <div class="col-sm-12">

                                                                                                <div class="row">

                                                                                                    <div class="col-sm-2">

                                                                                                        <label>SN.</label>

                                                                                                    </div>

                                                                                                    <div class="col-sm-5">

                                                                                                        <label>Name</label>

                                                                                                    </div>

                                                                                                    <div class="col-sm-5">

                                                                                                        <label>Gender</label>

                                                                                                    </div>

                                                                                                </div>

                                                                                            </div>

                                                                                        </div>

                                                                                        <?php

                                                                                        $j = 1;
																						//echo '<pre>';print_r($value['travler_info']);
                                                                                        if (!empty($value['travler_info'])) {
																								
                                                                                            foreach ($value['travler_info'] as $travelerkey => $traveler) {

                                                                                                //array_push($tavelerearray, $travelerkey);																										
                                                                                                //$travelere=DB::select('select * from trip_traveler where trip_id='.$trip_id.' and status="1" and id='.$traveler.'');

                                                                                                ?>

                                                                                                <div class="form-group pdrow-group">


                                                                                                    <div class="col-sm-12 travler">

                                                                                                        <div class="row">

                                                                                                            <div class="col-sm-2">

                                                                                                                <?php echo $j; ?>

                                                                                                            </div>

                                                                                                            <div class="col-sm-5">

                                                                                                                <?php echo $traveler->first_name; ?> <?php echo $traveler->last_name; ?>

                                                                                                            </div>

                                                                                                            <div class="col-sm-5">

                                                                                                                <?php echo ($traveler->gender == 1) ? 'Male' : 'Female'; ?>

                                                                                                            </div>



                                                                                                        </div>

                                                                                                        <input type="hidden" name="add_on_traveler_id[{{$i}}][{{$travelerkey}}]" value="<?php echo (!empty($traveler->id)) ? $traveler->id : ''; ?>"> 

                                                                                                    </div>

                                                                                                </div><?php

                                                                                                $j++;

                                                                                            }

                                                                                        }

                                                                                        //print_r($tavelerearray);											

                                                                                        ?>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>







                                                                    <div class="row addon_flight">

                                                                        <div class="panel panel-primary trip-design-flight">

                                                                            <div class="panel-heading">

                                                                                <h3 class="panel-title"><strong>Select flight or provide your flight's details</strong></h3>

                                                                                <div class="panel-tools">



                                                                                </div>

                                                                            </div>

                                                                            <div class="panel-body">

                                                                                <div class="basic_info_view">   

                                                                                    <div class="form-horizontal">

                                                                                        <div class="form-group pdrow-group">

                                                                                            <div class="col-sm-9">

                                                                                                <div class="row">



                                                                                                    <div class="col-sm-6">



                                                                                                    </div>

                                                                                                </div>

                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="addon-available-flights">

                                                                                            <div class="form-group pdrow-group">

                                                                                                <div class="col-sm-12">

                                                                                                    <div class="row">



                                                                                                        <div class="col-sm-2">

                                                                                                            <b>Airline Name</b>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <b>Departure Location</b>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <b>Departure Date</b>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <b>Departure Time</b>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <b>Reserve Amount</b>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <b>Cost</b>

                                                                                                        </div>



                                                                                                    </div>

                                                                                                </div>

                                                                                            </div>

                                                                                            <?php

																							if(!empty($value['flight_data']))

																							{

                                                                                            ?>



                                                                                            <div class="form-group pdrow-group flightparent">

                                                                                                <div class="col-sm-12">

                                                                                                    <div class="row">

                                                                                                        <div class="col-sm-2">

                                                                                                            <?php echo (is_array($value['flight_data'])) ? $value['flight_data'][0] : $value['flight_data']->name; ?>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <?php echo (is_array($value['flight_data'])) ? $value['flight_data'][1] : $value['flight_data']->airline_departure_location; ?>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <?php echo (is_array($value['flight_data'])) ? $value['flight_data'][2] : $value['flight_data']->airline_departure_date; ?>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <?php echo (is_array($value['flight_data'])) ? $value['flight_data'][3] : $value['flight_data']->airline_departure_time; ?>

                                                                                                        </div>

																										

																										<?php if(is_array($value['flight_data']))

																										{																											

																										?>

                                                                                                        <div class="col-sm-2">

                                                                                                            

                                                                                                        </div><?php }elseif($value['flight_data']->airline_reserve_type==1){

																											?>

																										<div class="col-sm-2">

                                                                                                            <?php echo $value['flight_data']->airline_reserve_amount*$value['flight_data']->airline_our_cost/100; ?>

                                                                                                        </div>

																										<?php }else{ ?>

																										<div class="col-sm-2">

                                                                                                            <?php echo $value['flight_data']->airline_reserve_amount; ?>

                                                                                                        </div><?php } ?>

																										

																										

																										

                                                                                                        <div class="col-sm-2">

                                                                                                            <?php echo (is_array($value['flight_data'])) ? '' : $value['flight_data']->airline_our_cost; ?>

                                                                                                        </div>

                                                                                                        <input type="hidden" name="add_on_flight_id[{{$i}}]" value="<?php echo (is_array($value['flight_data'])) ? '' : $value['flight_data']->id; ?>">

                                                                                                    </div>

                                                                                                </div>

                                                                                            </div><?php } ?>



                                                                                        </div>



                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>



                                                                    <div class="row addon_hotel">

                                                                        <div class="panel panel-primary trip-design-hotel">

                                                                            <div class="panel-heading">

                                                                                <h3 class="panel-title"><strong>Hotels</strong></h3>

                                                                                <div class="panel-tools">



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



                                                                                                        </div>



                                                                                                    </div>

                                                                                                </div>

                                                                                            </div>

                                                                                            <div class="form-group pdrow-group">

                                                                                                <div class="col-sm-12">

                                                                                                    <div class="row">



                                                                                                        <div class="col-sm-2">

                                                                                                            <b>Hotel Name</b>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <b>Type</b>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <b>Due Date</b>

                                                                                                        </div>



                                                                                                        <div class="col-sm-2 hotel_solo_cost">

                                                                                                            <b>Reserve Amount</b>

                                                                                                        </div>

																										<div class="col-sm-2 hotel_solo_cost" <?php echo !empty($displayhotel_cost)?$displayhotel_cost:'';?>>

                                                                                                            <b>Cost</b>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2 hotel_solo_cost" <?php echo !empty($displayhotel_solo_cost)?$displayhotel_solo_cost:'';?>>

                                                                                                            <b>Solo Cost</b>

                                                                                                        </div>



                                                                                                    </div>

                                                                                                </div>

                                                                                            </div>

                                                                                            <?php

																							

                                                                                            ?>

                                                                                            <div class="form-group pdrow-group hotleparent">

                                                                                                <div class="col-sm-12">

                                                                                                    <div class="row">

                                                                                                        <div class="col-sm-2">

                                                                                                            <?php echo  !empty($value['hote_data']) ? $value['hote_data']->hotel_name : ''; ?>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <?php echo !empty($value['hote_data']) ? $value['hote_data']->hotel_type : ''; ?>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2">

                                                                                                            <?php echo empty($value['hote_data']) ? '' : ($value['hote_data']->hotel_due_date != '') ? $value['hote_data']->hotel_due_date : ''; ?>

                                                                                                        </div>

						                                                                               <?php

																										if(!empty($value['hote_data']))

																										{

																											if(!empty($value['hote_data']->hotel_reserve_amount) && $value['hote_data']->hotel_reserve_type == 1)

																											{

																									   ?>

                                                                                                        <div class="col-sm-2 hotel_cost" >

                                                                                                            <label>$</label>

                                                                                                            <label class="cost">

                                                                                                                <?php echo !empty($value['hote_data']) ? $value['hote_data']->hotel_reserve_amount*$value['hote_data']->hotel_our_cost / 100 : ''; ?>

                                                                                                            </label>

                                                                                                        </div>

																											<?php }else{ ?> 

																											<div class="col-sm-2 hotel_cost" >

                                                                                                            <label>$</label>

                                                                                                            <label class="cost">

                                                                                                                <?php echo !empty($value['hote_data']) ? $value['hote_data']->hotel_reserve_amount : ''; ?>

                                                                                                            </label>

                                                                                                        </div>

																										<?php } ?>

																										

																										  <div class="col-sm-2 hotel_cost" <?php echo !empty($displayhotel_cost)?$displayhotel_cost:'';?>>

                                                                                                            <label>$</label>

                                                                                                            <label class="cost">

                                                                                                                <?php echo !empty($value['hote_data']) ? $value['hote_data']->hotel_our_cost : ''; ?>

                                                                                                            </label>

                                                                                                        </div>

                                                                                                        <div class="col-sm-2 hotel_cost" <?php echo !empty($displayhotel_solo_cost)?$displayhotel_solo_cost:'';?>>

                                                                                                            <label>$</label> 

                                                                                                            <label class="cost"> <?php echo !empty($value['hote_data']) ? $value['hote_data']->hotel_our_solo_cost : ''; ?></label>

                                                                                                        </div> 

																										<?php }?>

                                                                                                        <input type="hidden" name="add_on_hotel_id[{{$i}}]" value="<?php echo (!empty($value['hote_data'])) ? $value['hote_data']->id : ''; ?>">

                                                                                                    </div>

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

                                                                </div>

                                                            </div>



                                                        </div><?php $i++;

                                                           }

                                                         ?>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>	<?php } ?>





                        <!-- include activity-->



                        <div class="panel panel-primary addon-main">

                            <div class="panel-heading">

                                <h3 class="panel-title"><strong>included Activities</strong></h3>

                                <div class="panel-tools">

                                    <!--<label style="color: black">Total Cost: </label> <label class="total_addon_cost" style="color: black">$0</label>

                                    <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->

                                </div>

                            </div>

                            <div class="panel-body">

                                <div class="basic_info_view">   

                                    <div class="form-horizontal">

                                        <div class="trip-addons">

                                            <div class="form-group">

                                                <?php

												//echo '<pre>';print_r($tripIncludedActivities);die;

                                                $id = 1;

                                                $activityamount = 0;

                                                $activityflightamount = 0;

                                                $activityhotelamount = 0;

                                                $activityflightamount_cost = 0;

                                                $activityhotelamount_cost = 0;

                                                ?>   

                                                @if(!empty($tripIncludedActivities))



                                                @foreach ( $tripIncludedActivities AS $includedActivity)

									<?php $activityamount = $activityamount + $includedActivity['tripIncludedActivities']->activity_our_cost; ?>

                                                <div class="col-sm-12">



                                                    <div class="row number-group-row">

                                                        <div class="col-sm-1">

                                                            {{$id}}     

                                                        </div>

                                                        <div class="col-sm-3">

                                                            {{ isset($includedActivity['tripIncludedActivities']->activity_name) ? $includedActivity['tripIncludedActivities']->activity_name : 'N/A' }}

                                                        </div>

                                                        <div class="col-sm-3">

                                                            {{ isset($includedActivity['tripIncludedActivities']->activity_detail) ? $includedActivity['tripIncludedActivities']->activity_detail : 'N/A' }}

                                                        </div>

                                                        <div class="col-sm-3">

                                                            <label>${{ isset($includedActivity['tripIncludedActivities']->activity_our_cost) ? $includedActivity['tripIncludedActivities']->activity_our_cost : 'N/A' }}</label>

                                                            <label class="addon_cost"> </label>

                                                        </div>

                                                        <!------ Radio button here--------------->

                                                    </div>

                                                    <input type="hidden" name="includedactivity_id[<?php echo $includedActivity['tripIncludedActivities']->id; ?>]" value="<?php echo $includedActivity['tripIncludedActivities']->id; ?>">



                                                    <div class="row">

                                                        <div class="panel panel-primary trip-design-flight">

                                                            <div class="panel-heading">

                                                                <h3 class="panel-title"><strong>Select flight or provide your flight's details</strong></h3>

                                                                <div class="panel-tools">



                                                                </div>

                                                            </div>

                                                            <div class="panel-body">

                                                                <div class="basic_info_view">   

                                                                    <div class="form-horizontal">

                                                                        <div class="form-group pdrow-group">

                                                                            <div class="col-sm-9">

                                                                                <div class="row">



                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                        <div class="addon-available-flights">

                                                                            <div class="form-group pdrow-group">

                                                                                <div class="col-sm-12">

                                                                                    <div class="row">



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



                                                                                    </div>

                                                                                </div>

                                                                            </div>



                                                                            @if(!empty($includedActivity['activity_flight']))

                                                                            <?php

																		if(is_array($includedActivity['activity_flight'])){

																				$reserve_amount='0';

																			}elseif(!empty($includedActivity['activity_flight']) && $includedActivity['activity_flight']->airline_reserve_type==1){

																				$reserve_amount= $includedActivity['activity_flight']->airline_reserve_amount*$includedActivity['activity_flight']->airline_our_cost/100;

																			}else{

																				$reserve_amount=$includedActivity['activity_flight']->airline_reserve_amount;

																			}	

                                                                            $flight_amount_cost = (is_array($includedActivity['activity_flight'])) ? '0' : !empty($includedActivity['activity_flight']) ? $includedActivity['activity_flight']->airline_our_cost : '0';

                                                                            $activityflightamount = $activityflightamount + $reserve_amount;

                                                                            $activityflightamount_cost = $activityflightamount_cost + $flight_amount_cost

                                                                            ?>



                                                                            <div class="form-group pdrow-group">

                                                                                <div class="col-sm-12">

                                                                                    <div class="row">





                                                                                        <div class="col-sm-3">

																		<?php echo (is_array($includedActivity['activity_flight'])) ? $includedActivity['activity_flight'][0] : $includedActivity['activity_flight']->airline_name; ?>



                                                                                        </div>

                                                                                        <div class="col-sm-2">

																		<?php echo (is_array($includedActivity['activity_flight'])) ? $includedActivity['activity_flight'][1] : $includedActivity['activity_flight']->airline_departure_location; ?>



                                                                                        </div>

                                                                                        <div class="col-sm-2">

																		<?php echo (is_array($includedActivity['activity_flight'])) ? $includedActivity['activity_flight'][2] : $includedActivity['activity_flight']->airline_departure_date; ?>



                                                                                        </div>

                                                                                        <div class="col-sm-1">

																		<?php echo (is_array($includedActivity['activity_flight'])) ? $includedActivity['activity_flight'][3] : $includedActivity['activity_flight']->airline_departure_time; ?>



                                                                                        </div>

																						<?php if(is_array($includedActivity['activity_flight'])){?>

                                                                                        

																						<?php }elseif($includedActivity['activity_flight']->airline_reserve_type==1){ ?>

																						<div class="col-sm-1">

																						<?php echo $includedActivity['activity_flight']->airline_reserve_amount*$includedActivity['activity_flight']->airline_our_cost/100; ?>

                                                                                        </div>																						

																						<?php }else{ ?>

																						<div class="col-sm-1">

																						<?php echo $includedActivity['activity_flight']->airline_reserve_amount; ?>

                                                                                        </div><?php } ?>

                                                                                        <div class="col-sm-1">

																		<?php echo (is_array($includedActivity['activity_flight'])) ? '' : $includedActivity['activity_flight']->airline_our_cost; ?>



                                                                                        </div>

                                                                                        <div class="col-sm-1">

                                                                                            <label>

                                                                                                <input type="hidden" name="includedactivity_flight_id[{{$id}}]" value="<?php echo (is_array($includedActivity['activity_flight'])) ? '' : $includedActivity['activity_flight']->id; ?>" >



                                                                                            </label>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                            @endif

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="panel panel-primary trip-design-hotel">

                                                            <div class="panel-heading">

                                                                <h3 class="panel-title"><strong>Hotels</strong></h3>

                                                                <div class="panel-tools">





                                                                </div>

                                                            </div>

															  @if(!empty($includedActivity['activity_hotel']))

																  

                                                        <?php

														//echo $includehotelsolocost=$value['hote_data']->hotel_our_solo_cost;

														//echo '<pre>';print_r(session()->get('card_item')['is_solo_activity']);die;

														if(!empty($includedActivity['activity_hotel']))

															{																

																if(array_key_exists($includedActivity['tripIncludedActivities']->id,session()->get('card_item')['is_solo_activity']))

																{

																	//print_r(session()->get('card_item')['is_solo_activity'][$includedActivity['tripIncludedActivities']->id]);die;

																		if(session()->get('card_item')['is_solo_activity'][$includedActivity['tripIncludedActivities']->id]=='Y')

																		{

																			$includehotelsolocost=$includedActivity['activity_hotel']->hotel_our_solo_cost;

																			$includedisplayhotel_solo_cost='';

																			$includedisplayhotel_cost='style="display: none;"';

																		}else{

																			$includehotelsolocost=$includedActivity['activity_hotel']->hotel_our_cost;

																			$includedisplayhotel_solo_cost='style="display: none;"';

																			$includedisplayhotel_cost='';

																		}

																if($includedActivity['activity_hotel']->hotel_reserve_type==1){

																	$activityhotelreserveamount = $includedActivity['activity_hotel']->hotel_reserve_amount* $includehotelsolocost/100;}else{

																			$activityhotelreserveamount=$includedActivity['activity_hotel']->hotel_reserve_amount;

																	}

																}

																

															}else{

																$activityhotelreserveamount='0';

															}

														$activityhotelamount = $activityhotelamount + $activityhotelreserveamount;

														$activityhotelamount_cost = $activityhotelamount_cost + $includehotelsolocost;

                                                                                ?>

                                                            <div class="panel-body">

                                                                <div class="basic_info_view">   

                                                                    <div class="form-horizontal">

                                                                        <div class="trip-addons">

                                                                            <div class="form-group pdrow-group">

                                                                                <div class="col-sm-12">

                                                                                    <div class="row">

                                                                                        <div class="col-sm-3 text-right">

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                            <div class="form-group pdrow-group">

                                                                                <div class="col-sm-12">

                                                                                    <div class="row">
                                                                                        <div class="col-sm-3">

                                                                                            <b>Hotel Name</b>

                                                                                        </div>

                                                                                        <div class="col-sm-2">

                                                                                            <b>Type</b>

                                                                                        </div>

                                                                                        <div class="col-sm-2">

                                                                                            <b>Due Date</b>

                                                                                        </div>

                                                                                        <div class="col-sm-1">

                                                                                            <b>Reserve Amount</b>

                                                                                        </div>

                                                                                        <div class="col-sm-1" <?php echo !empty($includedisplayhotel_cost)?$includedisplayhotel_cost:'';?>>

                                                                                            <b>Cost</b>

                                                                                        </div>

                                                                                        <div class="col-sm-1 hotel_solo_cost" <?php echo !empty($includedisplayhotel_solo_cost)?$includedisplayhotel_solo_cost:'';?>>

                                                                                            <b>Solo Cost</b>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            </div>



                                                                            <div class="form-group pdrow-group">                                                                             

                                                                                <div class="form-group pdrow-group">

                                                                                    <div class="col-sm-12">

                                                                                        <div class="row">
                                                                                            <div class="col-sm-3">

                                                                                                {{ isset($includedActivity['activity_hotel']->hotel_name) ? $includedActivity['activity_hotel']->hotel_name : 'N/A' }}

                                                                                            </div>

                                                                                            <div class="col-sm-2">

                                                                                                {{ isset($includedActivity['activity_hotel']->hotel_type) ? $includedActivity['activity_hotel']->hotel_type : 'N/A' }}

                                                                                            </div>

                                                                                            <div class="col-sm-2">

                                                                                                {{ isset($includedActivity['activity_hotel']->hotel_due_date) ? $includedActivity['activity_hotel']->hotel_due_date : 'N/A' }}

                                                                                            </div>

																							

																						@if($includedActivity['activity_hotel']->hotel_reserve_type==1)

                                                                                            <div class="col-sm-1">

                                                                                               <?php echo $includedActivity['activity_hotel']->hotel_reserve_amount*$includedActivity['activity_hotel']->hotel_our_cost/100;?>

                                                                                            </div>

																								@else																								

																							<div class="col-sm-1">

                                                                                                {{ isset($includedActivity['activity_hotel']->hotel_reserve_amount) ? $includedActivity['activity_hotel']->hotel_reserve_amount : 'N/A' }}

                                                                                            </div>

																								@endif

                                                                                            <div class="col-sm-1" <?php echo !empty($includedisplayhotel_cost)?$includedisplayhotel_cost:'';?>>

                                                                                                {{ isset($includedActivity['activity_hotel']->hotel_our_cost) ? $includedActivity['activity_hotel']->hotel_our_cost : 'N/A' }}

                                                                                            </div>

                                                                                            <div class="col-sm-1" <?php echo !empty($includedisplayhotel_solo_cost)?$includedisplayhotel_solo_cost:'';?>>

                                                                                                {{ isset($includedActivity['activity_hotel']->hotel_our_solo_cost) ? $includedActivity['activity_hotel']->hotel_our_solo_cost : 'N/A' }}

                                                                                            </div>

                                                                                        </div>

                                                                                        <input type="hidden" name="includedactivity_hotel_id[{{$id}}]" value="{{$includedActivity['activity_hotel']->id}}">

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

															 @endif

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

										<?php $id++; ?>

                                            @endforeach

                                            @endif

                                        </div>

                                    </div>

                                </div>

                                <?php

								// reserve code detail//

                                $addontravelerarryacount = count($tavelerearray);

								if(count($tripdata['tripAirlines']) > 0)	{

									if($tripdata['tripAirlines'][0]->airline_reserve_type==1){

										$trip_flight_amount=$tripdata['tripAirlines'][0]->airline_reserve_amount*$tripdata['tripAirlines'][0]->airline_our_cost/100;

									}else{

										$trip_flight_amount=$tripdata['tripAirlines'][0]->airline_reserve_amount;

									}								

								}else{

									$trip_flight_amount='0';

								}

								if(count($tripdata['tripHotels']) > 0){

									if($tripdata['tripHotels'][0]->hotel_reserve_type==1){

										$trip_hotel_amount=$tripdata['tripHotels'][0]->hotel_reserve_amount*$is_solo_cost/100;

									}else{

										 $trip_hotel_amount=$tripdata['tripHotels'][0]->hotel_reserve_amount;

									}

								}else{

									$trip_hotel_amount='0';

								}

                               

							//echo $trip_hotel_amount;

                                $trip_traveler = (count($tripdata['tripTravelers']) > 0) ? count($tripdata['tripTravelers']) : '';

							// trip amount add//

                                $trip_only_amount = ($trip_flight_amount + $trip_hotel_amount) * $trip_traveler;

							// end here//

								// includeactivity amount add//



                                $includedactivity = ($activityamount + $activityflightamount + $activityhotelamount) * $trip_traveler;

							// end here//

                                $final_trip_amount_reserve = $trip_only_amount + $addonfinal_price + $includedactivity;





								// start here cost amount//

                                $trip_flight_cost = (count($tripdata['tripAirlines']) > 0) ? $tripdata['tripAirlines'][0]->airline_our_cost : '0';

                                $trip_hotel_cost = (count($tripdata['tripHotels']) > 0) ? $is_solo_cost : '0';

                                $trip_only_cost = ($trip_flight_cost + $trip_hotel_cost) * $trip_traveler;

							//	echo $activityhotelamount_cost;die;

                                $includedactivity_cost = ($activityamount + $activityflightamount_cost + $activityhotelamount_cost) * $trip_traveler;

                                $final_trip_amount_cost = $trip_only_cost + $addonfinal_price_cost + $includedactivity_cost;

								// end here//

								//check emi calculation//

                                $paidamount = 0;
								//echo '<pre>';print_r($tripdata['payment_data']);die;
                                if (!empty($tripdata['payment_data'])) {

                                    foreach ($tripdata['payment_data'] as $paymentitem) {

                                        $paidamount = $paidamount + $paymentitem->reserve_paid_amount;

                                    }

                                }



                                $adjustmentdate = strtotime(!empty($tripdata['trip_data']) ? $tripdata['trip_data']->adjustment_date : '');

                                $currentdate = strtotime(date('Y-m-d'));

                                if ($adjustmentdate > date('y-m-d')) {

                                    $days_between = ceil(abs($adjustmentdate - $currentdate) / 86400);

                                }

								//else{

								//    $days_between = ceil(abs($currentdate - $adjustmentdate) / 86400);

								//}

								//echo $days_between;die;

                                if ($days_between < 31) {
				
                                   $finalcost = $final_trip_amount_cost;

                                    if ($paidamount > $finalcost) {

										$finalamount = $finalcost - $paidamount;

                                        $message = "You will be refunded $" . abs($finalamount) . "";

                                    } elseif ($finalcost > $paidamount) {										

                                        $finalamount = $finalcost - $paidamount;

                                        $message = "You have to pay $" . $finalamount . "";

                                    } else {

                                        $finalamount = 0;

                                        $message = "There is nothing to pay";

                                    }

                                } else {
							//echo $paidamount;die;
											
                                   $basecost = $tripdata['trip_data']->base_cost;

                                    $paybale_amount = ($basecost * $trip_traveler) + $final_trip_amount_reserve;

                                   $finalamount = $paybale_amount - $paidamount;



                                    //emi calculation //

                                    $totalbasecost = $final_trip_amount_cost + ($basecost * $trip_traveler);

                                    if ($paidamount > $totalbasecost) {

                                        $refund_amount = $paidamount - $totalbasecost;

                                        $message = "You will be refunded $" . abs($refund_amount) . "";

                                    } elseif ($totalbasecost > $paidamount) {

                                        $numberofmonth = round($days_between / 30);

                                        $result = $totalbasecost - $paidamount;

                                        $emi = $result / $numberofmonth;

                                        $message = "Your Per month emi amount is $" . $emi . "";

                                    } else {

                                        $message = "There is nothing to pay";

                                    }

                                }

//echo $finalcheck;die;

                                ?>

                            </div>

                        </div>

					<div class="row">
                        <div class="col-sm-6">
                            <div class="update-btn">
                                <div class="panel-tools">
                                    <label style="color: black">Trip Reserve Cost: </label>
                                    <label class="total_addon_cost" style="color: black">${{$trip_only_amount}}</label></br>
                                    <label style="color: black">Add on Reserve Cost: </label>
                                    <label class="total_addon_cost" style="color: black">${{$addonfinal_price}}</label></br>
                                    <label style="color: black">Included Activity Reserve Cost: </label>
                                    <label class="total_addon_cost" style="color: black">${{$includedactivity}}</label></br>
                                    <label style="color: black">Total Reserve Cost: </label>
                                    <label class="total_addon_cost" style="color: black">${{$final_trip_amount_reserve}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 text-right">
                            <div class="update-btn">
                                <div class="panel-tools">
                                    <label style="color: black">Trip Cost: </label>
                                    <label class="total_addon_cost" style="color: black">${{$trip_only_cost}}</label></br>
                                    <label style="color: black">Add on Cost: </label>
                                    <label class="total_addon_cost" style="color: black">${{$addonfinal_price_cost}}</label></br>
                                    <label style="color: black">Included Activity Cost: </label>
                                    <label class="total_addon_cost" style="color: black">${{$includedactivity_cost}}</label></br>
                                    <label style="color: black">Total Cost: </label>
                                    <label class="total_addon_cost" style="color: black">${{$final_trip_amount_cost}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
					<div>
					<?php //echo $finalamount;die;?>
					@if (!empty($tripIncludedActivities) && $finalamount > 0) 
						<button type="button" id="checkout"  name="checkout">Process to Checkout</button>
					@else
					<button type="button" id="processtoemi"  name="checkout">Process to Checkout</button>
					@endif
						<a href="javascript:history.back()" id="editcart">Edit Cart</a>	
					</div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="resever_pay_amount" value="{{$finalamount}}">
        </form>	
		@else 
        <h1>CART IS EMPTY</h1>		
		@endif






    <!-- here is model popup for Emi detail for this trip-->



    <!-- paymenet detail-->
<?php
	$paypalUrl='https://www.sandbox.paypal.com/cgi-bin/webscr';
	$paypalId='testve@yopmail.com';
?>
<form action="https://mukesh.recurly.com/subscribe/987542">
    <div class="modal" id="myModal12" role="dialog">
        <div class="modal-dialog">  
            <div class="modal-content" style=" width: 764px;margin-left: -69px;">
                <div class="modal-body">
                    <h4 class="modal-title">Payment Detail</h4>
                    <div class="dashboardHeader" style="padding: 29px 13px 9px 43px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="cust-input-group">
                                    <label><span>Trip Name : <?php echo!empty($tripdata['trip_data']) ? $tripdata['trip_data']->name : ''; ?></span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cust-input-group">
                                    <label><span>Trip date : <?php echo!empty($tripdata['trip_data']) ? $tripdata['trip_data']->date : ''; ?></span></label>
                                </div>
                            </div>
                        </div>
				<div class="row">
						<div class="col-md-6">
                                <div class="cust-input-group">
                                    <label><span>Payable Amount : $<?php echo!empty($finalamount) ? $finalamount : ''; ?></span></label>
                                </div>
                            </div>							
							<div class="col-md-6">
                                <div class="cust-input-group">
                                    <label><span>Emi payment date  : 5th of each month</span></label>
                                </div>
                            </div>							
                      </div>                    
					 <div class="row">
                            <div class="col-md-6">
                                <div class="cust-input-group">
                                     <label><span>No of Emi Months : <?php echo!empty($numberofmonth) ? $numberofmonth : '0'; ?></span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cust-input-group">
                                  <label><span>Emi amount : $<?php echo!empty($emi) ? $emi : '0'; ?></span></label>
                                </div>
                            </div>
                        </div>						
						</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="paynow" class="btn btn-default" >Pay Now</button>
                </div>
            </div>
        </div>
    </div>
</form>
	
	
	

    <!-- end here-->
    <!-- emi calculation detail-->
   <div class="modal" id="emi_model" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style=" width: 764px;margin-left: -69px;">
                <div class="modal-body">
                    <h4 class="modal-title">Payment Information</h4> <br><b><?php echo $message; ?></b>
                    <div class="dashboardHeader" style="padding: 29px 13px 9px 43px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="cust-input-group">
                                    <label><span>Trip date : <?php echo!empty($tripdata['trip_data']) ? $tripdata['trip_data']->date : ''; ?></span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cust-input-group">
                                    <label><span>No of Emi Months : <?php echo!empty($numberofmonth) ? $numberofmonth : '0'; ?></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="cust-input-group">
                                    <label><span>Emi amount : $<?php echo!empty($emi) ? $emi : '0'; ?></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cust-input-group">
                                    <label><span>Emi payment date  : 5th of each month</span></label>
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end here..-->
</div> 



<script>

    $(document).ready(function () {


        var action = "{{url('checkout')}}";

        var form = $("#myForm");

        $('#checkout').click(function ()
        {
            $.ajax({

                type: "POST",

                url: action,

                data: form.serialize(),

                success: function (response) {

                    if (response == 'paymentdone')

                    {

                        //$("#myModal12").modal('hide');

                        $('#editcart').hide();

                        $('#checkout').hide();

                        $("#myModal12").modal({backdrop: "static"});

                    }

                }

            });

        });

		

	$('#processtoemi').click(function(){

		var actionemi="{{url('emi-calculation')}}";

			 $.ajax({

                type: "POST",

                url: actionemi,

                data: form.serialize(),

                success: function (response1) {

				 if (response1 == 'Emidataupdate')

                    {

                        $("#emi_model").modal({backdrop: "static"});

                    }

                }

            });	

	});	

       $('#close').click(function ()

        {

            var url = "{{url('dashboard')}}";

            location.href = url;

        });



// <?php if ($finalamount <= 0) {

    // ?>

            // setTimeout(function () {

                // $("#emi_model").modal({backdrop: "static"});

            // }, 5000);

// <?php } ?>



    });



</script>



@endsection