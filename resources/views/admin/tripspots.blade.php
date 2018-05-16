@extends('admin.layouts.dashboard')
@section('title', 'Dashboard')

@section('content')

<style type="text/css">
    .form-title {
        background-color: #e3e3e3;
        /* margin-bottom: 40px; */
        text-transform: uppercase;
    }
</style>

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
    <table class="table table-bordered table-striped table-hover table-color">
      <thead>
        <tr>
          <th>Trip Name</th>
          <th>Total Spots</th>
          <th>Booked</th>
          <th>Available</th>
        </tr>
      </thead>
          <tbody> 
                @if(count($trips)>0)
                @foreach($trips AS $trip)
                    <tr>
                    <td>{{$trip->name}}</td>
                    <td>{{$trip->maximum_spots}}</td>
                    <td>{{$trip->name}}</td>
                    <td>{{$trip->name}}</td>
                    </tr>
              @endforeach
                @endif   
              </tbody>
    </table>
  </div>
  <script>
</script>
</div>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>
</div>

@endsection