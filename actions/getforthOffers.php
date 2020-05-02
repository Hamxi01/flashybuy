<?php
	include('../includes/db.php');

if (isset($_POST['product_id'])) {
 	
 	$product_id             = $_POST['product_id'];
 	$vendor_id              = $_POST['vendor_id'];
 	$first_variation_value  = $_POST['variation1'];
 	$second_variation_value = $_POST['variation2'];
 	$third_variation_value  = $_POST['variation3'];
 	$forth_variation_value  = $_POST['variation4'];

//========= GET other product variation id ===============//

 	$sql = mysqli_query($con,"SELECT variation_id,sku FROM product_variations WHERE product_id ='$product_id' AND first_variation_value='$first_variation_value' AND second_variation_value='$second_variation_value' AND third_variation_value = '$third_variation_value' AND forth_variation_value='$forth_variation_value'");
 	$vRes = mysqli_fetch_array($sql);
 	
 	$variation_id = $vRes[0];
 	$sku          = $vRes[0];

//========= GET other vendor product price ===============//

 	$vpSql = mysqli_query($con,"SELECT id,price,dispatched_days,ven_id FROM vendor_product WHERE prod_id='$product_id' AND variation_id ='$variation_id' AND ven_id != '$vendor_id' AND active = 'Y'");
 	
 	while($vpRes = mysqli_fetch_array($vpSql)){

 		$v_p_id  = $vpRes['id'];
 		$price  = $vpRes['price'];
 		$days   = $vpRes['dispatched_days'];
 		$ven_id = $vpRes['ven_id'];

//========= GET other vendorname ===============//

 		$vSql = mysqli_query($con,"SELECT shop_name FROM vendor WHERE id='$ven_id'");
 		$vRes = mysqli_fetch_array($vSql);
 		$vendorname = $vRes[0];

 		echo '<div class="col-md-12">
 					<h4><b>R'.$price.'</b><button class="btn btn-warning" style="float: right;color:#fff" onclick="addtoCart('.$product_id.','.$ven_id.','.$variation_id.',1,'.$price.','.$v_p_id.')">Add to cart</button></h4>
 					<h5>By: <a href="#">'.$vendorname.'</a></h5>
					<p><b>'.$days.'</b></p>
 			 </div>';

 	}


 } 
?>