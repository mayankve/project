@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
<style>
    /* Style the tab */
    div.tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    div.tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    div.tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    div.tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
        border-bottom: none;
    }
    .tabcontent {
        -webkit-animation: fadeEffect 1s;
        animation: fadeEffect 1s; /* Fading effect takes 1 second */
    }

    @-webkit-keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    @keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
    }
</style>
<?php
$padiamountbyuser=0;
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

                        <a class="desh-title" href="{{url('dashboard')}}">Dashboard</a>

                    </li>

                    <li class="active">

                        <a> Trip Details    </a>

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



  

	@if (!empty($tripdata['trip_detail']))
		
	<?php //echo $tripdata['trip_detail'];die;?>

        <form method="post" id="myForm" >

            <div class="" id="pageWrapper">

                <div id="" class="customtab">

                    <!-- Nav tabs -->



                    <div class="tab-content">

                        <!-- flight-land-------------------Start --------------------------------------->

                        <div role="tabpanel" class="tab-pane active" id="DesignTrip">

                           

                            <div class="panel panel-primary trip-design-flight">

                                <div class="panel-heading">

                                    <h3 class="panel-title"><strong>Trip Detail</strong></h3>

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

                                                                    <b>Trip Name</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Base Cost</b>

                                                                </div>
																
																<div class="col-sm-2">

                                                                    <b>Flight Name</b>

                                                                </div>
																
																<div class="col-sm-2">

                                                                    <b>Departure Date</b>

                                                                </div>
																
																
																<div class="col-sm-2">

                                                                    <b>Hotel Name</b>

                                                                </div>

                                                               
																
																 <div class="col-sm-1">

                                                                    <b>Trip traveler</b>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>



                                                    <div class="form-group pdrow-group parent">

                                                        <div class="col-sm-12">

                                                            <div class="row">

                                                                <div class="col-sm-2">
																
																{{$tripdata['trip_detail']->name}}
																
                                                                   

                                                                </div>

                                                                <div class="col-sm-2">
																	${{$tripdata['trip_detail']->base_cost}}
                                                                   

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    	<?php echo (is_array($tripdata['flight_data'])) ? $tripdata['flight_data']['flight_name'] : $tripdata['flight_data']->name; ?>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <?php echo (is_array($tripdata['flight_data'])) ? $tripdata['flight_data']['flight_departure_date'] : $tripdata['flight_data']->airline_departure_date; ?>

                                                                </div>
																  <div class="col-sm-2">
                                                                    {{$tripdata['hotel_data']->hotel_name}}


                                                                </div>
																 
																<div class="col-sm-1">

                                                                  {{count($tripdata['traveler_detail'])}}

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

                        </div>


                        <!-- trip hotel here -->

                        <div role="tabpanel" class="tab-pane active" id="DesignTrip">

                           

                            <div class="panel panel-primary trip-design-flight">

                                <div class="panel-heading">

                                    <h3 class="panel-title"><strong>Add On Detail</strong></h3>

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

                                                                    <b>Addon Name</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b> Base Cost</b>

                                                                </div>
																
																<div class="col-sm-2">

                                                                    <b>Flight Name</b>

                                                                </div>
																
																<div class="col-sm-3">

                                                                    <b>Departure Date</b>

                                                                </div>
																
																
																<div class="col-sm-3">

                                                                    <b>Hotel Name</b>

                                                                </div>


                                                            </div>

                                                        </div>

                                                    </div>

													@if(count($tripdata['selected_add_on']))
														@foreach($tripdata['selected_add_on'] as $addonvalue)
													<?php
														$addonflight= DB::table('trip_addon_airline')
																		->join('airlines', 'trip_addon_airline.airline_name', '=', 'airlines.id')
																		->where('trip_addon_airline.trip_id', '=', $addonvalue->trip_id)
																		->where('trip_addon_airline.addon_id', '=', $addonvalue->add_on_id)
																		->where('trip_addon_airline.status', '=', '1')
																		->where('airlines.id', '=', $addonvalue->flight_id)
																		->get();
														$addonhotel= DB::table('trip_addon_hotel')
																	->where('trip_id', '=', $addonvalue->trip_id)
																	->where('id', '=', $addonvalue->hotel_id)
																	->where('status', '=', '1')
																	->get();

														//echo (count($addonflight)>0)?$addonflight[0]->name:'pankaj';					
													?>

                                                    <div class="form-group pdrow-group parent">

                                                        <div class="col-sm-12">

                                                            <div class="row">

                                                                <div class="col-sm-2">
																
																{{$addonvalue->addons_name}}
																
                                                                   

                                                                </div>

                                                                <div class="col-sm-2">
																	${{$addonvalue->addons_our_cost}}
                                                                   

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    	<?php echo (count($addonflight)>0) ? $addonflight[0]->name : $addonvalue->flight_name; ?>

                                                                </div>

                                                                <div class="col-sm-3">
																		<?php echo (count($addonflight)>0) ? $addonflight[0]->airline_departure_date : $addonvalue->flight_departure_date; ?>
                                                                  

                                                                </div>
																  <div class="col-sm-3">
                                                                    <?php echo (count($addonhotel)>0) ? $addonhotel[0]->hotel_name : ''; ?>


                                                                </div> 

																

                                                            </div>

                                                        </div>

                                                    </div>
													@endforeach
													@endif
													
													
                                                </div>                                        

                                            </div>                                   

                                        </div>

                                    </div>

                                </div>

                            </div>                  

                        </div>


				<div role="tabpanel" class="tab-pane active" id="DesignTrip">                          

                            <div class="panel panel-primary trip-design-flight">

                                <div class="panel-heading">

                                    <h3 class="panel-title"><strong>Activity Detail</strong></h3>

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

                                                                    <b>Activity Name</b>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                    <b>Cost</b>

                                                                </div>
																
																<div class="col-sm-2">

                                                                    <b>Flight Name</b>

                                                                </div>
																
																<div class="col-sm-2">

                                                                    <b>Departure Date</b>

                                                                </div>
																
																
																<div class="col-sm-2">

                                                                    <b>Hotel Name</b>

                                                                </div>

                                                               

                                                            </div>

                                                        </div>

                                                    </div>


												@if(count($tripdata['selected_activity']))
													@foreach($tripdata['selected_activity'] as $activity)
												<?php
												
												
														$activityflight= DB::table('trip_included_activity_airline')
																		->join('airlines', 'trip_included_activity_airline.airline_name', '=', 'airlines.id')
																		->where('trip_included_activity_airline.airline_departure_date', '>', date('Y-m-d'))
																		->where('trip_included_activity_airline.trip_id', '=', $activity->trip_id)
																		->where('trip_included_activity_airline.activity_id', '=', $activity->activity_id)
																		->where('trip_included_activity_airline.id', $activity->activity_flight_id)
																		->where('trip_included_activity_airline.status', '=', '1')
																		->get();
																		
														$activityhotel= DB::table('trip_included_activity_hotel')
																				->where('trip_id', '=', $activity->trip_id)
																				->where('hotel_due_date', '>', date('Y-m-d'))
																				->where('activity_id', '=', $activity->activity_id)
																				->where('id', $activity->activity_hotel_id)
																				->where('status', '=', '1')
																				->get();

														//echo '<pre>';print_r($activityflight);				
													?>
                                                    <div class="form-group pdrow-group parent">

                                                        <div class="col-sm-12">

                                                            <div class="row">

                                                                <div class="col-sm-2">
																
																{{$activity->activity_name}}
																
                                                                   

                                                                </div>

                                                                <div class="col-sm-2">
																	${{$activity->activity_our_cost}}
                                                                   

                                                                </div>
															<div class="col-sm-2">

                                                                   <?php echo (count($activityflight)>0) ? $activityflight[0]->name : $activity->flight_name; ?>

                                                                </div>

                                                                <div class="col-sm-2">

                                                                      <?php echo (count($activityflight)>0) ? $activityflight[0]->airline_departure_date : $activity->flight_departure_date; ?>

                                                                </div>
																  <div class="col-sm-2">
                                                                     <?php echo (count($activityhotel)>0) ? $activityhotel[0]->hotel_name : ''; ?>


                                                                </div>			
                                                                
																 
                                                            </div>
                                                        </div>
                                                    </div>
													@endforeach
													@endif
													

                                                </div>                                        

                                            </div>                                   

                                        </div>

                                    </div>

                                </div>

                            </div>              

                        </div> 
						
						
						
						
						<div role="tabpanel" class="tab-pane active" id="DesignTrip">                          

                            <div class="panel panel-primary trip-design-flight">

                                <div class="panel-heading">

                                    <h3 class="panel-title"><strong>Paid Amount</strong></h3>

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
                                                                <div class="col-sm-4">

                                                                    <b>Amount</b>

                                                                </div>

                                                                <div class="col-sm-4">

                                                                    <b>Transaction Id</b>

                                                                </div>
																
																<div class="col-sm-4">

                                                                    <b>Transaction Date</b>

                                                                </div>
																
                                                            </div>

                                                        </div>

                                                    </div>


												@if(count($tripdata['paidamount']))
													
													@foreach($tripdata['paidamount'] as $paidamount)
													<?php $padiamountbyuser= $padiamountbyuser+$paidamount->reserve_paid_amount;?>
                                                    <div class="form-group pdrow-group parent">

                                                        <div class="col-sm-12">

                                                            <div class="row">

                                                                <div class="col-sm-4">
																
																${{$paidamount->reserve_paid_amount}}
																
                                                                   

                                                                </div>

                                                                <div class="col-sm-4">
																	{{$paidamount->txn_id}}
                                                                   

                                                                </div>
																
																 <div class="col-sm-4">
																	{{$paidamount->create_date}}
                                                                   

                                                                </div>

                                                                
                                                                </div>
																 
                                                            </div>
                                                        </div>
                                                   
													@endforeach
													@endif
													

                                                </div>                                        

                                            </div>                                   

                                        </div>

                                    </div>

                                </div>

                            </div>              

                        </div> 
						
						
						<div class="row">
							<div class="col-sm-12">
								<div class="update-btn">
									<div class="panel-tools">
										<label style="color: black">Total Paid Amount: </label>
										<label class="total_addon_cost" style="color: black">${{$padiamountbyuser}}</label></br>
										
									</div>
								</div>
							</div>	
							
                      </div>
						<?php
						if(!empty($tripdata['trip_detail']->trip_total_cost))
						{
							
							 $adjustmentdate = strtotime(!empty($tripdata['trip_detail']) ? $tripdata['trip_detail']->adjustment_date : '');

                                $currentdate = strtotime(date('Y-m-d'));

                                if ($adjustmentdate > date('y-m-d')) {
                                    $days_between = ceil(abs($adjustmentdate - $currentdate) / 86400);
                                }
								
							$totalbasecost=$tripdata['trip_detail']->trip_total_cost;
							if($days_between > 31)
							{
								
								if ($padiamountbyuser > $totalbasecost) {

											$refund_amount = $padiamountbyuser - $totalbasecost;
											echo $message = "You will be refunded $" . abs($refund_amount) . "";
									} elseif ($totalbasecost > $padiamountbyuser) {
											$numberofmonth = round($days_between / 30);
											$result = $totalbasecost - $padiamountbyuser;
											$emi = $result / $numberofmonth;
											//echo $message = "<b>Your Per month emi amount is $" . $emi . "</b>";
										} else {
											echo $message = "<b>There is nothing to pay</b>";

										}
							}
						if(!empty($emi))
							{
							?>
						<div class="row">							
							<div class="col-sm-6">
								<div class="update-btn">
									<div class="panel-tools">
										<label style="color: black">Per Month Emi: </label>
										<label class="total_addon_cost" style="color: black">$<?php echo !empty($emi)?$emi:'';?></label></br>
										
									</div>
								</div>
							</div>					
						</div>
					  <div class="row">						
							<div class="col-sm-12">
								<div class="update-btn">
									<div class="panel-tools">
										<label style="color: black">Emi Date: </label>
										<label class="total_addon_cost" style="color: black">5th of each month</label></br>
										
									</div>
								</div>
							</div>	
					  </div>
					<div class="row">						
							<div class="col-sm-12">
								<div class="update-btn">
									<div class="panel-tools">
										<label style="color: black">No of Emi month: </label>
										<label class="total_addon_cost" style="color: black"><?php echo !empty($numberofmonth)?$numberofmonth:'';?></label></br>
										
									</div>
								</div>
							</div>
                      </div>
					  
					  <div class="row">						
							<div class="col-sm-12 text-right">
								<div class="update-btn">
									<div class="panel-tools">
										<button type="button"  data-toggle="modal" data-target="#myModal12" data-backdrop="static" id="checkout"  name="checkout">Pay Now</button>										
									</div>
								</div>
							</div>
                      </div>
						<?php } }?>
						
					
                    </div>
                </div>
            </div>
           
        </form>


<div class="modal" id="myModal12" role="dialog">
        <div class="modal-dialog">
		<form method="post" action="{{url('pay_ahead/'.$tripdata['trip_detail']->trip_id)}}">
            <div class="modal-content" style=" width: 764px;margin-left: -69px;">
                <div class="modal-body">
                    <h4 class="modal-title">Payment Detail</h4>
                    <div class="dashboardHeader" style="padding: 29px 13px 9px 43px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cust-input-group">
                                    <label><span>Payble Amount : <?php echo !empty($emi)?$emi:'';?></span></label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cust-input-group">
                                   <input type="number" name="payahead" id="payahead" min="1" class="form-control" value="<?php echo !empty($emi)?$emi:'';?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="paynow" class="btn btn-default" >Pay Now</button>
                </div>
            </div>
			 <input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
        </div>
  </div>

		
		@else 
        <h3>Trip Base cost paid only.</h3>		
		@endif
		
 

</div> 
@endsection