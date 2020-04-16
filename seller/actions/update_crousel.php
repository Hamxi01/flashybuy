<?php 
include('../../includes/db.php');
$db = new connection();
if (isset($_POST['btnsub'])) 
{
	$image  = $_FILES['file']['name'];
	 $tmpName = $_FILES['file']['tmp_name'];
		$id 			= $_POST['id'];
		$title 			= $_POST['title'];
		$url 			= $_POST['url'];
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
			$upload = move_uploaded_file($_FILES['file']['tmp_name'],"../../img/crousel/".$image);
	$query = mysqli_query($con,"update  tbl_slider set image = '$image' , title='$title',url='$url',sunday='$sunday',monday='$monday',tuesday='$tuesday',wednesday='$wednesday',thursday='$thursday',friday='$friday',saturday='$saturday' where id = $id");
}
else{
	$query = mysqli_query($con,"update  tbl_slider set title='$title',url='$url',sunday='$sunday',monday='$monday',tuesday='$tuesday',wednesday='$wednesday',thursday='$thursday',friday='$friday',saturday='$saturday' where id = $id");
}
if ($query) 
		{
			header('Location: ../view_crousel.php?msg=success');
		}
		else
		{
			echo "error";
		}
	
}

?>