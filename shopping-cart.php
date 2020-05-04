<?php include('includes/db.php') ?>
<?php include('includes/head.php') ?>
<?php include('includes/cart_vendorPackges.php') ?>

    <div class="ps-page--simple">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="shop-default.html">Shop</a></li>
                    <li>Shopping Cart</li>
                </ul>
            </div>
        </div>
        <div class="ps-section--shopping ps-shopping-cart">
            <div class="container">
                <div class="ps-section__header">
                    <h1>Shopping Cart</h1>
                </div>
                <div class="ps-section__content">
                    <div class="table-responsive">
                        <table class="table ps-table--shopping-cart">
                            <!-- <thead>
                                <tr>
                                    <th>Product name</th>
                                    <th>PRICE</th>
                                    <th>QUANTITY</th>
                                    <th>TOTAL</th>
                                    <th></th>
                                </tr>
                            </thead> -->
                            <tbody>
                                <?php 
                                        if(isset($_SESSION['product_cart'])){

                                            $vendorPackage = vendorPackges('vendor',$_SESSION['product_cart'],$con);

                                          $tquantity = 0;
                                          $tPrice    = 0;
                                          $i=0;
                                          foreach($vendorPackage as $index => $value){

                                            

                                            foreach ($value as $key => $data) {
                                             
                                            
                                                $priceProduct = $data['price']*$data['quantity'];
                                                $tPrice      += $priceProduct;
                                                $tquantity   += $data['quantity'];
                                                $id           = base64_encode($data['product_id']);
                                ?>
                                <tr>
                                    <thead>
                                        <th colspan="8"><?=$index?></th>
                                    </thead>
                                    
                                    <td>
                                        <div class="ps-product--cart">
                                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="upload/product/200_<?=$data['image']?>" alt=""></a></div>
                                            <div class="ps-product__content"><a href="product-default.html"><?=$data['name']?></a>
                                                <p>Sold By:<strong><?=$data['vendor']?></strong></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price"><b>R<?=$data['price']?></b></td>
                                    <td>
                                        <div class="form-group--number">
                                            <button class="up" id="up<?=$data['v_p_id']?>" onclick="add(this.id,<?=$data['product_id']?>,<?=$data['v_p_id']?>,<?=$data['price']?>)">+</button>
                                            <button class="down" id="down<?=$data['v_p_id']?>" onclick="minus(this.id,<?=$data['product_id']?>,<?=$data['v_p_id']?>,<?=$data['price']?>)">-</button>
                                            <input class="form-control" type="text" placeholder="" value="<?=$data['quantity']?>" id="qty<?=$data['v_p_id']?>">
                                        </div>
                                    </td>
                                    <td><b>R<?php echo $data['price']*$data['quantity'] ?></b></td>
                                    <td><a href="" onclick="remove_cart_items(<?=$data['v_p_id']?>)"><i class="icon-cross"></i></a></td>
                                </tr>
                            <?php } } }?>
                                <!-- <tr>
                                    <td>
                                        <div class="ps-product--cart">
                                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/clothing/2.jpg" alt=""></a></div>
                                            <div class="ps-product__content"><a href="product-default.html">Unero Military Classical Backpack</a>
                                                <p>Sold By:<strong> YOUNG SHOP</strong></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price">$205.00</td>
                                    <td>
                                        <div class="form-group--number">
                                            <button class="up">+</button>
                                            <button class="down">-</button>
                                            <input class="form-control" type="text" placeholder="1" value="1">
                                        </div>
                                    </td>
                                    <td>$205.00</td>
                                    <td><a href="#"><i class="icon-cross"></i></a></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="ps-section__cart-actions"><a class="ps-btn" href="shop-default.html"><i class="icon-arrow-left"></i> Back to Shop</a><a class="ps-btn ps-btn--outline" href="shop-default.html"><i class="icon-sync"></i> Update cart</a></div>
                </div>
                <div class="ps-section__footer">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <figure>
                                <figcaption>Coupon Discount</figcaption>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="">
                                </div>
                                <div class="form-group">
                                    <button class="ps-btn ps-btn--outline">Apply</button>
                                </div>
                            </figure>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <figure>
                                <figcaption>Calculate shipping</figcaption>
                                <div class="form-group">
                                    <select class="ps-select">
                                        <option value="1">America</option>
                                        <option value="2">Italia</option>
                                        <option value="3">Vietnam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Town/City">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Postcode/Zip">
                                </div>
                                <div class="form-group">
                                    <button class="ps-btn ps-btn--outline">Update</button>
                                </div>
                            </figure>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <div class="ps-block--shopping-total">
                                <div class="ps-block__header">
                                    <p>Subtotal <span><b>R<?=$tPrice?></b></span></p>
                                </div>
                                <div class="ps-block__content">
                                
                                    <ul class="ps-block__product">
                                        <?php    
                                    if(isset($_SESSION['product_cart'])){
                                     
                                          $tquantity = 0;
                                          $tPrice    = 0;
                                          foreach($_SESSION['product_cart'] as $data){
                                                $priceProduct = $data['price']*$data['quantity'];
                                                $tPrice      += $priceProduct;
                                                $tquantity   += $data['quantity'];
                                                $id           = base64_encode($data['product_id']);?>
                                        <li><span class="ps-block__shop"><?=$data['vendor']?></span><span class="ps-block__shipping">Free Shipping</span><span class="ps-block__estimate">Estimate for <strong>Viet Nam</strong><a href="#"> <?=$data['name']?></a></span></li>
                                        <!-- <li><span class="ps-block__shop">ROBERT’S STORE Shipping</span><span class="ps-block__shipping">Free Shipping</span><span class="ps-block__estimate">Estimate for <strong>Viet Nam</strong><a href="#">Apple Macbook Retina Display 12” ×1</a></span></li> -->
                                        <?php }} ?> 
                                    </ul>
                                   
                                    <h3>Total <span><b>R<?=$tPrice?></b></span></h3>
                                </div>
                            </div><a class="ps-btn ps-btn--fullwidth" href="checkout.html">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>
<script type="text/javascript">

//====================================///
//====== Quantity Box plus  ========= ///
//====================================///

    function add(id,product_id,v_p_id,price){

        id = id.match(/\d+/g);
        var val = $('#qty'+id[0]).val();
        $('#qty'+id[0]).val(parseInt(val)+1);
        updateQuantity(product_id,v_p_id,price);
    }

//====================================///
//====== Quantity Box Minus  ======== //
//====================================//

    function minus(id,product_id,v_p_id,price){

        id = id.match(/\d+/g);
        var val = $('#qty'+id[0]).val();
        if (val>1) {
            $('#qty'+id[0]).val(parseInt(val)-1);
            updateQuantity(product_id,v_p_id,price);
        }
        
    }

//====================================//
//========== Remove Cart Items =======//
//====================================//

function remove_cart_items(p_id){

    $.ajax({
        type:"post",
        url:"ajax_Cart.php",
        data:{action:'delete',p_id:p_id},
        success:function(data){

            var data = data.split("`");
            $('#ps-cart__items').html(data[0]);
            $('#total_cart_items').html(data[1]);
            location.reload();
            if (data[1] == 0) {

            $('#ps-cart__items').css('display','none');
            }else{

                $('#ps-cart__items').css('display','');
            }
        }
    });
}

//================================================//
//=========== Update product Quantity ========== //
//===============================================//

function updateQuantity(product_id,v_p_id,price){

    var quantity = $('#qty'+v_p_id).val();
    alert("Quantity is! "+quantity+" & Product id is! "+product_id+" & Price is"+price+" & vendor product id is "+v_p_id);
}
</script>