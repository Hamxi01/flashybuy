<?php 
include('../../includes/db.php');
$obj = new connection();
if(isset($_POST['btnsub'])) 
{
	$email 		= $_POST['email'];
	$password   = md5($_POST['password']);
	$obj->login($email,$password);
}
?>