<?php 
include('../includes/db.php');

	if (isset($_POST['saveAddress'])) {
		
		$user_id =  $_POST['user_id'];
		$f_name  =  $_POST['f_name'];
		$l_name  =  $_POST['l_name'];
		$name    =  $f_name.' '.$l_name;
		$address =  $_POST['address'];
		$city    =  $_POST['city'];
		$state   =  $_POST['state'];
		$mobile  =  $_POST['mobile'];
		$zip     =  $_POST['zip'];
		$route   =  $_POST['route'];
		$street  =  $_POST['street'];
		$subrub  =  $_POST['subrub'];
		$country =  $_POST['country'];

		$sql = "INSERT into user_addresses (user_id,name,mobile,address,city,state,zip_code,street,subrub,country,route) VALUES ('$user_id','$name','$mobile','$address','$city','$state','$zip','$street','$subrub','$country','$route')";

		if (mysqli_query($con,$sql)) {
			
			header('location:../shopping-cart.php');
		}else{

			header('location:../shopping-cart.php?msg=error');
		}

	}
?>