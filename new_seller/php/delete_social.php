<?php
$id = base64_decode($_GET['id']); 
	include('../../includes/db.php');
	$obj = new connection();

$delete = mysqli_query($obj->connect(),"delete from tbl_socialmedia where id = $id");
if ($delete>0) 
{
	header("Location:../view_social.php?success=msg");
}
else
{
	header("Location:../view_social.php?error=msg");	
}


?>