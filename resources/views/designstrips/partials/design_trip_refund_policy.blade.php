<!-- traveler-------------------Start ------------------------------------------>
<div role="tabpanel" class="tab-pane" id="traveler">
    <br>
    <div class="panel panel-primary traveler-list">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Refund Policy</strong></h3>
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
                                  <p style="text-align: justify;"><?php echo !empty($tripDetails)?$tripDetails->refund_detail:'';?></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- traveler-------------------End ---------------------------------------------->
