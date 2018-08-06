@extends('layouts.home')
@section('title', 'Contact')

@section('content')
<div class="wrapper">
<div class="alert-message">
</div>

<div class="container contact-form">
    <h3></h3>
  <div class="row">
    <div class="col-md-12">
      <div class="page-title text-center">
        <h2>Contact Us</h2>
      </div>
    </div>
  </div>
  <form method="POST" name="login" action="&#x2F;aat_zend&#x2F;public&#x2F;contact" id="login"> <div class="col-md-8 col-md-offset-2">
 <div class="form_bg">
  <div class="row">
    <div class="col-md-6">
      <div class="cust-input-group">
        <label><span>First Name</span><input type="text" name="first_name" class="form-control" required="required" value=""></label>      </div>
    </div>
    <div class="col-md-6">
      <div class="cust-input-group">
        <label><span>Last Name</span><input type="text" name="last_name" class="form-control" required="required" value=""></label>      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="cust-input-group">
        <label><span>Email</span><input type="email" name="email" class="form-control&#x20;" required="required" value=""></label>        <i class="fa fa-envelope" aria-hidden="true"></i> </div>
    </div>
    <div class="col-md-6">
      <div class="cust-input-group">
        <label><span>Phone</span><input type="text" name="phone" class="form-control" required="required" value=""></label>        <i class="fa fa-phone" aria-hidden="true"></i> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="cust-input-group">
        <label><span>Subject</span><input type="text" name="subject" class="form-control" required="required" value=""></label>      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 massagelbl">
      
        <label><span>Your Massage</span><textarea name="massage" class="form-control" required="required"></textarea></label>   
    </div>
  </div>
  <div class="row">
    
      <div class="col-md-6 col-md-offset-6 sendbtn"> <i class="fa fa-paper-plane sendicon" aria-hidden="true"></i>
        <input type="submit" name="submit" id="submitbutton" value="Send">     
    </div>
  </div>
  </div>
  </div>
  
  </form> 
  <script>
    $( function() {
        CKEDITOR.replace( 'massage' );
    } );
</script>
  <style>
    .cke_reset {
width: 557px;
</style>
</div>
   
<hr>
@endsection