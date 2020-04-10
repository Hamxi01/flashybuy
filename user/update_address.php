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
          <form class="ps-form--account ps-tab-root" name="signup" id="login" action="php/update_address.php" method="post">
            <ul class="ps-tab-list">
              <li class="active"><a href="#">Update Address</a></li>
            </ul>
              <div class="" id="">
                <div class="ps-form__content">
                 <div class="form-group">                    
                 <input value="<?php echo $fetch[0] ?>" name="id" type="hidden">
                    <label>Primary Address</label>
                    <textarea class="form-control" name="first_address" placeholder="Primary Address"><?php echo $fetch[5]; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Secondry Address</label>
                  <textarea class="form-control" name="second_address" placeholder="Primary Address"><?php echo $fetch[6]; ?></textarea>
                  </div>
                <div class="form-group">
                  <div class="form-group submtit">
                    <button type="submit" name="btnsub" id="btnsub" class="ps-btn ps-btn--fullwidth">Change Address</button>
                  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php include('include/footer.php'); ?>
 