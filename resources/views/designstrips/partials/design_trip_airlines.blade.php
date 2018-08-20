<?php if(!empty($bookedData['bookedTrip']->trip_flight_id)){
	$display='style="display:none;"';
	$flightdisplay='';
	$checkedlandonly='';
	$checkedflight='checked';
	}else{
		$display='';
		$checkedlandonly='checked';
		$checkedflight='';
		$flightdisplay='style="display:none;"';
	}?>
<div class="form-group pdrow-group">
		<div class="col-sm-9">
			<div class="row flights_heading">
				<div class="col-sm-6 pr-3">
					<label>
						<input type="radio" name="is_land_only" id="is_land_only" class="land_only" value="0" <?php echo !empty($checkedflight)?$checkedflight:'';?>>Avaliable Flights
					</label>
					<label>
						<input type="radio" name="is_land_only" class="land_only" value="1" <?php echo !empty($checkedlandonly)?$checkedlandonly:'';?>>Land only
					</label>
				</div>
				<div class="col-sm-6">
				</div>
			</div>
		</div>
</div>
<div class="available-flights" <?php echo !empty($flightdisplay)?$flightdisplay:'';?>>
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
    ?>
    @if(count($tripdata['tripAirlines'])>0)
    @foreach( $tripdata['tripAirlines'] AS $airlines)
    @if(($tripDetails['adjustment_date'] < date('Y-m-d')) && ($airlines->airline_due_date < date('Y-m-d')))                
    <div class="form-group pdrow-group parent available_airlines">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-1">
                    {{$sr}}
                </div>
                <div class="col-sm-3">
                    {{$airlines->name}}
                </div>
                <div class="col-sm-2">
                    {{$airlines->airline_departure_location}}
                </div>
                <div class="col-sm-2">
                    {{$airlines->airline_departure_date}}
                </div>
                <div class="col-sm-1">
                    {{$airlines->airline_departure_time}}
                </div>
                <div class="col-sm-1">
                  <label>$</label> <label class="cost">
                <?php
                if ($airlines->airline_reserve_type == 1 ){
                    echo $airlines->airline_reserve_amount * $airlines->airline_our_cost/100;

                }else{
                    echo $airlines->airline_reserve_amount;

                }?></label>
                </div>
                <div class="col-sm-1">
                    <label>$</label> <label class="cost"> {{$airlines->airline_our_cost}}</label>
                </div>
                <div class="col-sm-1">
                    <label>
                        @if(!empty($bookedData['bookedTrip']->trip_flight_id) && ($bookedData['bookedTrip']->trip_flight_id == $airlines->airline_name)) 
                        Selected
                        @endif
                        <input type ="hidden" value="{{$airlines->airline_due_date}}" name="" id="airline_due_date"/>
                    </label>
                </div>
            </div>
        </div>
    </div>
    @else                                                    
    <div class="form-group pdrow-group parent available_airlines">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-1">
                    {{$sr}}
                </div>
                <div class="col-sm-3">
                    {{$airlines->name}}
                </div>
                <div class="col-sm-2">
                    {{$airlines->airline_departure_location}}
                </div>
                <div class="col-sm-2">
                    {{$airlines->airline_departure_date}}
                </div>
                <div class="col-sm-1">
                    {{$airlines->airline_departure_time}}
                </div>
                <div class="col-sm-1">
                   <label>$</label> <label class="cost">
                   <?php
                    if ($airlines->airline_reserve_type == 1 ){
                        echo $airlines->airline_reserve_amount * $airlines->airline_our_cost/100;

                    }else{
                        echo $airlines->airline_reserve_amount;

                    }?>
                   </label>
                </div>
                <div class="col-sm-1">
                    <label>$</label> <label class="cost">{{$airlines->airline_our_cost}} </label>
                </div>
                <div class="col-sm-1">
                    <label> 
                        @if(!empty($bookedData['bookedTrip']->trip_flight_id) && ($bookedData['bookedTrip']->trip_flight_id == $airlines->airline_name)) 
                        <input type="radio" name="flight_id" value="{{$airlines->airline_name}}" class="flight_id" checked>
                        @else
                        <input type="radio" name="flight_id" value="{{$airlines->airline_name}}" class="flight_id">
                        @endif
                    </label>
                </div>
            </div>
        </div>
    </div>
    @endif
    <?php $sr++; ?>
    @endforeach
    @endif
</div>

<div class="land-only" <?php echo !empty($display)?$display:'';?>>
    <div class="form-group">
        <label class="control-label col-sm-3 custom-lbl">Flight Name</label>
        <!--{!! Form::label('airline[0][flight_name]', 'Flight Name','control-label col-sm-3 custom-lbl') !!}-->
        <div class="col-sm-9">
            <div class="row">
                <div class="user-edit col-sm-6">
                    <!--{!! Form::text('traveler[0][flight_name]', null, ['class' => 'form-control flight_name']) !!}-->
                    <input type="text" name="flight_name" value="<?php echo isset($bookedData['bookedTrip']->flight_name) ? $bookedData['bookedTrip']->flight_name : ''; ?>" class="form-control" >
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 custom-lbl">Flight Number</label>
        <div class="col-sm-9">
            <div class="row">
                <div class="user-edit col-sm-6">
                    <input type="text" value="<?php echo isset($bookedData['bookedTrip']->flight_number) ? $bookedData['bookedTrip']->flight_number : ''; ?>"  name="flight_number" class="form-control" > 
                </div>

            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 custom-lbl">Departure Date</label>
        <div class="col-sm-9">
            <div class="row">
                <div class="user-edit col-sm-6">
                    <input type="text" name="departure_date" value="<?php echo isset($bookedData['bookedTrip']->flight_departure_date) ? $bookedData['bookedTrip']->flight_departure_date : ''; ?>" class="form-control flightdeparture" > 
                </div>

            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 custom-lbl">Departure Time</label>
        <div class="col-sm-9">
            <div class="row">
                <div class="user-edit col-sm-6">
                    <input type="text" name="departure_time" value="<?php echo isset($bookedData['bookedTrip']->flight_departure_time) ? $bookedData['bookedTrip']->flight_departure_time : ''; ?>" class="form-control" > 
                </div>
            </div>
        </div>
    </div>
</div>