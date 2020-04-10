<?php 
$id = base64_decode($_GET['id']);
if(!isset($id)) 
{
  header("Location:login.php");
}
include('../includes/db.php');
$obj = new connection();
$rec = $obj->user_profile($id);
$fetch = mysqli_fetch_array($rec);
include('include/header.php');
?>
<div class="ps-page--my-account">
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="profile.php">My Profile</a></li>
            <li><a href="#">Update Profile</a></li>
          </ul>
        </div>
      </div>
      <div class="ps-my-account">
        <div class="container">
          <form class="ps-form--account ps-tab-root" name="signup" id="login" action="php/update_profile.php" method="post" enctype="multipart/form-data">
            <ul class="ps-tab-list">
              <li class="active"><a href="#">Update Account</a></li>
            </ul>
              <div class="" id="">
                <div class="ps-form__content">
                  <div class="form-group">
                    
                  <input value="<?php echo $fetch[0] ?>" name="id" type="hidden">
                    <input class="form-control" id="name" value="<?php echo $fetch[1] ?>" name="name" type="text" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" value="<?php echo $fetch[2] ?>" name="email" type="text" placeholder="Enter Email">
                  </div>

                  <div class="form-group">
                    <input class="form-control" value="<?php echo $fetch[4] ?>" id="mobile" name="mobile" type="text" placeholder="Enter Mobile">
                  </div>


                   <div class="form-group">
                    <input class="form-control" id="image" name="image" type="file" placeholder="Upload Image">
                  </div>


                <div class="form-group">
               
                  <div class="form-group submtit">
                    <button type="submit" name="btnsub" id="btnsub" class="ps-btn ps-btn--fullwidth">Update Account</button>
                  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php include('include/footer.php'); ?>
 