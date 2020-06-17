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
                            AND deal_NO ='10050'
                            AND start_date < UNIX_TIMESTAMP()
                            AND end_date   > UNIX_TIMESTAMP()  
                            group by product_id
                            ORDER BY v_p_d_id DESC");
$dRows = mysqli_num_rows($dSql);
if ($dRows>0) {
   

while ( $dRes = mysqli_fetch_array($dSql)) {
    
    $deal_price = $dRes['deal_price'];
    $mk_price = $dRes['market_price'];
    $product_id = $dRes['product_id'];
    $less = ($mk_price - $deal_price) / 100;
    $name       = $dRes['name'];
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

?>    <div class="ps-product ps-product--inner">
                            <div class="ps-product__thumbnail"><a href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><img src="upload/product/200_<?=$image?>" alt=""></a>
                                <div class="ps-product__badge"><?=$less?>%</div>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li><li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview<?=$product_id?>"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist" onclick="whishlist(<?=$product_id?>)"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container">
                                <p class="ps-product__price sale">R<?=$deal_price?> <del>R<?=$mk_price?> </del><small><?=$less?>%</small></p>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><?=$name?></a>
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
                                    <!-- <div class="ps-product__progress-bar ps-progress" data-value="94">
                                        <div class="ps-progress__value"><span></span></div>
                                        <p>Sold:16</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <?php } } ?>