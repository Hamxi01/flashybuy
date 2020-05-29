<?php 
     include('../includes/db.php');

if (isset($_POST['product_id'])) {
	
	$product_id                    = $_POST['product_id'];
	$vendor_id                     = $_POST['vendor_id'];
	$first_variation_value         = $_POST['variation1'];
	$second_variation_value        = $_POST['variation2'];
	$third_variation_value         = $_POST['variation3'];
	$forth_variation_value         = $_POST['variation4'];

	// ====== Get product_variation id for further procced =======  //

	$sql = mysqli_query($con,"SELECT variation_id ,sku FROM product_variations WHERE product_id = '$product_id' AND first_variation_value ='$first_variation_value' AND second_variation_value = '$second_variation_value' AND third_variation_value ='$third_variation_value' AND forth_variation_value ='$forth_variation_value'");
	$res = mysqli_fetch_array($sql);

	$variation_id = $res[0];
	$sku          = $res[1];

	// ====== Get Vendor Product Price quantity =======  //

	$pvSql = mysqli_query($con,"SELECT id,price,quantity,ven_id FROM vendor_product where prod_id = '$product_id' AND variation_id = '$variation_id' AND price = ( SELECT MIN(price) FROM vendor_product where prod_id='$product_id' AND variation_id = '$variation_id' AND active='Y')");

	$pvRows = mysqli_num_rows($pvSql);
	if ($pvRows>0) {
		
		while ($pvRes = mysqli_fetch_array($pvSql)) {
			
			$v_p_id   = $pvRes['id'];

	//=============================================================================//
	// ==============  Check variant of product is in deal or not =============== //
	//============================================================================//

			$vpdSql = mysqli_query($con,"SELECT * FROM vendor_product_deals WHERE start_date < UNIX_TIMESTAMP() AND end_date > UNIX_TIMESTAMP() AND  product_id='$product_id' AND variation_id = '$variation_id' AND deal_price = ( SELECT MIN(deal_price) FROM vendor_product_deals where product_id='$product_id' AND variation_id = '$variation_id')");
            while($vpdRes = mysqli_fetch_array($vpdSql)){

                $price = $vpdRes['deal_price'];
            }

	//============================================================================//
	// ============= End Check Variant in deal ================================== //
	//============================================================================//
			if (empty($price)) {
				
				$price    = $pvRes['price'];
			}		
			
			$quantity = $pvRes['quantity'];
			$ven_id   = $pvRes['ven_id'];

			// ====== Get Vendor name =======  //

			$vSql       = mysqli_query($con,"SELECT shop_name FROM vendor where id = '$ven_id'");
			$vRes       = mysqli_fetch_array($vSql);
			$vendorname = $vRes[0];
		}

	}else{

			$v_p_id  = 0;
			$price   = 0;
			$quantity = 0;
			$ven_id  = 0;
			$vendorname = 0;
			$ven_id = 0;
			$variation_id = 0;
	}
	
	$array = [$price,$quantity,$vendorname,$sku,$variation_id,$v_p_id,$ven_id];
	echo json_encode($array);		
}
?>