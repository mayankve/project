
                                    <div class="available-flights">
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
                                            // echo "<pre>";print_r($tripdata);die;
                                        ?>
                                        @if(count($tripdata['tripAirlines'])>0)
                                        @foreach( $tripdata['tripAirlines'] AS $airlines)
                                        <div class="form-group pdrow-group">
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
                                                            {!! Form::radio('flight_id',$airlines->id,['class' => 'form-control flight_id']) !!} 
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
                                                        <input type="text" name="departure_time" class="form-control" value=""> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>