<?php 
     include('includes/db.php');
     include('includes/cart_vendorPackges.php');

     if (isset($_POST['city'])) {
     	
     	$city = $_POST['city'];

     		if(isset($_SESSION['product_cart'])){
  
   				if(!empty($_SESSION['product_cart'])){

   					$vendorPackges = vendorPackges('vendor',$_SESSION['product_cart'],$con);

   					foreach ($vendorPackges as $index => $value) {
   						
   						$tweight = 0;
   						$productsT = 0;
   						$tProducts = count( $value  );

   						foreach ($value as $key => $data) {

   							$productsT++;
   							
   							$product_id = $data['product_id'];
   							$vendor_id  = $data['vendor_id'];
   							$quantity   = $data['quantity'];
   							
   							$pcw = mysqli_query($con,"SELECT courier_size,width,height,length FROM products where product_id='$product_id'");
   							
   							while ($pwRes = mysqli_fetch_array($pcw)) {
   								
   								$width        = $pwRes['width'];
   								$length       = $pwRes['length'];
   								$height       = $pwRes['height'];
   								$courier_size = $pwRes['courier_size'];

   								if (!empty($courier_size)) {
   									
   									$courierPrice = mysqli_query($con,"SELECT price FROM vendor_courier_sizes WHERE vendor_id='$vendor_id' AND city='$city' AND size='$courier_size'");

   									$courierPriceArray = mysqli_fetch_array($courierPrice);
   									$shippingPrice     = $courierPriceArray[0];
   									echo $shippingPrice;

   								}else{

   									$dimension =  $width*$height*$length;
   									$weight    = ($dimension/5000);
   									$tweight  += ($weight*$quantity);
   									$total_weight_counted = 0;
   									$total_amount_charged = 0;
   									$weightCounted=0;
   									$set_wait = 0;
   									$x;
   									$weightChrg_all = 0;

	   									if( $tweight  > 35 ){
										
											$total_weight_counted = $tweight;

												while($x <= $tweight ){

													if( $total_weight_counted <= 5 ){
														$set_wait = 5;
														$weightChrg_all = 79;
														$weightCounted = 5;
															
													}elseif( $total_weight_counted <= 10 ){
														$set_wait = 10;
														$weightChrg_all = 129;	
														$weightCounted = 10;
													}
													elseif( $total_weight_counted <= 15 ){
														$set_wait = 15;
														$weightChrg_all = 149;
														$weightCounted = 15;
													}
													elseif( $total_weight_counted <= 20 ){
														$set_wait = 20;
														$weightChrg_all = 169;	
														$weightCounted = 20;			}
													elseif( $total_weight_counted <= 25 ){
														$set_wait = 25;
														$weightChrg_all = 189;
														$weightCounted = 25;			
													}
													elseif( $total_weight_counted <= 30 ){
														$set_wait = 30;
														$weightChrg_all = 119;
														$weightCounted = 30;		
													}
													elseif( $total_weight_counted <= 35 ){
														$set_wait = 35;
														$weightChrg_all = 219;
														$weightCounted = 35;	
													}elseif( $total_weight_counted <= 40 ){
														$set_wait = 40;
														$weightChrg_all = 119;
														$weightCounted = 35;	
													}elseif( $total_weight_counted <= 45 ){
														$set_wait = 45;
														$weightChrg_all = 249;
														$weightCounted = 35;	
													}elseif( $total_weight_counted <= 50 ){
														$set_wait = 50;
														$weightChrg_all = 299;
														$weightCounted = 35;	
													}else{
														$set_wait = 50;
														$weightChrg_all = 299;
														$weightCounted = 50;	
													}
													
													$t_w_ct               = $weightCounted;
													$total_amount_charged += $weightChrg_all;
													$total_weight_counted = ($total_weight_counted-$set_wait);
													$x += $t_w_ct;
													
												}

											echo $total_amount_charged;
										}		

   									// if ($tweight  <= 50 && $tweight  > 45) {
   										
   									// 	$pweight = 50;
   									// 	echo $pweight;

   									// }elseif ($tweight  <= 45 && $tweight  > 40) {
   										
   									// 	$pweight = 45;
   									// 	echo $pweight;

   									// }elseif ($tweight  <= 40 && $tweight  > 35) {
   										
   									// 	$pweight = 40;
   									// 	echo $pweight;

   									// }elseif ($tweight  <= 35 && $tweight  > 30) {
   										
   									// 	$pweight = 35;
   									// 	echo $pweight;

   									// }elseif($tweight  <= 30 && $tweight  > 25){

   									// 	$pweight = 30;
   									// 	echo $pweight;
   									// }
   									// elseif($tweight  <= 25 && $tweight  > 20){

   									// 	$pweight = 25;
   									// 	echo $pweight;
   									// }elseif($tweight  <= 20 && $tweight  > 15){

   									// 	$pweight = 20;
   									// 	echo $pweight;
   									// }elseif($tweight  <= 15 && $tweight  > 10){

   									// 	$pweight = 15;
   									// 	echo $pweight;
   									// }elseif($tweight  <= 10 && $tweight  > 5){

   									// 	$pweight = 10;
   									// 	echo $pweight;
   									// }elseif($tweight  <= 5){

   									// 	$pweight = 5;
   									// 	echo $pweight;
   									// }

   								}
   							}
   						}
   					}

				}
   			}			
     }