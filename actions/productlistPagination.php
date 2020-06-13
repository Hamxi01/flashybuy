<?php include("../includes/db.php"); ?>
<div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-shopping-product">
                                    <div class="row">
<?php 

$limit = 4;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;


//================== Search Query ===================== //
if (isset($_GET['search'])) {
  
  $keyword = $_GET['search'];

  $productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND (P.name like '%$keyword%'  OR P.description like '%$keyword%')
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
}
 // ================== Categories ==================== //

if (isset($_GET['cat_id'])) {
	
	$cat_id = $_GET['cat_id'];

	$productQuery = "SELECT 
                      VP.*, 
                      P.name,
                      P.short_desc,  
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND P.cat_id = '$cat_id'
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
}

//============ Subcategories ============================ //

if (isset($_GET['subcat_id'])) {

	$subcat_id = $_GET['subcat_id'];

	$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND P.sub_cat_id = '$subcat_id'
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
}

// =========== Brands list query =============== //
if (isset($_GET['brand_id'])) {

	$brand_id = $_GET['brand_id'];

	$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND P.brand = '$brand_id'
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
}

//================ Price Range ================ //

if (isset($_GET['price_range'])) {
    
    $price_range = $_GET['price_range'];
    if ($price_range == '0_100') {

    	$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND VP.price < 100
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
    }
    if ($price_range == '0_100') {

    	$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND VP.price < 100
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
    }
    if ($price_range == '100_250') {

    	$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 100
                      AND VP.price < 250
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
    }
    if ($price_range == '250_500') {

    	$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 250
                      AND VP.price < 500
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
    }
    if ($price_range == '500_750') {

    	$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 500
                      AND VP.price < 750
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
    }
    if ($price_range == '750_1000') {

    	$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 750
                      AND VP.price < 1000
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
    }
    if ($price_range == '=>1000') {

    	$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
                      P.short_desc, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0
                      AND VP.price > 1000
                    GROUP BY 
                      VP.prod_id LIMIT $start_from, $limit";
    }
}
  $productSql = mysqli_query($con,$productQuery);
  while ( $productResult = mysqli_fetch_array($productSql)) {

        $product_id = $productResult['prod_id'];
  $name       = $productResult['name'];
  $min        = $productResult['min'];
  $max        = $productResult['max'];

  if (!empty($productResult['variation_id'])) {
    
  
      if ($max==$min) {
             
        $price = $min;
      }
      else{

        $price = $min."-".$max;
      }
  }else{

      $price = $productResult['price'];
  }     
  $image = $productResult['image1'];
  if (empty($image)) {
    
      $varaintImgQuery = "SELECT main_img from product_variant_images where product_id ='$product_id'";
      $varaintImgSql   = mysqli_query($con,$varaintImgQuery);
      while ($productVaraintImg = mysqli_fetch_array($varaintImgSql)) {

        $image = $productVaraintImg['main_img'];
      }
  }

?>

<div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><img src="upload/product/200_<?=$image?>" alt=""></a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">ROBERT’S STORE</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><?=$name?></a>
                                                        <p class="ps-product__price">R<?=$price?></p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><?=$name?></a>
                                                        <p class="ps-product__price">R<?=$price?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<?php
}
?>
  </div>
                                </div>
                                
                            </div>
                            <div class="ps-tab" id="tab-2">
                                <div class="ps-shopping-product">
<?php
 $productSql = mysqli_query($con,$productQuery);
 while ( $productResult = mysqli_fetch_array($productSql)) {

       $product_id = $productResult['prod_id'];
        $short_desc = $productResult['short_desc'];
        
 $name       = $productResult['name'];
 $names       = $productResult['name'];
 if (strlen($names) > 16){
  $names  = substr($names, 0, 16) . '..';
} 
 $min        = $productResult['min'];
 $max        = $productResult['max'];

 if (!empty($productResult['variation_id'])) {
   
 
     if ($max==$min) {
            
       $price = $min;
     }
     else{

       $price = $min."-".$max;
     }
 }else{

     $price = $productResult['price'];
 }     
 $image = $productResult['image1'];
 if (empty($image)) {
   
     $varaintImgQuery = "SELECT main_img from product_variant_images where product_id ='$product_id'";
     $varaintImgSql   = mysqli_query($con,$varaintImgQuery);
     while ($productVaraintImg = mysqli_fetch_array($varaintImgSql)) {

       $image = $productVaraintImg['main_img'];
     }
 }

?>
                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><img src="upload/product/200_<?=$image?>" alt=""></a>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"  style="width: 800px;"><a class="ps-product__title" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><?=$names?></a>
                                              <?= $short_desc?>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price">R<?=$price?></p><a class="ps-btn" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>">Shop </a>
                                                <!-- <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>
                                                    <li><a href="#"><i class="icon-chart-bars"></i> Compare</a></li>
                                                </ul> -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php
}
?>
                                   
                                </div>
                            
                            </div>