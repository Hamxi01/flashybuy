<?php 
session_start();
include('../../includes/db.php');
$obj = new connection();
print_r($obj);
exit();
if (isset($_POST['btnsub'])) 
{
	$email = $_POST['email'];
	$pass = md5($_POST['pwd']);
	$obj->login($email,$pass);
}


?>