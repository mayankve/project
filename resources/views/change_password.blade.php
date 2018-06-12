@extends('layouts.home')
@section('title', 'Change Password')
@section('content')

<div class="wrapper">
    <div class="container contact-form">
        <div class="row">
            <div class="page-title text-center">
                <h2>Change Password</h2>
            </div>  
        </div>

        <form method="POST" name="change-password"  id="change_password_form"> <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-6 cust-input-group">
                        <label><span>Current Password</span><input type="password" name="current_password" class="form-control" value=""></label>         </div>
                </div>

                <div class="row">     
                    <div class="col-md-6 cust-input-group">
                        <label><span>New Password</span><input type="password" name="new_password" class="form-control" value=""></label>         </div>    
                </div>

                <div class="row">     
                    <div class="col-md-6 cust-input-group">
                        <label><span>Re-enter new Password</span><input type="password" name="repeat_new_password" class="form-control" value=""></label>         </div>
                </div>
                
                <div class="row">     
                    <div class="col-md-6  cust-input-group sendbtn regbtn mt-0">
                        <input type="submit" name="submit" id="submitbutton" value="Change Password">    
                    </div>
                </div>
            </div>
        </form> 

    </div>
</div>


<script type="text/javascript">
   $( document ).ready(function() {
       
        $('#change_password_form').submit(function(e){
            e.preventDefault(); 
        }); 
	   $('#change_password_form').validate({
	        rules: {
	            current_password: {
	                required: true
	            },
	            new_password: {
	                required: true
	            },
	            repeat_new_password: {
	                required: true
	            }
	        },
	        messages: {
	            current_password: {
	                required: 'Please enter current Password',
	            },
	            new_password: {
	                required: 'Please enter new password',
	                minlength: 'Password must contain atleat 6 characters'
	            }, 
                    repeat_new_password: {
	                required: 'Please re-enter the new password'
	            },
	        }
	    });

	    // Check the user credentials for backend login
	 $('#submitbutton').click(function(){
	    	// Check the validation
	    	if($('#change_password_form').valid() )
	    	{
	    		var $this = $(this);
	    		$.ajax({
	    			url: $('meta[name="route"]').attr('content') + '/changeuserpassword',
	    			method: 'post',
	    			data: {
	    				frmData: $('#change_password_form').serialize()
	    			},
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
						//alert(response.redirectionUrl);
						//console.log(response);
				    	if( response.errCode == 0 )
				    	{
				    		document.location.href = response.redirectionUrl
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
</script>
@endsection



