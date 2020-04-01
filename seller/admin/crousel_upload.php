<?php 
	
	include('../../includes/db.php');
	$db = new connection();

if (isset($_POST['btnsub'])) 
{
	$title 	= $_POST['title'];
	$url 	= $_POST['url'];
	$image  = $_FILES['img']['name'];
	$upload = move_uploaded_file($_FILES['img']['tmp_name'],"crousel/".$image);
	if ($upload) 
	{
		$query = $db->db_insert("insert into tbl_slider (title,url,image) values('$title','$url','$image')");
		if ($query) 
		{
			header("Location:../crousel.php?msg=success");
		}
		else
		{
			echo "error";
		}
	}
}

?>