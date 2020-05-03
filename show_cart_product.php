<?php
include("includes/db.php");

if (isset($_POST['product_id'])) {

	$product_id = $_POST['product_id'];
	 
	$pSql = mysqli_query($con,"SELECT * FROM products WHERE product_id='$product_id'");

	while ($res = mysqli_fetch_array($pSql)) {
		
		$name = $res['name'];
		$image = $res['image1'];

		if (empty($image)) {
			
			$vSql = mysqli_query($con,"SELECT main_img FROM product_variant_images where product_id='$product_id'");
			while ($vRes = mysqli_fetch_array($vSql)) {
				
				$image = $vRes['main_img'];
			}
		}
	}

	 
}

?>
<div >
	<div style="background:#E0EAE1; color:#006600; font-size:14px;  padding:10px" >
		You have added <b><?=$name?></b> to your Cart.
	</div>
	<div align="center" style="padding:20px;" >
		<img src="upload/product/200_<?=$image?>"  />
	</div>
	<div align="center" style="padding-top:10px;" >
		<button class="btn btn-warning" style="background:#FDD922; color:#333333; border:none; padding:10px; width:150px;" onclick="$('#cartModal').modal('hide');">Conitnue Shopping
		</button>
	</div>
	<div align="center" style="padding-top:10px;" >
		<button class="btn btn-warning" style="background:#FDD922; color:#333333; border:none; padding:10px;width:150px;" onclick="window.location.href='checkout.php'">checkout</button>
	</div>
</div>
