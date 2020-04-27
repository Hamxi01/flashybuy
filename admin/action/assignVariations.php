<?php include('../../includes/db.php');


if (isset($_POST['product_id'])) {
	
	$product_id     = $_POST['product_id'];
	$product_id     = base64_decode($product_id);
	$variation_id   = $_POST['variation_id'];
	$variation_id   = base64_decode($variation_id);
	$quantity       = $_POST['stock'];
	$price          = $_POST['selling_price'];
	$mk_price       = $_POST['market_price'];
	$vendor         = $_POST['vendor'];
	$dispatched_days = $_POST['dispatched_days'];

	$sql   = "INSERT into vendor_product(ven_id,prod_id,variation_id,price,mk_price,quantity,dispatched_days) VALUES ('$vendor','$product_id','$variation_id','$price','$mk_price','$quantity','$dispatched_days')";
	
	if (mysqli_query($con,$sql)) {
		
		echo "success";
	}else{

		echo "Eror";
	}

}