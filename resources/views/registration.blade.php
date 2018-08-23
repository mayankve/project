@extends('layouts.home')
@section('title', 'Registration')
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
    <div class="" id="pageWrapper">
        <div id="my_information_container" class="tabcontent">
            <!--          Registration Information-->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Registration</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="basic_info_view">   
                        <form method="POST" name="frm_user_basic_info" id="frm_user_basic_info"><div class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-3 custom-lbl">Name </label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                           
                                            <div class="user-edit col-sm-6">
                                                <input type="text" name="first_name" id="first_name" class="form-control" value="">
                                            </div>
                                            <div class="user-edit col-sm-6">
                                                <input type="text" name="last_name" id="last_name" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3 custom-lbl">Gender</label>
                                    <div class="col-sm-9">
                                        
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
                                        
                                        <div class="user-edit">
                                            <input type="text" name="dob" class="form-control" id="dob" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" control-label col-sm-3 custom-lbl">Email</label>
                                    <div class="col-sm-9">
                                     
                                        <div class="user-edit">
                                            <input type="email" name="email" id="email" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group no-border">
                                    <label class="control-label col-sm-3 custom-lbl">Do You currently have a passport</label>
                                    <div class="col-sm-9">
                                       
                                        <div class="user-edit checkbtn">
                                            <label>
                                                <input type="radio" name="is_passport" class="is-passport"  value="0">No
                                            </label>
                                            <label>
                                                <input type="radio" name="is_passport" checked="checked" class="is-passport" value="1" >Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group passport_data">
                                    <label class="col-sm-3 control-label custom-lbl">Passport Copy</label>
                                    <div class="col-sm-9">
                                        <label class=" user-view profile-view inputlabl image" style="font-weight: normal">
                                            <img src="" alt="AAT" class="img-responsive model_image">
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
                                        
                                        <div class="user-edit">
                                            <input type="date" name="passport_exp_date" class="form-control" id="passport_exp_date" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group passport_data">
                                    <label class="control-label col-sm-3 custom-lbl">Issuing Country</label>
                                    <div class="col-sm-9">
                                        
                                        <div class="user-edit">
                                            <select name="issuing_country" id="issuing_country" class="form-control">
                                                <option value="">Select</option>
                                                <?php
                                                if (count($data['countries']) > 0) {
                                                    foreach ($data['countries'] AS $country) {
														?>
                                                            <option selected="selected" value="{{ $country->id }}" >{{ $country->name }}</option>
                                                        <?php
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
                                        <div class="user-edit">
                                            <select name="country_of_birth" id="country_of_birth" class="form-control">
                                                <option value="">Select</option>
                                                <?php
                                                if (count($data['countries']) > 0) {
                                                    foreach ($data['countries'] AS $country) {
                                                      ?>  
													  <option  value="{{ $country->id }}" >{{ $country->name }}</option>

                                                    <?php }
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
            <br>
        </div>
    </div>
</div>
@endsection