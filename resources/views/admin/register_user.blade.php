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
                            Register User    </a>
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
                <h3 class="panel-title">Register User</h3>
                <div class="panel-tools"> </div>
            </div>
        </div>
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
						<th>First Name</th>
						<th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>		 
                        <th>Date of birth</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @if(count($userdetail)>0)

                    @foreach($userdetail AS $userdetail)
                    <tr class="parent">
                        <td>{{$userdetail->first_name}}</td>
                        <td>{{$userdetail->last_name}}</td>
                        <td>{{$userdetail->email}}</td>
						 <td>{{$userdetail->gender}}</td>
						 <td>{{$userdetail->dob}}</td>

                        <td>
							<a href="{{url('admin/user_detail/'.$userdetail->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
						</td>
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