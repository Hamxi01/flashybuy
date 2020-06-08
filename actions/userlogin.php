<?php 

include('../includes/db.php');
if (isset($_POST['btnsub'])) 
{
	$email = $_POST['email'];
	$pass = md5($_POST['pwd']);
	$login = mysqli_query($con,"SELECT * from customers where email ='$email' and password ='$pass'");
	$count = mysqli_num_rows($login);
	if ($count>0) 
	{
		while ($fetch = mysqli_fetch_array($login)) {
			
			if ($fetch['status'] == 'Y') {
				session_start();
				$_SESSION['type']='user';
				$_SESSION['id']=$fetch['id'];
				$_SESSION['name']=$fetch['name'];
				$id = $_SESSION['id'];	

				// If Login is correct then destroy the variable
				unset($_SESSION['login_failed_error']);
				$_SESSION['login_failed_error'] = false;

				$time = date("Y-m-d H:i:s");
				$ip   = $_SERVER['REMOTE_ADDR'];
				$insert = "insert into login_log(user_id,login_time,ip) values('$id','$time','$ip')";
				if( mysqli_query($con,$insert)){

					if (isset($_SESSION['product_cart'])) {
						
						header("Location:../shopping-cart.php");
					}else{

						header("Location:../index.php");
					}		
				}
			}
		}
	}
	else
	{
		$_SESSION['login_failed_error'] = true;
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error');
	}
}


?>