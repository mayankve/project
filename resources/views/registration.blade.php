@extends('layouts.home')
@section('title', 'Registration')
@section('content')
<div class="wrapper">
    <div class="alert-message">
    </div>
    <div class="container contact-form">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title text-center">
                    <h2>REGISTRATION</h2>
                </div>
            </div>
        </div>
         {!! Form::open(['url' => 'register-user', 'id' => 'form-register', 'method'=>'post']) !!}
        <div class="col-md-8 col-md-offset-2">
                <div class="form_bg">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="cust-input-group">
                                <label><span>First Name</span>
                                    <input type="text" name="first_name" class="form-control" required="required" value=""></label>   
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cust-input-group">
                                <label><span>Last Name</span>
                                    <input type="text" name="last_name" class="form-control" required="required" value=""></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="mycss classes "><span>Gender</span>
                                <select name="gender" class="form-control">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select></label>
                        </div>
                        <div class="col-md-6">
                            <label for="dob">DOB</label>
                            <input type="date" name="dob" class="form-control hasDatepicker" id="dob" required="required" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label><span>Email</span>
                                <input type="email" name="email" class="form-control" required="required" value="">
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label><span>Password</span>
                                <input type="password" name="password" class="form-control" required="required" value="">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 cust-input-group">
                            <div class="checkbtn">
                                <fieldset><legend>Do You currently have a passport</legend>
                                    <label>
                                        <input type="radio" name="is_passport" class="is-passport" required="required" value="0" checked="checked">No</label>
                                    <label><input type="radio" name="is_passport" class="is-passport" required="required" value="1">Yes</label>
                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row passport_data" style="">
                        <div class="col-md-6">
                            <label for="passport_exp_date">Passport Exp Date</label><input type="date" name="passport_exp_date" class="form-control hasDatepicker" id="passport_exp_date" value="">         </div>

                        <div class="col-md-6">
                            <label><span>Issuing Country</span>
                                <select name="issuing_country" class="form-control">
                                    <?php
                                    if (count($data['countries']) > 0) {
                                        foreach ($data['countries'] AS $country) {
                                            ?>
                                            <option  value="{{ $country->id }}" >{{ $country->name }}</option>

                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="row passport_data" style="">
                        <div class="col-md-6">
                            <label><span>Country of Birth</span>
                                <select name="country_of_birth" class="form-control">
                                    <?php
                                    if (count($data['countries']) > 0) {
                                        foreach ($data['countries'] AS $country) {
                                            ?>
                                            <option  value="{{ $country->id }}" >{{ $country->name }}</option>

                                        <?php }
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6 sendbtn"> <i class="sendicon" aria-hidden="true"></i>
                            <input type="submit" name="submit" id="submitbutton" value="Register">
                        </div>
                    </div>
                </div>
            </div>
    {!! Form::close() !!}
        <!--</form>-->
        </div>
<script>
    $(document).ready(function () {
        $('.passport_data').hide();
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

        $('.passport_data').hide();
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
    </div>
    @endsection