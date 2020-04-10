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
          <form class="ps-form--account ps-tab-root" action="php/reset_password.php" method="post">
            <ul class="ps-tab-list">
              <li class="active"><a href="#sign-in">Forget Password</a></li>
            </ul>
            <div class="ps-tabs">
              <div class="ps-tab active" id="sign-in">
                <div class="ps-form__content">
                  <h5>Forget Password</h5>
                  <div class="form-group">
                    <input class="form-control" id="email" name="email" type="text" placeholder="Username or email address">
                  </div>
                  <div class="form-group submtit">
                    <button type="submit" name="btnsub" id="btnsub" class="ps-btn ps-btn--fullwidth">Reset</button>
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