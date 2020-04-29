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
		
		$vSql = mysqli_query($con,"SELECT * FROM product_variations WHERE product_id ='$product_id' AND variation_id='$variation_id'");
		while ($vRes = mysqli_fetch_array($vSql)) {
		
			$sku = $vRes['sku'];
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
	print_r($product);
}
?>