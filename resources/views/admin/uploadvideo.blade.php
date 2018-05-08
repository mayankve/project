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
                             Upload-trip-video   </a>
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
                <h3 class="panel-title">Upload Passed Trip's Video</h3>
                <div class="panel-tools">
                </div>
            </div>
        </div>

 <form method="POST" name="trip-upload-video" action=""  id="trip-upload-video">  
            <div class="form-fluid">
                <div class="row-box">
                    <div class="col-md-12">

                        <br/>
                        <div class="row">
                            <div class="col-md-6  cust-input-group">
                                <label class="mycss&#x20;classes&#x20;"><span>Trip</span>
                                    <select name="select_trip" class="form-control">
                                        <option value="">Select Trip</option>
                                     </select></label> 
                            </div>
                            <div class="col-md-6  cust-input-group">
                                <label for="trip_video">Upload Trip Video	</label><input type="file" name="trip_video" class="form-control" id="trip_video">                    </div>


                        </div>
                        <div class="row ">     
                            <div class="col-md-6  cust-input-group">
                                <label><span>About video</span><textarea name="about_video" class="form-control"></textarea></label>                    </div>

                        </div>
                        <div class="row ">     
                            <div class="col-md-12 text-right ">
                                <input type="submit" name="submit" id="submitbutton" value="Upload&#x20;Video">                    </div>

                        </div>
                    </div>
                </div>     
                <div id="progress" class="help-block">
                    <div class="progress progress-info progress-striped">
                        <div class="bar"></div>
                    </div>
                    <p></p>
                </div>

            </div>
        </form>
    </div>
    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            return confirm('Are you sure?');
        });
    </script>
</div>

@endsection