<!-- traveler-------------------Start ------------------------------------------>
<div role="tabpanel" class="tab-pane" id="traveler">
<!--{!! Form::open(['url' => '/book/', 'files' => true, 'id' => 'trip-land-flight' 'name'=> 'trip-land-flight']) !!}-->
<!--   <form method="POST" name="trip-land-flight" action="/book/" id="trip-land-flight"> -->
        <br>
        <div class="panel panel-primary traveler-list">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Travelers list</strong></h3>
                <div class="panel-tools">
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
                                        <div class="col-sm-1">
                                            <label>SN.</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Gender</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>City</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Profile Image</label>
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
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            {{$sr}}              
                                        </div>
                                        <div class="col-sm-5">
                                            {{$triptraveler->first_name}}   {{$triptraveler->last_name}}
                                        </div>
                                        <div class="col-sm-2">
                                            {{($triptraveler->gender == '1')?'Male':'Female'}}
                                        </div>
                                        <div class="col-sm-2">
                                           {{$triptraveler->city}}
                                        </div>
                                         <div class="col-sm-2">
                                           <img src="{{ url('/') . '/uploads/traveler_img/' .$triptraveler->passport_pic }}" alt="Profile image" class="img-responsive model_image" />
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
        <div class="form-group">
            <div class="col-sm-12 text-right">
                <div class="update-btn">
                </div>
            </div>
        </div>
     <!--{!! Form::close() !!}-->
<!--    </form>-->
</div>
<!-- traveler-------------------End ---------------------------------------------->
