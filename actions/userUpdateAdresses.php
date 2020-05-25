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

		$sql = "UPDATE user_addresses SET name ='".$name."', mobile='".$mobile."',address='".$address."',city='".$city."',state='".$state."',zip_code='".$zip."',street='".$street."',subrub='".$subrub."',country='".$country."',route='".$route."' WHERE user_id = '".$user_id."'";

		if (mysqli_query($con,$sql)) {
			
			header('location:../view-addresses.php?msg=success');
		}else{

			header('location:../view-addresses.php?msg=error');
		}

	}
?>