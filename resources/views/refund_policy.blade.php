@extends('admin.layouts.home')
@section('title', 'AAT:Trip Booking')
@section('content')

<style type="text/css">
    .form-title {
        background-color: #e3e3e3;
        /* margin-bottom: 40px; */
        text-transform: uppercase;
    }
</style>

<div class="deshboard_body">
    <div class="clearfix create-trip">
        <div class="container container_page">
            <div class="row-box">
                <div class="form-title">
                    <div class="col-md-6 col-xs-10">
                        <h3 class="panel-title">Refund Policy</h3>
                    </div>                    
                </div>                
                  <div class="col-md-12">
                        <div class="cust-input-group travelerDetails-row pt-4 pb-2">            
                            <div class="row">                               
                               <p><?php echo !empty($tripdata)?$tripdata->refund_detail:'';?></p>                         						
							</div>
						</div>             
				</div>
         
			</div>
		</div>
	</div>
</div>


@endsection