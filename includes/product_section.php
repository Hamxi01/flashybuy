<div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
<?php   
$productQuery = "SELECT 
                      VP.*, 
                      P.name,
                      VP.prod_id, 
                      P.image1,
                      VP.price, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP
                      LEFT JOIN orders AS O ON VP.prod_id = O.order_prod_id 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = O.order_prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                    GROUP BY 
                      VP.prod_id
                    ORDER BY 
                      O.order_id DESC 
                    LIMIT 6";
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
$prSql = mysqli_query($con,"SELECT count(DISTINCT(user_id)),rating FROM product_reviews where product_id ='$product_id'");
while($prRes = mysqli_fetch_array($prSql)){

    $totalR = $prRes[0];
    $rating = $prRes[1];
}
?>                         
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><img class="desktopimgsa" src="upload/product/200_<?=$image?>" alt=""></a>
                                <!-- <div class="ps-product__badge">-16%</div> -->
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Go Pro</a>
                                <div class="ps-product__content"><a class="ps-product__title" style="min-height: 34px;" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><?=$name?></a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <?php if ($rating == 5) { ?>    
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="1">5</option>
                                                    <?php } ?>
                                                    <?php if ($rating == 4) { ?>    
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    <?php } ?>
                                                    <?php if ($rating == 3) { ?>    
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="2">4</option>
                                                        <option value="2">5</option>
                                                    <?php } ?>    
                                                    <?php if ($rating == 2) { ?>    
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="2">3</option>
                                                        <option value="2">4</option>
                                                        <option value="2">5</option>
                                                    <?php } ?>
                                                    <?php if ($rating == 1) { ?>    
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="2">3</option>
                                                        <option value="2">4</option>
                                                        <option value="2">5</option>
                                                    <?php }?>
                                                    <?php if($rating == 0){ ?>

                                                        <option value="0">1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    <?php } ?>

                                        </select>
                                        <span>(<?=$totalR?> Review)</span>
                                    </div>
                                    <p class="ps-product__price sale">R<?=$price?></del></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><?=$name?></a>
                                    <p class="ps-product__price sale">R<?=$price?></p>
                                </div>
                            </div>
                        </div>
<?php } ?>                        
                        
                    </div>
                </div>