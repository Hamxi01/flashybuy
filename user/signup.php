<?php 
	include('include/header.php');
?>
<div class="ps-page--my-account">
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li>My account</li>
          </ul>
        </div>
      </div>
      <div class="ps-my-account">
        <div class="container">
          <form class="ps-form--account ps-tab-root" name="signup" id="login" action="php/signup.php" method="post">
            <ul class="ps-tab-list">
              <li class="active"><a href="#">Register</a></li>
            </ul>
            <div class="ps-tabs">
              <div class="" id="">
                <div class="ps-form__content">
                  <h5>Register An Account</h5>
                  <div class="form-group">
                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" name="email" type="email" placeholder="enter Email Address">
                  </div>

                <div class="form-group">
                <input id="pswd" placeholder="Password" class="form-control" type="password" name="pswd">
                       <div id="pswd_info" style="display: none;">
    <h4>Password must contain:</h4>
    <ul>
      <li id="letter" class="valid">At least <strong>one letter</strong></li>
      <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
      <li id="number" class="invalid">At least <strong>one number</strong></li>
      <li id="length" class="invalid">At least <strong>8 characters</strong></li>
    </ul>
  </div>
                  <div class="form-group submtit">
                    <button type="submit" name="btnsub" id="btnsub" class="ps-btn ps-btn--fullwidth">Signup</button>
                  </div>
            
                <div class="alert alert-primary" style="display: none;" id="result"></div>
                <div class="ps-form__footer">
                  <p>Connect with:</p>
                  <ul class="ps-list--social">
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php include('include/footer.php'); ?>
 
 <script>
     $(document).ready(function() {

  //you have to use keyup, because keydown will not catch the currently entered value
  $('input[type=password]').keyup(function() {

    // set password variable
    var pswd = $(this).val();

    //validate the length
    if (pswd.length < 8) {
      $('#length').removeClass('valid').addClass('invalid');
    } else {
      $('#length').removeClass('invalid').addClass('valid');
    }

    //validate letter
    if (pswd.match(/[A-z]/)) {
      $('#letter').removeClass('invalid').addClass('valid');
    } else {
      $('#letter').removeClass('valid').addClass('invalid');
    }

    //validate uppercase letter
    if (pswd.match(/[A-Z]/)) {
      $('#capital').removeClass('invalid').addClass('valid');
    } else {
      $('#capital').removeClass('valid').addClass('invalid');
    }

    //validate number
    if (pswd.match(/\d/)) {
      $('#number').removeClass('invalid').addClass('valid');
    } else {
      $('#number').removeClass('valid').addClass('invalid');
    }

  }).focus(function() {
    $('#pswd_info').show();
  }).blur(function() {
    $('#pswd_info').hide();
  });

});
 </script>