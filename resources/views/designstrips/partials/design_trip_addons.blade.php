
<!---------------------Addon Main------------------------------------>
<div class="panel panel-primary addon-main">
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
                        <?php
                        $id = 1;
//                        echo "<pre>";print_r($bookedData['bookedAddons']);die;
//                        foreach($bookedData['bookedAddons'] AS $bookedAddon){
//                            $result = in_array($bookedAddon , $tripdata['tripAddons']);
//                            if($result){
//                                echo "in IF";
//                            }
//                            die("else");
//                        }
//                        die;
                        ?>
                        @if(count($tripdata['tripAddons'])>0)
                        @foreach ( $tripdata['tripAddons'] AS $addOn)

                        <?php
//                        $result = in_array( $addOn->id , $bookedData['bookedAddons']['addon_id']);
//                         echo $result."lkldkfdl";die;
                        ?>
                        <div class="col-sm-12">
                            <div class="row number-group-row parent">
                                @if(($tripDetails['adjustment_date'] < date('Y-m-d')) && ($addOn['tripAddons_check']->addons_due_date < date('Y-m-d')) )
                                <div class="row addon">
                                    <div class="col-sm-1">
                                        {{$id}}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ isset($addOn['tripAddons_check']->addons_name) ? $addOn['tripAddons_check']->addons_name: "N/A" }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ isset($addOn['tripAddons_check']->addons_detail) ? $addOn['tripAddons_check']->addons_detail : 'N/A' }}
                                    </div>
                                    <div class="col-sm-3">
                                        <label>$ {{ isset($addOn['tripAddons_check']->addons_cost) ? $addOn['tripAddons_check']->addons_cost : 'N/A' }}</label><label class="addon_cost"> </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>
                                            <!--lable --->
                                        </label>
                                    </div>
                                </div>
                                @else
                                <div class="row addon">
                                    <div class="col-sm-1">
                                        {{$id}}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ isset($addOn['tripAddons_check']->addons_name) ? $addOn['tripAddons_check']->addons_name: "N/A" }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ isset($addOn['tripAddons_check']->addons_detail) ? $addOn['tripAddons_check']->addons_detail : 'N/A' }}
                                    </div>
                                    <div class="col-sm-3">
                                        <label>$ {{ isset($addOn['tripAddons_check']->addons_cost) ? $addOn['tripAddons_check']->addons_cost : 'N/A' }}</label><label class="addon_cost"> </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>
                                            <?php //echo '<pre>';print_r($bookedData['bookedAddons']['addon_id']);die;?>
                                            <input type="checkbox" name="selected_addons[{{$id}}]" value="{{$addOn['tripAddons_check']->id}}"<?php
                                            if (!empty($bookedData)) {
                                                if (in_array($addOn['tripAddons_check']->id, $bookedData['bookedAddons']['addon_id'])) {
                                                    echo 'checked';
                                                }
                                            };
                                            ?> class="selected_addons" id="selected_addons">
                                            <input type="hidden" name="add_on_cost" class="add_on_cost" value="{{ isset($addOn['tripAddons_check']->addons_cost) ? $addOn['tripAddons_check']->addons_cost : 'N/A' }}">
                                        </label>
                                    </div>
                                </div>
                                <div class="row addon_travler">
                                    <div class="panel panel-primary traveler-list">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong>Travelers list</strong></h3>
                                            <div class="panel-tools">
                                                <a href="#" class="updown"><span class="clickable">
                                                        <i class="glyphicon glyphicon-chevron-up"></i></span></a>
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
                                                            <?php
                                                            $sr = 1;
                                                            ?>
                                                            @if(count($tripdata['tripTravelers']))
                                                            @foreach($tripdata['tripTravelers'] AS $triptraveler)
                                                            <div class="col-sm-12 travler">
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        {{ $sr }}
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        {{ ucwords($triptraveler->first_name) }}   {{ ucwords($triptraveler->last_name) }}
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        {{ ($triptraveler->gender == '1') ? 'Male' : 'Female' }}
                                                                    </div>
                                                                    <div class="col-sm-2">

                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <label>
                                                                             <!--<input type="checkbox" name="selected_addon_travelers[]" class="selected_addon_traveler" id="selected_addon_traveler" value="{{ $triptraveler->id }}">-->
                                                                            <!-- {{ Form::checkbox('selected_addon_travelers[]', $triptraveler->id , null, ['class' => 'selected_addon_traveler' , 'id' => 'selected_addon_traveler'])}}-->
                            <input type="checkbox" name="selected_addon_traveler[{{$id}}][{{$sr}}]" value="{{$triptraveler->id}}" class="selected_addon_traveler" id="selected_addon_traveler" <?php if(!empty($bookedData['bookedAddons'])){if(array_key_exists($addOn['tripAddons_check']->id,$bookedData['bookedAddons']['traveler'])) {
		if(in_array($triptraveler->id, $bookedData['bookedAddons']['traveler'][$addOn['tripAddons_check']->id])){echo 'checked';} } }?>>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php $sr++; ?>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row addon_flight">
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
                                                                    <label><input type="radio" name="add_on_land-only[{{$id}}]" id="add_on_land-only" class="add_on_land-only" value="0" checked>Avaliable Flights</label>
                                                                    <label><input type="radio" name="add_on_land-only[{{$id}}]" class="add_on_land-only" value="1">Land only</label>
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

                                                        if (array_key_exists("tripAddonFlights", $addOn)) {
                                                            ?>
                                                            @if(count($addOn['tripAddonFlights'])>0)
                                                            @foreach($addOn['tripAddonFlights'] as $tripflight)
                                                            @if(($addOn['tripAddons_check']->addons_due_date < date('Y-m-d')) && ($tripDetails['adjustment_date'] < date('Y-m-d'))&& ($tripflight->airline_due_date < date('Y-m-d')) )
                                                            <div class="form-group pdrow-group flightparent">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-1">
                                                                            {{$sr}}
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            {{$tripflight->name}}
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            {{$tripflight->airline_departure_location}}
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            {{$tripflight->airline_departure_date}}
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            {{$tripflight->airline_departure_time}}
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>$</label> <label class="cost">
                                                                                <?php
                                                                                if ($tripflight->airline_reserve_type == 1) {
                                                                                    echo $tripflight->airline_reserve_amount * $tripflight->airline_our_cost / 100;
                                                                                } else {
                                                                                    echo $tripflight->airline_reserve_amount;
                                                                                }
                                                                                ?>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>$</label> <label class="cost">{{$tripflight->airline_our_cost}}</label>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="form-group pdrow-group flightparent">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-1">
                                                                            {{$sr}}
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            {{$tripflight->name}}
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            {{$tripflight->airline_departure_location}}
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            {{$tripflight->airline_departure_date}}
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            {{$tripflight->airline_departure_time}}
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>$</label> <label class="cost">
                                                                                <?php
                                                                                if ($tripflight->airline_reserve_type == 1) {
                                                                                    echo $tripflight->airline_reserve_amount * $tripflight->airline_our_cost / 100;
                                                                                } else {
                                                                                    echo $tripflight->airline_reserve_amount;
                                                                                }
                                                                                ?>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>$</label> <label class="cost">{{$tripflight->airline_our_cost}}</label>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>
                                                                                <input type="radio" class="addon_flight_name" name="addon_flight_name[{{$id}}]" value="{{$tripflight->id}}" <?php
                                                                                if (!empty($bookedData)) {
                                                                                    if (in_array($tripflight->id, $bookedData['bookedAddons']['flight_id'])) {
                                                                                        echo 'checked';
                                                                                    }
                                                                                };
                                                                                ?>>
                                                                                <input type="hidden" name="add_on_cost_flight" class="add_on_cost_flight" value="{{ isset($tripflight->airline_reserve_amount) ? $tripflight->airline_reserve_amount : 'N/A' }}">
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
                                                    <div class="add_on_land-onlydetail" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-3 custom-lbl">Flight Name</label>

                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="user-edit col-sm-6">

                                                                        <input type="text" name="add_on_flight_name[{{$id}}]" class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-3 custom-lbl">Flight Number</label>
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="user-edit col-sm-6">
                                                                        <input type="text" name="add_on_flight_number[{{$id}}]" class="form-control" value="">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-3 custom-lbl">Departure Date</label>
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="user-edit col-sm-6">
                                                                        <input type="text" name="add_on_departure_date[{{$id}}]"  class="form-control flightdeparture" value="">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-3 custom-lbl">Departure Time</label>
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="user-edit col-sm-6">
                                                                        <!--<input type="text" name="departure_time" class="form-control" value="">-->
                                                                        <!-- {{ Form::text('add_on_departure_time' , null, ['class' => 'form-control']) }}-->
                                                                        <input type="text" name="add_on_departure_time[{{$id}}]" class="form-control" value="">
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

                                <div class="row addon_hotel">
                                    <div class="panel panel-primary trip-design-hotel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong>Hotels</strong></h3>
                                            <div class="panel-tools">
                                                <!--<label style="color: black">Total Cost: </label> <label class="total_hotel_cost" style="color: black">$400</label>-->
                                                <a href="#" class="updown addon"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
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
                                                                        <div id="addon_hotel_is_solo{{$id}}" class="btn-group" hot="1">
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
                                                        <?php
                                                        $sr = 1;

                                                        if (array_key_exists("tripAddonHotels", $addOn)) {
                                                            ?>
                                                            @if(count($addOn['tripAddonHotels'])>0)
                                                            @foreach($addOn['tripAddonHotels'] as $triphotel)
                                                            @if((($tripDetails['adjustment_date'] < date('Y-m-d')) && $addOn['tripAddons_check']->addons_due_date < date('Y-m-d')) && ($triphotel->hotel_due_date < date('Y-m-d')) )
                                                            <div class="form-group pdrow-group hotleparent">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-1">
                                                                            {{$sr}}
                                                                        </div>

                                                                        <div class="col-sm-3">
                                                                            <?php echo (!empty($triphotel->hotel_name)) ? $triphotel->hotel_name : ''; ?>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <?php echo (!empty($triphotel->hotel_type)) ? $triphotel->hotel_type : ''; ?>

                                                                        </div>

                                                                        <div class="col-sm-2">
                                                                            <?php echo (!empty($triphotel->hotel_due_date)) ? $triphotel->hotel_due_date : ''; ?>

                                                                        </div>

                                                                        <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php
                                                                                // echo (!empty($triphotel->hotel_reserve_amount)) ? $triphotel->hotel_reserve_amount : '';
                                                                                if (!empty($triphotel->hotel_reserve_amount) && ($triphotel->hotel_reserve_amount == 1)) {
                                                                                    echo $triphotel->hotel_reserve_amount * $triphotel->hotel_our_cost / 100;
                                                                                } else {
                                                                                    (!empty($triphotel->hotel_reserve_amount)) ? $triphotel->hotel_reserve_amount : '';
                                                                                }
                                                                                ?>

                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php echo (!empty($triphotel->hotel_our_cost)) ? $triphotel->hotel_our_cost : ''; ?></label>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php
                                                                                if (!empty($triphotel->hotel_reserve_amount) && ($triphotel->hotel_reserve_amount == 1)) {
                                                                                    echo $triphotel->hotel_reserve_amount * $triphotel->hotel_our_solo_cost / 100;
                                                                                } else {
                                                                                    (!empty($triphotel->hotel_reserve_amount)) ? $triphotel->hotel_reserve_amount : '';
                                                                                }
                                                                                ?>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-1 hotel_solo_cost">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php echo (!empty($triphotel->hotel_our_solo_cost)) ? $triphotel->hotel_our_solo_cost : ''; ?>
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
                                                            <div class="form-group pdrow-group hotleparent">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-1">
                                                                            {{$sr}}
                                                                        </div>

                                                                        <div class="col-sm-3">

                                                                            <?php echo (!empty($triphotel->hotel_name)) ? $triphotel->hotel_name : ''; ?>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <?php echo (!empty($triphotel->hotel_type)) ? $triphotel->hotel_type : ''; ?>

                                                                        </div>

                                                                        <div class="col-sm-2">
                                                                            <?php echo (!empty($triphotel->hotel_due_date)) ? $triphotel->hotel_due_date : ''; ?>

                                                                        </div>



                                                                        <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php
                                                                                // echo (!empty($triphotel->hotel_reserve_amount)) ? $triphotel->hotel_reserve_amount : '';
                                                                                if (!empty($triphotel->hotel_reserve_amount) && ($triphotel->hotel_reserve_amount == 1)) {
                                                                                    echo $triphotel->hotel_reserve_amount * $triphotel->hotel_our_cost / 100;
                                                                                } else {
                                                                                    (!empty($triphotel->hotel_reserve_amount)) ? $triphotel->hotel_reserve_amount : '';
                                                                                }
                                                                                ?>

                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php echo (!empty($triphotel->hotel_our_cost)) ? $triphotel->hotel_our_cost : ''; ?></label>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php
                                                                                if (!empty($triphotel->hotel_reserve_amount) && ($triphotel->hotel_reserve_amount == 1)) {
                                                                                    echo $triphotel->hotel_reserve_amount * $triphotel->hotel_our_solo_cost / 100;
                                                                                } else {
                                                                                    (!empty($triphotel->hotel_reserve_amount)) ? $triphotel->hotel_reserve_amount : '';
                                                                                }
                                                                                ?>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-1 hotel_solo_cost">
                                                                            <label>$</label>
                                                                            <label class="cost">
                                                                                <?php echo (!empty($triphotel->hotel_our_solo_cost)) ? $triphotel->hotel_our_solo_cost : ''; ?>
                                                                            </label>
                                                                        </div>


                                                                        <div class="col-sm-1">
                                                                            <label>
                                                                                <input type="radio" class="selected_addon_hotel" name="selected_addon_hotel[{{$id}}]" value="{{$triphotel->id}}"
                                                                                <?php
                                                                                if (!empty($bookedData)) {
                                                                                    if (in_array($triphotel->id, $bookedData['bookedAddons']['hote_id'])) {
                                                                                        echo 'checked';
                                                                                    }
                                                                                };
                                                                                ?>
                                                                                       >
                                                                                <input type="hidden" name="add_on_cost_hotel" class="add_on_cost_hotel" value="{{ isset($triphotel->hotel_reserve_amount) ? $triphotel->hotel_reserve_amount : 'N/A' }}">
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

                        <?php $id++; ?>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----------------------Add-on  end ----------------------------------------->
