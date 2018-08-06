@extends('admin.layouts.home')
@section('title', 'AAT:EMI Caclculation')
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
            <div class="dashboardHeader">
                <div class="row">
                    <div class="col-sm-8 text-left">
                        <ol class="breadcrumb">
                            <li> <a class="desh-title" href="#">{{$tripdata->name}}</a> </li>
                        </ol>
                    </div>
                    <div class="col-sm-4 text-right">
                        <ol class="breadcrumb">
                            <li> <a class="desh-title">Base Cost:${{$tripdata->base_cost}}</a> </li>
                        </ol>
                    </div>
                </div>
            </div>
               
          
        </div>
    </div>
</div>

<script>
var value = 1;
var price='<?php echo $tripdata->base_cost;?> ';
$('.add_more_traveler').click(function(){
	
		value=value+1;
		$('.lable_cost').html("$"+price * value);
});


$('#remove_trip_traveler').click(function(){
	alert("clicked");
        value=value-1;
        alert(value);
        $('.lable_cost').html("$"+price * value);
});


</script>

@endsection