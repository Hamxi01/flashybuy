<?php 

include('../includes/db.php');
if (isset($_POST['btnsignup'])) 
{
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$name   = $f_name.' '.$l_name;
	$email  = $_POST['email'];
	$pass   = md5($_POST['password']);

	$sql    = "INSERT into customers (name,email,password) VALUES ('$name','$email','$pass')";

	if (mysqli_query($con,$sql)) 
	{
		header('Location:../userlogin.php?msg=success');
	}
	else
	{
		header('Location: ../userlogin.php?msg=error');

	}
}


?>