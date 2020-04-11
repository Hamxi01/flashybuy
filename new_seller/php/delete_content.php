<?php 
$id = $_GET['id'];
include('../../includes/db.php');
$obj = new connection();
$delete = mysqli_query($obj->connect(),"delete from tbl_content where id = $id");
if ($delete>0) 
{
	header("Location:../view_record.php?msg=success");
}
else
{
	header("Location:../view_record.php?msg=error");
}
?>