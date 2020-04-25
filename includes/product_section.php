<?php include('db.php');?>
<div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">

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
                      VP.prod_id";
$productSql = mysqli_query($con,$productQuery);
while ( $productResult = mysqli_fetch_array($productSql)) {
  
  $product_id = $productResult['prod_id'];
  $name       = $productResult['name'];
  $min        = $productResult['min'];
  $max        = $productResult['max'];
  if ($max==$min) {
         
    $price = $min;
  }
  else{

    $price = $min."-".$max;
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
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><img src="upload/product/200_<?=$image?>" alt=""></a>
                                <div class="ps-product__badge">-16%</div>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Go Pro</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><?=$name?></a>
                                    <!-- <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div> -->
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