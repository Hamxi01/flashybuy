<?php 
	include('../../includes/db.php');
$obj = new connection();
if (isset($_POST['btnsub'])) 
{
	$email = $_POST['email'];
	$pass = md5($_POST['pwd']);
	$obj->login($email,$pass);
}


?>