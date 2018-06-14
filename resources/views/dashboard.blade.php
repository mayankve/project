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

<?php //echo "<pre>";print_r($userdata);die; ?>
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
                    Welcome  {{$data['name']}}</h3>
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
                        <form method="POST" name="frm_user_basic_info" id="frm_user_basic_info"><div class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-3 custom-lbl">Name </label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label class="user-view inputlabl" style="font-weight: normal">{{ ucwords( strtolower( $data['first_name'] ) ) . ' ' . ucwords( strtolower( $data['last_name'] ) ) }}</label>
                                            </div>
                                            <div class="user-edit col-sm-6">
                                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $data['first_name'] }}">
                                            </div>
                                            <div class="user-edit col-sm-6">
                                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $data['last_name'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 custom-lbl">Gender</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ ( $data['gender'] == '1' ) ? 'Male' : 'Female' }}</label>
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
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ date('Y-m-d', strtotime($data['dob'])) }}</label>
                                        <div class="user-edit">
                                            <input type="text" name="dob" class="form-control" id="dob" value="{{ date('Y-m-d', strtotime($data['dob'])) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" control-label col-sm-3 custom-lbl">Email</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ $data['email'] }}</label>
                                        <div class="user-edit">
                                            <input type="email" name="email" id="email" class="form-control" value="{{ $data['email'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group no-border">
                                    <label class="control-label col-sm-3 custom-lbl">Do You currently have a passport</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ $data['is_passport'] ? 'Yes':'No' }}</label>
                                        <div class="user-edit checkbtn">
                                            <label>
                                                <input type="radio" name="is_passport" class="is-passport" value="0" {{ ( $data['is_passport'] == '0' ) ? 'checked' : '' }}>No
                                            </label>
                                            <label>
                                                <input type="radio" name="is_passport" class="is-passport" value="1" {{ ( $data['is_passport'] == '1' ) ? 'checked' : '' }}>Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group passport_data">
                                    <label class="col-sm-3 control-label custom-lbl">Passport Copy</label>
                                    <div class="col-sm-9">
                                        <label class=" user-view profile-view inputlabl image" style="font-weight: normal">
                                            <img src="{{ url('/') . '/passport_images/' . $data['passport_pic'] }}" alt="AAT" class="img-responsive model_image">
                                        </label>
                                        <div class="user-edit">
                                            <input type="file" name="passport_pic" id="passport_pic" class="form-control&#x20;image_upload" id="passport_pic">
                                            <img id="passport_pic_img" class="img-responsive model_image"  style="max-width: 80px; max-height: 80px;" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group passport_data">
                                    <label class="control-label col-sm-3 custom-lbl">Passport Exp Date</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ $data['passport_exp_date'] }}</label>
                                        <div class="user-edit">
                                            <input type="date" name="passport_exp_date" class="form-control" id="passport_exp_date" value="{{ $data['passport_exp_date'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group passport_data">
                                    <label class="control-label col-sm-3 custom-lbl">Issuing Country</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ $data['issuing_country'] != '' ? $data['issuing_country'] : 'NA' }}</label>
                                        <div class="user-edit">
                                            <select name="issuing_country" id="issuing_country" class="form-control">
                                                <option value="">Select</option>
                                                <?php
                                                if (count($countries) > 0) {
                                                    foreach ($countries AS $country) {
                                                        if ($user_country->issuing_country == $country->id) {
                                                            ?>
                                                            <option selected="selected" value="{{ $country->id }}" >{{$country->name}}</option>
                                                        <?php } else {
                                                            ?>   <option  value="{{ $country->id }}" >{{$country->name}}</option><?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group passport_data">
                                    <label class="control-label col-sm-3 custom-lbl">Country of Birth</label>
                                    <div class="col-sm-9">
                                        <label class="user-view inputlabl" style="font-weight: normal">{{ $data['country_of_Birth'] != '' ? $data['country_of_Birth'] : 'NA' }}</label>
                                        <div class="user-edit">
                                            <select name="country_of_birth" id="country_of_birth" class="form-control">
                                                <option value="">Select</option>
                                                <?php
                                                if (count($countries) > 0) {
                                                    foreach ($countries AS $country) {
                                                        if ($user_country->country_of_Birth == $country->id) {
                                                            ?>
                                                            <option selected="selected" value="{{ $country->id }}" >{{$country->name}}</option>
                                                        <?php } else {
                                                            ?>   <option  value="{{ $country->id }}" >{{$country->name}}</option><?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>    
                                        </div>
                                    </div>
                                </div>
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
                    var is_passport = "1";

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
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Profile <strong>Information</strong></h3>
                    <div class="panel-tools">
                        <a href="javascript:void(0)" class="profile_info"><i class="fa fa-pencil" aria-hidden="true" ></i></a>
                        <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="profile_info_view">
                        <form method="POST" name="frm_user_profile_info" action="&#x2F;aat_backup&#x2F;public&#x2F;dashboard" enctype="multipart&#x2F;form-data" id="frm_user_profile_info">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">Profile Pic</label>
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl image" style="font-weight: normal">
                                            <img src="{{ url('/') . '/profile_images/' . $profile['profile_pic'] }}" alt="tm-01" class="img-responsive model_image" />
                                        </label>
                                        <div class="profile-edit">
                                            <input type="file" name="profile_pic" id="profile_pic" class="form-control&#x20;image_upload" id="profile_pic">                <img id="profile_pic_img" class="img-responsive model_image" style="max-width: 28%;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">Food Allergies</label>
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['food_allergies'] }}</label>
                                        <div class="profile-edit">
                                            <input type="text" name="food_allergies" id="food_allergies" class="form-control" value="{{ $profile['food_allergies'] }}">            </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">Shirt Size</label>
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['shirt_size'] }}</label>
                                        <div class="profile-edit">
                                            <input type="text" name="shirt_size" id="shirt_size" class="form-control" value="{{ $profile['shirt_size'] }}">            </div>
                                    </div>
                                </div>       
                                <div class="form-group">
                                    <div class="form-title">
                                        <div class="col-md-12"><h3>Health information</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">Do you have any known health conditions</label>
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['helth_mental_conditions'] }}</label>
                                        <div class="profile-edit">
                                            <label><input type="radio" name="is_helth_mental" class="is_helth_conditions" value="0">No</label><label><input type="radio" name="is_helth_mental" class="is_helth_conditions" value="1" checked="checked">Yes</label>            </div>
                                        <div class="profile-edit">
                                            <input type="text" id="helth_mental_conditions" name="helth_mental_conditions" class="form-control&#x20;helth_conditions" style="" value="a">            </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">Do you have any known mental conditions</label>
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['is_mental_conditions'] }}</label>
                                        <div class="profile-edit">
                                            <label><input type="radio" name="is_mental_conditions" class="is_mental_conditions" value="0" checked="checked">No</label><label><input type="radio" name="is_mental_conditions" class="is_mental_conditions" value="1">Yes</label>            </div>
                                        <div class="profile-edit">
                                            <input type="text" id="mental_conditions" name="mental_conditions" class="form-control&#x20;mental_conditions" style="display&#x3A;&#x20;none" value="{{ $profile['mental_conditions'] }}">            </div>
                                    </div>
                                </div>



                                <!--- Emergency contact information -->
                                <div class="form-group">
                                    <div class="form-title">
                                        <div class="col-md-12"><h3>Emergency contact information</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">Name</label>

                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['emergency_contact_name'] }}</label>
                                        <div class="profile-edit">
                                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control" value="{{ $profile['emergency_contact_name'] }}">                </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">Phone</label>	
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['emergency_contact_phone'] }}</label>
                                        <div class="profile-edit">
                                            <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="form-control" value="{{ $profile['emergency_contact_phone'] }}">                </div>
                                    </div>
                                </div>
                                <!-- end  Emergency contact information -->  

                                <!-- Personality questions -->
                                <div class="form-group">
                                    <div class="form-title">
                                        <div class="col-md-12"><h3>Personality questions</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">What are your previous travel experiences?</label>
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['personality_previous_travel'] }}	</label>
                                        <div class="profile-edit">
                                            <input type="text" name="personality_previous_travel" id="personality_previous_travel" class="form-control" value="{{ $profile['personality_previous_travel'] }}">                </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">Where are your originally from?</label>
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['personality_originally_from'] }}</label>
                                        <div class="profile-edit">
                                            <input type="text" name="personality_originally_from" id="personality_originally_from" class="form-control" value="{{ $profile['personality_originally_from'] }}">                </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label custom-lbl">Where did you go to school?</label>
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['personality_school'] }}</label>
                                        <div class="profile-edit">
                                            <input type="text" name="personality_school"  id="personality_school" class="form-control" value="{{ $profile['personality_school'] }}">                </div>
                                    </div>
                                </div>
                                <div class="form-group no-border">
                                    <label class="col-sm-3 control-label custom-lbl">Is there anything else we should know about you?</label>
                                    <div class="col-sm-9">
                                        <label class="profile-view inputlabl" style="font-weight: normal">{{ $profile['personality_about'] }}</label>
                                        <div class="profile-edit">
                                            <input type="text" name="personality_about" id="personality_about" class="form-control" value="{{ $profile['personality_about'] }}">                </div>
                                    </div>
                                </div>

                                <!--  end Personality questions -->
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <div class="profile-edit update-btn">
                                            <input type="submit" name="submit"   id="submit_profile" value="Update&#x20;Profile&#x20;Info">            </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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