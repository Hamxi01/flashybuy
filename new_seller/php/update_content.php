<?php 
include('../../includes/db.php');
$obj = new connection();
if (isset($_POST['btnsub'])) 
{
	$id 			= $_POST['id'];
	$heading 		= $_POST['heading'];
	$sub_heading 	= $_POST['sub_heading'];
	$first_point 	= $_POST['first'];
	$second_point 	= $_POST['second_point'];
	$third_point 	= $_POST['third_point'];
$insert = mysqli_query($obj->connect(),"
	update tbl_content set heading='$heading',subheading='$sub_heading',first_point='$first_point',second_point='$second_point',thied_point='$third_point' where id = '$id' ");
if ($insert>0) 
	{
		header("Location:../view_record.php");
	}	
	else
	{
		header("Location:../view_record.php?msg=error");
	}
}
?>