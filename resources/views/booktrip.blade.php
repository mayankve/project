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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <!--<form method="POST" name="traveler-details" action="/aat_zend/public/book/20" id="traveler-details">-->  
         
            {!! Form::open(['url' => 'booktrip', 'id' => 'form-book-trip' , 'method'=>'get']) !!}
            <input name="trip_id" type="hidden" value="{{$tripdata->id}}">
            <div class="row-box">
                <div class="form-title">
                    <div class="col-md-6 col-xs-10">
                        <h3 class="panel-title">Traveler Details</h3>
                    </div>
                    <div class="text-right">
                        <a class="addMore add_more_traveler" row="travelerDetails-row">
                            <i class="fa fa-plus" aria-hidden="true">
                            </i>
                        </a> 
                    </div>
                </div>
                @if(count(old('traveler')))
                <?php // echo "<pre>"; print_r(old('traveler')); die;?>
                @foreach (old('traveler') as $key => $value)
                <div class="col-md-12 add_traveler">
                    <div class="cust-input-group travelerDetails-row pt-4 pb-2">            
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler['.$key.'][first_name]', 'First Name') !!}
                                    {!! Form::text('traveler['.$key.'][first_name]', null, ['class' => 'form-control traveler_name']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler['.$key.'][last_name]', 'Last Name') !!}
                                    {!! Form::text('traveler['.$key.'][last_name]', null, ['class' => 'form-control  traveler_name']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler['.$key.'][email]', 'Email') !!}
                                    {!! Form::text('traveler['.$key.'][email]', null, ['class' => 'form-control traveler_name']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler['.$key.'][gender]', 'Gender') !!}
                                    {!! Form::select('traveler['.$key.'][gender]', ['1' => 'Male', '2' => 'Female'],null,['class' => 'form-control']); !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler['.$key.'][city]', 'City') !!}
                                    {!! Form::text('traveler['.$key.'][city]',null,['class' => 'form-control']); !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler['.$key.'][profile_image]', 'Profile Image') !!}
                                    {!! Form::file('traveler['.$key.'][profile_image]',null,['class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>
                        <!-- Remove detail container -->
                        <div id="remove_trip_traveler"></div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-md-12 add_traveler">
                    <div class="cust-input-group travelerDetails-row pt-4 pb-2">            
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler[0][first_name]', 'First Name') !!}
                                    {!! Form::text('traveler[0][first_name]', null, ['class' => 'form-control traveler_name']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler[0][last_name]', 'Last Name') !!}
                                    {!! Form::text('traveler[0][last_name]', null, ['class' => 'form-control  traveler_name']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler[0][email]', 'Email') !!}
                                    {!! Form::text('traveler[0][email]', null, ['class' => 'form-control traveler_name']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler[0][gender]', 'Gender') !!}
                                    {!! Form::select('traveler[0][gender]', ['1' => 'Male', '2' => 'Female'],null,['class' => 'form-control']); !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler[0][city]', 'City') !!}
                                    {!! Form::text('traveler[0][city]', null, ['class' => 'form-control traveler_name']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('traveler[0][profile_image]', 'Profile Image') !!}
                                    {!! Form::file('traveler[0][profile_image]',null,['class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>
                        <!-- Remove detail container -->
                        <div id="remove_trip_traveler"></div>
                    </div>
                </div>
                @endif
                <div class="col-md-6 cust-input-group sendbtn regbtn mt-0 mb-3">
                    <label class="lable_cost">Total Base Cost: $564</label>
                    <input type="submit" name="submit" id="submitbutton" value="Book and Pay">
                </div>
                <div class="col-md-12">
                    <label>Note: Once you book this trip, you can design it with available options.</label>
                </div>
            </div>
           	{!! Form::close() !!}
        </div>
    </div>
</div>

@endsection