<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


     if(isset($_POST['add-variations'])){

        $name          =   addslashes( $_POST['variation_name'] );    
        $approval      =   addslashes( $_POST['image_approval'] );
        if($approval==""){
            $approval = "N";
        }

        $sql = "INSERT into variations (variation_name, image_approval) VALUES ('$name', '$approval')";

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
 <!-- Start Showing success or warning Msg -->
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'erorr') {?>
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
if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
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
                  <form method="post" action="add-variations.php" onsubmit="return validate()">
                    <div class="card-header">
                      <h4>ADD YOUR VARIATIONS</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Variation Name*</label>
                        <input type="text" name="variation_name" class="form-control" id="variations">
                        <span class="text text-danger variations"></span>
                      </div>
                      <div class="form-group">
                        <div class="pretty p-switch">
                            <input type="checkbox" value="Y" name="image_approval" />
                            <div class="state p-warning">
                              <label>Image Approval</label>
                            </div>
                        </div>
                      </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="Submit" name="add-variations">Submit</button>
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

      brands = $('#variations').val();
      if (brands == '') {

        $('.variations').html('variation name is required');
        return false;
      }
      return true;
    }
</script>        