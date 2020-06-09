<?php  

function relatedProducts($con,$cat_id){

    $pSql   = "SELECT P.*  FROM products AS P WHERE cat_id ='$cat_id' AND approved = 'Y' ";
    $sPQ = mysqli_query( $con , $pSql );      
    while($rPd = mysqli_fetch_array($sPQ )){

        $product_id         =   $rPd['product_id'];
        $name          =   $rPd['name'];
        $img             =   $rPd['image1'];

        if (empty($img)) {
    
          $varaintImgQuery = "SELECT main_img from product_variant_images where product_id ='$product_id'";
          $varaintImgSql   = mysqli_query($con,$varaintImgQuery);
          while ($productVaraintImg = mysqli_fetch_array($varaintImgSql)) {

            $img = $productVaraintImg['main_img'];
          }
        }
        $prSql       = mysqli_query($con,"SELECT count(DISTINCT(user_id)),rating FROM product_reviews where product_id ='$product_id'");
        while($prRes = mysqli_fetch_array($prSql)){

            $totalR = $prRes[0];
            $rating = $prRes[1];
        }
        $gV = " SELECT  VP.*,V.shop_name  FROM vendor_product AS VP 
                    INNER JOIN vendor AS V ON V.id = VP.ven_id
                    where VP.prod_id = '$product_id'   
                    and VP.quantity > 0
                    and VP.active = 'Y'
                    and VP.price > 0
                    ORDER BY price ASC, quantity DESC LIMIT 1";
                 
        $sV = mysqli_query( $con , $gV );
        $sVnum = mysqli_num_rows($sV );
            while( $rv = mysqli_fetch_array( $sV )){
                
                 $prod_pricess = $rv["price"];
                 $mk_price   = $rv["mk_price"];
                 $shop_name  = $rv['shop_name']; 
            }
            if($sVnum > 0){ ?>

                    <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><img src="upload/product/200_<?=$img?>" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#"><?=$shop_name?></a>
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
                                        <!-- <span><?=$totalR?></span> -->
                                    </div>
                                    <p class="ps-product__price">R<?=$prod_pricess?></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product.php?id=<?=base64_encode($product_id)?>&name=<?=str_replace(' ','-',$name)?>"><?=$name?></a>
                                    <p class="ps-product__price">R<?=$prod_pricess?></p>
                                </div>
                            </div>
                        </div>

           <?php }
    }
}

?>