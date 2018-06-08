@extends('admin.layouts.dashboard')
@section('title', 'Dashboard')

@section('content')

<style type="text/css">
    .form-title {
        background-color: #e3e3e3;
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
                            Addon-travelers
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

    <!-- Create Trip Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Manage Trip</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('trip_id', 'Trip') !!}
                        {!! Form::select('trip_id', [null => 'Select Trip'] + $tripPluck, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('addon_id', 'Addon') !!}
                        {!! Form::select('addon_id', [null => 'Select Addon'], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Traveler Detail</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Michael Moore</td>
                                <td>Eric Taylor</td>
                            </tr>
                            <tr>
                                <td>Michael Moore</td>
                                <td>Eric Taylor</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        // Get trip addons dynamically
        $('#trip_id').on('change', function() {
            $.ajax({
                method: 'GET',
                url: './get-trip-addons/'+$('#trip_id').val(),
                dataType: 'json',
                success: function(response) {
                    // Create addons string and then put
                    var strAddons = '<option value="" selected="selected">Select Addon</option>';
                    
                    if(response.tripAddon.length)
                    {
                        $.each(response.tripAddon, function(index) {
                            strAddons += '<option value="'+response.tripAddon[index].id+'">'+response.tripAddon[index].addons_name+'</option>';
                        });
                    }

                    $('#addon_id').html(strAddons);
                }
            });
        });

        // Get traveller detail by trip/addon dynamically
        /*$(document).on('change', '#addon_id', function() {
            $.ajax({
                method: 'GET',
                url: './get-trip-travellers-by/'+$('#trip_id').val()+'/'+$('#addon_id').val(),
                dataType: 'json',
                success: function(response) {
                    // Create addons string and then put
                    
                }
            });
        });*/
    });
</script>
@endsection