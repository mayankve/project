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
                            Create New Trip
                        </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">

                </h3>
            </div>
        </div>
    </div>

     <!--@include('common.errors')--> 

    {!! Form::open(['url' => 'admin/store-trip', 'files' => true, 'id' => 'form-create-trip', 'method'=>'post']) !!}
    <!-- Create Trip Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Create Trip</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', 'Trip Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        @if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                        {!! Form::label('date', 'Trip Date') !!}
                        {!! Form::date('date', null, ['class' => 'form-control']) !!}
                        @if($errors->has('date'))
                        <span class="help-block">{{ $errors->first('date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                        {!! Form::label('end_date', 'Trip Return Date') !!}
                        {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                        @if($errors->has('end_date'))
                        <span class="help-block">{{ $errors->first('end_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('about_trip') ? 'has-error' : ''}}">
                        {!! Form::label('about_trip', 'About Trip') !!}
                        {!! Form::textarea('about_trip', null, ['class' => 'form-control']) !!}
                        <!--<textarea class="form-control" name="about_trip" wrap="soft" ></textarea>-->
                        @if($errors->has('about_trip'))
                        <span class="help-block">{{ $errors->first('about_trip') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('banner_image') ? 'has-error' : ''}}">
                        {!! Form::label('banner_image', 'Banner Image') !!}
                        {!! Form::file('banner_image', ['class' => 'form-control']) !!}
                        @if($errors->has('banner_image'))
                        <span class="help-block">{{ $errors->first('banner_image') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('banner_video', 'Banner Video URL') !!}
                        {!! Form::text('banner_video', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
				
				 <div class="col-md-6">
                    <div class="form-group {{ $errors->has('maximum_spots') ? 'has-error' : ''}}">
                        {!! Form::label('maximum_spots', 'Maximum spots') !!}
                        {!! Form::text('maximum_spots', null, ['class' => 'form-control']) !!}
                        @if($errors->has('maximum_spots'))
                        <span class="help-block">{{ $errors->first('maximum_spots') }}</span>
                        @endif
                    </div>
                </div>
				
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('minimum_spots') ? 'has-error' : ''}}">
                        {!! Form::label('minimum_spots', 'Minimum spots') !!}
                        {!! Form::text('minimum_spots', null, ['class' => 'form-control']) !!}
                        @if($errors->has('minimum_spots'))
                        <span class="help-block">{{ $errors->first('minimum_spots') }}</span>
                        @endif
                    </div>
                </div>
               
				
				<div class="col-md-6">
                    <div class="form-group {{ $errors->has('maximum_wating_spots') ? 'has-error' : ''}}">
                        {!! Form::label('maximum_wating_spots', 'Maximum waiting spots') !!}
                        {!! Form::text('maximum_wating_spots', null, ['class' => 'form-control']) !!}
                        @if($errors->has('maximum_wating_spots'))
                        <span class="help-block">{{ $errors->first('maximum_wating_spots') }}</span>
                        @endif
                    </div>
                </div>
				
				 <div class="col-md-6">
                    <div class="form-group {{ $errors->has('base_cost') ? 'has-error' : ''}}">
                        {!! Form::label('base_cost', 'Trip base cost') !!}
                        {!! Form::text('base_cost', null, ['class' => 'form-control']) !!}
                        @if($errors->has('base_cost'))
                        <span class="help-block">{{ $errors->first('base_cost') }}</span>
                        @endif
                    </div>
                </div>
				
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('adjustment_date') ? 'has-error' : ''}}">
                        {!! Form::label('adjustment_date', 'Adjustment Last Date') !!}
                        {!! Form::date('adjustment_date', null, ['class' => 'form-control']) !!}
                        @if($errors->has('adjustment_date'))
                        <span class="help-block">{{ $errors->first('adjustment_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('land_only_date') ? 'has-error' : ''}}">
                        {!! Form::label('land_only_date', 'Land Only Dead Line') !!}
                        {!! Form::date('land_only_date', null, ['class' => 'form-control']) !!}
                        @if($errors->has('land_only_date'))
                        <span class="help-block">{{ $errors->first('land_only_date') }}</span>
                        @endif
                    </div>
                </div>
				
				
            </div>
        </div>
    </div>
    <!-- Airline Panel -->
    <div class="panel panel-default">
        @include('admin.trip.partials.create-trip-airlines')
    </div>
     <!-- Hotel Panel -->
    <div class="panel panel-default">
        @include('admin.trip.partials.create-trip-hotels')
    </div>
    <!-- Included Actiivity Panel -->
    <div class="panel panel-default">
        @include('admin.trip.partials.create-trip-included-activity')
    </div>
    <!-- Add-ons Panel -->
    <div class="panel panel-default">
        @include('admin.trip.partials.create-trip-add-ons')
    </div>
   
    <!-- Packing Panel -->
    <div class="panel panel-default">
        @include('admin.trip.partials.create-trip-to-do-list')
    </div>
    <!-- Entry Requirements Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Entry requirements</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('requirement_is_passport', 'Is passport required?') !!}
                        <br>
                        <label class="radio-inline">
                            {!! Form::radio('requirement_is_passport', 0, true) !!}No
                        </label>
                        <label class="radio-inline">
                            {!! Form::radio('requirement_is_passport', 1) !!}Yes
                        </label>
                    </div>
                    <div class="row is-passport-more hidden">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('requirement_passport_min_expiry', 'Passport Min Expiry Date') !!}
                                {!! Form::date('requirement_passport_min_expiry', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('requirement_is_visa', 'Is visa required?') !!}
                        <br>
                        <label class="radio-inline">
                            {!! Form::radio('requirement_is_visa', 0, true) !!}No
                        </label>
                        <label class="radio-inline">
                            {!! Form::radio('requirement_is_visa', 1) !!}Yes
                        </label>
                    </div>
                    <div class="row is-visa-more hidden">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('requirement_visa_cost', 'Visa Cost') !!}
                                {!! Form::text('requirement_visa_cost', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('requirement_visa_process', 'Visa Process') !!}
                                {!! Form::text('requirement_visa_process', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('requirement_is_shots', 'Is Shots/Medication required?') !!}
                        <br>
                        <label class="radio-inline">
                            {!! Form::radio('requirement_is_shots', 0, true) !!}No
                        </label>
                        <label class="radio-inline">
                            {!! Form::radio('requirement_is_shots', 1) !!}Yes
                        </label>
                    </div>
                    <div class="row is-shots-more hidden">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('requirement_shots_cost', 'Shots Cost') !!}
                                {!! Form::text('requirement_shots_cost', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('requirement_shots_timeframe', 'Shots Timeframe') !!}
                                {!! Form::text('requirement_shots_timeframe', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Misc Expense -->
    <div class="panel panel-default">
         @include('admin.trip.partials.create-trip-misc-expense')
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
        </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		
		//Set Trip Date minimum value
		var trip_date = document.getElementById('date');
		trip_date.min = current_date();
		
		//Set Trip End Date minimum value
		var trip_end_date = document.getElementById("end_date");
		trip_end_date.min = current_date();
		
		//Set Trip adjustment Date minimum value
		var adjustment_date = document.getElementById("adjustment_date");
		adjustment_date.min = current_date();
		
		//Set Trip land-only Date minimum value
		var land_only_date = document.getElementById("land_only_date");
		land_only_date.min = current_date();
			
	});
	//Returns current date
	function current_date(){
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();

		var output = d.getFullYear() + '-' +
		((''+month).length<2 ? '0' : '') + month + '-' +
		((''+day).length<2 ? '0' : '') + day;
		return output;
	}
		
	CKEDITOR.replace('about_trip');

    $(function () {
        $('input[name=requirement_is_passport]').on('change', function () {
            entryRequirementsChange('passport');
        });

        $('input[name=requirement_is_visa]').on('change', function () {
            entryRequirementsChange('visa');
        });

        $('input[name=requirement_is_shots]').on('change', function () {
            entryRequirementsChange('shots');
        });
    });

    // function to show/hide Entry Requirements
    function entryRequirementsChange(part = null)
    {
        if ($('input[name=requirement_is_' + part + ']:checked').val() == '1')
        {
            $('.is-' + part + '-more').removeClass('hidden');
        } else
        {
            $('.is-' + part + '-more').addClass('hidden');
        }
    }
	
	$('#form-create-trip').submit(function(event ){
		var trip_name = $('#date').val();
                var trip_date = $('#name').val();
                 if(trip_name == ''){
			 alert('Please enter Trip Name');
			 $('#name').focus();
			 return false;
		 }
		 if(trip_date == ''){
			 alert('Please select Trip Date');
			 $('#date').focus();
			 return false;
		 }
		var trip_return_date = $("input[name$='end_date']").val();
		   if(trip_return_date == ''){
			   alert("Please select trip end date");
			   $("input[name$='end_date']").focus();
			   return false;
		   }
		 else if(trip_return_date < trip_date){
			 alert("Trip Return date should not be smaller than trip date");
			 $("input[name$='end_date']").focus();
			 return false;
		 }
		
		//event.preventDefault();
	});
	
	$('.airline_departure_date').on('change',function(){
		var trip_return_date = $("input[name$='end_date']").val();
		//alert($(this).val());
		if($(this).val() > trip_return_date){
			 alert("Airline departure should not be after Trip Return date");
		   }
	})
	
</script>
@endsection