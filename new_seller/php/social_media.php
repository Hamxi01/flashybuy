<?php 
	include('../../includes/db.php');
	$obj = new connection();
	if(isset($_POST['btnsub'])) 
	{
		$title = $_POST["title"];
		$url = 	 $_POST["url"];
  		$img =   $_FILES['image']['name'];
  	$upload = move_uploaded_file($_FILES['image']['tmp_name'],"social_media/".$img);
  		if ($upload>0) 
  		{
  			$insert = mysqli_query($obj->connect(),"insert into tbl_socialmedia (social_title,social_url,icon_image) values('$title','$url','$img')");
  			if ($insert>0) 
  			{
  				header("Location:../view_social.php?msg=success");
  			}
  			else
  			{
  			header("Location:../view_social.php?error=success");	
  			}
  		}
  
	}
?>