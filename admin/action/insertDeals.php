<?php 
include('../../includes/db.php');

	if (isset($_POST['savedeal'])) {
		
		$name  =  $_POST['name'];
		$link  =  $_POST['url'];
		

		$sql = "INSERT into deals_links (deal_name,deal_url) VALUES ('$name','$link')";

		if (mysqli_query($con,$sql)) {
			
			header('location:../deals.php?msg=success');
		}else{

			header('location:../deals.php?msg=error');
		}

	}
?>