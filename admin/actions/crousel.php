<?php 
include('../../includes/db.php');
include("../../thirdparty/image-resize/ImageResize.php");
include("../../thirdparty/image-resize/ImageResizeException.php");
use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;
if (isset($_POST['btnsub'])) 
{
	
$datestart=date_create($_POST['start']);
$datestart=date_format($datestart,"Y-m-d");
$dateend=date_create($_POST['end']);
$dateend=date_format($dateend,"Y-m-d");
	$title 	= $_POST['title'];
	$url 	= $_POST['url'];
	if(isset($_POST['ch_sunday'])){
		$sunday 		= 1;
	}
	else{
		$sunday =0;
	}
	if(isset($_POST['ch_monday'])){
		$monday 		= 1;
	}
	else{
		$monday =0;
	}
	if(isset($_POST['ch_tuesday'])){
		$tuesday 		= 1;
	}
	else{
		$tuesday =0;
	}
	if(isset($_POST['ch_wednesday'])){
		$wednesday 		= 1;
	}
	else{
		$wednesday =0;
	}
	if(isset($_POST['ch_thursday'])){
		$thursday 		= 1;
	}
	else{
		$thursday =0;
	}

	if(isset($_POST['ch_friday'])){
		$friday 		= 1;
	}
	else{
		$friday =0;
	}

	if(isset($_POST['ch_saturday'])){
		$saturday 		= 1;
	}
	else{
		$saturday =0;
	}
	$filename = $_FILES["file"]["name"];
	$tmpName = $_FILES['file']['tmp_name'];
	$extension = @end(explode('.', $filename)); // explode the image name to get the extension
	$pic1extension = strtolower($extension);
	$pic1 = time().rand();
	$pic1we=$pic1.".".$pic1extension;
	$location = "../../img/crousel/".$pic1we;
	$upload = move_uploaded_file($_FILES['file']['tmp_name'],$location);
	
	try {
		$image = new ImageResize($location);
				$image->quality_jpg = 85;
				$image->resizeToWidth(150);
				$image->resizeToHeight(150);
				$new_name = '800_' . $pic1 . '.jpg';
				$new_path = '../../img/crousel/' . $new_name;
				$image->save($new_path, IMAGETYPE_JPEG);

	} catch (ImageResizeException $e) {
		return null;
	}
	if ($upload) 
	{
		$query =  mysqli_query($con,"insert into tbl_slider (title,url,image,sunday,monday,tuesday,wednesday,thursday,friday,saturday,start,end)values('$title','$url','$pic1we','$sunday','$monday','$tuesday','$wednesday','$thursday','$friday','$saturday','$datestart','$dateend')");
		if ($query) 
		{
			header('Location: ../view_crousel.php?msg=success');
		}
		else
		{
			header('Location: ../view_crousel.php?msg=error');
		}
	}
}

?>