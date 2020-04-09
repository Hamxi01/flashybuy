<?php 
include('../../includes/db.php');
$obj = new connection();
if(isset($_POST['btn_update'])) 
{
	$id 		= $_POST['txtid'];
	$adress 	= $_POST['address'];
	$street 	= $_POST['street'];
	$rout 		= $_POST['rout'];
	$state 		= $_POST['state'];
	$subrub 	= $_POST['sub_rub'];
	$postal 	= $_POST['postal_code'];
	$country 	= $_POST['country'];
	$city 		= $_POST['city'];
$update = mysqli_query($obj->connect(),"update shop_detail set address=
	'$adress',street='$street',rout='$rout',state='$state',subrub ='$subrub' , postal_code='$postal',country='$country',city='$city'where id =$id");
if ($update>0) 
	{
		header("Location:../my_account.php?msg=success");
	}	
	else
	{
		header("Location:../my_account.php?msg=error");
	}

}

?>