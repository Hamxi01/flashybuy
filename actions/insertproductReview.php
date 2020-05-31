<?php

	include('../includes/db.php');

if (isset($_POST['insertReview'])) {
 	
 	$rating      =  $_POST['rating'];
 	$product_id  =  $_POST['product_id'];
 	$user_id     =  $_POST['user_id'];
 	$description =  addslashes($_POST['description']);
 	$user_name   =  addslashes($_POST['user_name']);
 	$user_email  =  addslashes($_POST['email']);

 	$pSql  = mysqli_query($con,"SELECT * FROM products where product_id='$product_id'");
 	while ($pRes = mysqli_fetch_array($pSql)) {
 		
 		$name = $pRes['name'];
 	}

 	$prSql   = "INSERT into product_reviews (product_id,user_id,rating,description,user_name,user_email) VALUES ('$product_id','$user_id','$rating','$description','$user_name','$user_email')";
 	
 	if (mysqli_query($con,$prSql)) {
 	 	
 		header('location:../product.php?id='.base64_encode($product_id).'&name='.str_replace(' ','-',$name));
 	} 
 } 
?>