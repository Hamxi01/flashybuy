<?php 
include('../includes/db.php');
if (isset($_POST['product_id'])) {


	$product_id             = $_POST['product_id'];
	$first_variation_value = $_POST['variation1'];
	$second_variation_value =$_POST['variation2'];

	$sql = "SELECT variation_id,sku from product_variations where product_id='$product_id' AND first_variation_value = '$first_variation_value' AND second_variation_value = '$second_variation_value'";
	$query = mysqli_query($con,$sql);
	$res   = mysqli_fetch_array($query);
	$variation_id = $res[0];
	$sku = $res[1];

	$vpsql = "SELECT price,quantity,ven_id from vendor_product where prod_id='$product_id' AND variation_id = '$variation_id'";
	$vpquery = mysqli_query($con,$vpsql);
	$vpres   = mysqli_fetch_array($vpquery);
	$price = $vpres[0];
	$quantity = $vpres[1];
	$ven_id = $vpres[2];

	$vsql ="SELECT name from vendor where id='$ven_id'";
	$vquery = mysqli_query($con,$vsql);
	$vres   = mysqli_fetch_array($vquery);
	$vendorname = $vres['name'];



	$array = [$price,$quantity,$vendorname,$sku];
	echo json_encode($array);
}
?>