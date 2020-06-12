<style>
    .ps-site-overlay.new-active {
            display: none;
        }
    @media (max-width: 767.98px){
        .ps-cart--mini .ps-cart__content{
            display: none;
        }
    }
</style>

<?php 

include('includes/db.php');
include('includes/head.php');

 ?>

<?php

    if(!isset($_GET['msg'])) {
        unset($_SESSION['login_failed_error']);
        unset($_SESSION['same_email_error']);
    }
?>

<body>
    <div class="ps-page--my-account">
     <div class="ps-my-account-2 pt-5">

            <!-- If login information is not correct -->
            <?php
            if(isset($_SESSION['login_failed_error']) && $_SESSION['login_failed_error']){
                 $error = 'error';
                if($error == 'error') { ?>
                    <div class="container">
                        <div class="alert alert-danger fade show alert-dismissible mx-auto py-3 my-5 bg-white" style="max-width: 700px; border-left: 5px solid red;" role="alert">
                            <strong><i class="fa fa-warning" aria-hidden="true"></i></strong> 
                            <b>Incorrect Email or Password. Please try again!</b>
                            <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
            <?php
                }
            }
            elseif(isset($_SESSION['same_email_error']) && $_SESSION['same_email_error']) {
                    $error = 'error';
                    if($error == 'error') { ?>
                        <div class="container">
                            <div class="alert alert-danger fade show alert-dismissible mx-auto py-3 my-5 bg-white" style="max-width: 700px; border-left: 5px solid red;" role="alert">
                                <strong><i class="fa fa-warning" aria-hidden="true"></i></strong> 
                                <b>This Email is already Exist! Please try with another one.</b>
                                <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                <?php
                }
            }
            else {
                unset($_SESSION['login_failed_error']);
                unset($_SESSION['same_email_error']);
            }
            ?>  

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 offset-1">
                        <h2>Log in or sign up</h2>
                    </div>
                </div><br>
                    <div class="row">
                        <div class="ps-form--account w-100 ps-tab-root mb-0">
                            <ul class="ps-tab-list mb-0">
                                <li class="active"><a href="#sign-in">Login</a></li>
                                <li><a href="#sign-up">Register</a></li>
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab active" id="sign-in">
                                    <form class="ps-form--account ps-tab-root mb-0 border-0" method="post" action="actions/userlogin.php" onsubmit="return Validation()">
                                        <div class="ps-form__content">
                                            <h5>Log In Your Account</h5>
                                            <div class="form-group">
                                                <input class="form-control" name="email" id="email" type="text" placeholder="Username or email address">
                                                <span class="email text-danger"></span>
                                            </div>
                                            <div class="form-group form-forgot">
                                                <input class="form-control" name="pwd" id="pwd" type="password" placeholder="Password">
                                                <span class="pwd text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="ps-checkbox">
                                                    <input class="form-control" type="checkbox" id="remember-me" name="remember-me">
                                                    <label for="remember-me">Rememeber me</label>
                                                </div>
                                            </div>
                                            <div class="form-group submit">
                                                <button type="submit" name="btnsub" class="ps-btn ps-btn--fullwidth">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="ps-tab" id="sign-up">
                                    <form class="ps-form--account ps-tab-root mb-0 border-0" method="post" action="actions/userSignup.php" onsubmit="return Validate()">
                                        <div class="ps-form__content">
                                            <h5>New User? Create Account</h5>
                                            <div class="form-group">
                                                <input class="form-control" name="f_name" type="text" placeholder="First Name" required="">
                                            </div>
                                            <div class="form-group form-forgot">
                                                <input class="form-control" name="l_name" type="text" placeholder="Last Name" required="">
                                            </div>
                                            <div class="form-group form-forgot">
                                                <input class="form-control" name="email" type="email" placeholder="Enter Email" required="">
                                            </div>
                                            <div class="form-group form-forgot">
                                                <input class="form-control" name="password" type="password" id="txtPassword" placeholder="Enter password">
                                            </div>
                                            <div class="form-group form-forgot">
                                                <input class="form-control" name="confirmpassword" type="password" id="txtConfirmPassword" placeholder="Confirm password">
                                                <span class="text text-danger not"></span>
                                            </div>
                                            <div class="form-group submit">
                                                <button type="submit" name="btnsignup" class="ps-btn ps-btn--fullwidth">Sign Up</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script type="text/javascript">
    function Validate() {
        var password = document.getElementById("txtPassword").value;
        var confirmPassword = document.getElementById("txtConfirmPassword").value;
        if (password != confirmPassword) {
            $('.not').html("Passwords did not match.");
            return false;
        }
        return true;
    }
</script>
<script>
    $(document).ready(function() {
        $('.ps-cart--mini .header__extra').on('click', function(){
            $('div#cart-mobile').addClass('active');
        });
        $('.ps-cart--mini .header__extra').on('click', function(){
            $('.ps-site-overlay').addClass('new-active');
        });
});
    function Validation() {

        var email = document.getElementById("email").value;
        var pwd = document.getElementById("pwd").value;
        if (email == '' && email == '') {

            $('.email').html('Email is required');
            $('#email').css('border','1px solid red');
            $('.pwd').html('Password is required');
            $('#pwd').css('border','1px solid red');
            return false;
        }
        if (email != '' && pwd == ''){ 

          
          $('.pwd').html('Password is required');
          $('#pwd').css('border','1px solid red');
          return false;

        }
        if (email == '' && pwd != ''){ 

          $('.email').html('Email is required');
          $('#email').css('border','1px solid red');
          return false;

        }
    }
</script>
