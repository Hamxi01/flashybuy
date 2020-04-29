<?php 
include('../includes/db.php');
if (isset($_POST['product_id'])) {


	$product_id                = $_POST['product_id'];
	$vendor_id                =  $_POST['vendor_id'];
	$first_variation_value   =   $_POST['variation1'];
	$second_variation_value   =  $_POST['variation2'];
	$third_variation_value     = $_POST['variation3'];

	$sql = "SELECT variation_id,sku from product_variations where product_id='$product_id' AND first_variation_value = '$first_variation_value' AND second_variation_value = '$second_variation_value' AND third_variation_value='$third_variation_value'";
	$query = mysqli_query($con,$sql);
	$res   = mysqli_fetch_array($query);
	$variation_id = $res[0];
	$sku = $res[1];

	$vpsql = "SELECT price,quantity,ven_id from vendor_product where prod_id='$product_id' AND variation_id = '$variation_id' AND ven_id ='$vendor_id' AND active='Y'";
	$vpquery = mysqli_query($con,$vpsql);
	$tRows = mysqli_num_rows($vpquery);
	if ($tRows>0) {
			
			$vpres = mysqli_fetch_array($vpquery);

			$price   = $vpres[0];
			$quantity = $vpres[1];
			$ven_id  = $vpres[2];

			$vcsql ="SELECT shop_name from vendor where id='$ven_id'";
			$vcquery = mysqli_query($con,$vcsql);
			$vcres   = mysqli_fetch_array($vcquery);
			$vendorname = $vcres['shop_name'];
		

	}else{

		

			$price = 0;
			$quantity = 0;
			$vendorname = 0;
			$variation_id = 0;
			$sku          = 0;
	}

	$array = [$price,$quantity,$vendorname,$sku,$variation_id];
	echo json_encode($array);
}
?>