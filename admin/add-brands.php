<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


     if(isset($_POST['add-brands'])){

        $name          =   addslashes( $_POST['name'] );
        

        $sql = "INSERT into brands (name) VALUES ('$name')";

        if ( mysqli_query($con,$sql)){

            $msg = "<span>Data Inserted successfully...!!</span>";
        }
        else{

            $error = "<span>Something went wrong...!!</span>";
        }

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