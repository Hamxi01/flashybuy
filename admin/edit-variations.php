<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


$id = base64_decode($_GET['id']);
     if(isset($_POST['edit-variations'])){

        $id            =    addslashes($_POST['id']);
        $name          =   addslashes( $_POST['variation_name'] );    
        $approval      =   addslashes( $_POST['image_approval'] );
        if($approval==""){
            $approval = "N";
        }

        $query = "update variations SET variation_name='".$name."', image_approval='".$approval."' Where id='".$id."'";       
        
        if (mysqli_query($con,$query)){

            echo "<script>window.location.assign('variations.php');</script>";
            $msg = "<span>Categories updated successfully...!!</span>";
        }
        else{ 
            header("location:edit-variations.php?id=".$id);
            $error = "<span>Something went wrong...!!</span>";
        }

     }


//  Get variation data bases on id /////

     $sql = mysqli_query($con, "SELECT * From variations WHERE id=$id AND delte =0");
        $row = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_array($sql)){

            $id                 = $row['id'];
            $name               = $row['variation_name'];
            $approval           = $row['image_approval'];     

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
                  <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <div class="card-header">
                      <h4>ADD YOUR VARIATIONS</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Variation Name*</label>
                        <input type="text" name="variation_name" class="form-control" required="" value="<?=$name?>">
                      </div>
                      <div class="form-group">
                        <div class="pretty p-switch">
                            <input type="checkbox" value="Y" name="image_approval" <?php if($approval=="Y"){?> checked <?php } ?>/>
                            <div class="state p-warning">
                              <label>Image Approval</label>
                            </div>
                        </div>
                      </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="Submit" name="edit-variations">Submit</button>
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