<?php 
include('../../includes/db.php');
if (isset($_POST['btnsub'])) 
{
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
		$query =  mysqli_query($con,"insert into tbl_slider (title,url,image,sunday,monday,tuesday,wednesday,thursday,friday,saturday)values('$title','$url','$image','$sunday','$monday','$tuesday','$wednesday','$thursday','$friday','$saturday')");
		if ($query) 
		{
			header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=success');
		}
		else
		{
			header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error');
		}
	}
}

?>