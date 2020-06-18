<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


     if(isset($_POST['update-profile'])){

        $id           = $_POST['id'];
        $f_name       = $_POST['f_name'];
        $l_name       = $_POST['l_name'];
        $shop_name    = $_POST['shop_name'];
        $mobile       = $_POST['mobile'];
        $phone        = $_POST['phone'];
        $company      = $_POST['company'];
        $registration = $_POST['reg'];
        $vat          = $_POST['vat'];

        

            $sql = "update vendor SET name='".$f_name."',lastname='".$l_name."',shop_name='".$shop_name."',mobile='".$mobile."',phone='".$phone."',company='".$company."',vat_number='".$vat."',business_reg='".$registration."' Where id='".$id."'";

            if (mysqli_query($con,$sql)) {

              $vaSql = mysqli_query($con,"INSERT into vendor_activity (description,ven_id) VALUES ('You changed your Profile','$id')");
              echo "<script>window.location.assign('profile.php?msg=success');</script>";
            }

     }

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
  $mobile      = $vRes['mobile'];
  $company    = $vRes['company'];
  $registration = $vRes['business_reg'];
  $vat = $vRes['vat_number'];
}

?>
<!-- End Message Alert -->            
            <div class="row">
              <div class="col-md-10 offset-md-1">
                <div class="card">
                  <form action="profile.php"  method="post">
                    <div class="card-header">
                      <h4>Edit Your Profile</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-2">
                          <label>Seller ID</label>
                        </div>
                        <div class="col-lg-4">
                          <b><?=$vendor_id?></b>
                          <input type="hidden" name="id" value="<?=$vendor_id?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-2">
                          <label>Seller Email</label>
                        </div>
                        <div class="col-lg-4">
                          <b><?=$email?></b>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-2">
                          <label>First Name</label>
                        </div>
                        <div class="col-lg-4">
                          <input type="text" name="f_name" class="form-control" value="<?=$first_name?>">
                        </div>
                      </div><br>
                      <div class="row">
                        <div class="col-lg-2">
                          <label>Last Name</label>
                        </div>
                        <div class="col-lg-4">
                          <input type="text" name="l_name" class="form-control" value="<?=$last_name?>">
                        </div>
                      </div><br>
                      <div class="row">
                        <div class="col-lg-2">
                          <label>Shop Name</label>
                        </div>
                        <div class="col-lg-4">
                          <input type="text" name="shop_name" class="form-control" value="<?=$shop_name?>">
                        </div>
                      </div><br>
                      <div class="row">
                        <div class="col-lg-2">
                          <label>Mobile</label>
                        </div>
                        <div class="col-lg-4">
                          <input type="text" name="mobile" class="form-control" value="<?=$mobile?>">
                        </div>
                      </div><br>
                      <div class="row">
                        <div class="col-lg-2">
                          <label>Phone</label>
                        </div>
                        <div class="col-lg-4">
                          <input type="text" name="phone" class="form-control" value="<?=$phone?>">
                        </div>
                      </div><br>
                      <div class="row">
                        <div class="col-lg-2">
                          <label>Company</label>
                        </div>
                        <div class="col-lg-4">
                          <input type="text" name="company" class="form-control" value="<?=$company?>">
                        </div>
                      </div><br>
                      
                      <div class="row">
                        <div class="col-lg-2">
                          <label>Registration Number</label>
                        </div>
                        <div class="col-lg-4">
                          <input type="text" name="reg" class="form-control" value="<?=$registration?>">
                        </div>
                      </div><br>
                      <div class="row">
                        <div class="col-lg-2">
                          <label>VAT Number</label>
                        </div>
                        <div class="col-lg-4">
                          <input type="text" name="vat" class="form-control" value="<?=$vat?>">
                        </div>
                      </div><br>

                    </div> 
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="submit" name="update-profile">Submit</button>
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