<?php 
session_start();
include('../includes/db.php');
if (isset($_POST['btnsub'])) 
{
	$email = $_POST['email'];
	$pass = md5($_POST['pwd']);
	$login = mysqli_query($con,"select * from vendor where email ='$email' and pasword ='$pass'");
	$count = mysqli_num_rows($login);
	$fetch = mysqli_fetch_array($login);
	
	if ($count>0 && $fetch[19]=="1" &&$fetch[21]=="0"&&$fetch[22]=="0" ) 
	{
		session_start();
		$_SESSION['type']='vendor';
		$_SESSION['id']=$fetch[0];
		$_SESSION['name']=$fetch[1];
		$_SESSION['img']=$fetch[20];
		$id = $_SESSION['id'];	
		$time = date("Y-m-d H:i:s");
		$ip   = $_SERVER['REMOTE_ADDR'];
		$insert = mysqli_query($con,"insert into login_log(user_id,login_time,ip) values('$id','$time','$ip')");	
		header("Location: ../seller/dashboard.php");
	}
	else
	{
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error');

	}
}


?>