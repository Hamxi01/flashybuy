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
		$sunday 		= $_POST['ch_sunday'];
		$monday 		= $_POST['ch_monday'];
		$tuesday 		= $_POST['ch_tuesday'];
		$wednesday		= $_POST['ch_wednesday'];
		$thursday 		= $_POST['ch_thursday'];
		$friday 		= $_POST['ch_friday'];
		$saturday 		= $_POST['ch_saturday'];	
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