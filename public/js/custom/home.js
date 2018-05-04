/* Common js for all front-end related functionalities like register, login etc */

$(document).ready(function(){

	$('#frm_user_basic_info').submit(function(e){
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
			gender:{
			    required: true, 
			},
			 dob:{
			    required: true, 
			},
			 email:{
			    required: true, 
			    email:true,
			},
			is_passport: {
			required: true,
			},
			passport_pic:{
				required: true,
			},
			passport_exp_date:{
			     required: true,
			},
			issuing_country:{
			     required: true,
			},
			country_of_birth:{
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
			gender:{
			    required: 'Please select gender',
			},
			dob:{
			    required: 'Please select dob', 
			},
			is_passport:{
			    required: 'Please enter passport', 
			},
			passport_pic:{
				required: 'Please upload passport pic',
			},
			passport_exp_date:{
			    required: 'Please select passport expiry date',
			},
			issuing_country:{
			     required: 'Please select passport issuing country',
			},
			country_of_birth:{
			     required: 'Please select country of birth',
			}
		}
	});

	// Check the user credentials for backend login
	$('#submitbutton').click(function(){
		// Check the validation
		if( $('#frm_user_basic_info').valid() )
		{
			// hold the button reference
			let $this = $(this);

			let fname 	= $('#first_name').val();
			let lname 	= $('#last_name').val();
			let gender 	= $('#gender').val();
			let dob 	= $('#dob').val();
			let email 	= $('#email').val();
			let passportAvailable = $("input[name='is_passport']:checked").val();
			let passportExpDate = $('#passport_exp_date').val();
			let issuingCountry 	= $('#issuing_country').val();
			let countryOfBirth 	= $('#country_of_birth').val();
			let passportPic 	= $('#passport_pic').prop('files')[0];

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
                contentType : false,
                processData : false,
				beforeSend: function() {
					// Show the loading button
			        $this.button('loading');
			    },
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    complete: function()
			    {
			    	// Change the button to previous
			    	$this.button('reset');
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		$('#server_response').find('.modal-header').html('Success');
			    		$('#server_response').find('.modal-body').html(response.errMsg);
			    		$('#server_response').modal('show');
			    	}
			    	else
			    	{
			    		$('#server_response').find('.modal-header').html('Alert');
			    		$('#server_response').find('.modal-body').html(response.errMsg);
			    		$('#server_response').modal('show');
			    	}
			    }
			});
		}
	});
	
});