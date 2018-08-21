
<!---------------------Included Activities Start------------------------------------>
<div class="panel panel-primary addon-main">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>included Activities</strong></h3>
        <div class="panel-tools">
            <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
        </div>
    </div>
    <div class="panel-body">
        <div class="basic_info_view">
            <div class="form-horizontal">
                <div class="trip-addons">
                    <div class="form-group">
                        <?php
                        $id = 1;
                        ?>
                        @if(count($tripdata['tripIncludedActivities'])>0)
                        @foreach ( $tripdata['tripIncludedActivities'] AS $includedActivity)
						<?php
						if(!empty($bookedData['bookedActivities']))
						{
						//	echo '<pre>';print_r($bookedData['bookedActivities']['activity_data']);die;
							if(!empty($bookedData['bookedActivities']['activity_data'][$includedActivity['tripIncludedActivities_check']->id])){
								if(!empty($bookedData['bookedActivities']['activity_data'][$includedActivity['tripIncludedActivities_check']->id]['activity_flight_id'])){
									 $display_manual='style="display: none;"';
									 $flightdisplay='';
									 $checkedflight='checked';
									 $checkedlandonly='';
									 $flight_name='';
									 $flight_number='';
									 $flight_departure_date='';
									 $flight_departure_time='';
								} else {	
									$display_manual='';
									$flightdisplay='style="display: none;"';
									 $checkedlandonly='checked';
									$checkedflight='';		
									$flight_name= $bookedData['bookedActivities']['activity_data'][$includedActivity['tripIncludedActivities_check']->id]['flight_name'];
									$flight_number=$bookedData['bookedActivities']['activity_data'][$includedActivity['tripIncludedActivities_check']->id]['flight_number'];
									$flight_departure_date=$bookedData['bookedActivities']['activity_data'][$includedActivity['tripIncludedActivities_check']->id]['flight_departure_date'];
									$flight_departure_time=$bookedData['bookedActivities']['activity_data'][$includedActivity['tripIncludedActivities_check']->id]['flight_departure_time'];
								}
							}else{
							$display_manual='style="display: none;"';
							$flightdisplay='';
							$flight_name='';
							$flight_number='';
							$flight_departure_date='';
							$flight_departure_time='';
							$checkedlandonly='';
						}	
					}else{
						$display_manual='style="display: none;"';
						$flightdisplay='';
					}				
					
						?>
                        <div class="col-sm-12 parent">
                            <div class="row number-group-row">
                                <div class="col-sm-1">
                                    {{$id}}
                                </div>
                                <div class="col-sm-3">
                                    {{ isset($includedActivity['tripIncludedActivities_check']->activity_name) ? $includedActivity['tripIncludedActivities_check']->activity_name : 'N/A' }}
                                </div>
                                <div class="col-sm-3">
                                    {{ isset($includedActivity['tripIncludedActivities_check']->activity_detail) ? $includedActivity['tripIncludedActivities_check']->activity_detail : 'N/A' }}
                                </div>
                                <div class="col-sm-3">
                                    <label>${{ isset($includedActivity['tripIncludedActivities_check']->activity_cost) ? $includedActivity['tripIncludedActivities_check']->activity_cost : 'N/A' }}</label>
                                    <label class="addon_cost"> </label>
                                </div>
                                <!------ Radio button here--------------->
                            </div>
                            <div class="row includeactivity">
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
                                                                <label><input type="radio" name="is_land_only_activity_flight[{{$id}}]" id="is_land_only_activity_flight" class="is_land_only_activity_flight" value="0" <?php echo !empty($checkedflight)?$checkedflight:'checked';?>>Avaliable Flights</label>
                                                                <label><input type="radio" name="is_land_only_activity_flight[{{$id}}]" class="is_land_only_activity_flight" value="1"<?php echo !empty($checkedlandonly)?$checkedlandonly:'';?>>Land only</label>
                                                            </div>
                                                            <div class="col-sm-6">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="activity-available-flights" <?php echo !empty($flightdisplay)?$flightdisplay:'';?>>
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
                                                    <?php
                                                    $sr = 1;
                                                    if (array_key_exists("includedActivityFlights", $includedActivity)) {
                                                        ?>
                                                        @if(!empty($includedActivity['includedActivityFlights']))
                                                        @foreach( $includedActivity['includedActivityFlights'] AS $airlines)
                                                        @if(($tripDetails['adjustment_date'] < date('Y-m-d')) && ($includedActivity['tripIncludedActivities_check']->activity_due_date < date('Y-m-d')) && ($airlines->airline_due_date < date('Y-m-d')))
                                                        <div class="form-group pdrow-group">
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        {{$sr}}
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{ isset($airlines->airline_name) ? $airlines->airline_name : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        {{ isset($airlines->airline_departure_location) ? $airlines->airline_departure_location : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        {{ isset($airlines->airline_departure_date) ? $airlines->airline_departure_date : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        {{ isset($airlines->airline_departure_time) ? $airlines->airline_departure_time : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <label>$</label> <label class="cost">
                                                                            <?php
                                                                            if (isset($airlines->airline_reserve_amount) && ($airlines->airline_reserve_type == 1)) {
                                                                                echo $airlines->airline_reserve_amount * $airlines->airline_our_cost / 100;
                                                                            } else {
                                                                                echo $airlines->airline_reserve_amount;
                                                                            }
                                                                            ?>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <label>$</label> <label class="cost">{{ isset($airlines->airline_our_cost) ? $airlines->airline_our_cost : 'N/A' }}</label>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <label></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="form-group pdrow-group">
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        {{$sr}}
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{ isset($airlines->airline_name) ? $airlines->airline_name : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        {{ isset($airlines->airline_departure_location) ? $airlines->airline_departure_location : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        {{ isset($airlines->airline_departure_date) ? $airlines->airline_departure_date : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        {{ isset($airlines->airline_departure_time) ? $airlines->airline_departure_time : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <label>$</label>
																		<label class="cost">
                                                                            <?php
                                                                            if (isset($airlines->airline_reserve_amount) && ($airlines->airline_reserve_type == 1)) {
                                                                                echo $airlines->airline_reserve_amount * $airlines->airline_our_cost / 100;
                                                                            } else {
                                                                                echo $airlines->airline_reserve_amount;
                                                                            }
                                                                            ?>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <label>$</label> <label class="cost">{{ isset($airlines->airline_our_cost) ? $airlines->airline_our_cost : 'N/A' }}</label>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <label>
                                                                            <input type="radio" name="included_activity_flight[{{$includedActivity['tripIncludedActivities_check']->id}}]" value="{{$airlines->id}}"
                                                                            <?php if (!empty($bookedData)) {
                                                                                if (in_array($airlines->id, $bookedData['bookedActivities']['flight_id'])) {
                                                                                    echo 'checked';
                                                                                }
                                                                            }; ?>
                                                                                   class="included_activity_flight">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
											<?php $sr++; ?>
                                                        @endforeach
                                                        @endif
											<?php } ?>
                                                </div>

                                                <div class="land-only_activity" <?php echo !empty($display_manual)?$display_manual:'';?>>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3 custom-lbl">Flight Name</label>

                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="user-edit col-sm-6">
                                                                    <input type="text" name="activity_flight_name[{{$includedActivity['tripIncludedActivities_check']->id}}]" class="form-control flight_name" value="{{!empty($flight_name)?$flight_name:''}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3 custom-lbl">Flight Number</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="user-edit col-sm-6">
                                                                    <input type="text" name="activity_flight_flight_number[{{$includedActivity['tripIncludedActivities_check']->id}}]" class="form-control flight_number" value="{{!empty($flight_number)?$flight_number:''}}">

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3 custom-lbl">Departure Date</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="user-edit col-sm-6">
                                                                    <input type="text" name="activity_flight_departure_date[{{$includedActivity['tripIncludedActivities_check']->id}}]" class="form-control departure_date flightdeparture" value="{{!empty($flight_departure_date)?$flight_departure_date:''}}">

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3 custom-lbl">Departure Time</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="user-edit col-sm-6">
                                                                    <input type="text" name="activity_flight_departure_time[{{$includedActivity['tripIncludedActivities_check']->id}}]" class="form-control departure_time" value="{{!empty($flight_departure_time)?$flight_departure_time:''}}">
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
                            <div class="row activity_hotel">
                                <div class="panel panel-primary trip-design-hotel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Hotels</strong></h3>
                                        <div class="panel-tools">
                                            <!--<label style="color: black">Total Cost: </label> <label class="total_hotel_cost" style="color: black">$400</label>
                                            <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
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
                                                                <div class="col-sm-1">
                                                                    <b>Reserve Amount</b>
                                                                </div>
                                                                <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                    <b>Cost</b>
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
														<?php
														$sr = 1;
														if (array_key_exists("includedActivityHotles", $includedActivity)) {
															?>
                                                            @if(!empty($includedActivity['includedActivityHotles']))
                                                            @foreach( $includedActivity['includedActivityHotles'] AS $hotels)
                                                            @if(($tripDetails['adjustment_date'] < date('Y-m-d')) && ($includedActivity['tripIncludedActivities_check']->activity_due_date < date('Y-m-d')) && ($hotels->hotel_due_date < date('Y-m-d')) )
                                                            <div class="form-group pdrow-group">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-1">
                                                                            {{$sr}}
                                                                        </div>
                                                                        <div class="col-sm-3">
    <?php echo (!empty($hotels->hotel_name)) ? $hotels->hotel_name : ''; ?>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <?php echo (!empty($hotels->hotel_type)) ? $hotels->hotel_type : ''; ?>

                                                                        </div>
                                                                        <div class="col-sm-2">
    <?php echo (!empty($hotels->hotel_due_date)) ? $hotels->hotel_due_date : ''; ?>

                                                                        </div>
                                                                        <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php
                                                                                if (!empty($hotels->hotel_reserve_amount) && ($hotels->hotel_reserve_type == 1)) {
                                                                                    echo $hotels->hotel_reserve_amount * $hotels->hotel_our_cost / 100;
                                                                                } else {
                                                                                    
                                                                                   echo (!empty($hotels->hotel_reserve_amount)) ? $hotels->hotel_reserve_amount : '';

                                                                                }
                                                                                ?>

                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                            <?php echo (!empty($hotels->hotel_our_cost)) ? $hotels->hotel_our_cost : ''; ?></label>
                                                                        </div>

                                                                        <div class="col-sm-1 hotel_solo_cost">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php
                                                                              
                                                                                if (!empty($hotels->hotel_reserve_amount) && ($hotels->hotel_reserve_type == 1)) {
                                                                                    echo $hotels->hotel_reserve_amount * $hotels->hotel_our_solo_cost / 100;
                                                                                } else {
                                                          
                                                                                  echo (!empty($hotels->hotel_reserve_amount)) ? $hotels->hotel_reserve_amount : '';

                                                                                }
                                                                                ?>
                                                                            </label>
                                                                        </div>
                                                                       <div class="col-sm-1 hotel_solo_cost">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php echo (!empty($hotels->hotel_our_solo_cost)) ? $hotels->hotel_our_solo_cost : ''; ?>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="form-group pdrow-group">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-1">
                                                                            {{$sr}}
                                                                        </div>
                                                                        <div class="col-sm-3">
    <?php echo (!empty($hotels->hotel_name)) ? $hotels->hotel_name : ''; ?>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <?php echo (!empty($hotels->hotel_type)) ? $hotels->hotel_type : ''; ?>

                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <?php echo (!empty($hotels->hotel_due_date)) ? $hotels->hotel_due_date : ''; ?>

                                                                        </div>
                                                                         <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php
                                                                                if (!empty($hotels->hotel_reserve_amount) && ($hotels->hotel_reserve_type == 1)) {
                                                                                    echo $hotels->hotel_reserve_amount * $hotels->hotel_our_cost / 100;
                                                                                } else {
                                                                                   echo (!empty($hotels->hotel_reserve_amount)) ? $hotels->hotel_reserve_amount : '';
                                                                                }
                                                                                ?>

                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                            <?php echo (!empty($hotels->hotel_our_cost)) ? $hotels->hotel_our_cost : ''; ?></label>
                                                                        </div>

                                                                        <div class="col-sm-1 hotel_solo_cost">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php
                                                                               
                                                                                if (!empty($hotels->hotel_reserve_amount) && ($hotels->hotel_reserve_type == 1)) {
                                                                                    echo $hotels->hotel_reserve_amount * $hotels->hotel_our_solo_cost / 100;
                                                                                } else {

                                                                                  echo (!empty($hotels->hotel_reserve_amount)) ? $hotels->hotel_reserve_amount : '';
                                                                                }
                                                                                ?>
                                                                            </label>
                                                                        </div>
                                                                       <div class="col-sm-1 hotel_solo_cost">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php echo (!empty($hotels->hotel_our_solo_cost)) ? $hotels->hotel_our_solo_cost : ''; ?>
                                                                            </label>
                                                                        </div>
                                
                                                                        <div class="col-sm-1">
                                                                            <label>
                                                                                <input type="radio" name="included_activity_hotel[{{$includedActivity['tripIncludedActivities_check']->id}}]" value="{{$hotels->id}}"
																		<?php if (!empty($bookedData)) {
																			if (in_array($hotels->id, $bookedData['bookedActivities']['hotel_id'])) {
																				echo 'checked';
																			}
																		}; ?>
																																						   class="included_activity_hotel">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
    <?php $sr++; ?>
                                                            @endforeach
                                                            @endif
<?php } ?>
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
                        </div>
<?php $id++; ?>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----------------------Included Activities  end ----------------------------------------->

