<?php 
session_start();
include('../../includes/db.php');
$obj = new connection();
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
		$login = date("Y-m-d H:i:s");
		$ip   = $_SERVER['REMOTE_ADDR'];
		$insert = mysqli_query($this->connect(),"insert into login_log(user_id,login_time,ip) values('$id','$login','$ip')");	
		header("Location: ../new_seller/dashboard.php");
	}
	else
	{
		header("Location:../index.php?msg=error");

	}
}


?>