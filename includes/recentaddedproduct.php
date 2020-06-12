
<?php   
$productQuery = "SELECT 
                      VP.*, 
                      P.name, 
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
                    GROUP BY 
                      VP.prod_id
                    ORDER BY
                      P.product_id DESC
                    LIMIT 
                        12";
$productSql = mysqli_query($con,$productQuery);
while ( $productResult = mysqli_fetch_array($productSql)) {
  
  $product_id = $productResult['prod_id'];
  $name       = $productResult['name'];
  $names       = $productResult['name'];
  $min        = $productResult['min'];
  $max        = $productResult['max'];
  if (strlen($names) > 12){
    $names  = substr($names, 0, 12) . '..';
} 
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
$prSql = mysqli_query($con,"SELECT count(DISTINCT(user_id)),rating FROM product_reviews where product_id ='$product_id'");
while($prRes = mysqli_fetch_array($prSql)){

    $totalR = $prRes[0];
    $rating = $prRes[1];
}  
?>                         
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6" style="padding-bottom: 26px;">
                 
                            <div class="card" style="text-align: center;
    padding-top: 10px;">
                            <a href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><img class="desktopimgsa" src="upload/product/300_<?=$image?>" alt=""></a>
  <div class="card-body">
  <div class="ps-product__container" style="text-align: center;">
                            <p class="ps-product__price sale" style="color: #f30;">R<?=$price?> </p>
                         
                                <div class="ps-product__content"><a class="ps-product__title"  style="min-height: 34px;   color: black;
    font-weight: 600;" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><?=$names?></a>
                               
                                    <!-- <div class="ps-product__progress-bar ps-progress" data-value="94">
                                        <div class="ps-progress__value"><span></span></div>
                                        <p>Sold:16</p>
                                    </div> -->
                                </div>
                            </div>
  </div>
</div>
                        </div>
<?php } ?> 