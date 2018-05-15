/* Common js for all front-end related functionalities like register, login etc */

$(document).ready(function () {

    $('#frm_user_basic_info').submit(function (e) {
        e.preventDefault();
    });
    $('#frm_user_basic_info').validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            gender: {
                required: true,
            },
            dob: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            is_passport: {
                required: true,
            },
            passport_pic: {
                required: true,
            },
            passport_exp_date: {
                required: true,
            },
            issuing_country: {
                required: true,
            },
            country_of_birth: {
                required: true,
            }
        },
        messages: {
            email: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            first_name: {
                required: 'Please enter first name',
            },
            last_name: {
                required: 'Please enter last name',
            },
            gender: {
                required: 'Please select gender',
            },
            dob: {
                required: 'Please select dob',
            },
            is_passport: {
                required: 'Please enter passport',
            },
            passport_pic: {
                required: 'Please upload passport pic',
            },
            passport_exp_date: {
                required: 'Please select passport expiry date',
            },
            issuing_country: {
                required: 'Please select passport issuing country',
            },
            country_of_birth: {
                required: 'Please select country of birth',
            }
        }
    });

    // Check the user credentials for backend login
    $('#submitbutton').click(function () {
        // Check the validation
        if ($('#frm_user_basic_info').valid())
        {
        // hold the button reference
        let $this = $(this);
                let fname = $('#first_name').val();
                let lname = $('#last_name').val();
                let gender = $('#gender').val();
                let dob = $('#dob').val();
                let email = $('#email').val();
                let passportAvailable = $("input[name='is_passport']:checked").val();
                let passportExpDate = $('#passport_exp_date').val();
                let issuingCountry = $('#issuing_country').val();
                let countryOfBirth = $('#country_of_birth').val();
                let
        passportPic = $('#passport_pic').prop('files')[0];
                // Append these values in FormData
                var formData = new FormData();
        formData.append('fname', fname);
        formData.append('lname', lname);
        formData.append('gender', gender);
        formData.append('dob', dob);
        formData.append('email', email);
        formData.append('passportAvailable', passportAvailable);
        formData.append('passportExpDate', passportExpDate);
        formData.append('issuingCountry', issuingCountry);
        formData.append('countryOfBirth', countryOfBirth);
        formData.append('passportPic', passportPic);

        $.ajax({
            url: $('meta[name="route"]').attr('content') + '/updateuserbasicinfo',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // Show the loading button
                $this.button('loading');
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            complete: function ()
            {
                // Change the button to previous
                $this.button('reset');

            },
            success: function (response) {
                if (response.errCode == 0)
                {
                    location.reload();
                    $('#server_response').find('.modal-header').html('Success');
                    $('#server_response').find('.modal-body').html(response.errMsg);
                    $('#server_response').modal('show');
                } else
                {
                    $('#server_response').find('.modal-header').html('Alert');
                    $('#server_response').find('.modal-body').html(response.errMsg);
                    $('#server_response').modal('show');
                }
            }
        });
        }
    });


    $('#frm_user_profile_info').submit(function (e) {
        e.preventDefault();
    });
//	$('#frm_user_profile_info').validate({
//		rules: {
//			profile_pic: {
//			required: true,
//			},
//			last_name: {
//			required: true,
//			},
//			gender:{
//			    required: true, 
//			},
//			 dob:{
//			    required: true, 
//			},
//			 email:{
//			    required: true, 
//			    email:true,
//			},
//			is_passport: {
//			required: true,
//			},
//			passport_pic:{
//				required: true,
//			},
//			passport_exp_date:{
//			     required: true,
//			},
//			issuing_country:{
//			     required: true,
//			},
//			country_of_birth:{
//			     required: true,
//			}
//		},
//		messages: {
//			email: {
//			required: 'Please enter email',
//			email: 'Please enter valid email'
//			},
//			first_name: {
//			required: 'Please enter first name',
//			},
//			 last_name: {
//			required: 'Please enter last name',
//			},
//			gender:{
//			    required: 'Please select gender',
//			},
//			dob:{
//			    required: 'Please select dob', 
//			},
//			is_passport:{
//			    required: 'Please enter passport', 
//			},
//			passport_pic:{
//				required: 'Please upload passport pic',
//			},
//			passport_exp_date:{
//			    required: 'Please select passport expiry date',
//			},
//			issuing_country:{
//			     required: 'Please select passport issuing country',
//			},
//			country_of_birth:{
//			     required: 'Please select country of birth',
//			}
//		}
//	});

    // Check the user credentials for backend login
    $('#submit_profile').click(function () {
        // Check the validation
//		if( $('#frm_user_profile_info').valid() )
//		{
        // hold the button reference
        let $this = $(this);
                let profile_pic = $('#profile_pic').prop('files')[0];
                let is_helth_mental = $("input[name='is_helth_mental']:checked").val();
                let helth_mental_conditions = $('#helth_mental_conditions').val();
                let is_mental_conditions = $("input[name='is_mental_conditions']:checked").val();
                let mental_conditions = $('#mental_conditions').val();
                let food_allergies = $('#food_allergies').val();
                let shirt_size = $('#shirt_size').val();
                let emergency_contact_name = $('#emergency_contact_name').val();
                let emergency_contact_phone = $('#emergency_contact_phone').val();
                let personality_previous_travel = $('#personality_previous_travel').val();
                let personality_originally_from = $('#personality_originally_from').val();
                let personality_school = $('#personality_school').val();
                let
        personality_about = $('#personality_about').val();
                // Append these values in FormData
                var formData = new FormData();
        formData.append('profile_pic', profile_pic);
        formData.append('is_helth_mental', is_helth_mental);
        formData.append('helth_mental_conditions', helth_mental_conditions);
        formData.append('is_mental_conditions', is_mental_conditions);
        formData.append('mental_conditions', mental_conditions);
        formData.append('food_allergies', food_allergies);
        formData.append('shirt_size', shirt_size);
        formData.append('emergency_contact_name', emergency_contact_name);
        formData.append('emergency_contact_phone', emergency_contact_phone);
        formData.append('personality_previous_travel', personality_previous_travel);
        formData.append('personality_originally_from', personality_originally_from);
        formData.append('personality_school', personality_school);
        formData.append('personality_about', personality_about);

        $.ajax({
            url: $('meta[name="route"]').attr('content') + '/updateuserprofileinfo',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // Show the loading button
                $this.button('loading');
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            complete: function ()
            {
                // Change the button to previous
                $this.button('reset');
            },
            success: function (response) {
                if (response.errCode == 0)
                {
                    location.reload();
                    $('#server_response').find('.modal-header').html('Success');
                    $('#server_response').find('.modal-body').html(response.errMsg);
                    $('#server_response').modal('show');
                } else
                {
                    $('#server_response').find('.modal-header').html('Alert');
                    $('#server_response').find('.modal-body').html(response.errMsg);
                    $('#server_response').modal('show');
                }
            }
        });
        //}
    });

//    $('.addMore').click(function () {
//        var row = $(this).attr('row');
//        var currentCount = $('.' + row + ' > fieldset > fieldset').length;
//        var template = $('.' + row + ' > fieldset > span').data('template');
//        template = template.replace(/__index__/g, currentCount)
//                .replace('</fieldset>', '<a class="remove-row" >Remove</a></fieldset>');
//        $('.' + row + ' > fieldset').append(template);
//        return false;
//    });
//    $(document).on('click', '.remove-row', function () {
//        $(this).parent().remove();
//        totalCost();
//    });
//    $(document).on('change', '.traveler_name', function () {
//        totalCost();
//    });

    $('.airline-plus').click(function () {
        var template = $('.airline-row').clone().find("input").val("");
        //template.end().appendTo('.airline-row:last');
        template.append('<div><a class="remove-row" >Remove</a></fieldset></div>');
        template.end().appendTo('.airline-row');
      
       // var remove_button = '<div><a class="remove-row" >Remove</a></fieldset></div>';
       // remove_button.appendTo('.airline-row:last');
    });
    $('.include-plus').click(function () {
        $('.included-activity-row:last').clone()
                .find("input").val("").end()
                .appendTo('.included-activity-row:last');
    });
    $('.addon-plus').click(function () {
        $('.addons-row:last').clone()
                .find("input").val("").end()
                .appendTo('.addons-row:last');
    });
    $('.hotel-plus').click(function () {
        $('.hotel-row:last').clone()
                .find("input").val("").end()
                .appendTo('.hotel-row:last');
    });
});