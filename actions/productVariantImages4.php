<?php 
     include('../includes/db.php');

if (isset($_POST['product_id'])) {
	
	$product_id                    = $_POST['product_id'];
	$forth_variation_value         = $_POST['variation4'];

	$ivSql = mysqli_query($con,"SELECT * from product_variant_images where product_id='$product_id' AND variation_value = '$forth_variation_value'");
	$viRows = mysqli_num_rows($ivSql);
	if ($viRows>0) {
		
		while ($res = mysqli_fetch_array($ivSql)) {
		
			$image1 = $res['image1'];
			$image2 = $res['image2'];
			$image3 = $res['image3'];
			$image4 = $res['image4'];
		}
	$array = [$image1,$image2,$image3,$image4];
	echo json_encode($array);	
	}
	
			
}
?>