@extends('layouts.dashboard')
@section('title', 'EMI Calculator')
@section('content')

<div class="pageContainer">
    <div class="dashboardHeader" style="padding : 50px;">
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
                        <a> EMI Details  </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">Welcome  {{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>
    <div class="pageWrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="cust-input-group">
                    <label><span>Total Cost : $5500</span></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="cust-input-group">
                    <label><span>Total Reserve Cost : $2000</span></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="cust-input-group">
                    <label><span>Trip date : 09-05-2018</span></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="cust-input-group">
                    <label><span>Booking Date : </span></label> </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="cust-input-group">
                    <label><span>No emi months : 3</span></label>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <div class="cust-input-group">
                    <label><span>EMI amount : $1920</span></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="cust-input-group">
                    <label><span>EMI payment date  : 5th of each month</span></label>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cke_reset {
        width: 557px;
    </style>
</div>
</div>
@endsection