<?php
	include('../../includes/db.php');
$obj = new connection();	
if (isset($_POST['btnsub'])) 
{
	$email = $_POST['email'];
	
   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
   );
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $key = md5(2418*2+$email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;
$check= 
mysqli_query($obj->connect(),"select * from signup where email='$email' ");
		$count = mysqli_num_rows($check);
		if ($count==0) 
		{
			echo "Email does not exsist";
		}
		else
		{
			$query = mysqli_query($obj->connect(),"insert into password_reset_temp (email,token,expDate)values('$email','$key','$expDate')");
			if ($query>0) 
			{
				$lastid = mysqli_query($obj->connect(),"select * from  password_reset_temp ORDER BY id DESC LIMIT 1"); 
				$fetch = mysqli_fetch_array($lastid);
				$lastid = $fetch[0];
				echo "
			<script>window.location='../activation_link.php?id=".$lastid." '</script>";
			}
			
			}
		}

?>