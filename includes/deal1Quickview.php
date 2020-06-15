<?php 
if (isset($_REQUEST['deal_No'])) {
    $deal_NO = $_REQUEST['deal_No'];
    
}
$dSql = mysqli_query($con,"SELECT P.*,VPD.v_p_id,VPD.deal_price,VPD.start_date,VPD.end_date,VPD.deal_quantity,VPD.market_price , VPD.deal_NO ,VPD.v_p_d_id,VP.quantity 
                    FROM vendor_product_deals AS VPD
                    INNER JOIN vendor_product as VP ON VP.id= VPD.v_p_id
                    INNER JOIN products AS P ON VPD.product_id = P.product_id 
                    WHERE   1 = 1  
                            AND VP.active = 'Y'
                            AND VP.price > 0
                            AND deal_NO ='10030'
                            AND start_date < UNIX_TIMESTAMP()
                            AND end_date   > UNIX_TIMESTAMP()  
                            group by product_id
                            ORDER BY v_p_d_id DESC");
$dRows = mysqli_num_rows($dSql);
if ($dRows>0) {
   

while ( $dRes = mysqli_fetch_array($dSql)) {

    
    
    $deal_price = $dRes['deal_price'];
    $mk_price = $dRes['market_price'];
    $less = ($mk_price - $deal_price) / 100;
    $product_id = $dRes['product_id'];
    $name       = $dRes['name'];
    $shortDesc = $dRes['short_desc'];
    $image = $dRes['image1'];
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
$brand_id  = $dRes['brand'];
        $bSql      = mysqli_query($con,"SELECT name from brands where id='$brand_id' AND delte =0");
        $bRes      = mysqli_fetch_array($bSql);
        $brand_name = $bRes[0];
?>
<div class="modal fade" id="product-quickview<?=$product_id?>" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
                <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                    <div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="false">
                            <div class="ps-product__images" data-arrow="true">
                                <div class="item"><img src="upload/product/200_<?=$image?>" alt=""></div><!-- 
                                <div class="item"><img src="img/products/detail/fullwidth/2.jpg" alt=""></div>
                                <div class="item"><img src="img/products/detail/fullwidth/3.jpg" alt=""></div> -->
                            </div>
                        </div>
                        <div class="ps-product__info">
                            <h1><?=$name?></h1>
                            <div class="ps-product__meta">
                                <p>Brand:<a href=""><?=$brand_name?></a></p>
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
                            </div>
                            <h4 class="ps-product__price">R<?=$price?></h4>
                            <div class="ps-product__desc">
                                <!-- <p>Sold By:<a href="#"><strong> Go Pro</strong></a></p> -->
                                <ul class="ps-list--dot">
                                    <?=$shortDesc?>
                                </ul>
                            </div>
                            <div class="ps-product__shopping"><a class="ps-btn ps-btn--black" href="#">Add to cart</a><a class="ps-btn" href="#">Buy Now</a>
                                <div class="ps-product__actions"><a href="#"><i class="icon-heart"></i></a><a href="#"><i class="icon-chart-bars"></i></a></div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
<?php } } ?>    