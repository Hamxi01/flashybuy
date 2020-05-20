<?php 
     include('includes/db.php');
     include('includes/courier_Packages.php');
     include('includes/cart_vendorPackges.php');

$totalDeliveryPrice = 0;
$weightChrg = 0;
$shippingPrice =0;

     if (isset($_POST['city'])) {

      $subTotal = $_POST['subTotal'];
     	
     	$city = $_POST['city'];

     		if(isset($_SESSION['product_cart'])){
  
   				if(!empty($_SESSION['product_cart'])){

   					$vendorPackges = vendorPackges('vendor',$_SESSION['product_cart'],$con);

                    $tquantity  = 0;
                    $tPrice     = 0;
                    $cart       = 0;
                    $j          = 0;
                    $ven_change = 0;
                    $x =0;
   					foreach ($vendorPackges as $index => $value) {
   						
   						$i = 1;
                     $productsT = 0;
                     $j++;
                     $tweight = 0;
                     $tProducts = count( $value  );

   						foreach ($value as $key => $data) {

   							$productsT++;
                        $cartProdArr[] = $data;
                        $ven_change++;
   							$cart        = 1;
   							$product_id = $data['product_id'];
   							$vendor_id  = $data['vendor_id'];
   							$quantity   = $data['quantity'];
   							
   							$pcw = mysqli_query($con,"SELECT courier_size,width,height,length FROM products where product_id='$product_id'");
   							
         							while ($pwRes = mysqli_fetch_array($pcw)) {
         								
         								$width        = $pwRes['width'];
         								$length       = $pwRes['length'];
         								$height       = $pwRes['height'];
         								$courier_size = $pwRes['courier_size'];

         							
         							}
                              $csql = mysqli_query($con,"SELECT courier_permission FROM vendor where id='$vendor_id'");
                              while ($cpres = mysqli_fetch_array($csql)) {
                                 
                                 $courier_permission = $cpres['courier_permission'];
                              }
                              if ($courier_permission == 'Y') {
                                 
                                 $shipSql = mysqli_query($con,"SELECT price FROM vendor_courier_sizes where size='$courier_size' AND city ='$city' AND vendor_id ='$vendor_id'");

                                 $shippPrice     = mysqli_fetch_array($shipSql);

                                 $shippingPrice  = $shippPrice[0];


                              }
                              else{

                                 $dimension       = ($width*$height*$length);
                                 $weightExtraItem = 0;
                                 $weight          = ($dimension)/5000;
                                 $tweight        += ($weight*$quantity);

                                 $total_weight_counted = 0;
                                 $total_amount_charged = 0;

                                 if( $tProducts == $productsT){
                                     
                                    if( $tweight  > 50 ){

                                          $total_weight_counted = $tweight;
                                          while($x <= $tweight ) {
                                                
                                             if( $total_weight_counted <= 5 ){
                                                $set_wait = 5;
                                                $weightChrg_all = $courWArr[5];
                                                $weightCounted = 5;
                                                   
                                             }elseif( $total_weight_counted <= 10 ){
                                                $set_wait = 10;
                                                $weightChrg_all = $courWArr[10]; 
                                                $weightCounted = 10;
                                             }
                                             elseif( $total_weight_counted <= 15 ){
                                                $set_wait = 15;
                                                $weightChrg_all = $courWArr[15];
                                                $weightCounted = 15;
                                             }
                                             elseif( $total_weight_counted <= 20 ){
                                                $set_wait = 20;
                                                $weightChrg_all = $courWArr[20]; 
                                                $weightCounted = 20;       }
                                             elseif( $total_weight_counted <= 25 ){
                                                $set_wait = 25;
                                                $weightChrg_all = $courWArr[25];
                                                $weightCounted = 25;       
                                             }
                                             elseif( $total_weight_counted <= 30 ){
                                                $set_wait = 30;
                                                $weightChrg_all = $courWArr[30];
                                                $weightCounted = 30;    
                                             }
                                             elseif( $total_weight_counted <= 35 ){
                                                $set_wait = 35;
                                                $weightChrg_all = $courWArr[35];
                                                $weightCounted = 35; 
                                             }
                                             elseif( $total_weight_counted <= 40 ){
                                                $set_wait = 40;
                                                $weightChrg_all = $courWArr[40];
                                                $weightCounted = 40; 
                                             }
                                             elseif( $total_weight_counted <= 45 ){
                                                $set_wait = 45;
                                                $weightChrg_all = $courWArr[45];
                                                $weightCounted = 45; 
                                             }
                                             elseif( $total_weight_counted <= 50 ){
                                                $set_wait = 50;
                                                $weightChrg_all = $courWArr[50];
                                                $weightCounted = 50; 
                                             }
                                             else{
                                                $set_wait = 50;
                                                $weightChrg_all = $courWArr[50];
                                                $weightCounted = 50; 
                                             }
                                             
                                             $t_w_ct               = $weightCounted;
                                             $total_amount_charged += $weightChrg_all;
                                             $total_weight_counted = ($total_weight_counted-$set_wait);
                                             
                                             $x += $t_w_ct;

                                          }
                                    }
                                    else{
         
                                       if( $tweight <= 5 ){
                                          $weightChrg = $courWArr[5];   
                                       }elseif( $tweight <= 10 ){
                                          $weightChrg = $courWArr[10];  
                                       }
                                       elseif( $tweight <= 15 ){
                                          $weightChrg = $courWArr[15];
                                       }
                                       elseif( $tweight <= 20 ){
                                          $weightChrg = $courWArr[20];           
                                       }
                                       elseif( $tweight <= 25 ){
                                          $weightChrg = $courWArr[25];
                                       }
                                       elseif( $tweight <= 30 ){
                                          $weightChrg = $courWArr[30];
                                       }
                                       elseif( $tweight <= 35 ){
                                          $weightChrg = $courWArr[35];
                                       }
                                       elseif( $tweight <= 40 ){
                                          $weightChrg = $courWArr[40];
                                       }
                                       elseif( $tweight <= 45 ){
                                          $weightChrg = $courWArr[45];
                                       }
                                       elseif( $tweight <= 50 ){
                                          $weightChrg = $courWArr[50];
                                       }
                                    }
                                 $totalDeliveryPrice += ($weightChrg+$total_amount_charged );
                                   
                                 }
                                 
                              }

   						}
   					}

$orderShippingPrice =   $totalDeliveryPrice+$shippingPrice;
$orderGrandTotal    =   $subTotal+$totalDeliveryPrice+$shippingPrice;
$array = [$orderShippingPrice,$orderGrandTotal];
echo json_encode($array);


				  }
   			}			
     }