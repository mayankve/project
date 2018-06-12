<!-- todo-------------------Start ---------------------------------------------->
<div role="tabpanel" class="tab-pane" id="todo">
  
    <!--<form method="POST" name="trip-land-flight" action="/book/" id="trip-land-flight">          
    <br>-->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Do/Packing list</strong></h3>
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
                        <div class="form-group">
                            <?php
//                            $sr = 1;
//                                echo "<pre>";
//                                print_r($tripdata['tripTodo']);die;
                            ?>
                            @if(count($tripdata['tripTodo']))
                            @foreach($tripdata['tripTodo'] AS $tripTodo)
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-1">
                                        {{$sr}}   
                                    </div>
                                    <div class="col-sm-9">
                                        {{$tripTodo->todo_name}}  
                                    </div>
                                    <div class="col-sm-2">
                                        <label>
<!--                                            <input type="checkbox" name="selected_todo[]" class="selected_todo" id="selected_todo" value="54">-->
                                            {{ Form::checkbox('selected_todo[]', 1, null, ['class' => 'selected_todo','id' => 'selected_todo' ]) }}
                                        </label>                                
                                    </div>
                                </div>
                            </div>
                        <?php $sr++; ?>
                            @endforeach
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <div class="update-btn">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Note: All is required to check them off as done before they register.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
     
</div>
<!-- todo-------------------End ------------------------------------------------>