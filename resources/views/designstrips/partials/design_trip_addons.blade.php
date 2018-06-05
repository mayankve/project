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
                                            <div class="col-sm-12">
                                                <?php
                                                    $sr = 1;
                                                ?>
                                                @if(count($tripdata['tripAddons'])>0)
                                                @foreach( $tripdata['tripAddons'] AS $addOns)
                                                <?php 
                                                   //  echo $addOns->addons_name;die;
                                                ?>
                                                <div class="row number-group-row">
                                                    <div class="col-sm-1">
                                                        {{$sr}}         
                                                    </div>
                                                    <div class="col-sm-3">
                                                       <?php //$addOns->addons_name; ?>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <?php  //echo $addOns->addons_name; ?>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label>$</label><label class="addon_cost"> </label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>
                                                            <input type="checkbox" name="selected_addons[]" class="selected_addons" id="selected_addons" value="">
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
                                                                        @if(count($tripdata['tripAddons'])>0)
                                                                        @foreach( $tripdata['tripAddons']['tripAddonTravelers'] AS $addOnTraveler)
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        1
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        Vaishnavesh2 Shukla   
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        Male 
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
                                                                                    <label><input type="radio" name="is_land_only" id="is_land_only" class="land_only" value="0" checked="checked">Avaliable Flights</label>
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

                                                                    </div>
                                                                    <div class="land-only" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="flight_name" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="flight_number" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="departure_date" class="form-control" value="">                                </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3 custom-lbl"></label>
                                                                            <div class="col-sm-9">
                                                                                <div class="row">
                                                                                    <div class="user-edit col-sm-6">
                                                                                        <input type="text" name="departure_time" class="form-control" value=""> </div>
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
                                                                <label style="color: black">Total Cost: </label> <label class="total_hotel_cost" style="color: black">$400</label>
                                                                <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>

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
                                                                        <div class="form-group pdrow-group">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-1">
                                                                                        1
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                        CC
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        4 Star
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        2017-10-28
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <label>$</label>
                                                                                        <label class="cost">
                                                                                            100 
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_cost" style="display: none;">
                                                                                        <label>$</label> 
                                                                                        <label class="cost">200</label>
                                                                                    </div>

                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <label>$</label>
                                                                                        <label class="cost">
                                                                                            200  
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 hotel_solo_cost">
                                                                                        <label>$</label>
                                                                                        <label class="solo_cost">400</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 text">
                                                                                        <label><input type="radio" name="selected_hotel" class="selected_hotel" id="selected_hotel" value="0"></label>
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


                                                        });

                                                    </script>
                                                </div>
                                                <?php $sr++; ?>
                                                @endforeach
                                                @endif
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
                    <script>
                        $('document').ready(function () {
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
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <div class="update-btn">
                            </div>
                        </div>
                    </div>
                   
                </div>
                <!-----------------------Add-on  end ----------------------------------------->