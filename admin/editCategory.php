<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php');

/////////////////// Image resize plugin files ///////

include("../thirdparty/image-resize/ImageResize.php");
include ("../thirdparty/image-resize/ImageResizeException.php");
use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;

/////////////////// Image resize plugin files ///////

$cat_id = base64_decode($_GET['cat_id']);
if (isset($_POST['edit-category'])) {
	
	 $id        =    $_POST['id'];
     $name      =    $_POST['name'];



// /////////Crop image //////////
	if (isset($_FILES['file']["name"]) && !empty($_FILES['file']["name"])) {
	    $filename = $_FILES["file"]["name"];
	    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
	    $pic1extension = strtolower($extension);
	    $pic1 = time().rand();
	    $pic1we=$pic1."."."jpg";
	    $location = "../upload/category/".$pic1we;
    
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $location)){

		        try {
		            $image = new ImageResize($location);
		            $image->quality_jpg = 85;
		            $image->resizeToWidth(170);
		            $image->resizeToHeight(170);
		            $new_name = '170_' . $pic1 . '.jpg';
		            $new_path = '../upload/category/' . $new_name;
		            $image->save($new_path, IMAGETYPE_JPEG); 
		        } 
		        catch (ImageResizeException $e) {
		            return null;
		        }

		}
	}
	$query = "update categories SET name='".$name."',banner='".$pic1we."' Where cat_id='".$id."'";       
        
        if (mysqli_query($con,$query)){	

        	echo "<script>window.location.assign('category.php?msg=success');</script>";

        }
}

//  Get Category data bases on cat_id /////

     $sql = mysqli_query($con, "SELECT * From categories WHERE cat_id=$cat_id AND delte = 0");
        $row = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_array($sql)){

            $cat_id               = $row['cat_id'];
            $name                 = $row['name'];
            $meta_title           = $row['meta_title'];     
            $meta_description     = $row['meta_description'];
            $banner               = $row['banner'];
            $icon                 = $row['icon'];

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
                        <input type="hidden" name="id" value="<?=$cat_id?>">
                        <label>Category Name*</label>
                        <input type="text" name="name" value="<?=$name?>" class="form-control" required="">
                      </div>
                      <div class="form-group">
                  		<input type='file' id="inputFile" name="file"/>
						<img id="image_upload_preview" src="../upload/category/170_<?=$banner?>" width="100" height="100" alt="your image"/>
                      </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="Submit" name="edit-category">Submit</button>
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });
</script>        