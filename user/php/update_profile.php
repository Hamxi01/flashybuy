<?php 
include('../../includes/db.php');
$obj = new connection();
if (isset($_POST['btnsub'])) 
{
	$id 	= $_POST['id'];
	$name 	= $_POST['name'];
	$email  = $_POST['email'];
	$mobile = $_POST['mobile'];
	$img 	= $_FILES['image']['name'];
$upload = move_uploaded_file($_FILES['image']['tmp_name'], "profile_image/".$img);	
if ($upload>0) 
{
	$update = mysqli_query($obj->connect(),"update signup set name = '$name' , email = '$email' , mobile = '$mobile' , profile_pic = '$img' where id = $id ");
	if ($update>0) 
	{
		header("Location:../profile.php");
	}
	else
	{
		echo "error";
	}
}
}
?>