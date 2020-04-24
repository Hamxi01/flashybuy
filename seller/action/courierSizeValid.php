<?php 
	include('../../includes/db.php');

	if (isset($_POST['id'])) {
		
		$id   = $_POST['id'];
		$size = $_POST['size'];
		$city = $_POST['city'];

		$sql = mysqli_query($con,"SELECT * from vendor_courier_sizes where id='$id' AND size='$size' AND city='$city'");
		$rows = mysqli_num_rows($sql);
		if ($rows>0) {
		
			echo "exist";
		}
	}

?>