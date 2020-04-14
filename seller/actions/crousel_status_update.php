<?php 
	include('../../includes/db.php');
if (isset($_POST['id'])) 
{
	$update = mysqli_query($con,"update tbl_slider set status = ".$_POST['status']." where id = ".$_POST['id']."");
}


?>