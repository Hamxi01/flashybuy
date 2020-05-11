<?php include('includes/db.php') ?>
<?php include('includes/head.php') ?>
<?php include('includes/cart_vendorPackges.php') ?>
<?php 
    if(isset($_SESSION['name'])){
        
    }else{
      header("location: login.php");
    }
?>
<style type="text/css">
    .td-custom{

        padding    :  0px !important;
        max-height :  90px !important;
        font-size  :  small !important;
    }
    table.ps-block__product td{

        padding: 0px;
        border: none;
    }
    table.ps-block__product th{

        font-weight: bold;
        border-bottom: 1px solid #dee2e6 !important;
    }
    table.ps-block__product .total{

        font-weight: bold;
        border-top: 1px solid #dee2e6 !important;
        border-bottom: none;
        color: red;
        font-size: 20px;
    }
</style>
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
<!-- Alert Message  -->
<?php if (isset($_GET['msg_cart']) && $_GET['msg_cart']=='success') { ?>
<div class="row">
    <div class="col-lg-6 offset-3">  
        <div class="alert alert-success">
            <p class="text text-success" style="font-weight: bold;font-size: 16px;text-align:center">Cart Quantity updated Successfully!</p>
        </div>
    </div>    
 </div>
<?php } ?>
<?php  if (isset($_GET['msg_cart']) && $_GET['msg_cart']!='success') { $maxStock = base64_decode($_GET['msg_cart']); ?>
<div class="row">
    <div class="col-lg-6 offset-3">
        <div class="alert alert-danger">
            <p class="text text-danger" style="font-weight: bold;font-size: 16px;text-align: center">Only <?=$maxStock?> Unites available.Contact support for any inquiry</p>
        </div>
    </div>
</div> 
<?php } ?>
                <!-- <div class="ps-section__content"> -->
                    <!-- <div class="table-responsive"> -->
                        
                    <!-- </div> -->
                    <!-- <div class="ps-section__cart-actions"> -->
                        <!-- <a class="ps-btn" href="index.php"><i class="icon-arrow-left"></i> Back to Shop</a> -->
                        <!-- <a class="ps-btn" href="shop-default.html"><i class="icon-arrow-left"></i> Update cart</a> -->
                    <!-- </div>
                </div> -->
                <div class="ps-section__footer">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
                            <h3><b>My Cart</b></h3>
                            <table class="table ps-table--shopping-cart">
                            
                                <?php 
                                        if(isset($_SESSION['product_cart'])){

                                            $vendorPackage = vendorPackges('vendor',$_SESSION['product_cart'],$con);

                                          $tquantity = 0;
                                          $tPrice    = 0;
                                          $i=0;
                                          foreach($vendorPackage as $index => $value){

                                            echo "<thead><tr><th colspan='4'>Package ".++$i."</th><th colspan='4'>Shipped By : ".$index."</th></tr></thead>";

                                            foreach ($value as $key => $data) {
                                             
                                            
                                                $priceProduct = $data['price']*$data['quantity'];
                                                $tPrice      += $priceProduct;
                                                $tquantity   += $data['quantity'];
                                                $id           = base64_encode($data['product_id']);
                                ?>
                                <tr>
                                    <td colspan="3" class="td-custom">
                                        <div class="ps-product--cart">
                                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="upload/product/200_<?=$data['image']?>" alt=""></a></div>
                                            <div class="ps-product__content"><a href="product-default.html"><?=$data['name']?>
                                                <?php

                                                    if (isset($data['sku'])) {
                                                    
                                                        echo '('.$data['sku'].')';
                                                    }
                                                ?>    
                                                </a>
                                                <p>Sold By:<strong><?=$data['vendor']?></strong></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="1" class="price td-custom"><b>R<?=$data['price']?></b></td>
                                    <td colspan="2" class="td-custom">
                                        <div class="form-group--number">

                                            <!-- Quantity Plus Button -->

                                            <button class="up" id="up<?=$data['v_p_id']?>" onclick="add(this.id,<?=$data['product_id']?>,<?=$data['v_p_id']?>,<?=$data['price']?>,<?=$data['vendor_id']?>)">+</button>

                                            <!-- Quantity Minus Button -->

                                            <button class="down" id="down<?=$data['v_p_id']?>" onclick="minus(this.id,<?=$data['product_id']?>,<?=$data['v_p_id']?>,<?=$data['price']?>,<?=$data['vendor_id']?>)">-</button>

                                            <!-- Quantity Input Box -->

                                            <input class="form-control" type="text" placeholder="" onchange="updateQuantity(<?=$data['product_id']?>,<?=$data['v_p_id']?>,<?=$data['price']?>,<?=$data['vendor_id']?>)" value="<?=$data['quantity']?>" id="qty<?=$data['v_p_id']?>">
                                        </div>
                                    </td>
                                    <td colspan="1" class="td-custom"><b>R<?php echo $data['price']*$data['quantity'] ?></b></td>
                                    <td colspan="1" class="td-custom"><a href="" onclick="remove_cart_items(<?=$data['v_p_id']?>)"><i class="icon-cross"></i></a></td>
                                </tr>
                            <?php 
                                    } 
                                } 
                            }
                            ?>
                        </table>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <h3><b>Checkout</b></h3>
                            <div class="ps-block--shopping-total">
                                <!-- <div class="ps-block__content"> -->
                                    
                                    <button class="ps-btn btn-warning offset-2" data-toggle="modal" data-target="#addressModel">add new adress</button>

                                <!-- </div> -->
                                   
                            </div>
                            <!-- <a class="ps-btn ps-btn--fullwidth" href="checkout.php">Proceed to checkout</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Address Modal -->

    <div class="modal fade" id="addressModel" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add new Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form role="form">
                    <input type="hidden" name="user_id" value="<?=$_SESSION['id']?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="f_name" class="form-control" placeholder="First Name">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="l_name" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile" class="form-control" placeholder="Cell Number">
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" class="form-control" placeholder="Address">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="city" class="form-control" placeholder="City">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="state" class="form-control" placeholder="State">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="subrub" class="form-control" placeholder="Subrub">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="zip" class="form-control" placeholder="Zip">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="street" class="form-control" placeholder="Street">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="route" class="form-control" placeholder="Route">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="country" class="form-control" placeholder="Country">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-warning" style="background: #e0a800;border: none;color: white">Save Address</button>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    <!-- Address Modal -->

<?php include('includes/footer.php'); ?>
<script type="text/javascript">

//====================================//
//====== Quantity Box plus  ========= //
//====================================//

    function add(id,product_id,v_p_id,price,vendor_id){

        id = id.match(/\d+/g);
        var val = $('#qty'+id[0]).val();
        $('#qty'+id[0]).val(parseInt(val)+1);
        updateQuantity(product_id,v_p_id,price,vendor_id);
    }

//====================================///
//====== Quantity Box Minus  ======== //
//====================================//

    function minus(id,product_id,v_p_id,price,vendor_id){

        id = id.match(/\d+/g);
        var val = $('#qty'+id[0]).val();
        if (val>1) {
            $('#qty'+id[0]).val(parseInt(val)-1);
            updateQuantity(product_id,v_p_id,price,vendor_id);
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
            window.location.assign('shopping-cart.php');
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

function updateQuantity(product_id,v_p_id,price,vendor_id){

    var quantity = $('#qty'+v_p_id).val();
    $.ajax({

            type    : "POST",
            url     : "cartQuantityCheck.php",
            data    : {product_id:product_id,v_p_id,price,quantity:quantity,vendor_id:vendor_id},
            success : function(data){

                // console.log(data);
                if (!$.trim(data)) {

                    window.location.assign('shopping-cart.php?msg=in_stock_set_qty&msg_cart=success');
                }
                else{

                    var qty = data;
                    qty     = btoa(qty);
                    window.location.assign('shopping-cart.php?msg=in_stock_set_qty&msg_cart='+qty);
                }
            }

    });
}
//==============================================//
//================= Calculate Shipping =========//
//==============================================//

function calculateShipping(){

    var selectedCity = $("#cities").val();
    $.ajax({

            type    : 'post',
            url     : 'calculateShipping.php',
            data    : {city:selectedCity},
            success : function(data){

                alert(data);
            }
    });
}
</script>