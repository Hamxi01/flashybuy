<?php 
session_start(); 
 include('includes/head.php');
 if (isset($_SESSION['id'])) 
 {
     header("Location:dashboard.php");
 }
include('includes/db.php'); 
 ?>

<body>
    <div class="ps-page--my-account">
     <div class="ps-my-account-2">
            <div class="container">
                <div class="ps-section__wrapper">
                    <div class="ps-section__left">
                        <form class="ps-form--account ps-tab-root" method="post"
                         action="php/login.php" >
                            <ul class="ps-tab-list">
                                <li class="active"><a href="#sign-in">Login</a></li>
                                <li><a href="" onclick="location.href='sell.php';">Register</a></li>
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab active" id="sign-in">
                                    <div class="ps-form__content">
                                        <h5>Log In Your Account</h5>
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
                    <div class="ps-section__right">
                        <figure class="ps-section__desc">
                            <?php
                             $query = mysqli_query($con,"select * from tbl_content where status = 1"); 
                            while($fetch = mysqli_fetch_array($query)){
                            ?>
                           
                            <figcaption><?php echo $fetch[1] ?>:</figcaption>
                            <p><?php echo $fetch[2] ?>:</p>
                            <ul class="ps-list">
                                <li><i class="icon-credit-card"></i><span><?php echo $fetch[3] ?></span></li>
                                <li><i class="icon-clipboard-check"></i><span><?php echo $fetch[4] ?></span></li>
                                <li><i class="icon-bag2"></i><span><?php echo $fetch[5] ?></span></li>
                            </ul>
                        <?php } ?>
                        </figure>
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