<?php
     include('includes/db.php');

    if (isset($_POST['product_id'])) {


      	 $v_p_id             = $_POST['v_p_id'];
      	 $product_id         = $_POST['product_id'];
      	 $quantity           = $_POST['quantity'];
      	 $price              = $_POST['price'];
      	 $vendor_id          = $_POST['vendor_id'];

      	 $vqSql = mysqli_query($con, "SELECT * FROM vendor_product where prod_id ='$product_id' AND ven_id='$vendor_id' AND id='$v_p_id'");
      	 while ($vqRes = mysqli_fetch_array($vqSql)) {
      	  	
      	 		$vendorQuantity = $vqRes['quantity'];
      	 		$variation_id   = $vqRes['variation_id'];
      	  }
      	  if ($quantity > $vendorQuantity) {

      	   		$quantity = $vendorQuantity;

      	   }
      	   if (!empty($variation_id) && !empty($product_id)) {

      	   			//=========== Product name =========== //

					$pSql = mysqli_query($con,"SELECT * FROM products WHERE product_id='$product_id'");
					while($pRes = mysqli_fetch_array($pSql)){

						$name  = $pRes['name'];
						$image = $pRes['image1'];
					}

      	   			$pvSql = mysqli_query($con,"SELECT * FROM product_variations WHERE product_id ='$product_id' AND variation_id='$variation_id'");
					while ($pvRes = mysqli_fetch_array($pvSql)) {
					
						$sku = $pvRes['sku'];
						$skuu = explode('-', $sku);
						$color = $skuu[0];
					}
					$imgSql = mysqli_query($con,"SELECT main_img FROM product_variant_images WHERE product_id='$product_id' AND variation_value = '$color'");
					$tRows  = mysqli_num_rows($imgSql);
					if ($tRows>0) {

						$imgRes = mysqli_fetch_array($imgSql);
						$image  = $imgRes[0];
					}else{

						$piSql = mysqli_query($con,"SELECT * FROM products WHERE product_id='$product_id'");
						while($piRes = mysqli_fetch_array($piSql)){

							
							$image = $piRes['image1'];
						}
					}

//=============== Find Vendor Name ========================== ///

					$vSql = mysqli_query($con,"SELECT shop_name FROM vendor WHERE id='$vendor_id'");
					$vRes = mysqli_fetch_array($vSql);
					$vendor = $vRes['shop_name'];

					$product = Array(

									'v_p_id'       => $v_p_id,
									'product_id'   => $product_id,
									'name'         => $name,
									'sku'          => $sku,
									'price'        => $price,
									'quantity'     => $quantity,
									'vendor_id'    => $vendor_id,
									'image'	       => $image,
									'variation_id' => $variation_id,
									'vendor'       => $vendor

								);

      	   }else{

      	   			//=========== Product name =========== //

					$pSql = mysqli_query($con,"SELECT * FROM products WHERE product_id='$product_id'");
					while($pRes = mysqli_fetch_array($pSql)){

						$name  = $pRes['name'];
						$image = $pRes['image1'];
					}
      	   			//=============== Find Vendor Name ========================== ///

					$vSql = mysqli_query($con,"SELECT shop_name FROM vendor WHERE id='$vendor_id'");
					$vRes = mysqli_fetch_array($vSql);
					$vendor = $vRes['shop_name'];

					$product = Array(

									'v_p_id'       => $v_p_id,
									'product_id'   => $product_id,
									'vendor_id'    => $vendor_id,
									'name'         => $name,
									'price'        => $price,
									'quantity'     => $quantity,
									'image'	       => $image,
									'vendor'       => $vendor

								);

      	   }
			//=================== CART SESSION=================//

				if(isset($_SESSION['product_cart']) && !empty($_SESSION['product_cart']))
				{
					if(!array_key_exists($v_p_id,$_SESSION['product_cart']))
					{
				   
						$_SESSION['product_cart'][$v_p_id] = $product;
				   
					}
					else{
						
						$_SESSION['product_cart'][$v_p_id]['price'] 	= $price;
						$_SESSION['product_cart'][$v_p_id]['quantity'] 	= $quantity;
					}		
				}
				else{
				  $_SESSION['product_cart'][$v_p_id] = $product;
				}		 
    } 
?>