@extends('layouts.home')
@section('title', 'login')

@section('content')
<div class="wrapper">
<!--<div class="alert-message"></div>-->



 <div class="container contact-form">
  <div class="loginbox">
      <h3></h3>
    <div class="text-center login-title">
      <h2>Login</h2>
	  
	@if ($message = Session::get('success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>	
					<p>{{ $message }}</p>
			</div>
	@endif

    </div>
  <form method="POST" name="login"  id="login_form">        
    <div class="row">
      <div class="col-md-12 cust-input-group">
        <label><span>Email</span><input type="text" name="email" class="form-control" value=""></label>      </div>
    </div>
    <div class="row">
      <div class="col-md-12 cust-input-group">
        <label><span>Password</span><input type="password" name="password" class="form-control" value=""></label>      </div>
    </div>
    <div class="row">
      <div class="col-md-12 sendbtn login-btn"><i class="fa fa-key sendicon" data-unicode="f084"></i> <input type="submit" name="submit" id="submitbutton" value="Login"> </div>
    </div>
  </form> 
  </div>
 
  </div>
<hr>


<script type="text/javascript">
   $( document ).ready(function() {
       
        $('#login_form').submit(function(e){
            e.preventDefault(); 
        }); 
	   $('#login_form').validate({
	        rules: {
	            email: {
	                required: true,
	                email: true
	            },
	            password: {
	                required: true,
	                minlength: 6
	            }
	        },
	        messages: {
	            email: {
	                required: 'Please enter email',
	                email: 'Please enter valid email'
	            },
	            password: {
	                required: 'Please enter password',
	                minlength: 'Password must contain atleat 6 characters'
	            }
	        }
	    });

	    // Check the user credentials for backend login
	 $('#submitbutton').click(function(){
	    	// Check the validation
	    	if( $('#login_form').valid() )
	    	{
	    		var $this = $(this);
	    		$.ajax({
	    			url: $('meta[name="route"]').attr('content') + '/userlogin',
	    			method: 'post',
	    			data: {
	    				frmData: $('#login_form').serialize()
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



