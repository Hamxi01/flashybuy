<?php include('../../includes/db.php');


if (isset($_POST['name'])) {
	
	$name = $_POST['name'];

	$sql   = "INSERT into brands(name) VALUES ('$name')";
	if (mysqli_query($con,$sql)) {
		
		echo "success";
	}else{

		echo "Eror";
	}

}

























?>