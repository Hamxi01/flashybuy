<?php 
     include('../includes/db.php');


if (isset($_POST['product_id'])) {


	$product_id             = $_POST['product_id'];
	$vendor_id             =  $_POST['vendor_id'];
	$first_variation_value = $_POST['variation1'];

	$sql = "SELECT variation_id,sku from product_variations where product_id='$product_id' AND first_variation_value = '$first_variation_value'";
	$query = mysqli_query($con,$sql);
	$res   = mysqli_fetch_array($query);
	$variation_id = $res[0];
	$sku = $res[1];

	$vpsql = "SELECT price,quantity,ven_id,dispatched_days from vendor_product where prod_id='$product_id' AND variation_id = '$variation_id' AND ven_id !='$vendor_id' AND active = 'Y'";
	$vpquery = mysqli_query($con,$vpsql);
	$tRows = mysqli_num_rows($vpquery);
	// $result   = mysqli_fetch_array($vpquery);
	
	 while ($pro = mysqli_fetch_array($vpquery)) {

		$price = $pro['price'];
		$days = $pro['dispatched_days'];
		$ven_id = $pro['ven_id'];

		$vsql ="SELECT shop_name from vendor where id='$ven_id'";
		$vquery = mysqli_query($con,$vsql);
		$vres   = mysqli_fetch_array($vquery);
		$vendorname = $vres['shop_name'];
		           
		echo '<div class="col-md-12">
                                    <h4><b>R'.$price.'</b><button class="btn btn-warning" style="float: right;color:#fff">Add to cart</button></h4>
                                    <h5>By: <a href="#">'.$vendorname.'</a></h5>
                                    <p><b>'.$days.'</b></p>
                                </div>';
                               
	}
	 
}
?>