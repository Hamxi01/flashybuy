<?php 
	include('include/header.php');
  if (isset($_SESSION['name'])) 
  {
    echo "<script>window.location='Home.php'</script>";
  }
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
          <form class="ps-form--account ps-tab-root" action="php/login.php" method="post">
            <ul class="ps-tab-list">
              <li class="active"><a href="#sign-in">Login</a></li>
            </ul>
            <div class="ps-tabs">
              <div class="ps-tab active" id="sign-in">
                <div class="ps-form__content">
                  <h5>Log In Your Account</h5>
                  <div class="form-group">
                    <input class="form-control" id="email" name="email" type="text" placeholder="Username or email address">
                  </div>
                  <div class="form-group form-forgot">
                    <input class="form-control" id="password" name="password" type="password" placeholder="Password"><a href="forget_password.php">Forgot?</a>
                  </div>
                  <div class="form-group">
                                <div class="ps-checkbox">
                                  <input class="form-control" type="checkbox" id="remember-me" name="remember-me">
                                  <label for="remember-me">Rememeber me</label>
                                </div>
                  </div>
                  <div class="form-group submtit">
                    <button type="submit" name="btnsub" id="btnsub" class="ps-btn ps-btn--fullwidth">Login</button>
                  </div>
                </div>
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
    	$(document).ready(function(){
    		
    	})
    </script>