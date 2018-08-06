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

     @include('common.errors') 

    {!! Form::open(['url' => 'admin/check-validation', 'method'=>'post']) !!}
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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
        </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection