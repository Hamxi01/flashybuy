<?php 
include('../../includes/db.php');
$obj = new connection();
	$id = $_GET['id'];
	$delete = mysqli_query($obj->connect(),"delete from tbl_slider where id = $id");
	if ($delete>0) 
	{
		header("Location:../view_crousel.php?msg=success");
	}
?>