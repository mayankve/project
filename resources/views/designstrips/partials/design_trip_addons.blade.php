
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
                        $id = 0;
                        ?>
                        @if(count($tripdata['tripAddons'])>0)
                        @foreach( $tripdata['tripAddons'] AS $addOns)
                        @foreach ( $addOns AS $addOn)
                        <?php
                        $id++;
                        ?>
                        <div class="col-sm-12">
                            <div class="row number-group-row parent">
                                <div class="addon">
                                    <div class="col-sm-1">
                                        {{$id}}        
                                    </div>
                                    <div class="col-sm-3">
                                        {{ isset($addOn->addons_name) ? $addOn->addons_name: 'N/A' }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ isset($addOn->addons_detail) ? $addOn->addons_detail : 'N/A' }}
                                    </div>
                                    <div class="col-sm-3">
                                        <label>${{ isset($addOn->addons_cost) ? $addOn->addons_cost : 'N/A' }}</label><label class="addon_cost"> </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>
                                            <!--<input type="checkbox" name="selected_addons[]" class="selected_addons" id="selected_addons" value="{{ $addOn->id }}">-->
                                            <!--  {{ Form::checkbox('selected_addons[]',$addOn->id, null, ['class' => 'selected_addons' , 'id' => 'selected_addons'])}}-->
                                            <input type="checkbox" name="selected_addons[{{$id}}]" value="{{$addOn->id}}" class="selected_addons" id="selected_addons">
                                            <input type="hidden" name="add_on_cost" class="add_on_cost" value="{{ isset($addOn->addons_cost) ? $addOn->addons_cost : 'N/A' }}">
                                        </label>  
                                    </div>
                                </div>
                                <div class="row">
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
                                                            //echo "<pre>";print_r($tripdata['tripTravelers']);die;
                                                            ?>
                                                            @if(count($tripdata['tripTravelers']))
                                                            @foreach($tripdata['tripTravelers'] AS $triptraveler)
                                                            <div class="col-sm-12 travler">
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        {{ $sr }}              
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        {{ $triptraveler->first_name }}   {{ $triptraveler->last_name }}
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        {{ ($triptraveler->gender == '1') ? 'Male' : 'Female' }}
                                                                    </div>
                                                                    <div class="col-sm-2">

                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <label>
                                                                             <!--<input type="checkbox" name="selected_addon_travelers[]" class="selected_addon_traveler" id="selected_addon_traveler" value="{{ $triptraveler->id }}">-->
                                                                            <!-- {{ Form::checkbox('selected_addon_travelers[]', $triptraveler->id , null, ['class' => 'selected_addon_traveler' , 'id' => 'selected_addon_traveler'])}}-->								<input type="checkbox" name="selected_addon_traveler[{{$id}}][{{$sr}}]" value="{{$triptraveler->id}}" class="selected_addon_traveler" id="selected_addon_traveler">
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
                                                                    <label><input type="radio" name="is_land_only" id="is_land_only" class="land_only" value="0" checked>Avaliable Flights</label>
                                                                    <label><input type="radio" name="is_land_only" class="land_only" value="1">Land only</label>
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
                                                        //echo "<pre>";print_r($tripdata['tripAddons']['tripAddonFlights']);die;
                                                        ?>
                                                        @if(count($tripdata['tripAddons']['tripAddonFlights'])>0)
                                                        @foreach( $tripdata['tripAddons']['tripAddonFlights'] AS $airlines)
                                                        <div class="form-group pdrow-group flightparent">
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
                                                                        {{$airlines->airline_reserve_amount}}
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        {{$airlines->airline_cost}}
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <label>
                                                                            <!-- {!! Form::radio('addon_flight_name{{$airlines->id}}',$airlines->name,['class' => 'form-control addon_flight_name']) !!}-->
                                                                            <input type="radio" class="addon_flight_name" name="addon_flight_name[{{$id}}]" value="{{$airlines->id}}">							<input type="hidden" name="add_on_cost_flight" class="add_on_cost_flight" value="{{ isset($airlines->airline_reserve_amount) ? $airlines->airline_reserve_amount : 'N/A' }}">	
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $sr++; ?>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="land-only" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-3 custom-lbl">Flight Name</label>
                                                            <!--{!! Form::label('airline[0][flight_name]', 'Flight Name','control-label col-sm-3 custom-lbl') !!}-->
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="user-edit col-sm-6">
                                                                        <!--{!! Form::text('traveler[0][flight_name]', null, ['class' => 'form-control flight_name']) !!}-->
                                                                        <input type="text" name="flight_name" class="form-control" value="">    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-3 custom-lbl">Flight Number</label>
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="user-edit col-sm-6">
                                                                        <input type="text" name="flight_number" class="form-control" value=""> 
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-3 custom-lbl">Departure Date</label>
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="user-edit col-sm-6">
                                                                        <input type="text" name="departure_date" class="form-control" value="">   
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
                                                                        {{ Form::text('departure_time' , null, ['class' => 'form-control']) }}
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
                                                <label style="color: black">Total Cost: </label> <label class="total_hotel_cost" style="color: black">$400</label>
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
                                                        ?>
                                                        @if(count($tripdata['tripAddons']['tripAddonHotels'])>0)
                                                        @foreach( $tripdata['tripAddons']['tripAddonHotels'] AS $hotels)
                                                        <div class="form-group pdrow-group hotleparent">
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        {{$sr}}
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        {{$hotels->hotel_name}}
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        {{$hotels->hotel_type}}
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        {{$hotels->hotel_due_date ? $hotels->hotel_due_date :'N/A' }}
                                                                    </div>
                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                        <label>$</label>
                                                                        <label class="cost">
                                                                            {{$hotels->hotel_reserve_amount}}
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                        <label>$</label> 
                                                                        <label class="cost">{{$hotels->hotel_cost}}</label>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        {{$hotels->hotel_reserve_amount}}
                                                                    </div>
                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                        {{$hotels->hotel_solo_cost}}
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <label>
                                                                            <!-- {!! Form::radio('selected_addon_hotel',$hotels->hotel_name,['class' => 'form-control selected_addon_hotel']) !!}-->								<input type="radio" class="selected_addon_hotel" name="selected_addon_hotel[{{$id}}]" value="{{$hotels->id}}">								<input type="hidden" name="add_on_cost_hotel" class="add_on_cost_hotel" value="{{ isset($hotels->hotel_reserve_amount) ? $hotels->hotel_reserve_amount : 'N/A' }}">			
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $sr++; ?>
                                                        @endforeach
                                                        @endif
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
                        @endforeach
                        <?php $sr++; ?>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----------------------Add-on  end ----------------------------------------->
<script>
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
            //   saveData(data);
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
        $('.selected_addons').click(function () {
            var cost = 0;
            $('.total_addon_cost').text('$' + cost);
            $(".selected_addons:checked").each(function () {
                cost = cost + parseFloat($(this).closest(".row").find("." + 'addon_cost').text());
                $('.total_addon_cost').text('$' + cost);
            });
        });
    });


</script>
