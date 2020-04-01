<?php 
	include('../../includes/db.php');
	$db = new connection();
	if (isset($_POST['crousel_id']))
	{
$delete = mysqli_query($db->connect(),"delete from tbl_slider where id = ".$_POST['crousel_id']."");
if ($delete>0) 
{
		header("Location:../crousel_view.php");	
}
}
	
	
?>