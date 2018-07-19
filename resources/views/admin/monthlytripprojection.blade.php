@extends('admin.layouts.dashboard')
@section('title', 'Monthly Trip Projection')

@section('content')

<style type="text/css">
    .form-title {
        background-color: #e3e3e3;
        /* margin-bottom: 40px; */
        text-transform: uppercase;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<div class="pageContainer">
 <div class="dashboardHeader">
<div class="row">
<div class="col-sm-6 text-left">
<div class="sidebar_toggle">
            <i class="fa fa-chevron-right" data-unicode="f00a"></i>
            </div>
    <ol class="breadcrumb">
    <li>
    <a class="desh-title" href="#">Dashboard</a>
    </li>
    <li class="active">
    <a>
        Trip Spots    </a>
    </li>
    </ol>
</div>
<div class="col-sm-6 text-right">
<h3 class="userName">
    Welcome Vaishnavash Shukla</h3>
</div>
</div>
</div>
<div class="clearfix create-trip">
    <div class="panel panel-primary">
    <div class="panel-heading white-bg">
      <h3 class="panel-title">Manage Trip</h3>
      <div class="panel-tools"> </div>
    </div>
  </div>
  <div class="table-responsive">
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
      <thead>
        <tr>
          <th>Trip Name</th>
          <th>Base Cost</th>
          <th>Booking Date</th>		 
          <th>Nex Payment Date</th>
        </tr>
      </thead>
          <tbody> 
                @if(count($monthlytrip)>0)
					
                @foreach($monthlytrip AS $tripdetail)
                    <tr class="parent">
                    <td>{{$tripdetail->name}}</td>
                    <td>{{$tripdetail->base_cost}}</td>
                    <td>{{$tripdetail->booking_date}}</td>
					
					<td><input  name="adjustment_date" type="date" class="form-control datechek" value="<?php echo($tripdetail->monthly_payment_date!='')?$tripdetail->monthly_payment_date:'';?>"  id="adjustment_date" style=" width: 165px;"></td>
					<input type="hidden" name="trip_id" class="trip_id" value="{{$tripdetail->trip_id}}">
                    </tr>
              @endforeach
                @endif   
              </tbody>
    </table>
  </div>
  <script>
</script>
</div>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
	
$('.datechek').on('change',function(){
	
	var date= $(this).val();
	var trip_id = $(this).parents('.parent').find('.trip_id').val();
	//alert(trip_id);
	$.ajax({
			 method: 'GET',
                url: './setmonthlypaymentdate/'+date+'/'+trip_id,
                success: function(response) {
					if(response=='data update'){
						location.reload();					
					}
				}	
	});	
});	
	
 $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });	
</script>
</div>

@endsection