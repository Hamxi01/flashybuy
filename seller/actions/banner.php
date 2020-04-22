<?php 
include('../../includes/db.php');
if (isset($_POST['btnsub'])) 
{
	$image  = $_FILES['file']['name'];
     $tmpName = $_FILES['file']['tmp_name'];
     $image1  = $_FILES['file1']['name'];
	 $tmpName1 = $_FILES['file1']['tmp_name'];
$fileinfo = @getimagesize($_FILES["file"]["tmp_name"]);
    $width = $fileinfo[0];
	$height = $fileinfo[1];
	$fileinfo1 = @getimagesize($_FILES["file1"]["tmp_name"]);
    $width1 = $fileinfo[0];
	$height1 = $fileinfo[1];
	if($width =='390' && $height=='193'){
		$id 			= $_POST['id'];
		$title 			= $_POST['title'];
        $url 			= $_POST['url'];
        $url1 			= $_POST['url1'];
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
		if($image != ''){
			$upload = move_uploaded_file($_FILES['file']['tmp_name'],"../../img/banner/".$image);
	$query = mysqli_query($con,"update  tbl_banner set primary_image = '$image' , title='$title',url='$url',url1='$url1',sunday='$sunday',monday='$monday',tuesday='$tuesday',wednesday='$wednesday',thursday='$thursday',friday='$friday',saturday='$saturday' where id = $id");
}
if($image1 != ''){
    $upload1 = move_uploaded_file($_FILES['file1']['tmp_name'],"../../img/banner/".$image1);
$query = mysqli_query($con,"update  tbl_banner set secondry_image = '$image1' , title='$title',url='$url',url1='$url1',sunday='$sunday',monday='$monday',tuesday='$tuesday',wednesday='$wednesday',thursday='$thursday',friday='$friday',saturday='$saturday' where id = $id");
}
else{
	$query = mysqli_query($con,"update  tbl_banner set title='$title',url='$url',url1='$url1',sunday='$sunday',monday='$monday',tuesday='$tuesday',wednesday='$wednesday',thursday='$thursday',friday='$friday',saturday='$saturday' where id = $id");
}
if ($query) 
		{
			header('Location: ../view_banner.php?msg=success');
		}
		else
		{
			echo "error";
		}
	}
	else{
		header('Location: ../view_banner.php?msg=error');
	}
}


?>