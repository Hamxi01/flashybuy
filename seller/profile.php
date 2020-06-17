<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


     // if(isset($_POST['add-couriersizes'])){

     //    $id   = $_POST['id'];
     //    $size = $_POST['size'];
     //    $city = $_POST['city'];
     //    $price = $_POST['price'];

     //    $sql = mysqli_query($con,"SELECT * from vendor_courier_sizes where id='$id' AND size='$size' AND city='$city'");
     //    $rows = mysqli_num_rows($sql);
     //    if ($rows>0) {
        
     //      echo "<script>window.location.assign('addcouriersizes.php?msg=error');</script>";

     //    }
     //    else{

     //        $sql = "INSERT into vendor_courier_sizes (vendor_id,size,city,price) VALUES ('$id','$size','$city','$price')";
     //        if ($query =mysqli_query($con,$sql)) {

     //          echo "<script>window.location.assign('addcouriersizes.php?msg=success');</script>";
     //        }

     //    }

     // }

?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
 <!-- Start Showing success or warning Msg -->
<?php
if (isset($_GET['msg']) && $_GET['msg'] =="error") {?>
    <div class="row">
        <div class="col-lg-4 col-sm-offset-3">
            <div class="alert alert-danger msg">    
              <span>These values are already Exists.</span>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($_GET['msg']) && $_GET['msg'] =="success") { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
          <span>Values are added successfully.</span>
        </div>
    </div>
</div>
<?php 
}
?>
<?php 

$vSql = mysqli_query($con,"SELECT * FROM vendor where id='$vendor_id'");
while ($vRes = mysqli_fetch_array($vSql)) {
 
  $first_name = $vRes['name'];
  $last_name  = $vRes['lastname'];
  $shop_name  = $vRes['shop_name'];
  $email      = $vRes['email'];
  $phone      = $vRes['phone'];
  $company    = $vRes['company'];
}

?>
<!-- End Message Alert -->            
            <div class="row">
              <div class="col-md-10 offset-md-1">
                <div class="card">
                  <form action="addcouriersizes.php"  method="post">
                    <div class="card-header">
                      <h4>Edit Your Profile</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group row">
                        <input type="hidden" name="id" value="<?=$vendor_id?>" id="id">
                        <div class="col-lg-4">
                          <label>First Name*</label>
                          <input type="text" name="f_name" class="form-control" value="<?=$first_name?>" required="" id="size">
                        </div>
                        <div class="col-lg-4">
                          <label>Last Name*</label>
                          <input type="text" name="l_name" class="form-control" value="<?=$last_name?>" required="">
                        </div>
                        <div class="col-lg-4">
                          <label><b>Shop Name</b></label>
                          <input type="text" name="shop_name" class="form-control" value="<?=$shop_name?>" required="" id="city">
                        </div>
                      </div>
                      <div class="form-group row">
                        <input type="hidden" name="id" value="<?=$vendor_id?>" id="id">
                        <div class="col-lg-4">
                          <label>Email*</label>
                          <input type="text" name="email" class="form-control" value="<?=$email?>" required="" id="size">
                        </div>
                        <div class="col-lg-4">
                          <label>Phone*</label>
                          <input type="text" name="phone" class="form-control" value="<?=$phone?>" required="">
                        </div>
                        <div class="col-lg-4">
                          <label><b>Company</b></label>
                          <input type="text" name="company" class="form-control" value="<?=$company?>" required="" id="city">
                        </div>
                      </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="submit" name="add-couriersizes">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>
        </section>
      </div>  
        <?php include('includes/footer.php') ?>
<script type="text/javascript">
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });

</script>        