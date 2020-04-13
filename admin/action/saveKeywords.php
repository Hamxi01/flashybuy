<?php include('../../includes/db.php');


if (isset($_POST['keyword'])) {
	
	$name = $_POST['keyword'];

	$sql   = "INSERT into keywords(keyword) VALUES ('$name')";
	if (mysqli_query($con,$sql)) {
		
		echo "success";
	}else{

		echo "Eror";
	}

}