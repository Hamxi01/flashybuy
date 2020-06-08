<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


    $id = $_GET['vendor_id'];
     if(isset($_POST['edit-vendor'])){

            $id                 = $_POST['id'];
            $shop_name          = $_POST['shop_name'];
            $name               = $_POST['name'];
            $lastname           = $_POST['lastname'];
            $mobile             = $_POST['mobile'];
            $bank_name          = $_POST['bank_name'];
            $bank_account       = $_POST['bank_account'];
            $bank_branch        = $_POST['bank_branch'];
            $branch_code        = $_POST['branch_code'];
            $email              = $_POST['email']; 

        $query = "update vendor SET name='".$name."',lastname='".$lastname."',shop_name='".$shop_name."',email='".$email."',mobile='".$mobile."',bank_name='".$bank_name."',bank_account='".$bank_account."',bank_branch='".$bank_branch."',branch_code='".$branch_code."' Where id='".$id."'";       
        
        if (mysqli_query($con,$query)){

            echo "<script>window.location.assign('view-vendor.php');</script>";        }
        else{ 
            header("location:vendor.php?vendor_id=".$id);
        }

     }


//  Get brands data bases on id /////

     $sql = mysqli_query($con, "SELECT * From vendor WHERE id='$id'");
        $row = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_array($sql)){

            $id                 = $row['id'];
            $shop_name          = $row['shop_name'];
            $name               = $row['name'];
            $lastname           = $row['lastname'];
            $mobile             = $row['mobile'];
            $bank_name          = $row['bank_name'];
            $bank_account       = $row['bank_account'];
            $bank_branch        = $row['bank_branch'];
            $branch_code        = $row['branch_code'];
            $email              = $row['email'];

        }

?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
 <!-- Start Showing success or warning Msg -->
<?php
if (isset($error)) {?>
    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <div class="alert alert-warning msg">    
    <?php echo $error; ?>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($msg)) { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo $msg; ?>

        </div>
    </div>
</div>
<?php 
}
?>

<!-- End Message Alert -->            
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <form method="post" action="" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Vendor</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <input type="hidden" name="id" value="<?=$id?>">
                          <label>Shop Name*</label>
                          <input type="text" name="shop_name" value="<?=$shop_name?>" class="form-control" required="">
                        </div>
                        <label>Contact Details:</label>
                        <div class="form-group">
                          <label>Email</label>
                          <input type="text" name="email" value="<?=$email?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Name*</label>
                          <input type="text" name="name" value="<?=$name?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lastname" value="<?=$lastname?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Mobile</label>
                          <input type="text" name="mobile" value="<?=$mobile?>" class="form-control" required="">
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4>Bank Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <label>Bank Name*</label>
                          <input type="text" name="bank_name" value="<?=$bank_name?>" class="form-control" required="">
                        </div>
                        <label>Contact Details:</label>
                        <div class="form-group">
                          <label>Account No.</label>
                          <input type="text" name="bank_account" value="<?=$bank_account?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Bank Brnach</label>
                          <input type="text" name="bank_branch" value="<?=$bank_branch?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Branch Code</label>
                          <input type="text" name="branch_code" value="<?=$branch_code?>" class="form-control" required="">
                        </div>
                    </div>  
                    <div class="card-footer text-right">
                      <button class="btn btn-warning" type="Submit" name="edit-vendor">Submit</button>
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