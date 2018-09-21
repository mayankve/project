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
                            Book Trip    </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">Welcome  {{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>
    <div class="clearfix create-trip">
        <div class="panel panel-primary">
            <div class="panel-heading white-bg">
                <h3 class="panel-title">Book Trip</h3>
                <div class="panel-tools"> </div>	
				<div class="text-right">
					<a href="{{url('admin/downloadcsv')}}"><img src="{{url('images/download.png')}}" style="width: 35px;height: 35px;"></a>
				</div>				
            </div>
				
			
        </div>
        <div class="table-responsive">
		  @if(count($tripalldetail)>0)
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
						<th>User Name</th>	
						<th>User Email</th>
						<th>Trip Name</th>						
						<th>Addon Name</th>
                        <th>Paid Amount</th>
                        <th>Remaning Amount</th>		 
                        
                    </tr>
                </thead>
                <tbody> 
                  

                    @foreach($tripalldetail AS $tripvalue)
					<?php
					$paidamount=  !empty($tripvalue['paidamount'][0])?$tripvalue['paidamount'][0]->total_paid:'';
					$totaltripcost = !empty($tripvalue['trip_detail'])?$tripvalue['trip_detail']->trip_total_cost:'';
					$reamingamount= $totaltripcost - $paidamount;
					?>
                    <tr class="parent">
						<td><?php echo !empty($tripvalue['user_detail'])?$tripvalue['user_detail'][0]->name:'';?></td>
						<td><?php echo !empty($tripvalue['user_detail'])?$tripvalue['user_detail'][0]->email:'';?></td>
                       <td><?php echo !empty($tripvalue['trip_detail'])?$tripvalue['trip_detail']->name:'';?></td> 
                     
						<td>
						  <?php if(!empty($tripvalue['selected_add_on'])){ $i=1; foreach($tripvalue['selected_add_on'] as $key=> $addvalue){?>
						  <?php echo  '('.$i.')'.$addvalue->addons_name;?></br>
						  <?php $i++;} }?></td>
						
						
						<td  style="color: #008000;">$<?php echo $paidamount;?></td>						
						<td  style="color: #f6ae31;">$<?php echo $reamingamount;?></td>
                </tr>
                @endforeach
              
                </tbody>
            </table>
			  @else 


				<h1>No Record Found..</h1>	
				@endif
        </div>
        <script>
        </script>
    </div>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

    <script type="text/javascript">
            $('.confirmation').on('click', function () {
                return confirm('Are you sure?');
            });

            $('.datechek').on('change', function () {

                var date = $(this).val();
                var trip_id = $(this).parents('.parent').find('.trip_id').val();
                //alert(trip_id);
                $.ajax({
                    method: 'GET',
                    url: './setmonthlypaymentdate/' + date + '/' + trip_id,
                    success: function (response) {
                        if (response == 'data update') {
                            location.reload();
                        }
                    }
                });
            });

            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
    </script>
</div>

@endsection