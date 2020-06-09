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
        unset($_SESSION['seller_login_failed_error']);
    }
?>

<body>
    <div class="ps-page--my-account">
     <div class="ps-my-account-2 pt-5">

            <!-- If login information is not correct -->
            <?php
            if(isset($_SESSION['seller_login_failed_error']) && $_SESSION['seller_login_failed_error']){
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
            else {
                unset($_SESSION['seller_login_failed_error']);
            }
            ?>  

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Seller Log in or sign up</h2>
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
                                    <form class="ps-form--account ps-tab-root mb-0 border-0" method="post" action="actions/sellerlogin.php">
                                        <div class="ps-form__content">
                                            <h5>Log In Your Account</h5>
                                            <div class="form-group">
                                                <input class="form-control" name="email" type="text" placeholder="Username or email address" required>
                                            </div>
                                            <div class="form-group form-forgot">
                                                <input class="form-control" name="pwd" type="password" placeholder="Password" required>
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
                                            <h5>New Seller? Create Account</h5>
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

                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                                <form class="ps-form--account ps-tab-root" method="post"
                                 action="actions/userlogin.php">
                                    <ul class="ps-tab-list">
                                        <li class="active"><a href="#sign-in">Login</a></li>
                                    </ul>
                                    <div class="ps-tabs">
                                        <div class="ps-tab active" id="sign-in">
                                            <div class="ps-form__content">
                                                <h5>Existing User? Log In here</h5>
                                                <div class="form-group">
                                                    <input class="form-control" name="email" type="text" placeholder="Username or email address">
                                                </div>
                                                <div class="form-group form-forgot">
                                                    <input class="form-control" name="pwd" type="password" placeholder="Password">
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
                                        </div>
                                        
                                    </div>
                                </form>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <form class="ps-form--account ps-tab-root" method="post"
                             action="actions/userSignup.php" onsubmit="return Validate()">
                                <ul class="ps-tab-list">
                                    <li class="active"><a href="#sign-in">Sign Up</a></li>
                                </ul>
                                <div class="ps-tabs">
                                    <div class="ps-tab active" id="sign-in">
                                        <div class="ps-form__content">
                                            <h5>New User? Create Account</h5>
                                            <div class="form-group">
                                                <input class="form-control" name="f_name" type="text" placeholder="First Name" required="">
                                            </div>
                                            <div class="form-group form-forgot">
                                                <input class="form-control" name="l_name" type="text" placeholder="Last Name" required="">
                                            </div>
                                            <div class="form-group form-forgot">
                                                <input class="form-control" name="email" type="text" placeholder="Enter Email" required="">
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
                                    </div>
                                    
                                </div>
                            </form>
                        </div> -->
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
</script>