<!------------Trip Design Hotel---------------------------------------->
<!--<div class="panel panel-primary trip-design-hotel">-->
<div class="panel-heading">
    <h3 class="panel-title"><strong>Hotels</strong></h3>
    <div class="panel-tools">
        <label style="color: black">Total Cost: </label> <label class="total_hotel_cost" style="color: black">$00</label>
        <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
         <!--<a href="#"><span class="basic_info"><i class="fa fa-edit" aria-hidden="true" ></i></span></a>
        <a href="#"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
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
                @if(count($tripdata['tripHotels'])>0)
                @foreach( $tripdata['tripHotels'] AS $hotels)
                @if(($tripDetails['adjustment_date'] < date('Y-m-d')) && ($hotels->hotel_due_date < date('Y-m-d')))           
                <div class="form-group pdrow-group parent">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-1"> {{$sr}} </div>
                            <div class="col-sm-3">{{$hotels->hotel_name}}</div>
                            <div class="col-sm-2">{{$hotels->hotel_type}} </div>
                            <div class="col-sm-2">{{$hotels->hotel_due_date}}</div>
                            <div class="col-sm-1 hotel_cost" style="display: none;">
                                <label>$</label> <label class="cost">
                                    {{$hotels->hotel_reserve_amount}}</label>
                            </div>
                            <div class="col-sm-1 hotel_cost" style="display: none;">
                                <label>$</label> <label class="cost">{{$hotels->hotel_cost}}</label>
                            </div>
                            <div class="col-sm-1 hotel_solo_cost">
                                <label>$</label> <label class="cost">
                                    {{$hotels->hotel_reserve_amount}} </label>
                            </div>
                            <div class="col-sm-1 hotel_solo_cost">
                                <label>$</label> <label class="solo_cost"> {{$hotels->hotel_solo_cost}}</label>
                            </div>
                            <div class="col-sm-1 text">
                                <label>
                                    <label>
                                        <input type ="hidden" value="{{$hotels->hotel_due_date}}" name="" id="hotel_due_date"/>
                                    </label>
                                </label> 
                            </div>
                        </div>
                    </div>
                </div>
                 @else
                   <div class="form-group pdrow-group parent">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-1"> {{$sr}} </div>
                            <div class="col-sm-3">{{$hotels->hotel_name}}</div>
                            <div class="col-sm-2">{{$hotels->hotel_type}} </div>
                            <div class="col-sm-2">{{$hotels->hotel_due_date}}</div>
                            <div class="col-sm-1 hotel_cost" style="display: none;">
                                <label>$</label> <label class="cost">
                                    {{$hotels->hotel_reserve_amount}}</label>
                            </div>
                            <div class="col-sm-1 hotel_cost" style="display: none;">
                                <label>$</label> <label class="cost">{{$hotels->hotel_cost}}</label>
                            </div>

                            <div class="col-sm-1 hotel_solo_cost">
                                <label>$</label> <label class="cost">
                                    {{$hotels->hotel_reserve_amount}} </label>
                            </div>

                            <div class="col-sm-1 hotel_solo_cost">
                                <label>$</label> <label class="solo_cost"> {{$hotels->hotel_solo_cost}}</label>
                            </div>

                            <div class="col-sm-1 text">
                                <label>
                                    <input type="radio" name="selected_hotel" class="selected_hotel" value="{{$hotels->id}}"<?php echo ($hotels->id==$hotels->trip_hotel_id)?'checked':'';?>>
                                    <input type="hidden" name="reserver_amount" class="reserver_amount" value="{{$hotels->hotel_reserve_amount}}">
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
        </div>
    </div>

</div>
<!--</div>-->
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

