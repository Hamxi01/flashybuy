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
	// $courier_size                 =     $_POST['courier_size'];
	$description                     =     $_POST['description'];
	$sku                             =     str_replace(" ","-", $name);



// upload and crop image1 //
if (isset($_FILES['file1']["name"]) && !empty($_FILES['file1']["name"])) {

    $filename = $_FILES["file1"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic1extension = strtolower($extension);
    $pic1 = time().rand();
    $pic1we=$pic1.".".$pic1extension;
    $location = "../../upload/product/".$pic1we;
    
	if(move_uploaded_file($_FILES["file1"]["tmp_name"], $location)){

	        try {
				    $image = new ImageResize($location);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(800);
				    $image->resizeToHeight(800);
				    $new_name = '800_' . $pic1 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
	  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(300);
				    $image->resizeToHeight(300);
				    $new_name = '300_' . $pic1 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(200);
				    $image->resizeToHeight(150);
				    $new_name = '200_' . $pic1 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}

	}
}

// upload and crop image2 //
if (isset($_FILES['file2']["name"]) && !empty($_FILES['file2']["name"])) {

    $filename = $_FILES["file2"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic2extension = strtolower($extension);
    $pic2 = time().rand();
    $pic2we=$pic2.".".$pic2extension;
    $location2 = "../../upload/product/".$pic2we;
    
	if(move_uploaded_file($_FILES["file2"]["tmp_name"], $location2)){

	        try {
				    $image = new ImageResize($location2);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(800);
				    $image->resizeToHeight(800);
				    $new_name = '800_' . $pic2 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
	  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location2);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(300);
				    $image->resizeToHeight(300);
				    $new_name = '300_' . $pic2 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location2);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(200);
				    $image->resizeToHeight(150);
				    $new_name = '200_' . $pic2 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}

	}
}
// upload and crop image3 //
if (isset($_FILES['file3']["name"]) && !empty($_FILES['file3']["name"])) {

    $filename = $_FILES["file3"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic3extension = strtolower($extension);
    $pic3 = time().rand();
    $pic3we=$pic3.".".$pic3extension;
    $location3 = "../../upload/product/".$pic3we;
    
	if(move_uploaded_file($_FILES["file3"]["tmp_name"], $location3)){

	        try {
				    $image = new ImageResize($location3);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(800);
				    $image->resizeToHeight(800);
				    $new_name = '800_' . $pic3 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
	  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location3);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(300);
				    $image->resizeToHeight(300);
				    $new_name = '300_' . $pic3 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location3);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(200);
				    $image->resizeToHeight(150);
				    $new_name = '200_' . $pic3 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}

	}
}
// upload and crop image1 //
if (isset($_FILES['file4']["name"]) && !empty($_FILES['file4']["name"])) {

    $filename = $_FILES["file4"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic4extension = strtolower($extension);
    $pic4 = time().rand();
    $pic4we=$pic4.".".$pic4extension;
    $location4 = "../../upload/product/".$pic4we;
    
	if(move_uploaded_file($_FILES["file4"]["tmp_name"], $location4)){

	        try {
				    $image = new ImageResize($location4);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(800);
				    $image->resizeToHeight(800);
				    $new_name = '800_' . $pic4 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
	  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location4);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(300);
				    $image->resizeToHeight(300);
				    $new_name = '300_' . $pic4 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}
			try {
				    $image = new ImageResize($location4);
				    $image->quality_jpg = 85;
				    $image->resizeToWidth(200);
				    $image->resizeToHeight(150);
				    $new_name = '200_' . $pic4 . '.jpg';
				    $new_path = '../../upload/product/' . $new_name;
				    $image->save($new_path, IMAGETYPE_JPEG);
				  
				} catch (ImageResizeException $e) {
				    return null;
				}

	}
}


	$sql = "INSERT into products (name,cat_id,sub_cat_id,sub_sub_cat_id,sku,brand,market_price,selling_price,quantity,width,height,length,description,image1,image2,image3,image4) VALUES ('$name', '$category_id', '$subcategory_id','$subsubcategory_id','$sku','$brand','$market_price','$selling_price','$quantity','$width','$height','$length','$description','$pic1we','$pic2we','$pic3we','$pic4we')";



	if ( mysqli_query($con,$sql)){

		$id = mysqli_insert_id($con);

			$custom_option        =     $_POST['custom_options'];
////////////////// insert Varition images ////////////////

	if ($custom_option=="Y") {

		foreach ($_POST['vari'] as $key => $value) {
			
			if ($value == "Color") {
				
			if(isset($_FILES['variant_img1']['name']) && !empty($_FILES['variant_img1']["name"])){	
				foreach ($_FILES['variant_img1']['name'] as $index => $value) {

						$skuu         = $_POST['sku'][$index];
						$skuu         = explode("-", $skuu);
						$variantvalue = $skuu[0];

						$filename = $_FILES['variant_img1']['name'][$index];
					    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
					    $pic8extension = strtolower($extension);
					    $pic8 = time().rand();
					    $pic8we=$pic8.".".$pic8extension;
					    $location8 = "../../upload/product/".$pic8we;

					    if(move_uploaded_file($_FILES["variant_img1"]["tmp_name"][$index], $location8)){

						        try {
									    $image = new ImageResize($location8);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(800);
									    $image->resizeToHeight(800);
									    $new_name = '800_' . $pic8 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
						  
									} catch (ImageResizeException $e) {
									    return null;
									}
								try {
									    $image = new ImageResize($location8);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(300);
									    $image->resizeToHeight(300);
									    $new_name = '300_' . $pic8 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
									  
									} catch (ImageResizeException $e) {
									    return null;
									}
								try {
									    $image = new ImageResize($location8);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(200);
									    $image->resizeToHeight(150);
									    $new_name = '200_' . $pic8 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
									  
									} catch (ImageResizeException $e) {
									    return null;
									}

						}
						$sql = "INSERT into product_variant_images(product_id,variation_value,image1) VALUES('$id','$variantvalue','$pic8we')";
						if (mysqli_query($con,$sql)) {
							
							echo "Success";
						}
				}		

						
			}
			if(isset($_FILES['variant_img2']['name']) && !empty($_FILES['variant_img2']["name"])){
				foreach ($_FILES['variant_img2']['name'] as $index => $value) {

						$skuu         = $_POST['sku'][$index];
						$skuu         = explode("-", $skuu);
						$variantvalue = $skuu[0];

						$filename = $_FILES['variant_img2']['name'][$index];
					    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
					    $pic7extension = strtolower($extension);
					    $pic7 = time().rand();
					    $pic7we=$pic7.".".$pic7extension;
					    $locatio7 = "../../upload/product/".$pic7we;

					    if(move_uploaded_file($_FILES["variant_img2"]["tmp_name"][$index], $location7)){

						        try {
									    $image = new ImageResize($location7);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(800);
									    $image->resizeToHeight(800);
									    $new_name = '800_' . $pic7 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
						  
									} catch (ImageResizeException $e) {
									    return null;
									}
								try {
									    $image = new ImageResize($location7);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(300);
									    $image->resizeToHeight(300);
									    $new_name = '300_' . $pic7 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
									  
									} catch (ImageResizeException $e) {
									    return null;
									}
								try {
									    $image = new ImageResize($location7);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(200);
									    $image->resizeToHeight(150);
									    $new_name = '200_' . $pic7 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
									  
									} catch (ImageResizeException $e) {
									    return null;
									}

						}

						$sql = "update product_variant_images SET image2 ='".$pic7we."' Where product_id ='".$id."'";
						if (mysqli_query($con,$sql)) {
							
							echo "Success";
						}
				}
			}
			if(isset($_FILES['variant_img3']['name']) && !empty($_FILES['variant_img3']["name"])){
				foreach ($_FILES['variant_img3']['name'] as $index => $value) {

						$skuu         = $_POST['sku'][$index];
						$skuu         = explode("-", $skuu);
						$variantvalue = $skuu[0];

						$filename = $_FILES['variant_img3']['name'][$index];
					    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
					    $pic6extension = strtolower($extension);
					    $pic6 = time().rand();
					    $pic6we=$pic6.".".$pic6extension;
					    $location6 = "../../upload/product/".$pic6we;

					    if(move_uploaded_file($_FILES["variant_img3"]["tmp_name"][$index], $location6)){

						        try {
									    $image = new ImageResize($location6);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(800);
									    $image->resizeToHeight(800);
									    $new_name = '800_' . $pic6 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
						  
									} catch (ImageResizeException $e) {
									    return null;
									}
								try {
									    $image = new ImageResize($location6);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(300);
									    $image->resizeToHeight(300);
									    $new_name = '300_' . $pic6 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
									  
									} catch (ImageResizeException $e) {
									    return null;
									}
								try {
									    $image = new ImageResize($location6);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(200);
									    $image->resizeToHeight(150);
									    $new_name = '200_' . $pic6 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
									  
									} catch (ImageResizeException $e) {
									    return null;
									}

						}

						$sql = "update product_variant_images SET image3 ='".$pic6we."' Where product_id ='".$id."'";
						if (mysqli_query($con,$sql)) {
							
							echo "Success";
						}
				}
			}
			  if(isset($_FILES['variant_img4']['name']) && !empty($_FILES['variant_img4']["name"])){
				foreach ($_FILES['variant_img4']['name'] as $index => $value) {

						$skuu         = $_POST['sku'][$index];
						$skuu         = explode("-", $skuu);
						$variantvalue = $skuu[0];

						$filename = $_FILES['variant_img4']['name'][$index];
					    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
					    $pic5extension = strtolower($extension);
					    $pic5 = time().rand();
					    $pic5we=$pic5.".".$pic5extension;
					    $location5 = "../../upload/product/".$pic5we;

					    if(move_uploaded_file($_FILES["variant_img4"]["tmp_name"][$index], $location5)){

						        try {
									    $image = new ImageResize($location5);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(800);
									    $image->resizeToHeight(800);
									    $new_name = '800_' . $pic5 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
						  
									} catch (ImageResizeException $e) {
									    return null;
									}
								try {
									    $image = new ImageResize($location5);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(300);
									    $image->resizeToHeight(300);
									    $new_name = '300_' . $pic5 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
									  
									} catch (ImageResizeException $e) {
									    return null;
									}
								try {
									    $image = new ImageResize($location5);
									    $image->quality_jpg = 85;
									    $image->resizeToWidth(200);
									    $image->resizeToHeight(150);
									    $new_name = '200_' . $pic5 . '.jpg';
									    $new_path = '../../upload/product/' . $new_name;
									    $image->save($new_path, IMAGETYPE_JPEG);
									  
									} catch (ImageResizeException $e) {
									    return null;
									}

						}

						$sql = "update product_variant_images SET image4 ='".$pic5we."' Where product_id ='".$id."'";
						if (mysqli_query($con,$sql)) {
							
							echo "Success";
						}
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

//////// End Variation insertion Code //////////////////////////

    }
    else{

					header("location:../add-product.php?msg=error");
	}

}

?>