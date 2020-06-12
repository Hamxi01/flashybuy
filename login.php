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
     <div class="ps-my-account-2">

        <!-- If login information is not correct -->
        <?php
            if(isset($_SESSION['seller_login_failed_error']) && $_SESSION['seller_login_failed_error']){
                 $error = 'error';
                if($error == 'error') { ?>
                    <div class="container">
                        <div class="alert alert-danger fade show alert-dismissible py-3 mb-5 bg-white" style="max-width: 700px; border-left: 5px solid red;" role="alert">
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
                <div class="ps-section__wrapper">
                    <div class="ps-section__left">
                        <form class="ps-form--account ps-tab-root" method="post" action="actions/sellerlogin.php" onsubmit="return Validation()">
                            <ul class="ps-tab-list">
                                <li class="active"><a href="#sign-in">Login</a></li>
                                <li><a href="" onclick="location.href='sell.php';">Register</a></li>
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab active" id="sign-in">
                                    <div class="ps-form__content">
                                        <h5>Log In Your Account</h5>
                                        <div class="form-group">
                                            <input class="form-control" name="email" id="email" type="text" placeholder="Username or email address">
                                            <span class="email"></span>
                                        </div>
                                        <div class="form-group form-forgot">
                                            <input class="form-control" name="pwd" id="pwd" type="password" placeholder="Password">
                                            <span class="pwd"></span>
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
                    <div class="ps-section__right">
                        
                            <?php
                             $query = mysqli_query($con,"select * from tbl_content where status = 1"); 
                             if(($query)) {
                            while($fetch = mysqli_fetch_array($query)){
                            ?>
                           <figure class="ps-section__desc">
                            <figcaption><?php echo $fetch[1] ?>:</figcaption>
                            <p><?php echo $fetch[2] ?>:</p>
                            <ul class="ps-list">
                                <li><i class="icon-credit-card"></i><span><?php echo $fetch[3] ?></span></li>
                                <li><i class="icon-clipboard-check"></i><span><?php echo $fetch[4] ?></span></li>
                                <li><i class="icon-bag2"></i><span><?php echo $fetch[5] ?></span></li>
                            </ul>
                            </figure>
                        <?php } } ?>
                        
                        <div class="ps-section__coupon"><span>$25</span>
                            <aside>
                                <h5>A small gift for your first purchase</h5>
                                <p>Martfury give $25 as a small gift for your first purchase. Welcome to Martfury!</p>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script type="text/javascript">
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