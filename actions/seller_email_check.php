<?php 
include('../includes/db.php');
	if (isset($_POST['email'])) 
	{
		$email = mysqli_real_escape_string($con, $_POST["email"]);
		$query = mysqli_query($con,"select * from vendor where email = '$email'");
	 	 $count = mysqli_num_rows($query);
	 	if($count>0)
	 	{
	 		echo "<font color='red'>Email already exsist</font>";
	 	}
	 	else
	 	{
	 		echo "<font color='green'>Email Avaliable</font>";
	 	}
	}

?>