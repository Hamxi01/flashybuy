<?php 
include('../../includes/db.php');
$db = new connection();
if (isset($_POST['btnsub'])) 
{
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
	$query = $db->db_insert("update  tbl_slider 
		
	set title='$title',url='$url',sunday='$sunday',monday='$monday',tuesday='$tuesday'
	,wednesday='$wednesday',thursday='$thursday',friday='$friday',saturday='$saturday' where id = $id");
		if ($query) 
		{
			header("Location:../view_crousel.php?msg=success");
		}
		else
		{
			echo "error";
		}
	
}

?>