<?php 
$id = $_GET['id'];
    include('include/header.php');
  include('../includes/db.php');
  $obj = new connection();
  $record = $obj->reset_pass($id);
  $fetch = mysqli_fetch_array($record);
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
          <div class="alert alert-success">Dear User Please click this link for reset your password<br>
            <?php echo "<a href='reset_password.php?id=".$fetch[0]." '>Click</a>"; ?>
          </div>
        </div>
      </div>
    </div>
    <?php include('include/footer.php'); ?>
 