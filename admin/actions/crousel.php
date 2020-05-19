<?php 
include('../../includes/db.php');
if (isset($_POST['btnsub'])) 
{
	
$datestart=date_create($_POST['start']);
$datestart=date_format($datestart,"Y-m-d");
$dateend=date_create($_POST['start']);
$dateend=date_format($dateend,"Y-m-d");
	$title 	= $_POST['title'];
	$url 	= $_POST['url'];
	$image  = $_FILES['image']['name'];
	$tmpName = $_FILES['image']['tmp_name'];
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
	$upload = move_uploaded_file($_FILES['image']['tmp_name'],"../../img/crousel/".$image);

	if ($upload) 
	{
		$query =  mysqli_query($con,"insert into tbl_slider (title,url,image,sunday,monday,tuesday,wednesday,thursday,friday,saturday,start,end)values('$title','$url','$image','$sunday','$monday','$tuesday','$wednesday','$thursday','$friday','$saturday','$datestart','$dateend')");
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