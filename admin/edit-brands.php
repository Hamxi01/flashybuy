<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


    $id = base64_decode($_GET['id']);
     if(isset($_POST['edit-brands'])){

        $id            =    addslashes($_POST['id']);
        $name          =   addslashes( $_POST['name'] ); 

        $query = "update brands SET name='".$name."' Where id='".$id."'";       
        
        if (mysqli_query($con,$query)){

            echo "<script>window.location.assign('brands.php');</script>";
            $msg = "<span>Categories updated successfully...!!</span>";
        }
        else{ 
            header("location:edit-brands.php?id=".$id);
            $error = "<span>Something went wrong...!!</span>";
        }

     }


//  Get brands data bases on id /////

     $sql = mysqli_query($con, "SELECT * From brands WHERE id=$id AND delte = 0");
        $row = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_array($sql)){

            $id                 = $row['id'];
            $name               = $row['name'];     

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
                    <div class="card-header">
                      <h4>Edit Your Brand</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <label>Brand Name*</label>
                        <input type="text" name="name" value="<?=$name?>" class="form-control" required="">
                      </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="Submit" name="edit-brands">Submit</button>
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