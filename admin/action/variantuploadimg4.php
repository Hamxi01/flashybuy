<?php
include("../../thirdparty/image-resize/ImageResize.php");
include ("../../thirdparty/image-resize/ImageResizeException.php");
use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;
//upload.php
if($_FILES["file"]["name"] != '')
{
    $filename = $_FILES["file"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic1extension = strtolower($extension);
    $pic1 = time().rand();
    $pic1we=$pic1."."."jpg";
    $location = "../../upload/product/".$pic1we;
    
	if(move_uploaded_file($_FILES["file"]["tmp_name"], $location)){

	        try {
				    $image = new ImageResize($location);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(800);
				    $image->resizeToHeight(800);
				    $new_name = '800_' . $pic1 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
	  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(300);
				    $image->resizeToHeight(300);
				    $new_name = '300_' . $pic1 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(200);
				    $image->resizeToHeight(150);
				    $new_name = '200_' . $pic1 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}

	}
}
echo '<img src="../upload/product/200_'.$pic1we.'" height="150" width="225" class="img-thumbnail" />
 <input type="hidden" name="variant_img4[]" value="'.$pic1we.'"/>';
?>
