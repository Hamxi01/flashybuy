<?php 
	include('../includes/db.php');

if (isset($_POST['product_id'])) {
	
	$product_id             = $_POST['product_id'];
	$vendor_id              = $_POST['vendor_id'];
	$first_variation_value  = $_POST['variation1'];
	$second_variation_value = $_POST['variation2'];
	$third_variation_value  = $_POST['variation3'];

	$sql = mysqli_query($con,"SELECT variation_id,sku FROM product_variations WHERE product_id='$product_id' AND first_variation_value='$first_variation_value' AND second_variation_value ='$second_variation_value' AND third_variation_value='$third_variation_value'");
	$res = mysqli_fetch_array($sql);
	
	$variation_id = $res[0];
	$sku          = $res[1];

	$vpsql = mysqli_query($con,"SELECT id,price,mk_price,ven_id,dispatched_days FROM vendor_product where variation_id = '$variation_id' AND prod_id='$product_id' AND price != ( SELECT MIN(price) FROM vendor_product where prod_id='$product_id' AND variation_id = '$variation_id' AND active='Y')");
	$tRows = mysqli_num_rows($vpsql);
	if ($tRows > 0) {
		
	
		while($vpres = mysqli_fetch_array($vpsql)){

			$v_p_id  = $vpres['id'];

	//==============================================================//
	// ============ Check if product variant is in deal =========== //
	//==============================================================//
		 	
		 	$vpdSql = mysqli_query($con,"SELECT * FROM vendor_product_deals WHERE start_date < UNIX_TIMESTAMP() AND end_date > UNIX_TIMESTAMP() AND  product_id='$product_id' AND variation_id = '$variation_id' AND deal_price != ( SELECT MIN(deal_price) FROM vendor_product_deals where product_id='$product_id' AND variation_id = '$variation_id')");

            while ( $vpdRes = mysqli_fetch_array($vpdSql) ){

                $price = $vpdRes['deal_price'];
            }
            
    //============================================================//
    // ============ Deal Check code End ========================= //
    //============================================================//

            if (empty($price)) {
                
                $price = $vpres['price'];
            }

			$price   =  $vpres['price'];
			$days    = $vpres['dispatched_days'];
			$ven_id  =  $vpres['ven_id'];

			$vsql       = mysqli_query($con,"SELECT shop_name FROM vendor WHERE id='$ven_id'");
			$vres       = mysqli_fetch_array($vsql);
			$vendorname = $vres[0];

			echo '<div class="col-md-12"> 
						<h4><b>R'.$price.'</b><button class="btn btn-warning" style="float: right;color:#fff" onclick="addtoCart('.$product_id.','.$ven_id.','.$variation_id.',1,'.$price.','.$v_p_id.')">Add to cart</button></h4>
						<h5>By: <a href="#">'.$vendorname.'</a></h5>
						<p><b>'.$days.'</b></p>
				 </div>';

		}
	}		 
}
?>