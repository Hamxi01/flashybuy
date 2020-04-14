<?php 
include('../includes/db.php');
if (isset($_POST['btnsub']))
{
    $email = mysqli_real_escape_string($con, $_POST["email"]);
		$querycheck = mysqli_query($con,"select * from vendor where email = '$email'");
	 	 $count = mysqli_num_rows($querycheck);
	 	if($count>0)
	 	{
            header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error"');
	 	}
	 	else
	 	{
    $name 			= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
	$shop_name 		= $_POST['shp_name'];
	$mobile 		= $_POST['mobile_number'];
	$phone 			= $_POST['phone_number'];
	$company 		= $_POST['company'];
	$cat 			= $_POST['category'];
	$website 		= $_POST['web'];
	$social_media 	= $_POST['s_media'];
	$vat 			= $_POST['radio1'];
	$vat_number 	= $_POST['v_number'];
	$monthly_rev 	= $_POST['r_amount'];
	$bus_number 	= $_POST['b_number'];
	$add_comment 	= $_POST['extra_comment'];
$query =  mysqli_query($con,"insert into vendor (name,lastname,shop_name,email,mobile,phone,company,cat_name,website,social,vat,vat_number,monthly_revenue,business_reg,adiotional_coment) 
values('$name','$lastname','$shop_name','$email','$mobile','$phone','$company','$cat','$website','$social_media','$vat','$vat_number','$monthly_rev','$bus_number','$add_comment')");
if ($query==true) 
{
    header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=success"');
}
else
{
	header('Location: ' . $_SERVER['HTTP_REFERER'].'?msg=error"');
}
}
}
?>