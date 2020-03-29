<?php
include('../../includes/db.php');

if (isset($_POST['add-product'])) {

	$filename = $_FILES["file1"]["name"];
	$filename = $_FILES["file1"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic1extension = strtolower($extension);
    $pic1 = time().rand();
    $pic1we=$pic1.$pic1extension;
    $location = "../upload/product/".$pic1we;

	// $name                            =     $_POST['name'];
	// $category_id                     =     $_POST['category_id'];
	// $subcategory_id                  =     $_POST['subcategory_id'];
	// $subsubcategory_id               =     $_POST['subsubcategory_id'];
	// $brand                           =     $_POST['brand'];
	// $market_price                    =     $_POST['market_price'];	
	// $selling_price                   =     $_POST['selling_price'];
	// $quantity                        =     $_POST['quantity'];
	// $width                           =     $_POST['width'];
	// $height                          =     $_POST['height'];
	// $length                          =     $_POST['length'];
	// // $courier_size                    =     $_POST['courier_size'];
	// $description                     =     $_POST['description'];
	// $sku                            = str_replace(" ","-", $name);

	// $sql = "INSERT into products (name,cat_id,sub_cat_id,sub_sub_cat_id,sku,brand,market_price,selling_price,quantity,width,height,length,description) VALUES ('$name', '$category_id', '$subcategory_id','$subsubcategory_id','$sku','$brand','$market_price','$selling_price','$quantity','$width','$height','$length','$description')";

	// if ( mysqli_query($con,$sql)){

	// 	$variations_approval  =     $_POST['variation_approval'];
	// 	if($variations_approval=="N"){

	// 		$id = mysqli_insert_id($con);
	// 		$variation_name       =     $_POST['variations_name'];
	// 		$variation_name       =     str_replace('-',' ', $variation_name);
	// 		$variation_name       =     explode(" ", $variation_name);
	// 		$variationname        =     count($variation_name);
	// 		if ($variationname == 2) {
				
	// 			$first_variation_name  = $variation_name[0];
	// 			$second_variation_name = $variation_name[1];
	// 		}else{

	// 			$first_variation_name  = $variation_name[0];
	// 			$second_variation_name = "";

	// 		}
	// 		foreach ($_POST['price'] as $key => $value) {

	// 			$sql = "INSERT into product_variations(product_id,price,quantity,mk_price,first_variation_name,second_variation_name,first_variation_value,second_variation_value) VALUES('$id','".$value."','".$_POST['stock'][$key]."','".$_POST['mk_price'][$key]."','".$first_variation_name."','".$second_variation_name."','".$_POST['first_variation_value'][$key]."','".$_POST['second_variation_value'][$key]."')";
	// 			echo $sql;
	// 			if (mysqli_query($con,$sql)) {

	// 						header("location:../add-product.php?msg=success");
        					
	// 			}
	// 			else{

	// 				header("location:../add-product.php?msg=error");
	// 			}		
	// 		}
            
	// 	}
 //        else{

 //        	header("location:../add-product.php?msg=success");
 //        }   
 //    }

}

?>