<?php 
include('../../includes/db.php');
$obj = new connection();
if (isset($_POST['btnsub'])) 
{
	$id 	= $_POST['id'];
	$first_address 	= $_POST['first_address'];
	$second_address  = $_POST['second_address'];
	$update = mysqli_query($obj->connect(),"update signup set 
		first_address = '$first_address',second_address ='$second_address'
		where id = $id ");
	if ($update>0) 
	{
		header("Location:../profile.php");
	}
	else
	{
		echo "error";
	}
}
?>