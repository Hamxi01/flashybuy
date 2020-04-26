<?php 

if (isset($_POST['product_id'])) {
	
	$product_id            = $_POST['product_id'];
	$first_variation_value = $_POST['variation1'];
	$vendor_id             = $_POST['vendor_id'];

	$pvsql = mysqli_query("SELECT variation_id,sku FROM product_variations Where product_id='$product_id' AND first_variation_value = '$first_variation_value'");
	$pvres = mysqli_fecth_array($pvsql);

	print_r($pvres);
	return;

}
?>