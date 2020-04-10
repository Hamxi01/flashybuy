<?php 
	include('include/header.php');
	$id = $_SESSION['user_id'];
	include('../includes/db.php');
$obj = new connection();
$query =$obj->user_profile($id);
$fetch = mysqli_fetch_array($query);	
?>

    <h3 align="center">Manage Account</h3>
    <div class="ps-site-features">
        <div class="ps-container">
 <form class="ps-form--account ps-tab-root" name="signup" id="login" action="php/signup.php" method="post">
              <div class="" id="">
                <div class="ps-form__content">
                  <div class="form-group">
                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter Name">
                  </div>

                <div class="form-group">
               
                  <div class="form-group submtit">
                    <button type="submit" name="btnsub" id="btnsub" class="ps-btn ps-btn--fullwidth">Signup</button>
                  </div>
              </div>
            </div>
          </form>
        </div>

        <?php include('include/footer.php'); ?>