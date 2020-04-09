<?php 
include('../../includes/db.php');
$obj = new connection();
$update = mysqli_query($obj->connect(),"update shop_detail set update_allow=1 where user_id = ".$_GET['a_id']."");
if ($update>0) 
{
	header("Location:../permission.php?msg=success");
}
else
{
header("Location:../allow.php?error=success");	
}
?>