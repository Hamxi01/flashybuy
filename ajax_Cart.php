<?php 
		include('includes/db.php');

if (isset($_POST['action']) && $_POST['action']=='add'){
	
	$product_id        =  $_POST['product_id'];
	$vendor_id         =  $_POST['vendor_id'];
	$quantity          =  $_POST['quantity'];
	$price             =  $_POST['price'];
	$variation_id      =  $_POST['variation_id'];

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
		}
		$imgSql = mysqli_query($con,"SELECT main_img FROM product_variant_images WHERE product_id='$product_id'");
		$imgRes = mysqli_fetch_array($imgSql);
		$image  = $imgRes[0];

		$product = Array(

						'product_id'   => $product_id,
						'name'         => $name,
						'price'        => $price*$quantity,
						'quantity'     => $quantity,
						'variation_id' => $variation_id,

					);

	}else{

		$product = Array(

						'product_id'   => $product_id,
						'name'         => $name,
						'price'        => $price*$quantity,
						'quantity'     => $quantity,

					);
	}

//=============== Find Vendor Name ========================== ///

	$vSql = mysqli_query($con,"SELECT shop_name FROM vendor WHERE id='$vendor_id'");
	$vRes = mysqli_fetch_array($vSql);
	$vendor = $vRes['shop_name'];


//======================== return cart items detial ===================//

	echo '<div class="ps-cart__items">
									<div class="ps-product--cart-mobile">
                                        <div class="ps-product__thumbnail"><a href="#"><img src="upload/product/200_'.$image.'" alt=""></a></div>
                                        <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">'.$name.'</a>
                                            <p><strong>Sold by:</strong> '.$vendor.'</p><small>'.$quantity.' x '.$price.'</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-cart__footer">
                                    <h3>Sub Total:<strong>R'.$price*$quantity.'</strong></h3>
                                    <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn" href="checkout.html">Checkout</a></figure>
                                </div>';
	// print_r($product);
}
?>