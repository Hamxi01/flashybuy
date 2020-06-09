<?php 
        include('includes/db.php');
        include('includes/head.php');
        include('actions/singleproductOtherOffers.php');
        include('includes/relatedProducts.php');

if (isset($_GET['id'])) {


   $product_id = base64_decode($_GET['id']);
   $pMain  = "SELECT
        P.*,
        PV.first_variation_value,
        PV.first_variation_name,
        PV.second_variation_value,
        PV.second_variation_name,
        PV.third_variation_value,
        PV.third_variation_name,
        PV.forth_variation_value,
        PV.forth_variation_name,
        VP.price as actual_price,
        VP.variation_id,
        VP.quantity as qty,
        VP.ven_id as vendorid,
        VP.id as v_p_id,
        PV.price,
        PV.quantity as stock,
        PV.sku,
        PVS.variation_value,
        PVS.image1 as variant_img1,
        PVS.image2 as variant_img2,
        PVS.image3 as variant_img3,
        PVS.image4 as variant_img4 
    FROM
        products AS P 
    LEFT JOIN
        product_variations AS PV 
            ON PV.product_id = P.product_id
    LEFT JOIN
        vendor_product AS VP 
            ON VP.prod_id = P.product_id 
    LEFT JOIN
        product_variant_images AS PVS 
            ON PV.product_id = PVS.product_id 
    WHERE
        P.product_id = $product_id
    AND
        VP.active='Y'
    AND
        VP.price = ( SELECT MIN(price) FROM vendor_product where prod_id='$product_id' AND active='Y')";
   $pQuery = mysqli_query($con,$pMain);
   while ( $result = mysqli_fetch_array($pQuery)) {
        
        $name      = $result['name'];
        $cat_id    = $result['cat_id'];
        $shortDesc = $result['short_desc']; 
        ///=========Product Reveiw ================ //
        $prSql       = mysqli_query($con,"SELECT count(DISTINCT(user_id)),rating FROM product_reviews where product_id ='$product_id'");
        while($prRes = mysqli_fetch_array($prSql)){

            $totalR = $prRes[0];
            $rating = $prRes[1];
        }
        //===========================================//
    // ============= Check product is in deal or not ========= //

        $vpdSql  = mysqli_query($con,"SELECT * FROM vendor_product_deals WHERE start_date < UNIX_TIMESTAMP() AND end_date > UNIX_TIMESTAMP() AND product_id ='$product_id'");
        while($vpdRes = mysqli_fetch_array($vpdSql)){

                $price       = $vpdRes['deal_price'];
                $v_p_id    = $vpdRes['v_p_id'];
                $stock      = $vpdRes['deal_quantity'];

                $vndrSql = mysqli_query($con,"SELECT * FROM vendor_product where id ='$v_p_id'");
                while ($vndrRes = mysqli_fetch_array($vndrSql)) {
                    
                    $vendor_id = $vndrRes['ven_id'];

                    $vsql ="SELECT shop_name from vendor where id='$vendor_id'";
                    $vquery = mysqli_query($con,$vsql);
                    $vres   = mysqli_fetch_array($vquery);
                    $vendorname = $vres['shop_name'];
                }
             }

    // =================== End check for product ============ //
       
        if (empty($price)){

            if (empty($result['selling_price'])) {

            $priceSql   = mysqli_query($con,"SELECT MIN(price),MAX(price) FROM vendor_product where prod_id='$product_id' AND active='Y'");
            $priceArray = mysqli_fetch_array($priceSql);
            $price      = $priceArray[0].'-R'.$priceArray[1];
            }
            else{

                $price = $result['actual_price'];
            }

            $v_p_id  = $result['v_p_id'];
            $vendor_id = $result['vendorid'];
            $vsql ="SELECT shop_name from vendor where id='$vendor_id'";
            $vquery = mysqli_query($con,$vsql);
            $vres   = mysqli_fetch_array($vquery);
            $vendorname = $vres['shop_name'];
            $stock      = $result['qty'];


        }

        $quantity = $result['quantity'];

        if (empty($result['image1'])) {
            
            $vimg = mysqli_query($con,"SELECT * from product_variant_images Where product_id ='$product_id'");
            while ($res = mysqli_fetch_array($vimg)) {
                    
                    $image1 = $res['main_img'];
                    $image2 = $res['image2'];
                    $image3 = $res['image3'];
                    $image4 = $res['image4'];
            }
        }else{

            $image1 = $result['image1'];
            $image2 = $result['image2'];
            $image3 = $result['image3'];
            $image4 = $result['image4'];
        }
        $first_variation_name  = $result['first_variation_name'];
        $second_variation_name = $result['second_variation_name'];
        $third_variation_name  = $result['third_variation_name'];
        $forth_variation_name  = $result['forth_variation_name'];
        $description           = $result['description'];
        $variationid           = $result['variation_id'];
        

        $brand_id  = $result['brand'];
        $bSql      = mysqli_query($con,"SELECT name from brands where id='$brand_id' AND delte =0");
        $bRes      = mysqli_fetch_array($bSql);
        $brand_name = $bRes[0];    
    } 
}
?>
<style type="text/css">
    .product-variation{
        cursor: pointer;
        min-width: 5rem;
        min-height: 2.125rem;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: .25rem .75rem;
        margin: 0 8px 8px 0;
        color: rgba(0,0,0,.8);
        font-size: 12px;
        text-align: left;
        border-radius: 2px;
        border: 1px solid rgba(0,0,0,.09);
        position: relative;
        background: #fff;
        outline: 0;
        word-break: break-word;
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -moz-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -moz-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -moz-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;}
    
    .Active {
        color: #fff;
        padding: 5px 5px;
        border-color:white;
        background: #ee4d2d;
    }
    .Active1 {
        color: #fff;
        padding: 5px 5px;
        border-color:white;
        background: #ee4d2d;
    }
    .Active2 {
        color: #fff;
        padding: 5px 5px;
        border-color:white;
        background: #ee4d2d;
    }
    .Active3 {
        color: #fff;
        padding: 5px 5px;
        border-color:white;
        background: #ee4d2d;
    }
    div#other-offers {
        background: #ffffff;
        box-shadow: -1px -1px 3px 1px rgba(0, 0, 0, 0.23);
        padding: 10px;
    }
    .widget_same-brand .widget__content {
        padding: 20px;
        position: relative;
        bottom: 50px;
    }
    button#cart:disabled {
        background: gainsboro;
    }
    #quantity::-webkit-outer-spin-button,
    #quantity::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #quantity {
        -moz-appearance:textfield;
    }
    span#notify {
        padding: 10px;
        border-radius: 4px;
        box-shadow: 1px 1px rgba(136, 136, 136, 0.38);
    }
</style>    
    <nav class="navigation--mobile-product"><a class="ps-btn ps-btn--black" href="shopping-cart.html">Add tos cart</a><a class="ps-btn" href="checkout.html">Buy Now</a></nav>
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="shop-default.html">Clothing & Apparel</a></li>
                <li><a href="shop-default.html">Mens</a></li>
                <li>Sleeve Linen Blend Caro Pane Shirt</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--product">
        <div class="ps-container">
            <div class="ps-page__container">
                <div class="ps-page__left">
                    <div class="ps-product--detail ps-product--fullwidth">
                        <div class="ps-product__header">
                            <div class="ps-product__thumbnail" data-vertical="true">
                                <figure>
                                    <div class="ps-wrapper">
                                        <div class="ps-product__gallery" data-arrow="true">
                                        <?php if(!empty($image1)){?>
                                            <div class="item"><a id="imglink1" href="upload/product/800_<?=$image1?>"><img src="upload/product/800_<?=$image1?>" id="img1" alt=""></a></div>
                                        <?php } ?>
                                        <?php if(!empty($image2)){?>
                                            <div class="item"><a id="imglink2" href="upload/product/800_<?=$image2?>"><img src="upload/product/800_<?=$image2?>" id="img2" alt=""></a></div>
                                        <?php } ?>
                                        <?php if(!empty($image3)){?>    
                                            <div class="item"><a id="imglink3" href="upload/product/800_<?=$image3?>"><img src="upload/product/800_<?=$image3?>" id="img3" alt=""></a></div>
                                        <?php } ?>
                                        <?php if(!empty($image4)){?>
                                            <div class="item"><a id="imglink4" href="upload/product/800_<?=$image4?>"><img src="upload/product/800_<?=$image4?>" id="img4" alt=""></a></div>
                                        <?php } ?>    
                                        </div>
                                    </div>
                                </figure>
                                <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                                <?php if(!empty($image1)){?>    
                                    <div class="item"><img id="imgth1" src="upload/product/800_<?=$image1?>" alt=""></div>
                                <?php } ?> 
                                <?php if(!empty($image2)){ ?>   
                                    <div class="item"><img id="imgth2" src="upload/product/800_<?=$image2?>" alt=""></div>
                                <?php } ?>
                                <?php if(!empty($image3)){?>    
                                    <div class="item"><img id="imgth3" src="upload/product/800_<?=$image3?>" alt=""></div>
                                <?php } ?>
                                <?php if(!empty($image4)){?>    
                                    <div class="item"><img id="imgth4" src="upload/product/800_<?=$image4?>" alt=""></div>
                                <?php } ?>    
                                </div>
                            </div>
                            <div class="ps-product__info">
                                <h1><?=$name?></h1>
                                <div class="ps-product__meta">
                                    <p>Brand:<a href="#"><?=$brand_name?></a></p>
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
                                        </select><span>(<?=$totalR?> review)</span>
                                    </div>
                                </div>
                                <h4 id="ps-product__price"><b>R</b><?=$price?></h4>
                                <div class="ps-product__desc">
                                    <p>Sold By:<a href="#"><strong id="vendorname"><?=$vendorname?></strong></a></p>
                                    <ul class="ps-list--dot">
                                        <?=$shortDesc?>
                                    </ul>
                                </div>
                                <div class="ps-product__variations">
                                    <?php if(!empty($first_variation_name)){?>
                                    <figure>
                                        <figcaption><strong><?=$first_variation_name?>:  Choose an option</strong></figcaption>
                                        <?php if ($quantity==0) {
                                                
                                                $variants = "SELECT DISTINCT first_variation_value from product_variations where product_id = '$product_id' AND active='Y'";
                                                $query    = mysqli_query($con,$variants);
                                                while ($variations = mysqli_fetch_array($query)) {
                                                    
                                               
                                          ?>
                                            
                                        
                                        <button class="product-variation option"><?=$variations['first_variation_value']?></button>
                                        <input type="hidden" name="option">
                                    <?php } }?>
                                        <!-- <div class="ps-variant ps-variant--image"><span class="ps-variant__tooltip"> Dark</span><img src="img/products/detail/variants/small-2.jpg" alt=""></div>
                                        <div class="ps-variant ps-variant--image"><span class="ps-variant__tooltip"> pink</span><img src="img/products/detail/variants/small-3.jpg" alt=""></div> -->
                                    </figure>
                                <?php } ?>
                                <?php if(!empty($second_variation_name)){?>
                                    <figure>
                                        <figcaption><strong><?=$second_variation_name?>:  Choose an option</strong></figcaption>
                                        <?php if ($quantity==0) {
                                                
                                                $variants = "SELECT DISTINCT second_variation_value from product_variations where product_id = '$product_id' AND active='Y'";
                                                $query    = mysqli_query($con,$variants);
                                                while ($variations = mysqli_fetch_array($query)) {
                                                    
                                               
                                          ?>
                                        <button class="product-variation option1"><?=$variations['second_variation_value']?></button>
                                        <?php } }?>
                                            
                                        <!-- <div class="ps-variant ps-variant--size"><span class="ps-variant__tooltip"> M</span><span class="ps-variant__size">M</span></div>
                                        <div class="ps-variant ps-variant--size"><span class="ps-variant__tooltip"> L</span><span class="ps-variant__size">L</span></div> -->
                                    </figure>
                                <?php } ?>
                                <?php if(!empty($third_variation_name)){?>
                                    <figure>
                                        <figcaption><strong><?=$third_variation_name?>:  Choose an option</strong></figcaption>
                                        <?php if ($quantity==0) {
                                                
                                                $variants = "SELECT DISTINCT third_variation_value from product_variations where product_id = '$product_id' AND active='Y'";
                                                $query    = mysqli_query($con,$variants);
                                                while ($variations = mysqli_fetch_array($query)) {
                                                    
                                               
                                          ?>
                                        <button class="product-variation option2"><?=$variations['third_variation_value']?></button>
                                        <?php } }?>
                                            
                                        <!-- <div class="ps-variant ps-variant--size"><span class="ps-variant__tooltip"> M</span><span class="ps-variant__size">M</span></div>
                                        <div class="ps-variant ps-variant--size"><span class="ps-variant__tooltip"> L</span><span class="ps-variant__size">L</span></div> -->
                                    </figure>
                                <?php } ?>
                                <?php if(!empty($forth_variation_name)){?>
                                    <figure>
                                        <figcaption><strong><?=$forth_variation_name?>:  Choose an option</strong></figcaption>
                                        <?php if ($quantity==0) {
                                                
                                                $variants = "SELECT DISTINCT forth_variation_value from product_variations where product_id = '$product_id' AND active='Y'";
                                                $query    = mysqli_query($con,$variants);
                                                while ($variations = mysqli_fetch_array($query)) {
                                                    
                                               
                                          ?>
                                        <button class="product-variation option3"><?=$variations['forth_variation_value']?></button>
                                        <?php } }?>
                                            
                                        <!-- <div class="ps-variant ps-variant--size"><span class="ps-variant__tooltip"> M</span><span class="ps-variant__size">M</span></div>
                                        <div class="ps-variant ps-variant--size"><span class="ps-variant__tooltip"> L</span><span class="ps-variant__size">L</span></div> -->
                                    </figure>
                                <?php } ?>
                                </div>
                                <div class="ps-product__shopping">
                                    <figure>
                                        <figcaption>Quantity</figcaption>
                                        <div class="form-group--number">
                                            <button class="up"><i class="fa fa-plus"></i></button>
                                            <button class="down"><i class="fa fa-minus"></i></button>
                                            <input class="form-control" type="number" value="1" min="1"  id="quantity">
                                        </div>
                                        <input type="hidden" name="" id="variation_id" value="">

                                    </figure>
                                    <?php if(empty($variationid)){?>

                                        <button class="ps-btn ps-btn--black" id="cart">Add to cart</button>

                                    <?php }else{?>

                                        <button class="ps-btn ps-btn--black" id="cart" disabled>Select Options</button>

                                    <?php } ?>
                                    <!-- <a class="ps-btn" href="#">Buy Now</a> -->
                                    <div class="ps-product__actions"><a href="#"><i class="icon-heart"></i></a><a href="#"><i class="icon-chart-bars"></i></a></div>
                                </div>
                                <div class="ps-product__specification"><a class="report" href="#">Report Abuse</a>
                                    <p><strong>SKU:</strong> SF1133569600-1</p>
                                    <p class="categories"><strong> Categories:</strong><a href="#">Consumer Electronics</a>,<a href="#"> Refrigerator</a>,<a href="#">Babies & Moms</a></p>
                                    <p class="tags"><strong> Tags</strong><a href="#">sofa</a>,<a href="#">technologies</a>,<a href="#">wireless</a></p>
                                </div>
                                <div class="ps-product__sharing"><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></div>
                            </div>
                        </div>
                        <div class="ps-product__content ps-tab-root">
                            <ul class="ps-tab-list">
                                <li class="active"><a href="#tab-1">Description</a></li>
                                <li><a href="#tab-2">Specification</a></li>
                                <li><a href="#tab-3">Vendor</a></li>
                                <li><a href="#tab-4">Reviews (1)</a></li>
                                <li><a href="#tab-5">Questions and Answers</a></li>
                                <li><a href="#tab-6">More Offers</a></li>
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab active" id="tab-1">
                                    <div class="ps-document">
                                        <?=$description?>
                                        <!-- <h5>Embodying the Raw, Wayward Spirit of Rock 'N' Roll</h5>
                                        <p>Embodying the raw, wayward spirit of rock ‘n’ roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p>
                                        <p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p><img class="mb-30" src="img/products/detail/content/description.jpg" alt="">
                                        <h5>What do you get</h5>
                                        <p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p>
                                        <p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p>
                                        <p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement – the S6 had it, then the Note5 didn’t, and now with the S7 the trend is clear.</p>
                                        <h5>Perfectly Done</h5>
                                        <p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus there’s no annoying flap covering the charging port</p>
                                        <ul class="pl-0">
                                            <li>No FM radio (except for T-Mobile units in the US, so far)</li>
                                            <li>No IR blaster</li>
                                            <li>No stereo speakers</li>
                                        </ul>
                                        <p>If you’ve taken the phone for a plunge in the bath, you’ll need to dry the charging port before plugging in. Samsung hasn’t reinvented the wheel with the design of the Galaxy S7, but it didn’t need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p> -->
                                    </div>
                                </div>
                                <div class="ps-tab" id="tab-2">
                                    <div class="table-responsive">
                                        <table class="table table-bordered ps-table ps-table--specification">
                                            <tbody>
                                    <?php 

                                            $vpSql = mysqli_query($con,"SELECT * FROM product_specification WHERE product_id = '$product_id'");
                                            while ($vpRes = mysqli_fetch_array($vpSql)) {
                                                 
                                                 $options =  $vpRes['options'];
                                             }
                                             if (!empty($options)) {

                                    ?>
                                    <?php 

                                                foreach (json_decode($options) as $key => $element){
                                                if ($element->type == 'text' || $element->type == 'file'){

                                    ?>
                                                <tr>
                                                    <td><?=$element->label?></td>
                                                    <td><?=$element->value?></td>
                                                </tr>

                                    <?php }elseif ($element->type == 'select' || $element->type == 'multi_select' || $element->type == 'radio'){ ?>
                                                <tr>
                                                 <td><?=$element->label?></td>
                                                 <td><?=$element->value?></td>
                                                </tr>
                                    <?php   } }} ?>            
                                                <!-- <tr>
                                                    <td>Wireless</td>
                                                    <td>Yes</td>
                                                </tr>
                                                <tr>
                                                    <td>Dimensions</td>
                                                    <td>5.5 x 5.5 x 9.5 inches</td>
                                                </tr>
                                                <tr>
                                                    <td>Weight</td>
                                                    <td>6.61 pounds</td>
                                                </tr>
                                                <tr>
                                                    <td>Battery Life</td>
                                                    <td>20 hours</td>
                                                </tr>
                                                <tr>
                                                    <td>Bluetooth</td>
                                                    <td>Yes</td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="ps-tab" id="tab-3">
                                    <h4 id="vendor"><?=$vendorname?></h4>
                                    <p>Digiworld US, New York’s no.1 online retailer was established in May 2012 with the aim and vision to become the one-stop shop for retail in New York with implementation of best practices both online</p><a href="#">More Products from gopro</a>
                                </div>
                                <div class="ps-tab" id="tab-4">
                                    <div class="row">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">
                                            <div class="ps-block--average-rating">
<?php 
$prSql = mysqli_query($con,"SELECT * FROM product_reviews WHERE approved ='Y' AND reject = 'N' AND product_id = '$product_id' ORDER BY p_r_id DESC");
while($prRes = mysqli_fetch_array($prSql)){

  
  $user_name   = $prRes['user_name'];
  $description = $prRes['description'];
  $rating      = $prRes['rating'];
?>
                                                <div class="ps-block__header">
                                                    
                                                    <h4><?=$user_name?></h4>
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
                                                    <?php } ?>
                                                    </select><span><?=$description?></span>
                                                </div>
<?php } ?>                                      
                                            </div>
                                        </div>

                                    <!-- Submit Reveiw for product  -->
                                    <?php 
                                            if(isset($_SESSION['id'])){
                                                $user_id = $_SESSION['id'];

                                            $oSql = mysqli_query($con,"SELECT * FROM orders WHERE order_user ='$user_id' AND order_prod_id ='$product_id' AND order_status = 'comp'");
                                            while ($oRes = mysqli_fetch_array($oSql)) {
                                                
                                                $date      = $oRes['time_id'];
                                                $date      = explode(' ', $date);
                                                $exactDate = $date[0];

                                                $newDate = date("m-d-Y", strtotime($exactDate));
                                                $expiry_date = $exactDate;
                                                $today = time();
                                                $interval = $today - strtotime($expiry_date);
                                                $days = floor($interval / 86400);
                                                
                                             

                                                    $urSql = mysqli_query($con,"SELECT * FROM product_reviews WHERE user_id = '$user_id' AND product_id ='$product_id'");
                                                    $urRows = mysqli_num_rows($urSql);
                                                    if ($urRows == 0) {
                                                    
                                                
                                                
                                    ?>            
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                            <form class="ps-form--review" action="actions/insertproductReview.php" method="post">
                                                <h4>Submit Your Review</h4>
                                                <p>Your email address will not be published. Required fields are marked<sup>*</sup></p>
                                                <div class="form-group form-group__rating">
                                                    <label>Your rating of this product</label>
                                                    <select class="ps-rating" data-read-only="false" name="rating">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="user_id"    value="<?=$user_id?>">
                                                <input type="hidden" name="product_id" value="<?=$product_id?>">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="description" rows="6" placeholder="Write your review here"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                        <div class="form-group">
                                                            <input class="form-control" name="user_name" type="text" placeholder="Your Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                        <div class="form-group">
                                                            <input class="form-control" name="email" type="email" placeholder="Your Email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group submit">
                                                    <button class="ps-btn" type="submit" name="insertReview">Submit Review</button>
                                                </div>
                                            </form>
                                        </div>

                                    <?php }  } }?>    
                                    <!-- Submit Reveiw for product  -->

                                    </div>
                                </div>
                                <div class="ps-tab" id="tab-5">
                                    <div class="ps-block--questions-answers">
                                        <h3>Questions and Answers</h3>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Have a question? Search for answer?">
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-tab active" id="tab-6">
                                    <p>Sorry no more offers available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-page__right">
                    <aside class="widget widget_product widget_features">
                        <p><i class="icon-network"></i> Shipping worldwide</p>
                        <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>
                        <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>
                        <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>
                    </aside>
                    <aside class="widget widget_sell-on-site">
                        <p><i class="icon-store"></i> Sell on Martfury?<a href="#"> Register Now !</a></p>
                    </aside>
                    <aside class="widget widget_ads"><a href="#"><img src="img/ads/product-ads.png" alt=""></a></aside>
                    
                                <?php if(empty($variationid)){

                                    echo singleProductOtherOffers($product_id,$vendor_id,$con);
                                    }     
                                ?>
                            
                </div>
            </div>
            <div class="ps-section--default ps-customer-bought">
                <div class="ps-section__header">
                    <h3>Customers who bought this item also bought</h3>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/4.jpg" alt=""></a>
                                    <div class="ps-product__badge hot">hot</div>
                                    <ul class="ps-product__actions">
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>01</span>
                                        </div>
                                        <p class="ps-product__price">$55.99</p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>
                                        <p class="ps-product__price">$55.99</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/5.jpg" alt=""></a>
                                    <div class="ps-product__badge">-37%</div>
                                    <ul class="ps-product__actions">
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>01</span>
                                        </div>
                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>
                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/6.jpg" alt=""></a>
                                    <div class="ps-product__badge">-5%</div>
                                    <ul class="ps-product__actions">
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Youngshop</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>01</span>
                                        </div>
                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/7.jpg" alt=""></a>
                                    <div class="ps-product__badge">-16%</div>
                                    <ul class="ps-product__actions">
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Youngshop</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>01</span>
                                        </div>
                                        <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>
                                        <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/8.jpg" alt=""></a>
                                    <div class="ps-product__badge">-16%</div>
                                    <ul class="ps-product__actions">
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young shop</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>02</span>
                                        </div>
                                        <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>
                                        <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/9.jpg" alt=""></a>
                                    <ul class="ps-product__actions">
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young shop</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>02</span>
                                        </div>
                                        <p class="ps-product__price">$35.89</p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>
                                        <p class="ps-product__price">$35.89</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-section--default">
                <div class="ps-section__header">
                    <h3>Related products</h3>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                        
                        <?php  echo relatedProducts($con,$cat_id); ?>
                        <!-- <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/12.jpg" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Paul’s Smith Sneaker InWhite Color</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$75.44</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Paul’s Smith Sneaker InWhite Color</a>
                                    <p class="ps-product__price">$75.44</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/13.jpg" alt=""></a>
                                <div class="ps-product__badge">-7%</div>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/14.jpg" alt=""></a>
                                <div class="ps-product__badge">-7%</div>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Beat Spill 2.0 Wireless Speaker – White</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Beat Spill 2.0 Wireless Speaker – White</a>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/15.jpg" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">ASUS Chromebook Flip – 10.2 Inch</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$332.38</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">ASUS Chromebook Flip – 10.2 Inch</a>
                                    <p class="ps-product__price sale">$332.38</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/16.jpg" alt=""></a>
                                <div class="ps-product__badge">-7%</div>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Apple Macbook Retina Display 12&quot;</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$1200.00 <del>$1362.99 </del></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Apple Macbook Retina Display 12&quot;</a>
                                    <p class="ps-product__price sale">$1200.00 <del>$1362.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/17.jpg" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$599.00</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <p class="ps-product__price">$599.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/18.jpg" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$233.28</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <p class="ps-product__price">$233.28</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/19.jpg" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$233.28</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <p class="ps-product__price">$233.28</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="" value="<?=$price?>" id="price">
    <input type="hidden" name="id" value="<?=$product_id?>" id="productid">
    <input type="hidden" name="ven_id" value="<?=$vendor_id?>" id="vendorid">
    <input type="hidden" name=""  value="<?=$stock?>" id="maxQty">
    <input type="hidden" name=""  value="<?=$v_p_id?>" id="v_p_id">
    <?php include('includes/footer.php'); ?>
    <script type="text/javascript">
        
       var variation1;
       var variation2;
       var variation3;
       var variation4;
       var vendor_id;
       var product_id;

//==================option===================//
       
       $(document).delegate(".option","click",function(e){
        e.preventDefault();
        if($('.Active').length){
           $('.Active').not($(this)).removeClass('Active').addClass('option');
        }      
           $(this).removeClass('option').addClass('Active');

           variation1     = $('.Active').text();
           product_id = $('input[name=id').val();
           vendor_id = $('input[name=ven_id').val();
           if($(".option1").length && $(".option2").length && $(".option3").length){
                if($(".Active1").length && $(".Active2").length && $(".Active3").length){

                         getforthVariation(variation1,variation2,variation3,variation4,product_id,vendor_id);
                         getforthOffers(variation1,variation2,variation3,variation4,product_id,vendor_id);
                }
            } 
            else if($(".option1").length && $(".option2").length){
            if($(".Active1").length && $(".Active2").length){

                    getthirdVariation(variation1,variation2,variation3,product_id,vendor_id);
                    getthirdOffers(variation1,variation2,variation3,product_id,vendor_id);  
             }
           }else if($(".option1").length){
                if($(".Active1").length){
                    getsecondVariation(variation1,variation2,product_id,vendor_id);
                    getotherOffers(variation1,variation2,product_id,vendor_id);
                }
           }else{

                    getfirstVariation(variation1,product_id,vendor_id);
                    getsingleOffers(variation1,product_id,vendor_id); 

           }
       });

//=================option1===============//  

       $('.option1').click(function(){
            if($('.Active1').length){
                $('.Active1').not($(this)).removeClass('Active1').addClass('option1');
            }      
            $(this).removeClass('option1').addClass('Active1');
            variation2     = $('.Active1').text();
            
           vendor_id = $('input[name=ven_id').val();
            product_id = $('input[name=id').val();
            if($(".Active").length && $(".Active2").length && $(".Active3").length){

                     getforthVariation(variation1,variation2,variation3,variation4,product_id,vendor_id);
                     getforthOffers(variation1,variation2,variation3,variation4,product_id,vendor_id); 
            }   
            else if($(".option2").length && $(".option").length){
                if($(".Active2").length && $(".Active").length){

                     getthirdVariation(variation1,variation2,variation3,product_id,vendor_id);
                     getthirdOffers(variation1,variation2,variation3,product_id,vendor_id);
                 }
            }           
            else if($('.option').length){
                if ($('.Active').length){
                    getsecondVariation(variation1,variation2,product_id,vendor_id);
                    getotherOffers(variation1,variation2,product_id,vendor_id); 
                }   
            }  
        });

//============== option2 ====================//
       
       $('.option2').click(function(){
            if($('.Active2').length){
                $('.Active2').not($(this)).removeClass('Active2').addClass('option2');
            }      
            $(this).removeClass('option2').addClass('Active2');
            variation3     = $('.Active2').text();
            
            vendor_id = $('input[name=ven_id').val();
            product_id = $('input[name=id').val();

                if($(".Active").length && $(".Active1").length && $(".Active3").length){

                     getforthVariation(variation1,variation2,variation3,variation4,product_id,vendor_id);
                     getforthOffers(variation1,variation2,variation3,variation4,product_id,vendor_id); 
                 }
                else if($('.option').length && $('.option1').length){ 
                if($('.Active').length && $('.Active1').length){
                    getthirdVariation(variation1,variation2,variation3,product_id,vendor_id);
                    getthirdOffers(variation1,variation2,variation3,product_id,vendor_id); 
                }}  
        });

//==========option3==============//

        $('.option3').click(function(){
            if($('.Active3').length){

                $('.Active3').not($(this)).removeClass('Active3').addClass('option3');
            }
            $(this).removeClass('.option3').addClass('Active3');
            variation4 = $('.Active3').text();
            product_id = $('input[name=id').val();
            vendor_id = $('input[name=ven_id').val();
            if($('.Active').length && $('.Active1').length && $('.Active2').length){

                getforthVariation(variation1,variation2,variation3,variation4,product_id,vendor_id);
                getforthOffers(variation1,variation2,variation3,variation4,product_id,vendor_id); 

            }
        });

//==========get Second Variations===============// 

       function getsecondVariation(variation1,variation2,product_id,vendor_id){

            $.ajax({
                  type: "POST",
                  url: 'actions/productVariations2.php',
                  data: {variation1:variation1,variation2:variation2,product_id:product_id,vendor_id:vendor_id},
                  dataType:'json',
                  success:function(data){

                      if (data[0]!=0) {

                            $('#ps-product__price').html('R'+data[0]);
                            $('#price').val(data[0]);
                            $('#maxQty').val(data[1]);
                            $("#vendorname").html(data[2]);
                            $("#vendor").html(data[2]);
                            $("#variation_id").val(data[4]);
                            $("#v_p_id").val(data[5]);
                            $("#vendorid").val(data[6]);
                            $("#cart").prop('disabled', false);
                            $("#cart").html('Buy Now');
                      }
                      else{
                            $('#ps-product__price').html("out Of Stock");
                            $("#cart").prop('disabled', true);
                      }
                      // let refresh = window.location + '?'+data[3];  
                      // window.history.replaceState({ path: refresh }, '', refresh);
                  }
            });
       }
//============get other offers===============//
        
       function getotherOffers(variation1,variation2,product_id,vendor_id){

            $.ajax({
                  type: "POST",
                  url: 'actions/getotherOffers.php',
                  data: {variation1:variation1,variation2:variation2,product_id:product_id,vendor_id:vendor_id},
                  
                  success:function(data){

                      // console.log(data);
                      $(".widget_same-brand").remove();
                      $(".ps-page__right").append(data);
                  }
            });
       }

///=================Get first Variation==============///

       function getfirstVariation(variation1,product_id,vendor_id){


            $.ajax({
                  type: "POST",
                  url: 'actions/productVariation1.php',
                  data: {variation1:variation1,product_id:product_id,vendor_id:vendor_id},
                  dataType:'json',
                  success:function(data){

                      if (data[0]!=0) {

                            $('#price').val(data[0]);
                            $('#ps-product__price').html('R'+data[0]);
                            $('#maxQty').val(data[1]);
                            $("#vendorname").html(data[2]);
                            $("#vendor").html(data[2]);
                            $("#variation_id").val(data[4]);
                            $("#v_p_id").val(data[5]);
                            $("#vendorid").val(data[6]);
                            $("#cart").prop('disabled', false);
                            $("#cart").html('Buy Now');
                      }
                      else{
                            $('#ps-product__price').html("out Of Stock");
                            $("#cart").prop('disabled', true);
                      }
                      // let refresh = window.location + '?'+data[3];  
                      // window.history.replaceState({ path: refresh }, '', refresh);
                  }
            });
       }

//============Gey Single offers====================//

       function getsingleOffers(variation1,product_id,vendor_id){

            $.ajax({
                  type: "POST",
                  url: 'actions/getsingleOffers.php',
                  data: {variation1:variation1,product_id:product_id,vendor_id:vendor_id},
                  
                  success:function(data){

                      // console.log(data);
                      $(".widget_same-brand").remove();
                      $(".ps-page__right").append(data);
                  }
            });
       }

//===========get third variation===============//

       function getthirdVariation(variation1,variation2,variation3,product_id,vendor_id){

            $.ajax({
                  type: "POST",
                  url: 'actions/productVariations3.php',
                  data: {variation1:variation1,variation2:variation2,variation3:variation3,product_id:product_id,vendor_id:vendor_id},
                  dataType:'json',
                  success:function(data){

                      if (data[0]!=0) {
                            $('#ps-product__price').html('R'+data[0]);
                            $('#price').val(data[0]);
                            $('#maxQty').val(data[1]);
                            $("#vendorname").html(data[2]);
                            $("#vendor").html(data[2]);
                            $("#variation_id").val(data[4]);
                            $("#v_p_id").val(data[5]);
                            $("#vendorid").val(data[6]);
                            $("#cart").prop('disabled', false);
                            $("#cart").html('Buy Now');
                      }
                      else{
                            $('#ps-product__price').html("out Of Stock");
                            $("#cart").prop('disabled', true);
                      }
                      // let refresh = window.location + '?'+data[3];  
                      // window.history.replaceState({ path: refresh }, '', refresh);
                  }
            });

       }
///==============get third offers===========///

        function getthirdOffers(variation1,variation2,variation3,product_id,vendor_id){

            $.ajax({

                type      : 'POST',
                url       : 'actions/getthirdOffers.php',
                data      : {variation1:variation1,variation2:variation2,variation3:variation3,product_id:product_id,vendor_id,vendor_id},
                success   : function(data){

                    // console.log(data);
                    $(".widget_same-brand").remove();
                    $(".ps-page__right").append(data);
                }

            });
        }
//=========== Get forth Variations =============== ////
    function getforthVariation(variation1,variation2,variation3,variation4,product_id,vendor_id){

        $.ajax({

            type : 'POST',
            url  : 'actions/productVariations4.php',
            data : {variation1:variation1,variation2:variation2,variation3:variation3,variation4:variation4,product_id:product_id,vendor_id:vendor_id},
            dataType : 'json',
            success : function(data){

                if (data[0]!=0) {
                    $('#ps-product__price').html('R'+data[0]);
                    $('#price').val(data[0]);
                    $('#maxQty').val(data[1]);
                    $("#vendorname").html(data[2]);
                    $("#vendor").html(data[2]);
                    $("#variation_id").val(data[4]);
                    $("#v_p_id").val(data[5]);
                    $("#vendorid").val(data[6]);
                    $("#cart").prop('disabled', false);
                    $("#cart").html('Buy Now');
                }
                else{
                    $('#ps-product__price').html("out Of Stock");
                    $("#cart").prop('disabled', true);
                }
            }

        });
    }

//==================GET FORTH OFFERS===============///

function getforthOffers(variation1,variation2,variation3,variation4,prodcut_id,vendor_id){

    $.ajax({

        type    : 'POST',
        url     : 'actions/getforthOffers.php',
        data    : {variation1:variation1,variation2:variation2,variation3:variation3,variation4:variation4,product_id:prodcut_id,vendor_id:vendor_id},
        success : function(data){

            // console.log(data);
            $(".widget_same-brand").remove();
            $(".ps-page__right").append(data);
        }
    });
}
//====================================///
//====== Quantity Box plus  ========= ///
//====================================///

    $('.up').click(function(){

        var val = $('#quantity').val();
        $('#quantity').val(parseInt(val)+1);
        
        
    });

//===================================//
//======  Minus Functions  ========= //
//==================================// 
    
    $('.down').click(function(){

        var val = $('#quantity').val();

        if(val>1){

           $('#quantity').val(parseInt(val)-1); 
        }
        
    });

   //========================================//
// ========= Start Cart Functionality =========//
  //========================================// 

    $("#cart").click(function(){

        var product_id   = $("#productid").val();
        var vendor_id    = $("#vendorid").val();
        var variation_id = $("#variation_id").val();
        var quantity     = $("#quantity").val();
        var maxQty       = $("#maxQty").val();
        var price        = $('#price').val();
        var v_p_id       = $('#v_p_id').val();

        if (parseInt(maxQty) < quantity) {
            if (!$("div").is("#notify")) {

                $(".ps-product__variations").append("<div id='notify' class='btn btn-danger'>Sorry! We have Only "+maxQty+" items in Stock.For Further info Conatct Support.</div>");
            }    
        }
        else if(parseInt(maxQty) >= quantity){

            if ($("div").is("#notify")) {

                $('#notify').remove();

            }
            addtoCart(product_id,vendor_id,variation_id,quantity,price,v_p_id);
        }
        
        
    });

  //==================================================================//  
 //  ========================   Cart Function ===================== ///
//==================================================================//

    function addtoCart(product_id,vendor_id,variation_id,quantity,price,v_p_id){

        $.ajax({

                    type        : 'POST',
                    url         : 'ajax_Cart.php',
                    data        :  {

                                      action       : 'add',
                                      product_id   :  product_id,
                                      variation_id : variation_id,
                                      vendor_id    :  vendor_id,
                                      quantity     :  quantity,
                                      price        :  price,
                                      v_p_id       :  v_p_id
                                    },            
                    success     :  function(data){

                        showCartInbox(product_id);
                        var data = data.split("`");
                        $('#ps-cart__items').html(data[0]);
                        $('#total_cart_items').html(data[1]);
                        if (data[1] == 0) {

                            $('#ps-cart__items').css('display','none');
                        }else{

                            $('#ps-cart__items').css('display','');
                        }
                    
                }
        });   
    } 

//================================================================//    
    ///============= Variation image if one variant ========= ////
//================================================================//

$(document).delegate(".option","click",function(e){
        e.preventDefault();
        if($('.Active').length){
           $('.Active').not($(this)).removeClass('Active').addClass('option');
        }      
           $(this).removeClass('option').addClass('Active');

           variation1     = $('.Active').text();
           product_id     = $('input[name=id').val();
           vendor_id      = $('input[name=ven_id').val();

           $.ajax({

                    type : 'POST',
                    url  : 'actions/productVariantImages1.php',
                    data : {variation1:variation1,product_id:product_id},
                    dataType : 'json',
                    success : function(data){

                        
                        var img1 = 'upload/product/800_';

                        if (data[0] != null) {

                            $("#img1").attr("src", img1+data[0]);
                            $("#imglink1").attr("href", img1+data[0]);
                            $("#imgth1").attr("src", img1+data[0]);
                        }
                        if (data[1] != null) {

                            $("#img2").attr("src", img1+data[1]);
                            $("#imglink2").attr("href", img1+data[1]);
                            $("#imgth2").attr("src", img1+data[1]);
                        }
                        if (data[2] != null) {

                            $("#img3").attr("src", img1+data[2]);
                            $("#imglink3").attr("href", img1+data[2]);
                            $("#imgth3").attr("src", img1+data[2]);
                        }
                        if (data[3] != null) { 
                           
                            $("#img4").attr("src", img1+data[3]);
                            $("#imglink4").attr("href", img1+data[3]);
                            $("#imgth4").attr("src", img1+data[3]);
                        }
                    }

    });
});
 
 //================================================================//    
    ///============= Variation image if two variant ========= ////
 //================================================================//

$('.option1').click(function(){
        if($('.Active1').length){
           $('.Active1').not($(this)).removeClass('Active1').addClass('option1');
        }      
           $(this).removeClass('option1').addClass('Active1');

           variation2     = $('.Active1').text();
           product_id     = $('input[name=id').val();
           vendor_id      = $('input[name=ven_id').val();

    $.ajax({

        type : 'POST',
        url  : 'actions/productVariantImages2.php',
        data : {variation2:variation2,product_id:product_id},
        dataType : 'json',
        success : function(data){

            
            var img1 = 'upload/product/800_';

            if (data[0] != null) {

                $("#img1").attr("src", img1+data[0]);
                $("#imglink1").attr("href", img1+data[0]);
                $("#imgth1").attr("src", img1+data[0]);
            }
            if (data[1] != null) {

                $("#img2").attr("src", img1+data[1]);
                $("#imglink2").attr("href", img1+data[1]);
                $("#imgth2").attr("src", img1+data[1]);
            }
            if (data[2] != null) {

                $("#img3").attr("src", img1+data[2]);
                $("#imglink3").attr("href", img1+data[2]);
                $("#imgth3").attr("src", img1+data[2]);
            }
            if (data[3] != null) { 
               
                $("#img4").attr("src", img1+data[3]);
                $("#imglink4").attr("href", img1+data[3]);
                $("#imgth4").attr("src", img1+data[3]);
            }
        }

    });
});

 //================================================================//    
   ///============= Variation image if three variant ========= ////
 //================================================================//

$('.option2').click(function(){
        if($('.Active2').length){
           $('.Active2').not($(this)).removeClass('Active2').addClass('option2');
        }      
           $(this).removeClass('option2').addClass('Active2');

           variation3     = $('.Active2').text();
           product_id     = $('input[name=id').val();
           vendor_id      = $('input[name=ven_id').val();

    $.ajax({

        type : 'POST',
        url  : 'actions/productVariantImages3.php',
        data : {variation3:variation3,product_id:product_id},
        dataType : 'json',
        success : function(data){

            
            var img1 = 'upload/product/800_';

            if (data[0] != null) {

                $("#img1").attr("src", img1+data[0]);
                $("#imglink1").attr("href", img1+data[0]);
                $("#imgth1").attr("src", img1+data[0]);
            }
            if (data[1] != null) {

                $("#img2").attr("src", img1+data[1]);
                $("#imglink2").attr("href", img1+data[1]);
                $("#imgth2").attr("src", img1+data[1]);
            }
            if (data[2] != null) {

                $("#img3").attr("src", img1+data[2]);
                $("#imglink3").attr("href", img1+data[2]);
                $("#imgth3").attr("src", img1+data[2]);
            }
            if (data[3] != null) { 
               
                $("#img4").attr("src", img1+data[3]);
                $("#imglink4").attr("href", img1+data[3]);
                $("#imgth4").attr("src", img1+data[3]);
            }
        }

    });
});

 //================================================================//    
    ///============= Variation image if four variant ========= ////
 //================================================================//

$('.option3').click(function(){
        if($('.Active3').length){
           $('.Active3').not($(this)).removeClass('Active3').addClass('option3');
        }      
           $(this).removeClass('option3').addClass('Active3');

           variation4     = $('.Active3').text();
           product_id     = $('input[name=id').val();
           vendor_id      = $('input[name=ven_id').val();

    $.ajax({

        type : 'POST',
        url  : 'actions/productVariantImages4.php',
        data : {variation4:variation4,product_id:product_id},
        dataType : 'json',
        success : function(data){

            
            var img1 = 'upload/product/800_';

            if (data[0] != null) {

                $("#img1").attr("src", img1+data[0]);
                $("#imglink1").attr("href", img1+data[0]);
                $("#imgth1").attr("src", img1+data[0]);
            }
            if (data[1] != null) {

                $("#img2").attr("src", img1+data[1]);
                $("#imglink2").attr("href", img1+data[1]);
                $("#imgth2").attr("src", img1+data[1]);
            }
            if (data[2] != null) {

                $("#img3").attr("src", img1+data[2]);
                $("#imglink3").attr("href", img1+data[2]);
                $("#imgth3").attr("src", img1+data[2]);
            }
            if (data[3] != null) { 

                $("#img4").attr("src", img1+data[3]);
                $("#imglink4").attr("href", img1+data[3]);
                $("#imgth4").attr("src", img1+data[3]);
            }    
        }

    });
});

$(document).ready(function() {

  setTimeout(function(){ $(".msg").hide(); }, 3000);

});
    </script>