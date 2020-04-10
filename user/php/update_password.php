<?php 
include('../../includes/db.php');
$obj = new connection();
if (isset($_POST['btnsub'])) 
{
	$email 	  = $_POST['email'];
	$password = md5($_POST['password']);
$update = mysqli_query($obj->connect(),"update signup set password = '$password' where email = '$email'");
if ($update>0) 
	{
		echo "<script>window.location='../login.php?msg=change'</script>";
	}	
}
?>