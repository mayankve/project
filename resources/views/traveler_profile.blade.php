@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
<style>
    /* Style the tab */
    div.tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    div.tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    div.tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    div.tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
        border-bottom: none;
    }
    .tabcontent {
        -webkit-animation: fadeEffect 1s;
        animation: fadeEffect 1s; /* Fading effect takes 1 second */
    }

    @-webkit-keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    @keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
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
                            My Information    </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">
                    Welcome  <?php echo $travelerprofile->first_name;?>
                </h3>
            </div>
        </div>
    </div>
	
    
    <div class="" id="pageWrapper">
        <div id="my_information_container" class="tabcontent">
            <!--          Basic Information-->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Basic <strong>Information</strong></h3>
                    <div class="panel-tools">
                        <a href="#" class="basic_info"><i class="fa fa-pencil" aria-hidden="true" ></i></a>
                        <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
                      <!--<a href="#"><span class="basic_info"><i class="fa fa-edit" aria-hidden="true" ></i></span></a>
                        <a href="#"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
                    </div>

                </div>
                <div class="panel-body">
                    <div class="basic_info_view">   
                        <form method="POST"><div class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-3 custom-lbl">Name </label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label class="user-view inputlabl" style="font-weight: normal">{{ ucwords( strtolower(  $travelerprofile->first_name) ) . ' ' . ucwords( strtolower( $travelerprofile->last_name ) ) }}</label>
                                            </div>
                                            <div class="user-edit col-sm-6">
                                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $travelerprofile->first_name}}">
                                            </div>
                                            <div class="user-edit col-sm-6">
                                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{$travelerprofile->last_name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 custom-lbl">Gender</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ ( $travelerprofile->gender == '1' ) ? 'Male' : 'Female' }}</label>
                                        <div class="user-edit">
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="1" selected="">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 custom-lbl">DOB</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ date('Y-m-d', strtotime($travelerprofile->dob)) }}</label>
                                        <div class="user-edit">
                                            <input type="text" name="dob" class="form-control" id="dob" value="{{ date('Y-m-d', strtotime($travelerprofile->dob)) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" control-label col-sm-3 custom-lbl">Email</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ $travelerprofile->email }}</label>
                                        <div class="user-edit">
                                            <input type="email" name="email" id="email" class="form-control" value="{{ $travelerprofile->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group no-border">
                                    <label class="control-label col-sm-3 custom-lbl">Do You currently have a passport</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{($travelerprofile->is_passport==1) ? 'Yes':'No' }}</label>
                                        <div class="user-edit checkbtn">
                                            <label>
                                                <input type="radio" name="is_passport" class="is-passport"  value="0" <?php echo ($travelerprofile->is_passport=='0')?'checked':'';?>>No
                                            </label>
                                            <label>
                                                <input type="radio" name="is_passport" class="is-passport" value="1" <?php echo ($travelerprofile->is_passport=='1')?'checked':'';?>>Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>

                               < <div class="form-group passport_data">
                                    <label class="col-sm-3 control-label custom-lbl">Passport Copy</label>
                                    <div class="col-sm-9">
                                        <label class=" user-view profile-view inputlabl image" style="font-weight: normal">
                                            <img src="{{ url('/') . '/passport_images/' . $travelerprofile->passport_pic }}" alt="AAT" class="img-responsive model_image">
                                        </label>
                                        <div class="user-edit">
                                            <input type="file" name="passport_pic"  class="form-control&#x20;image_upload" id="passport_pic">
                                            <img id="passport_pic_img" class="img-responsive model_image"  style="max-width: 80px; max-height: 80px;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group passport_data">
                                    <label class="control-label col-sm-3 custom-lbl">Passport Exp Date</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ $travelerprofile->passport_exp_date }}</label>
                                        <div class="user-edit">
                                            <input type="date" name="passport_exp_date" class="form-control" id="passport_exp_date" value="{{  $travelerprofile->passport_exp_date }}">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                
                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <div class="user-edit update-btn">
                                            <input type="submit" name="submit" id="submitbutton" class="user-edit" value="Update Basic Info">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>

            <script>
                $(function () {
                    var submitForm = "0";
                    if (submitForm == '1') {
                        $('.user-edit').show();
                        $('.user-view').hide();
                    } else {
                        $('.user-edit').hide();
                    }
                    //$('.basic_info').trigger('click');
                    //$('.user-edit').hide();
                    $('.basic_info').click(function () {
                        $('.user-edit').toggle();
                        $('.user-view').toggle();
                    });


                    $('#dob').datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: 'yy-mm-dd'
                    });
                    $('#passport_exp_date').datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: 'yy-mm-dd',
                        minDate: 0
                    });
                    
                    var is_passport = "<?php echo $travelerprofile->is_passport;?>";

                    if (is_passport == '1') {
                        $('.passport_data').show();

                    } else {
                        $('.passport_data').hide();
                    }

                    $('.is-passport').click(function () {
                        var is_passport = $(this).val();
       
                        if (is_passport == 1) {
                            $('.passport_data').show();
                        } else {
                            $('.passport_data').hide();
                        }
                    });

                });
            </script>

            <script type="text/javascript">
                $(document).on('click', '.panel-heading span.clickable', function (e) {
                    var $this = $(this);
                    if (!$this.hasClass('panel-collapsed')) {
                        $this.parents('.panel').find('.panel-body').slideUp();
                        $this.addClass('panel-collapsed');
                        $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                    } else {
                        $this.parents('.panel').find('.panel-body').slideDown();
                        $this.removeClass('panel-collapsed');
                        $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                    }
                });
                $(function () {
                    $('head').append('<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">');
                });
            </script>

            <br>
            <!-- Profile Information -->
           
            <script>


                $(function () {

                    $('.image_upload').change(function (event) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var img_id = event.target.id;
                            $('#' + img_id + '_img').attr('src', e.target.result)
                        };
                        reader.readAsDataURL(this.files[0]);
                    })

                    var submitForm = "0";
                    if (submitForm == '2') {
                        $('.profile-edit').show();
                        $('.profile-view').hide();

                    } else {
                        $('.profile-edit').hide();
                        $('.profile-view').show();
                    }
                    //$('.basic_info').trigger('click');
                    //$('.profile-edit').hide();
                    $('.profile_info').click(function () {
                        $('.profile_info_view').focus();
                        $('.profile-edit').toggle();
                        $('.profile-view').toggle();
                    });
                    $('.is_helth_conditions').click(function () {
                        if ($(this).val() == 0) {
                            $('.helth_conditions').hide();
                        } else {
                            $('.helth_conditions').show();
                        }
                    })
                    $('.is_mental_conditions').click(function () {
                        if ($(this).val() == 0) {
                            $('.mental_conditions').hide();
                        } else {
                            $('.mental_conditions').show();
                        }
                    })

                });
            </script>
        </div>
        <div id="my_trip_container" class="tabcontent">
            <h3>My Trip</h3>
        </div>

        <!-- Server Response -->
        <div class="modal fade" id="server_response" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <a style="width: 80px;" id="bt-modal-cancel" class="btn btn-success" href="javascript:void(0);" data-dismiss="modal">OK</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Server Response -->

    </div>
<script>
    $('.tablinks').click(function () {
        var id = $(this).attr('id');
        $('.tablinks').removeClass('active')
        $(this).addClass('active');
        $('.tabcontent').hide();
        var idc = '#' + id + '_container';
        $(idc).show();
    });
    $("#my_information").trigger("click");

</script>
</div>
@endsection