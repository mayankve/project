@extends('layouts.dashboard')
@section('title', 'Card Details')
@section('content')
<link href="{{ URL::asset('css/style_card.css') }}" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery-creditcardvalidator/jquery.creditCardValidator.js') }}"></script>
<script>
function validate(){
	var valid = true;	 
    $(".demoInputBox").css('background-color','');
    var message = "";

    var cardHolderNameRegex = /^[a-z ,.'-]+$/i;
    var cvvRegex = /^[0-9]{3,3}$/;
    
    var cardHolderName = $("#card-holder-name").val();
    var cardNumber = $("#card-number").val();
    var cvv = $("#cvv").val();

    if(cardHolderName == "" || cardNumber == "" || cvv == "") {
    	   message  += "<div>All Fields are Required.</div>";  
    	   if(cardHolderName == "") {
    		   $("#card-holder-name").css('background-color','#FFFFDF');
    	   }
    	   if(cardNumber == "") {
    		   $("#card-number").css('background-color','#FFFFDF');
    	   }
    	   if (cvv == "") {
    		   $("#cvv").css('background-color','#FFFFDF');
    	   }
       valid = false;
    }
    
    if (cardHolderName != "" && !cardHolderNameRegex.test(cardHolderName)) {
        message  += "<div>Card Holder Name is Invalid</div>";    
    		$("#card-holder-name").css('background-color','#FFFFDF');
    		valid = false;
    }
    
    if(cardNumber != "") {
        	$('#card-number').validateCreditCard(function(result){
            if(!(result.valid)){
                	message  += "<div>Card Number is Invalid</div>";    
            		$("#card-number").css('background-color','#FFFFDF');
            		valid = false;
            }
        });
    }
    
    if (cvv != "" && !cvvRegex.test(cvv)) {
        message  += "<div>CVV is Invalid</div>";    
        $("#cvv").css('background-color','#FFFFDF');
    		valid = false;
    }
    
    if(message != "") {
        $("#error-message").show();
        $("#error-message").html(message);
    }
    return valid;
}
</script>
</head>
<body>
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
                        <a> Add your credit-card detail </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">Welcome  {{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>
	@if ($message = Session::get('error'))
			<div class="alert alert-danger alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>	
					<p>{{ $message }}</p>
			</div>
	@endif
	
    <form id="frmContact" method = "POST" action = "{{url('/save-details')}}" onSubmit="return validate();">
	@if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
	@endif
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="field-row">
            <label style="padding-top: 20px;">Card Holder Name</label> <span
                id="card-holder-name-info" class="info"></span><br /> 
				<input type="text" id="card-holder-name" class="demoInputBox" name="card_holder_name"  value = "{{!empty($cardData->card_holder_name)?$cardData->card_holder_name:''}}"/>
        </div>
        <div class="field-row">
            <label>Card Number</label> <span id="card-number-info"
                class="info"></span><br />
				<input type="text" id="card-number" name="card_number" value = "{{!empty($cardData->card_number)?$cardData->card_number:''}}" class="demoInputBox">
        </div>
        <div class="field-row">
            <div class="contact-row column-right">
                <label>Expiry Month / Year</label>/
				<span id="userEmail-info" class="info"></span><br /> 
			<select name="expiry_month" id="expiryMonth" class="demoSelectBox">
				<?php
				for ($i = date("m"); $i <= 12; $i ++) {
					$monthValue = $i;
					if (strlen($i) < 2) {
						$monthValue = "0" . $monthValue;
					}
					if($cardData->expiry_month == $monthValue ){?>
					<option selected value="<?php echo $monthValue; ?>"><?php echo $i; ?></option>
					<?php
					}
					else{
					?>
					<option value="<?php echo $monthValue; ?>"><?php echo $i; ?></option>
					<?php
					}
				}
				?>
			</select> 
			<select name="expiry_year" id="expiryMonth" class="demoSelectBox">
            <?php
            for ($i = date("Y"); $i <= 2030; $i ++) {
                $yearValue = substr($i, 2);
				if($cardData->expiry_year == $yearValue ){?>
                ?>
            <option selected value="<?php echo $yearValue; ?>"><?php echo $i; ?></option>
            <?php
            }else{?>
				 <option value="<?php echo $yearValue; ?>"><?php echo $i; ?></option>
			<?php	}
			}
            ?>
            </select>
            </div>
            <div class="contact-row cvv-box">
                <label>CVV</label> <span id="cvv-info" class="info"></span><br />
                <input type="text" name="cvv" value = "{{!empty($cardData->cvv)? $cardData->cvv : ''}}" id="cvv"
                    class="demoInputBox cvv-input">
            </div>
        </div>
        <div>
            <input type="submit" value="Submit" class="btnAction" />
        </div>
        <div id="error-message"></div>

    </form>
</div>
@endsection