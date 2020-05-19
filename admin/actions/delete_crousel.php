<?php 
include('../../includes/db.php');
	$id = $_GET['id'];
	$delete = mysqli_query($con,"delete from tbl_slider where id = $id");
	if ($delete>0) 
	{
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=success');
	}
?>