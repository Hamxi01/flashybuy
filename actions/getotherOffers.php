<?php 
     include('../includes/db.php');


if (isset($_POST['product_id'])) {


	$product_id             = $_POST['product_id'];
	$vendor_id             =  $_POST['vendor_id'];
	$first_variation_value = $_POST['variation1'];
	$second_variation_value =$_POST['variation2'];

	$sql = "SELECT variation_id,sku from product_variations where product_id='$product_id' AND first_variation_value = '$first_variation_value' AND second_variation_value = '$second_variation_value'";
	$query = mysqli_query($con,$sql);
	$res   = mysqli_fetch_array($query);
	$variation_id = $res[0];
	$sku = $res[1];

	$vpsql = "SELECT id,price,quantity,ven_id,dispatched_days from vendor_product where prod_id='$product_id' AND variation_id = '$variation_id' AND active = 'Y' AND price != ( SELECT MIN(price) FROM vendor_product where prod_id='$product_id' AND variation_id = '$variation_id' AND active='Y')";
	$vpquery = mysqli_query($con,$vpsql);
	$tRows   = mysqli_num_rows($vpquery);

	if ($tRows>0) {

		 while ($pro = mysqli_fetch_array($vpquery)) {

		 	$v_p_id = $pro['id'];

 	//==================================================================//
	// =============== check product variant is in deal =============== //
 	//==================================================================//

		 	$vpdSql = mysqli_query($con,"SELECT * FROM vendor_product_deals WHERE start_date < UNIX_TIMESTAMP() AND end_date > UNIX_TIMESTAMP() AND  product_id='$product_id' AND variation_id = '$variation_id' AND deal_price != ( SELECT MIN(deal_price) FROM vendor_product_deals where product_id='$product_id' AND variation_id = '$variation_id')");
            while($vpdRes = mysqli_fetch_array($vpdSql)){

                $price = $vpdRes['deal_price'];
            }

            
    //=================================================================//
    // =============== end check variant is in deal or not =========== //
    //=================================================================//
             
            if (empty($price)) {
                
                $price = $pro['price'];
            }


            
			$days = $pro['dispatched_days'];
			$ven_id = $pro['ven_id'];

			$vsql ="SELECT shop_name from vendor where id='$ven_id'";
			$vquery = mysqli_query($con,$vsql);
			$vres   = mysqli_fetch_array($vquery);
			$vendorname = $vres['shop_name'];
			           
			echo '<aside class="widget widget_same-brand">
                        <h3>Other Offers</h3>
                        <div class="widget__content">
                            <div id="other-offers" class="row"><div class="col-md-12">
	                                    <h4><b>R'.$price.'</b><button class="btn btn-warning" style="float: right;color:#fff" onclick="addtoCart('.$product_id.','.$ven_id.','.$variation_id.',1,'.$price.','.$v_p_id.')">Add to cart</button></h4>
	                                    <h5>By: <a href="#">'.$vendorname.'</a></h5>
	                                    <p><b>'.$days.'</b></p>
	                                </div></div>
                        </div>
                    </aside>';
	                               
		 }
	} 
}
?>