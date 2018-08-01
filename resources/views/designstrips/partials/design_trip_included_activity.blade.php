
<!---------------------Included Activities Start------------------------------------>
<div class="panel panel-primary addon-main">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>included Activities</strong></h3>
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
                        <?php
                        $id = 1;
                        //echo '<pre>';print_r($tripdata['tripIncludedActivities']);die;
                        ?>   
                        @if(count($tripdata['tripIncludedActivities'])>0)

                        @foreach ( $tripdata['tripIncludedActivities'] AS $includedActivity)
                        <?php
                        // var_dump($includedActivities);die;
                        ?>
                        <div class="col-sm-12">

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

                            <!--  <div class="row">
                                  <div class="panel panel-primary traveler-list">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><strong>Travelers list</strong></h3>
                                          <div class="panel-tools">
                                              <a href="#" class="updown"><span class="clickable">
                                                      <i class="glyphicon glyphicon-chevron-up"></i></span></a>
                                          </div>
                                      </div>
                                  </div>
                              </div>-->
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
                                                                <label><input type="radio" name="is_land_only_activity_flight" id="is_land_only_activity_flight" class="is_land_only_activity_flight" value="0" checked>Avaliable Flights</label>
                                                                <label><input type="radio" name="is_land_only_activity_flight" class="is_land_only_activity_flight" value="1">Land only</label>
                                                            </div>
                                                            <div class="col-sm-6">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="addon-available-flights">
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
                                                                        {{ isset($airlines->airline_reserve_amount) ? $airlines->airline_reserve_amount : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        {{ isset($airlines->airline_cost) ? $airlines->airline_cost : 'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <label>

                                                                            <!-- here-->
                                                                            <input type="radio" name="included_activity_flight[{{$includedActivity['tripIncludedActivities_check']->id}}]" value="{{$airlines->id}}" class="included_activity_flight">

                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
    <?php $sr++; ?>
                                                        @endforeach
                                                        @endif
<?php } ?>


                                                <div class="land-only_activity" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3 custom-lbl">Flight Name</label>
                                                      
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="user-edit col-sm-6">
                                                                    {!! Form::text('activity_flight_name', null, ['class' => 'form-control flight_name']) !!}
                                                                                           
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3 custom-lbl">Flight Number</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="user-edit col-sm-6">
                                                                    <!--<input type="text" name="flight_number" class="form-control" value="">-->
                                                                    {!! Form::text('activity_flight_flight_number', null, ['class' => 'form-control flight_number']) !!}
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3 custom-lbl">Departure Date</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="user-edit col-sm-6">
                                                                    <!--<input type="text" name="departure_date" class="form-control" value="">--> 
                                                                    {!! Form::text('activity_flight_departure_date', null, ['class' => 'form-control departure_date']) !!}
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3 custom-lbl">Departure Time</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="user-edit col-sm-6">
                                                                     {!! Form::text('activity_flight_departure_time', null, ['class' => 'form-control departure_time']) !!}
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
                            <div class="row">
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
                                                                        <div class="col-sm-1">
    <?php echo (!empty($hotels->hotel_reserve_amount)) ? $hotels->hotel_reserve_amount : ''; ?>

                                                                        </div>

                                                                        <div class="col-sm-1">
    <?php echo (!empty($hotels->hotel_cost)) ? $hotels->hotel_cost : ''; ?>

                                                                        </div>
                                                                        <div class="col-sm-1">
    <?php echo (!empty($hotels->hotel_solo_cost)) ? $hotels->hotel_solo_cost : ''; ?>

                                                                        </div>

                                                                        <div class="col-sm-1">
                                                                            <label>

                                                                                <input type="radio" name="included_activity_hotel[{{$includedActivity['tripIncludedActivities_check']->id}}]" value="{{$hotels->id}}" class="included_activity_hotel">

                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
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

