<?php 
	if (isset($_POST['title']) && isset($_POST['url']) && isset($_POST['image'])) 
	{
		$title = mysqli_real_escape_string($connect, $_POST["title"]);
		$url = mysqli_real_escape_string($connect, $_POST["url"]);
  		$img = $_FILES['image']['name'];
  		$upload = move_uploaded_file($_FILES['image']['tmp_name'],"social_media".$img);
  
	}
?>