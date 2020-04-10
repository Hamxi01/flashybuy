<?php 
include('../../includes/db.php');
$obj = new connection();	

if (isset($_POST['btnsub'])) 
{
		$email = $_POST['email'];
		$pass  = md5($_POST['password']);
		$obj->user_login($email,$pass);
}



?>