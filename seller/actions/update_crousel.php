<?php 
include('../../includes/db.php');
$db = new connection();
if (isset($_POST['btnsub'])) 
{
	$image  = $_FILES['file']['name'];
	 $tmpName = $_FILES['file']['tmp_name'];
		$id 			= $_POST['id'];
		$title 			= $_POST['title'];
		$url 			= $_POST['url'];
		$sunday 		= $_POST['ch_sunday'];
		$monday 		= $_POST['ch_monday'];
		$tuesday 		= $_POST['ch_tuesday'];
		$wednesday		= $_POST['ch_wednesday'];
		$thursday 		= $_POST['ch_thursday'];
		$friday 		= $_POST['ch_friday'];
		$saturday 		= $_POST['ch_saturday'];
		if($image != ''){
			$upload = move_uploaded_file($_FILES['file']['tmp_name'],"../../img/crousel/".$image);
	$query = mysqli_query($con,"update  tbl_slider set image = '$image' , title='$title',url='$url',sunday='$sunday',monday='$monday',tuesday='$tuesday',wednesday='$wednesday',thursday='$thursday',friday='$friday',saturday='$saturday' where id = $id");
}
else{
	$query = mysqli_query($con,"update  tbl_slider set title='$title',url='$url',sunday='$sunday',monday='$monday',tuesday='$tuesday',wednesday='$wednesday',thursday='$thursday',friday='$friday',saturday='$saturday' where id = $id");
}
if ($query) 
		{
			header('Location: ../view_crousel.php?msg=success');
		}
		else
		{
			echo "error";
		}
	
}

?>