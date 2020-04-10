<?php
	include('../../includes/db.php');
$obj = new connection();	

if (isset($_POST['btnsub']))
 {
$name 	= mysqli_real_escape_string($obj->connect(),$_POST['name']);
$email 	= mysqli_real_escape_string($obj->connect(),$_POST['email']);
$pass 	= mysqli_real_escape_string($obj->connect(),md5($_POST['password']));
$ip = $_SERVER['REMOTE_ADDR'];
$bin = bin2hex(15);
$token = rand($bin,15);
$check = mysqli_query($obj->connect(),"select * from signup where email = '$email'");
$count = mysqli_num_rows($check);
if ($count>0) 
{
echo "Email already Exsist";
exit();
}
else
{
$query = $obj->user_signup($name,$email,$pass,$ip,$token);	
if ($query) 
{

	echo "<script>window.location='../confirmation_page.php?msg=success'</script>";

	/*$to_mail = $email;
	$subject = "Hi Mr ,$name. Click here to activate your account
	http://localhost/flashybuy/user/php/activate.php?token=$token";
	$body 	 = "Test email";
	$sender_email  ="From:rameezyousuf135@gmail.com";
	if (mail($email,$subject,$body,$sender_email)) 
	{
		echo "check your account Mr/Miss".$name;
	}
	else
	{
		echo "error";
	}*/
}
}



}
?>