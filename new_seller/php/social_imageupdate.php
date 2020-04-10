<?php 
include('../../includes/db.php');
$obj = new connection();
if (isset($_POST['btnsub'])) 
{
$id = $_POST['i_id'];
$img = $_FILES['pic']['name'];
$upload = move_uploaded_file($_FILES['pic']['tmp_name'],"social_media/".$img);
if ($upload>0) 
{
	$update = mysqli_query($obj->connect(),"update tbl_socialmedia set icon_image = '$img' where id = '$id'  ");
if ($update>0) 
{
	header("Location:../view_social.php?success=msg");
}
else
{
header("Location:../view_social.php?error=msg");	
}

}
else{
	echo "image not found";
}	
}




?>