<?php 
	include('../../includes/db.php');
	$obj = new connection();
	if(isset($_POST['btnsub'])) 
	{
		$id    = $_POST['id'];
		$title = $_POST["title"];
		$url   =  $_POST["url"];
  		$status   =  $_POST["cmb_status"];
  	
  	$update = mysqli_query($obj->connect(),"update tbl_socialmedia set social_title = '$title' , social_url = '$url',status = '$status' where id = '$id' ");
  			if ($update>0) 
  			{
  				header("Location:../view_social.php?msg=success");
  			}
  			else
  			{
  			header("Location:../view_social.php?error=success");	
  			}
  		
  
	}
?>