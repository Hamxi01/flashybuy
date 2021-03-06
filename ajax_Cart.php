<?php 
		include('includes/db.php');

if (isset($_POST['action']) && $_POST['action']=='add'){
	
	$product_id        =  $_POST['product_id'];
	$vendor_id         =  $_POST['vendor_id'];
	$quantity          =  $_POST['quantity'];
	$price             =  $_POST['price'];
	$variation_id      =  $_POST['variation_id'];
	$v_p_id            =  $_POST['v_p_id'];

	// echo $product_id.$vendor_id.$quantity.$variation_id;

    //=========== Product name =========== //

	$pSql = mysqli_query($con,"SELECT * FROM products WHERE product_id='$product_id'");
	while($pRes = mysqli_fetch_array($pSql)){

		$name  = $pRes['name'];
		$image = $pRes['image1'];
	}

	//=========== Product have variation =========== //

	if (!empty($variation_id)) {
		
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

//==================== CART SESSION IF PRODUCT HAVE VARIATIONS ===================// 

						

	}else{
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

//================= Remove product from Cart ======================= //

if(isset($_POST['action']) && $_POST['action'] == "delete"){

@$p_id   	= trim($_POST['p_id']);
unset($_SESSION['product_cart'][$p_id]);
}

// ============================== Empty Whole Cart ====================== //

if(isset($_POST['action']) && $_POST['action'] == "empty"){
	unset($_SESSION['product_cart']);
}
?>	

<!-- ==========  Showing Cart Items  ================ -->

<?php 
		if(isset($_SESSION['product_cart'])){
	 
  		  $tquantity = 0;
		  $tPrice    = 0;
		  foreach($_SESSION['product_cart'] as $data){
		  		$priceProduct = $data['price']*$data['quantity'];
				$tPrice		 += $priceProduct;
				$tquantity 	 += $data['quantity'];
				$id           = base64_encode($data['product_id']);

		  
		 echo '
		 								<div class="ps-product--cart-mobile">
		                                        <div class="ps-product__thumbnail"><a href=""><img src="upload/product/200_'.$data['image'].'" alt=""></a></div>
 		                                       <div class="ps-product__content"><a href="" class="ps-product__remove" onclick="remove_cart('.$data['v_p_id'].')"><i class="icon-cross"></i></a><a href="product.php?id='.$id.'&name='.str_replace(" ", "-",$data['name']).'">'.$data['name'].'('.!empty($data['sku']).')</a>
                                            <p><strong>Sold by:</strong> '.$data['vendor'].'</p><small>'.$data['quantity'].' x '.$data['price'].'</small>
                                        </div>
                                    </div>';
			}
			if ($tPrice!=0) {?>
			 	
			  
					<div class="ps-cart__footer">
                                    <h3>Sub Total:<strong>R<?=$tPrice?></strong></h3>
                                    <?php
									    if(isset($_SESSION['name'])){?>

									    	<figure><a class="ps-btn" href="shopping-cart.php">View Cart</a><a class="ps-btn" href="shopping-cart.php">Checkout</a></figure>
									        
									   <?php  }else{?>
									      <figure><a class="ps-btn" href="userlogin.php">View Cart</a><a class="ps-btn" href="userlogin.php">Checkout</a></figure>
									    <?php } ?>
                                    
                               </div>
    <?php                           
            }                   
            echo '`'.$tquantity;                   
		}

	?>
