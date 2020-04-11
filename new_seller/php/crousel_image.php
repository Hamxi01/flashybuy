<?php 
include('../../includes/db.php');
$db = new connection();
if (isset($_POST['btnsub'])) 
{
	$id 	= $_POST['crousel_id'];
	$image  = $_FILES['image']['name'];
	$tmpName = $_FILES['image']['tmp_name'];

list($width, $height, $type, $attr) = getimagesize($tmpName);

		if($width!="1230" || $height!="425")
		{
			header("Location:../crousel.php?img=invalid");
			exit();
		}
	if($width!="1230" || $height!="425")
	{
			echo "<script>alert('invalid file')</script>";
			exit();
	}	
	$upload = move_uploaded_file($_FILES['image']['tmp_name'],"crousel/".$image);

	if ($upload) 
	{
		$query = $db->db_insert("update tbl_slider set image = '$image' where id = '$id' ");
		if ($query) 
		{
			header("Location:../view_crousel.php?msg=success");
		}
		else
		{
			echo "error";
		}
	}
}

?>