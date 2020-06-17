<?php include('includes/db.php'); ?>

<?php

if (isset($_POST['product_id'])) {
	
	$product_id = $_POST['product_id'];
	$user_id    = $_POST['user_id'];

	$wSql = mysqli_query($con,"SELECT * FROM wishlist where product_id ='$product_id' AND user_id ='$user_id'");
	$wRow = mysqli_num_rows($wSql);
	if ($wRow > 0) {
			
			echo 'Already in whislist';

	}else{

		$wiSql ="INSERT into wishlist (product_id,user_id) VALUES ('$product_id','$user_id')";

		mysqli_query($con,$wiSql);
		echo 'Product added your wishlist.';
	}
}







?>