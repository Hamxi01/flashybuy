<?php
include('../../includes/db.php');
include("../../thirdparty/image-resize/ImageResize.php");
include ("../../thirdparty/image-resize/ImageResizeException.php");
use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;


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
	$ven_id                          =     $_POST['vendor_id'];
	$courier_size                    =     $_POST['courier_size'];
	$description                     =     $_POST['description'];
	$sku                             =     str_replace(" ","-", $name);
	$image1                          =     $_POST['image1'];
	$image2                          =     $_POST['image2'];
	$image3                          =     $_POST['image3'];
	$image4                          =     $_POST['image4'];
	$warranty                        =     $_POST['warranty'];
	  if (isset($_POST['exclusive'])) {
	  
	  $exclusive = $_POST['exclusive'];
	  }else{

	    $exclusive = 'N';
	  }


	$sql = "INSERT into products (name,cat_id,sub_cat_id,sub_sub_cat_id,sku,brand,market_price,selling_price,quantity,ven_id,width,height,length,description,image1,image2,image3,image4,exclusive,warranty,courier_size) VALUES ('$name', '$category_id', '$subcategory_id','$subsubcategory_id','$sku','$brand','$market_price','$selling_price','$quantity','$ven_id','$width','$height','$length','$description','$image1','$image2','$image3','$image4','$exclusive','$warranty','$courier_size')";



	if ( mysqli_query($con,$sql)){

		$id = mysqli_insert_id($con);

			$custom_option        =     $_POST['custom_options'];
			$variations_approval  =     $_POST['variation_approval'];

////////////////// insert Varition images ////////////////

		if ($variations_approval=="N") {

			foreach ($_POST['vari'] as $key => $value) {
				
				if ($value == "Color") {
					
					if(isset($_POST['variant_img1']) && !empty($_POST['variant_img1'])){	
						foreach ($_POST['variant_img1'] as $index => $value) {

								$skuu         = $_POST['sku'][$index];
								$skuu         = explode("-", $skuu);
								$variantvalue = $skuu[0];

								$sql = "INSERT into product_variant_images(product_id,variation_value,image1,main_img,image2,image3,image4) VALUES('".$id."','".$variantvalue."','".$_POST['variant_img1'][$index]."','".$_POST['variant_img1'][$index]."','".$_POST['variant_img2'][$index]."','".$_POST['variant_img3'][$index]."','".$_POST['variant_img3'][$index]."')";

								mysqli_query($con,$sql);
						}		

								
					}	

				}

			}
		}			

////////////////////////////End varition images/////////////

//////////// Custom option Code /////////////////
			if ($custom_option=="Y") {
					
					$sql = "SELECT * from variant_options where subsubcategory_id = '$subsubcategory_id'";
					$res = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($res)) {
						
						$options = $row['options'];
					}
					$data = array();
		        	$i = 0;
		            if (!empty($options)) {
		        		
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
			            array_push($data, $item);
			            $i++;
					}

					$data = json_encode($data);
		        	$stmt = $con->prepare("INSERT INTO product_specification (product_id,options) VALUES (?, ?)");
		        	$stmt->bind_param("ss",$id,$data);
		        	$stmt->execute();
		        }		
			}
// ///////////////////// End Custom option  ////////////////////


	/////////////// Start Variation insert Code /////////		
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
							$sql = "INSERT into product_variations(product_id,price,mk_price,quantity,sku,first_variation_name,first_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$first_variation_value."')";
							
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

							$sql = "INSERT into product_variations(product_id,price,mk_price,quantity,sku,first_variation_name,second_variation_name,first_variation_value,second_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$second_variation_name."','".$first_variation_value."','".$second_variation_value."')";
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

							$sql = "INSERT into product_variations(product_id,price,mk_price,quantity,sku,first_variation_name,second_variation_name,third_variation_name,first_variation_value,second_variation_value,third_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$second_variation_name."','".$third_variation_name."','".$first_variation_value."','".$second_variation_value."','".$third_variation_value."')";
							
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

							$sql = "INSERT into product_variations(product_id,price,mk_price,quantity,sku,first_variation_name,second_variation_name,third_variation_name,forth_variation_name,first_variation_value,second_variation_value,third_variation_value,forth_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$second_variation_name."','".$third_variation_name."','".$forth_variation_name."','".$first_variation_value."','".$second_variation_value."','".$third_variation_value."','".$forth_variation_value."')";

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

//////// End Variation insertion Code //////////////////////////

    }
    else{
					header("location:../add-product.php?msg=error");
	}

}

?>