<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php');

$sub_cat_id = base64_decode($_GET['cat_id']);
echo base64_decode($_GET['cat_id']);
if (isset($_POST['edit-subsubcategory'])) {
	
	   $id            =    $_POST['id'];
     $name          =    $_POST['name'];
     $category_id   =   addslashes( $_POST['category_id'] );

     foreach ($_POST['variation_id'] as $key => $value) {
            
            $variation_id     =  implode(',' , $_POST['variation_id']);

     }

	   $query = "update sub_sub_categories SET name='".$name."',sub_category_id='".$category_id."',variation_id='".$variation_id."' Where sub_sub_cat='".$id."'";       
        
        if (mysqli_query($con,$query)){	

        	echo "<script>window.location.assign('category.php?msg=success');</script>";

        }
}

//  Get Category data bases on cat_id /////


     $sql = mysqli_query($con, "SELECT * From sub_sub_categories WHERE sub_sub_cat=$sub_cat_id AND delte=0");
     $row = mysqli_num_rows($sql);
     while ($row = mysqli_fetch_array($sql)){

            $sub_cat_id           = $row['sub_sub_cat'];
            $name                 = $row['name'];
            $meta_title           = $row['meta_title'];     
            $meta_description     = $row['meta_description'];
            $category_id          = $row['sub_category_id'];
            $variation_id         = $row['variation_id'];
            $variation_id         = explode(',',$variation_id);
     }
$sql = mysqli_query($con, "SELECT * From sub_categories WHERE sub_cat_id=$category_id AND delte=0");
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
                      <h4>Edit Sub-Sub-Category</h4>
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
                              <option value="<?=$category_id?>" selected><?=$cat_name?></option>
                          <?php
                              $sql = mysqli_query($con, "SELECT * From sub_categories where delte = 0");
                              $row = mysqli_num_rows($sql);
                              while ($row = mysqli_fetch_array($sql)){
                              echo "<option value='". $row['sub_cat_id'] ."'>" .$row['name'] ."</option>" ;
                          }
                          ?>
                          
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Choose variation type</label>
                          <select class="select2 select2-multiple form-control" multiple multiple="multiple"  data-placeholder="Choose variation Type" name="variation_id[]">
                            <?php 
                                        foreach ($variation_id as $key => $value) {
                                            
                                          $sql = mysqli_query($con, "SELECT * From variations where delte = 0 AND id ='$variation_id[$key]'");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['id']?>" selected><?=$res['variation_name']?></option>
                                            
                                        <?php }  }?>
                            <?php
                                $sql = mysqli_query($con, "SELECT * From variations where delte=0");
                                $row = mysqli_num_rows($sql);
                                while ($row = mysqli_fetch_array($sql)){
                                echo "<option value='". $row['id'] ."'>" .$row['variation_name'] ."</option>" ;
                            }
                            ?>
                    
                          </select>
                      </div>                      
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="Submit" name="edit-subsubcategory">Submit</button>
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