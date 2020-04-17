<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php');

/////////////////// Image resize plugin files ///////

include("../thirdparty/image-resize/ImageResize.php");
include ("../thirdparty/image-resize/ImageResizeException.php");
use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;

/////////////////// Image resize plugin files ///////

$sub_cat_id = base64_decode($_GET['cat_id']);
if (isset($_POST['edit-subcategory'])) {
	
	   $id            =    $_POST['id'];
     $name          =    $_POST['name'];
     $category_id   =   addslashes( $_POST['category_id'] );

	   $query = "update sub_categories SET name='".$name."',category_id='".$category_id."' Where sub_cat_id='".$id."'";       
        
        if (mysqli_query($con,$query)){	

        	echo "<script>window.location.assign('category.php?msg=success');</script>";

        }
}

//  Get SubCategory data bases on cat_id /////

     $sql = mysqli_query($con, "SELECT * From sub_categories WHERE sub_cat_id=$sub_cat_id AND delte = 0");
        $row = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_array($sql)){

            $sub_cat_id           = $row['sub_cat_id'];
            $name                 = $row['name'];
            $meta_title           = $row['meta_title'];     
            $meta_description     = $row['meta_description'];
            $category_id          = $row['category_id'];

        }
$sql = mysqli_query($con, "SELECT * From categories WHERE cat_id=$category_id AND delte = 0");
        $row = mysqli_num_rows($sql);
    while ($row = mysqli_fetch_array($sql)){

        $cat_name = $row['name'];
}

?>    
<!-- End -->
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
                      <h4>Edit Category</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?=$sub_cat_id?>">
                        <label>Category Name*</label>
                        <input type="text" name="name" value="<?=$name?>" class="form-control" required="">
                      </div>
                      <div class="form-group">
                          <label>Choose Parent Category</label>
                          <select class="form-control select2" name="category_id">
                              <option  selected value="<?=$category_id?>" ><?=$cat_name?></option>
                          <?php
                              $sql = mysqli_query($con, "SELECT * From categories WHERE delte = 0");
                              $row = mysqli_num_rows($sql);
                              while ($row = mysqli_fetch_array($sql)){?>
                              <option value="<?=$row['cat_id']?>"><?=$row['name']?></option>
                         <?php }
                          ?>
                          
                          </select>
                      </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="Submit" name="edit-subcategory">Submit</button>
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