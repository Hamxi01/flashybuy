<?php 
include('../../includes/db.php');
$obj = new connection();
if (isset($_POST['btnsub'])) 
{
	$heading 		= $_POST['heading'];
	$sub_heading 	= $_POST['sub_heading'];
	$first_point 	= $_POST['first'];
	$second_point 	= $_POST['second_point'];
	$third_point 	= $_POST['third_point'];
$insert = mysqli_query($obj->connect(),"insert into tbl_content (heading,subheading,first_point,second_point,thied_point) values('$heading','$sub_heading','$first_point','$second_point','$third_point')");
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