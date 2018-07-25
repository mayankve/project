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
   
        //airline land_only 
        //
        // flightLandDivs();
        $('.land_only').click(function () {
            flightLandDivs();
            var valuses = $('input[name=is_land_only]:checked').val()
            var data = {is_land_only: valuses};
            //saveData(data);
        });
        $('.flight_id').click(function () {
            var valuses = $(this).val()
            var data = {flight_id: valuses};
         //  saveData(data);
        });
        function flightLandDivs() {
            var valuses = $('input[name=is_land_only]:checked').val()
            if (valuses == '0') {
                $('.available-flights').show();
                $('.land-only').hide();
            } else {
                $('.available-flights').hide();
                $('.land-only').show();
            }
        }
        
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
            let passportPic = $('#passport_pic').prop('files')[0];
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
                let personality_about = $('#personality_about').val();
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
		
		$(".panel panel-default .trip-hotel").addClass("tabpanel");
        //}
    });

    // Add more airline details
    $('.airline-plus').click(function () {
        // Clone the first row
        var template = $('.airline_details:first').clone();
        
        // update template attr dynamically
        var num = $('.airline_details').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('airline[0]', 'airline['+num+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

        // Reset the values
        $(template).find('input').val('');

        // Add the remove option
        $(template).find('.remove-airline-details-div').html('<a href="javascript:void(0);" class="remove_airline_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>');

        // Append it
        $('.airline_details:last').after($(template));
    });

    // Remove airline details
    $(document).on('click', '.remove_airline_details', function () {
        $(this).closest('.airline_details').remove();
    });

    // Add more activities
    $('.include-plus').click(function(){
		// Clone the first row
	    var template = $('.activities_details:first').clone();
        $(template).find(".activities_hotels:not(:first)").remove();
        $(template).find(".activities_airlines:not(:first)").remove();

        // update template attr dynamically
        var num = $('.activities_details').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('included_activity[0]', 'included_activity['+num+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

	    // Reset the values
	    $(template).find('input').val('');
	    
	    // Add the remove option
        $(template).find('.remove-activities-details-div').html('<a href="javascript:void(0);" class="remove_activities_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>');

	    // Append it
	    $('.activities_details:last').after( $(template) );
    });

    // Remove activities details
    $(document).on('click', '.remove_activities_details', function () {
        $(this).closest('.activities_details').remove();
    });

    // Add more add-ons
    $('.addon-plus').click(function(){
		// Clone the first row
	    var template = $('.add_on_details:first').clone();
        $(template).find(".addon_hotels:not(:first)").remove();
        $(template).find(".addon_airlines:not(:first)").remove();

        // update template attr dynamically
        var num = $('.add_on_details').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('addon[0]', 'addon['+num+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

	    // Reset the values
	    $(template).find('input').val('');
	    
	    // Add the remove option
	    $(template).find('.remove-addon-plus-details-div').html('<a href="javascript:void(0);" class="remove_addon_plus_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>');

	    // Append it
	    $('.add_on_details:last').after( $(template) );
    });

    // Remove add-ons details
    $(document).on('click', '.remove_addon_plus_details', function () {
        $(this).closest('.add_on_details').remove();
    });

    // Add more hotels
    $('.hotel-plus').click(function(){
		// Clone the first row
	    var template = $('.hotel_details:first').clone();

        // update template attr dynamically
        var num = $('.hotel_details').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('hotels[0]', 'hotels['+num+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

	    // Reset the values
	    $(template).find('input').val('');
	    
	    // Add the remove option
	    $(template).find('.remove-hotel-details-div').html('<a href="javascript:void(0);" class="remove_hotel_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>');

	    // Append it
	    $('.hotel_details:last').after( $(template) );
    });

    // Remove hotel details
    $(document).on('click', '.remove_hotel_details', function () {
        $(this).closest('.hotel_details').remove();
    });

    // Add more todo list
    $('.todo-plus').click(function(){
		// Clone the first row
	    var template = $('.todo_details:first').clone();

        // update template attr dynamically
        var num = $('.todo_details').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('to_do[0]', 'to_do['+num+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

	    // Reset the values
	    $(template).find('input').val('');
	    
	    // Add the remove option
	    $(template).find('.remove-todo-details-div').html('<a href="javascript:void(0);" class="remove_todo_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>');

	    // Append it
	    $('.todo_details:last').after( $(template) );
    });

    // Remove todo details
    $(document).on('click', '.remove_todo_details', function () {
        $(this).closest('.todo_details').remove();
    });

    // Add more other expenses
    $('.add-expense-other').click(function() {
        var template = $(this).closest('.misc-expense-other').clone();

        // update template attr dynamically
        var num = $('.misc-expense-default').length;
        var numOther = $('.misc-expense-other').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('misc_expense['+num+']', 'misc_expense['+(num+numOther)+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

        // Reset the values
        $(template).find('input').val('');

        $(template).find('.action-expense-other').html('<button type="button" class="btn remove-expense-other"><i class="fa fa-minus" aria-hidden="true"></i></button>');

        // Append it
        $('.misc-expense-other:last').after( $(template) );
    });

    // Remove other expense
    $(document).on('click', '.remove-expense-other', function () {
        $(this).closest('.col-md-12').remove();
    });

  	// Add Hotels for Include activities
    $(document).on('click', '.add_activities_hotel', function() {
        // Clone the fieldset row
        var template = $(this).closest('.row').nextAll('.activities_hotels:first').clone();

        // update template attr dynamically
        var num = $(this).closest('.activities_details').find('.activities_hotels').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('[activity_hotels][0]', '[activity_hotels]['+num+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

        // Reset the values
        $(template).find('input').val('');

        // Add the remove option
        $(template).find('.remove-activity-hotels-div').html('<a href="javascript:void(0);" class="remove_activity_hotels"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>');

        // Append it

        $(this).closest('.row').nextAll('.activities_hotels:last').after( $(template) );
    });

    // Remove hotel details
    $(document).on('click', '.remove_activity_hotels', function () {
        $(this).closest('.activities_hotels').remove();
    });

  	// Add Airlines for Include activities
    $(document).on('click', '.add_activities_airline', function(){
        // Clone the fieldset row
        var template = $(this).closest('.row').nextAll('.activities_airlines:first').clone();

        // update template attr dynamically
        var num = $(this).closest('.activities_details').find('.activities_airlines').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('[activity_airlines][0]', '[activity_airlines]['+num+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

        // Reset the values
        $(template).find('input').val('');

        // Add the remove option
        $(template).find('.remove-activity-airline-div').html('<a href="javascript:void(0);" class="remove_activity_airline"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>');

        // Append it

        $(this).closest('.row').nextAll('.activities_airlines:last').after( $(template) );
    });

    // Remove hotel details
    $(document).on('click', '.remove_activity_airline', function () {
        $(this).closest('.activities_airlines').remove();
    });

	// Add more hotel for Addon Upgrades
    $(document).on('click', '.addon_more_hotel', function() {
    	// Clone the fieldset row
        var template = $(this).closest('.row').nextAll('.addon_hotels:first').clone();

        // update template attr dynamically
        var num = $(this).closest('.add_on_details').find('.addon_hotels').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('[addons_hotels][0]', '[addons_hotels]['+num+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

        // Reset the values
        $(template).find('input').val('');

        // Add the remove option
        $(template).find('.remove-addon-hotels-div').html('<a href="javascript:void(0);" class="remove_addon_hotels"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>');

        // Append it
        $(this).closest('.row').nextAll('.addon_hotels:last').after( $(template) );
    });

    // Remove hotel details
    $(document).on('click', '.remove_addon_hotels', function () {
        $(this).closest('.addon_hotels').remove();
    });

    // Add Airlines for Addon Upgrades activities
    $('.add_addon_airline').click(function () {
        // Clone the fieldset row
        var template = $('.addon_airlines:first').clone();

        // Reset the values
        $(template).find('input').val('');


        // Add the remove option
        $(template).find('#remove_addon_airlines').html('<div><a class="remove-row remove_addon_airlines">Remove</a></div>');

        // Append it
        $('.addon_airlines:last').after($(template));
    });

    // Remove addon airline details
    $(document).on('click', '.remove_addon_airlines', function () {
        $(this).closest('.addon_airlines').remove();
    });

    
    // Add new treveler template for trip booking
    $('.add_more_traveler').click(function () {
        // Clone the fieldset row
        var template = $('.add_traveler:first').clone();
        // update template attr dynamically
        var num = $('.add_traveler').length;

        $(template).find('.form-control').each(function () {
            name = $(this).attr('name').replace('traveler[0]', 'traveler[' + num + ']');
            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });
        // Reset the values
        $(template).find('input').val('');

        // Add the remove option
        $(template).find('#remove_trip_traveler').html('<div><a class="remove-row remove_trip_traveler">Remove</a></div>');

        // Append it
        $('.add_traveler:last').after($(template));
    });

    // Remove traveler details template
    $(document).on('click', '.remove_trip_traveler', function () {
        $(this).closest('.add_traveler').remove();
    });

    // Add Airlines for Addon Upgrades activities
    $(document).on('click', '.add_addon_airline', function() {
        // Clone the fieldset row
        var template = $(this).closest('.row').nextAll('.addon_airlines:first').clone();

        // update template attr dynamically
        var num = $(this).closest('.add_on_details').find('.addon_airlines').length;

        $(template).find('.form-control').each(function() {
            name = $(this).attr('name').replace('[addons_airlines][0]', '[addons_airlines]['+num+']');

            $(this).prev('label').attr('for', name);
            $(this).attr('id', name).attr('name', name);
        });

        // Reset the values
        $(template).find('input').val('');

        // Add the remove option
        $(template).find('.remove-addon-airlines-div').html('<a href="javascript:void(0);" class="remove_addon_airlines"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>');

        // Append it
        $(this).closest('.row').nextAll('.addon_airlines:last').after( $(template) );
    });

    // Remove hotel details
    $(document).on('click', '.remove_addon_airlines', function(){
        $(this).closest('.addon_airlines').remove();
    });
    
    
    //Add to Cart Functionality
    
    // var path = window.location.href;
    // var url = path.substring(0, 36);
    // var flight_id = 0;
    // var trip_id = $('#trip_id').val();
    // $("[name=flight_id]").click(function () {
        // if ($('.available-flights :radio[name=flight_id]:checked, .available-flights :radio[name=flight_id]:checked').length == 1) {
            // flight_id = $(this).val();
            // $.ajax({
                // url: url +'/addFlightToCart',
                // method: 'post',
                // data: {'trip_id': trip_id, flight_id: flight_id, 'item_type': 'airlines'},
                // dataType: "json",
                // headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                // success: function (result) {
                    // console.log(result);
                // }
            // });
        // }
    // });
   
});


    $(".filter-button").click(function () {
        var value = $(this).attr('data-filter');
        if (value == "all")
        {
            $('.filter').show('1000');
        } else
        {
            $(".filter").not('.' + value).hide('3000');
            $('.filter').filter('.' + value).show('3000');
        }
    });

    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }
    $(this).addClass("active");

    $(".filter-button2").click(function () {
        var value = $(this).attr('data-filter');
        if (value == "all")
        {
            $('.filter2').show('1000');
        } else
        {
            $(".filter2").not('.' + value).hide('3000');
            $('.filter2').filter('.' + value).show('3000');
        }
    });

    if ($(".filter-button2").removeClass("active2")) {
        $(this).removeClass("active2");
    }
    $(this).addClass("active2");

    $('#itemslider').carousel({interval: 3000});

    $('.carousel-showmanymoveone .item').each(function () {
        var itemToClone = $(this);
        for (var i = 1; i < 4; i++) {
            itemToClone = itemToClone.next();
            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }

            itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-" + (i))
                    .appendTo($(this));
        }
    });

    $(".dropdown-hov").hover(function () {
        $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");
    },
    function () {
        $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");
    });