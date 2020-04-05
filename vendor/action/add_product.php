<?php
include('../../includes/db.php');
$options = array();
if (isset($_POST['add-product'])) {

	$name                            =     $_POST['name'];
	$category_id                     =     $_POST['category_id'];
	$subcategory_id                  =     $_POST['subcategory_id'];
	$subsubcategory_id               =     $_POST['subsubcategory_id'];
	$brand                           =     $_POST['brand'];
	$market_price                    =     $_POST['market_price'];	
	$selling_price                   =     $_POST['selling_price'];
	$quantity                        =     $_POST['quantity'];
	$width                           =     $_POST['width'];
	$height                          =     $_POST['height'];
	$length                          =     $_POST['length'];
	// $courier_size                 =     $_POST['courier_size'];
	$description                     =     $_POST['description'];
	$sku                             =     str_replace(" ","-", $name);

	$sql = "INSERT into products (name,cat_id,sub_cat_id,sub_sub_cat_id,sku,brand,market_price,selling_price,quantity,width,height,length,description) VALUES ('$name', '$category_id', '$subcategory_id','$subsubcategory_id','$sku','$brand','$market_price','$selling_price','$quantity','$width','$height','$length','$description')";

	if ( mysqli_query($con,$sql)){

		$id = mysqli_insert_id($con);

			$custom_option        =     $_POST['custom_options'];
			if ($custom_option=="Y") {
					
					$sql = "SELECT * from variant_options where subsubcategory_id = '$subsubcategory_id'";
					$res = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($res)) {
						
						$options = $row['options'];
					}
					$data = array();
		        	$i = 0;
					foreach (json_decode($options) as $key => $element){


						$item = array();
			            if ($element->type == 'text') {
			                $item['type'] = 'text';
			                $item['label'] = $element->label;
			                $item['value'] = $_POST['element_'.$i];
			            }
			            elseif ($element->type == 'select' || $element->type == 'radio') {
			                $item['type'] = 'select';
			                $item['label'] = $element->label;
			                $item['value'] = $_POST['element_'.$i];
			            }
			            elseif ($element->type == 'multi_select') {
			                $item['type'] = 'multi_select';
			                $item['label'] = $element->label;
			                $item['value'] = json_encode($_POST['element_'.$i]);
			            }
			            // elseif ($element->type == 'file') {
			            //     $item['type'] = 'file';
			            //     $item['label'] = $element->label;
			            //     $item['value'] = $$_POST['element_'.$i]->store('uploads/verification_form');
			            // }
			            array_push($data, $item);
			            $i++;
					}

				$data = json_encode($data);
		        $stmt = $con->prepare("INSERT INTO product_specification (product_id,options) VALUES (?, ?)");
		        $stmt->bind_param("ss",$id,$data);
		        $stmt->execute();		
			}

		$variations_approval  =     $_POST['variation_approval'];
		if($variations_approval=="N"){

			foreach ($_POST['qty'] as $key => $value) {

				$variationname = $_POST['variationname'];
				// $variationname = explode($variationname);
				if (count($_POST['variationname'])==1) {

						$first_variation_name = $_POST['variationname'][0];

						$sku = $_POST['sku'][$key];
						$sku = explode("-",$sku);
						if (count($sku)==1) {
						
							$first_variation_value = $sku[0];
							$sql = "INSERT into product_variations(product_id,price,quantity,sku,first_variation_name,first_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$first_variation_value."')";
							
							if (mysqli_query($con,$sql)) {

								header("location:../add-product.php?msg=success");
		        					
							}
							else{

										header("location:../add-product.php?msg=error");
							}
						}
				}
				if (count($_POST['variationname'])==2) {

						$first_variation_name = $_POST['variationname'][0];
						$second_variation_name = $_POST['variationname'][1];

						$sku = $_POST['sku'][$key];
						$sku = explode("-",$sku);
						if (count($sku)==2) {
						
							$first_variation_value = $sku[0];
							$second_variation_value = $sku[1];

							$sql = "INSERT into product_variations(product_id,price,quantity,sku,first_variation_name,second_variation_name,first_variation_value,second_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$second_variation_name."','".$first_variation_value."','".$second_variation_value."')";
							if (mysqli_query($con,$sql)) {

								header("location:../add-product.php?msg=success");
		        					
							}
							else{

										header("location:../add-product.php?msg=error");
							}
						}
				}
				if (count($_POST['variationname'])==3) {

						$first_variation_name = $_POST['variationname'][0];
						$second_variation_name = $_POST['variationname'][1];
						$third_variation_name = $_POST['variationname'][2];

						$sku = $_POST['sku'][$key];
						$sku = explode("-",$sku);
						if (count($sku)==3) {
						
							$first_variation_value  = $sku[0];
							$second_variation_value = $sku[1];
							$third_variation_value  = $sku[2];

							$sql = "INSERT into product_variations(product_id,price,quantity,sku,first_variation_name,second_variation_name,third_variation_name,first_variation_value,second_variation_value,third_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$second_variation_name."','".$third_variation_name."','".$first_variation_value."','".$second_variation_value."','".$third_variation_value."')";
							
							if (mysqli_query($con,$sql)) {

								header("location:../add-product.php?msg=success");
		        					
							}
							else{

										header("location:../add-product.php?msg=error");
							}
						}
				}
				if (count($_POST['variationname'])==4) {

						$first_variation_name = $_POST['variationname'][0];
						$second_variation_name = $_POST['variationname'][1];
						$third_variation_name = $_POST['variationname'][2];
						$forth_variation_name = $_POST['variationname'][3];

						$sku = $_POST['sku'][$key];
						$sku = explode("-",$sku);
						if (count($sku)==4) {
						
							$first_variation_value = $sku[0];
							$second_variation_value = $sku[1];
							$third_variation_value  = $sku[2];
							$forth_variation_value  = $sku[3];

							$sql = "INSERT into product_variations(product_id,price,quantity,sku,first_variation_name,second_variation_name,third_variation_name,forth_variation_name,first_variation_value,second_variation_value,third_variation_value,forth_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$second_variation_name."','".$third_variation_name."','".$forth_variation_name."','".$first_variation_value."','".$second_variation_value."','".$third_variation_value."','".$forth_variation_value."')";

								if (mysqli_query($con,$sql)) {

									header("location:../add-product.php?msg=success");
			        					
								}
								else{

											header("location:../add-product.php?msg=error");
								}
						}
				}		
			}
			
				
		}
		else{

        	header("location:../add-product.php?msg=success");
        }		
			// $variation_name       =     $_POST['variations_name'];
			// $variation_name       =     str_replace('-',' ', $variation_name);
			// $variation_name       =     explode(" ", $variation_name);
			// $variationname        =     count($variation_name);
			// if ($variationname == 2) {
				
			// 	$first_variation_name  = $variation_name[0];
			// 	$second_variation_name = $variation_name[1];
			// }else{

			// 	$first_variation_name  = $variation_name[0];
			// 	$second_variation_name = "";

			// }
			// foreach ($_POST['price'] as $key => $value) {

			// 	$sql = "INSERT into product_variations(product_id,price,quantity,mk_price,first_variation_name,second_variation_name,first_variation_value,second_variation_value) VALUES('$id','".$value."','".$_POST['stock'][$key]."','".$_POST['mk_price'][$key]."','".$first_variation_name."','".$second_variation_name."','".$_POST['first_variation_value'][$key]."','".$_POST['second_variation_value'][$key]."')";
			// 	echo $sql;
		// 		if (mysqli_query($con,$sql)) {

		// 					header("location:../add-product.php?msg=success");
        					
		// 		}
		// 		else{

		// 			header("location:../add-product.php?msg=error");
		// 		}		
		// 	}
            
		// }
  //          
    }
    else{

					header("location:../add-product.php?msg=error");
	}

}

?>