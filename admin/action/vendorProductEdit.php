<?php 

include('../../includes/db.php');

if (isset($_POST['update-vendor-product'])) {
	

	$prod_id       = base64_encode($_POST['product_id']);
	$id            = $_POST['v_p_id'];
	$price         = $_POST['price'];
	$mk_price      = $_POST['mk_price'];
	$quantity      = $_POST['quantity'];

	$sql = "update vendor_product SET price ='".$price."',mk_price ='".$mk_price."',quantity ='".$quantity."' where id ='".$id."'";
	if (mysqli_query($con,$sql)) {
		
		header("Location:../product-vendor-detail.php?id=".$prod_id."&show-vendors-detail");
	}
}


















?>