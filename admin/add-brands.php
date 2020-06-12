<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


     if(isset($_POST['add-brands'])){

        $name          =   addslashes( $_POST['name'] );
        if (empty($name)) {
          
            echo "<script>window.location.assign('add-brands.php?msg=erorr');</script>";
        }

        $sql = "INSERT into brands (name) VALUES ('$name')";

        if ( mysqli_query($con,$sql)){

            echo "<script>window.location.assign('add-brands.php?msg=success');</script>";
        }
        else{

            echo "<script>window.location.assign('add-brands.php?msg=erorr');</script>";
        }

     }

?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
 <!-- Start Showing success or warning Msg -->
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'erorr') {?>
    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <div class="alert alert-warning msg">    
    <span>Something went wrong...!!</span>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <span>Data Inserted successfully...!!</span>

        </div>
    </div>
</div>
<?php 
}
?>

<!-- End Message Alert -->            
            <div class="row">
              <div class="col-md-10 offset-md-1">
                <div class="card">
                  <form action="add-brands.php" method="post" onsubmit="return validate()">
                    <div class="card-header">
                      <h4>Add new Brands</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Brand Name*</label>
                        <input type="text" name="name" class="form-control"  id="brands">
                        <span class="text text-danger brands"></span>
                      </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="Submit" name="add-brands">Submit</button>
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
    function validate(){

      brands = $('#brands').val();
      if (brands == '') {

        $('.brands').html('brand name is required');
        return false;
      }
return true;
    }
</script>        