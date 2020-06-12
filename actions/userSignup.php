<?php 

include('../includes/db.php');
if (isset($_POST['btnsignup'])) 
{
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$name   = $f_name.' '.$l_name;
	$email  = $_POST['email'];
	$pass   = md5($_POST['password']);

	if(empty($f_name)) {
		
		$_SESSION['login_failed_error'] = true;
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error');
	}
	if(empty($l_name)) {
		
		$_SESSION['login_failed_error'] = true;
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error');
	}
	if(empty($name)) {
		
		$_SESSION['login_failed_error'] = true;
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error');
	}
	if(empty($email)) {
		
		$_SESSION['login_failed_error'] = true;
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error');
	}
	if(empty($pass)) {
		
		$_SESSION['login_failed_error'] = true;
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error');
	}


	$sql    = "INSERT into customers (name,email,password) VALUES ('$name','$email','$pass')";

	if (mysqli_query($con,$sql)) 
	{
		unset($_SESSION['same_email_error']);
		header('Location:../userlogin.php?msg=success');
	}
	else
	{
		$_SESSION['same_email_error'] = true;
		header('Location: ../userlogin.php?msg=error');

	}
}


?>