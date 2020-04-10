<?php include('../../includes/db.php');


if (isset($_POST['product_id'])) {
	
	$product_id             = $_POST['product_id'];
	$first_variation_name   = $_POST['first_variation_name'];
	$first_variation_value  = $_POST['first_variation_value'];
	$sku                    = $first_variation_value;

if (isset($_POST['second_variation_value'])) {	
	$second_variation_name  = $_POST['second_variation_name'];
	$second_variation_value = $_POST['second_variation_value'];
	$sku                    = $sku.'-'.$second_variation_value;
}
if (isset($_POST['third_variation_value'])) {
	$third_variation_name   = $_POST['third_variation_name'];	
	$third_variation_value  = $_POST['third_variation_value'];
	$sku                    = $sku.'-'.$third_variation_value;
}
if (isset($_POST['forth_variation_value'])) {
	$forth_variation_name   = $_POST['forth_variation_name'];	
	$forth_variation_value  = $_POST['forth_variation_value'];
	$sku                    = $sku.'-'.$forth_variation_value;
}	
	$quantity               = $_POST['stock'];
	$price                  = $_POST['price'];
	$sql   = "INSERT into product_variations(product_id,first_variation_name,first_variation_value,second_variation_name,second_variation_value,third_variation_name,third_variation_value,forth_variation_name,forth_variation_value,sku,price,quantity) VALUES ('$product_id','$first_variation_name','$first_variation_value','$second_variation_name','$second_variation_value','$third_variation_name','$third_variation_value','$forth_variation_name','$forth_variation_value','$sku','$price','$quantity')";
	if (mysqli_query($con,$sql)) {
		
		echo "success";
	}else{

		echo "Eror";
	}

}