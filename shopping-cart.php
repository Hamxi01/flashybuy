<?php include('includes/db.php') ?>
<?php include('includes/head.php') ?>
<?php include('includes/courier_Packages.php'); ?>
<?php include('includes/cart_vendorPackges.php') ?>
<?php 
    if(isset($_SESSION['name'])){
        
    }else{
      header("location: login.php");
    }


?>

<!-- Submit Order new -->

<?php 
if (isset($_POST['action']) && $_POST['action'] == 'submit_order') {

    $digits = 6;
    $order_ids = rand(pow(10, $digits-1), pow(10, $digits)-1);
    $order_ids = "OR".$order_ids;
    
    $totalOrderPrice          = $_POST['total_order_price'];
    $totalOrderShippingPrice  = $_POST['total_shipping_price'];
    $uiaddress                = $_POST['address'];

    $sU                     =   mysqli_query( $con ,  " SELECT * FROM user_addresses  where u_a_id = '$uiaddress'" );
    $rU                     =   mysqli_fetch_array( $sU ); 
    $mobile                 =   $rU['mobile'];
    $name                   =   mysqli_real_escape_string($con,$rU['name']);
    $address                =   mysqli_real_escape_string($con,$rU['address']);
    $city                   =   mysqli_real_escape_string($con,$rU['city']);
    $state                  =   mysqli_real_escape_string($con,$rU['state']);
    $subrub                 =   mysqli_real_escape_string($con,$rU['subrub']);
    $zip_code               =   mysqli_real_escape_string($con,$rU['zip_code']);

        $user_id = $user_id = $_SESSION['id'];
        $sL   = " SELECT * FROM customers WHERE id = '$user_id' ";
        $sQry = mysqli_query( $con , $sL );
        $rQry = mysqli_fetch_array( $sQry );

        $user_email         = $rQry["email"];
        $user_phone         = $rQry["mobile"];
        $wallet_price       = $rQry["wallet_price"];

    if(isset($_SESSION['product_cart'])){

            foreach( $_SESSION['product_cart'] as $cartProducts){ 

                $v_p_id = $cartProducts["v_p_id"];
                $vQ = "SELECT V.id as ven_id,VP.id as v_p_id,VP.price,V.shop_name,VP.dispatched_days,VP.quantity FROM vendor_product AS VP 
                                    INNER JOIN vendor AS V ON VP.ven_id = V.id WHERE VP.id = '$v_p_id'";
                $vpSql = mysqli_query( $con , $vQ );
                $sV = mysqli_fetch_array(  $vpSql );
                $ven_id        = $sV["ven_id"];
                $ven_quantity  = $sV["quantity"];
                $v_p_id        = $sV["v_p_id"];
                $ven_price     = $sV["price"];
                $vendor        = $sV['shop_name'];


                $cartArr[$ven_id][$cartProducts["v_p_id"]]["vendor_id"]             = $ven_id;
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["vendor"]                = $vendor;
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["v_p_id"]                = $v_p_id;
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["product_id"]            = $cartProducts["product_id"];
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["name"]                  = $cartProducts["name"];
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["price"]                 = $cartProducts["price"];
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["image"]                 = $cartProducts["image"];
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["quantity"]              = $cartProducts["quantity"];
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["ven_qty"]               = $ven_quantity;
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["ven_price"]             = $ven_price;
                $cartArr[$ven_id][$cartProducts["v_p_id"]]["order_delivery_date"]   = $sV["dispatched_days"];
                
            }
            foreach($cartArr as $data){
                $i = 1;
                foreach( $data as $dt){
                    
                    

                    $order_ven_prod     = $dt["v_p_id"];        
                    $order_vendor_id    = $dt["vendor_id"];                    
                    $order_prod_price   = $dt["price"];     
                    $order_vendor_name  = $dt["vendor"];  
                    $quantity           = $dt["quantity"];
                    $order_prod_name    = $dt["name"];
                    // $order_prod_name     = mysqli_real_escape_string($order_prod_name );
                    $order_prod_id      = $dt["product_id"];
                    $order_price        = $dt["price"];
                    $order_price        = $quantity * $order_price;
                    $order_price_exact  = $dt["price"];
                    $order_prod_img     = $dt["image"];
                    $ven_price          = $dt["ven_price"];
                    
                    
                    
                    $order_pay_price    = $order_price;
                    

                    $order_delivery_date    = (time()+((2+2)*86400));
                    
                    $order_token        = $order_ids.'-'.$order_prod_id;
                    
                
                    
                    
                    $pW           = "SELECT courier_size,width,height,length FROM products where product_id='$order_prod_id'"; 
                    $sPW          = mysqli_query( $con , $pW );
                    $rPW          = mysqli_fetch_array( $sPW );
                    $width        = $rPW['width']; 
                    $height       = $rPW['height'];
                    $length       = $rPW['length'];
                    $courier_size = $rPW['courier_size'];

                    $shippingPrice =0;
                    $weightChrg = 0;
                    $weightExtraItem = '';
                    $csql = mysqli_query($con,"SELECT courier_permission FROM vendor where id='$order_vendor_id'");
                    while ($cpres = mysqli_fetch_array($csql)) {
                     
                        $courier_permission = $cpres['courier_permission'];
                    }
                    if ($courier_permission == 'Y') {
                     
                        $shipSql = mysqli_query($con,"SELECT price FROM vendor_courier_sizes where size='$courier_size' AND city ='$city' AND vendor_id ='$order_vendor_id'");

                        $shippPrice     = mysqli_fetch_array($shipSql);

                        $shippingPrice  = $shippPrice[0];
                    }
                    else{

                        $dimension    = ($width*$height*$length);
                        $wg           = ($dimension)/5000;
                        $weightExtraItem  = '';
                        
                            
                        if( $wg <= 5 ){
                            $weightChrg = $courWArr[5]; 
                            if( $quantity > 1){
                                $weightExtraItem = ( $quantity-1)*$courWEArr[5];
                            }
                            
                            
                        }elseif( $wg <= 10 ){
                            $weightChrg = $courWArr[10];    
                            if( $quantity > 1){
                                $weightExtraItem = ( $quantity-1)*$courWEArr[10];
                            }
                        }
                        elseif( $wg <= 15 ){
                            $weightChrg = $courWArr[15];    
                            if( $quantity > 1){
                                $weightExtraItem = ( $quantity-1)*$courWEArr[15];
                            }
                        }
                        elseif( $wg <= 20 ){
                            $weightChrg = $courWArr[20];    
                            if( $quantity > 1){
                                $weightExtraItem = ( $quantity-1)*$courWEArr[20];
                            }
                        }
                        elseif( $wg <= 25 ){
                            $weightChrg = $courWArr[25];    
                            if( $quantity > 1){
                                $weightExtraItem = ( $quantity-1)*$courWEArr[25];
                            }                       
                        }
                        elseif( $wg <= 30 ){
                            $weightChrg = $courWArr[30];    
                            if( $quantity > 1){
                                $weightExtraItem = ( $quantity-1)*$courWEArr[30];
                            }   
                        }
                        elseif( $wg <= 35 ){
                            $weightChrg = $courWArr[35];    
                            if( $quantity > 1){
                                $weightExtraItem = ( $quantity-1)*$courWEArr[35];
                            }   
                        }else{

                            $weightChrg = $courWArr[35];    
                            if( $quantity > 1){
                                $weightExtraItem = ( $quantity-1)*$courWEArr[35];
                            }

                        }
                    }
                    
                    $totalDeliveryPrice = (intval($weightChrg)+intval($weightExtraItem)+intval($shippingPrice)); 
                    
                    $order_price_exact         = $order_pay_price+$totalDeliveryPrice; 
                    $total_order_price         = $order_pay_price+$totalDeliveryPrice;

                   //courier_fees   
                   $sO = " INSERT INTO orders SET time_id = UNIX_TIMESTAMP(),
                                                                order_ids           = '$order_ids',
                                                                order_user          = '$user_id',
                                                                order_user_name     = '$name',
                                                                order_user_phone    = '$mobile',
                                                                order_usr_address   = '$address',
                                                                order_user_subrub   = '$subrub',
                                                                order_user_city     = '$city',
                                                                order_user_zipcode  = '$zip_code',
                                                                order_ven_prod      = '$order_ven_prod',
                                                                order_vendor_id     = '$order_vendor_id',               
                                                                order_prod_price    = '$ven_price', 
                                                                order_vendor_name   = '$order_vendor_name',
                                                                order_delivery_date = '$order_delivery_date',
                                                                quantity            = '$quantity',
                                                                order_prod_name     = '$order_prod_name',
                                                                order_prod_id       = '$order_prod_id',
                                                                order_price         = '$order_price',
                                                                order_token         = '$order_token', 
                                                                courier_fees        = '$totalDeliveryPrice',
                                                                total_courier_price  = '$totalOrderShippingPrice',
                                                                order_pay_price     = '$total_order_price',
                                                                total_order_price   = '$totalOrderPrice',
                                                                order_prod_img      = '$order_prod_img'";
                    

                        mysqli_query( $con , $sO );

                        $sO = "UPDATE vendor_product SET quantity = ( quantity-$quantity ) WHERE v_p_id = '$v_p_id'" ;
                        mysqli_query( $con , $sO );
                    
                        $i++;
                        $_SESSION['product_cart'] = '';
                        unset( $_SESSION['product_cart'] );
                    
                    
               }
            }


    }

    echo "<script>window.location.assign('submit-order.php')</script>";
}

?>
<!-- Code End Submit Order -->
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
    .address{

        position: relative;
        left: 10px;
        padding: 5px;
    }
    .none-address{

        border-bottom: 1px solid #dee2e6 !important;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .usraddress{

        border-bottom: 1px solid #dee2e6 !important;
    }
    .wallet{
        background: #ffb7b76e;
        padding: 5px;
    }
    .debit_visa {

        position: relative;
        top: 10px;
    }
    .master {

        position: relative;
        top: 20px;
    }
    .ozow {

        position: relative;
        top: 18px;
    }
    .visa {

        position: relative;
        top: 15px;
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
                <!-- <div class="ps-section__header">
                    <h1>Shopping Cart</h1>
                </div> -->
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
                                            }
                                           }
                                        }        
                                ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    
                    <div class="ps-block--shopping-total">
                        <h3><b>Order Summary</b></h3><br>
                        <div class="row">
                            <div class="col-xl-4">
                                <p><b>SubTotal:</b>  R<?=$tPrice?></p>
                            </div>
                            <div class="col-xl-4 text-center">
                                <p class="shippPrice"><b>Shipping:</b>  TBC</p>
                            </div>
                            <div class="col-xl-4 text-right" >
                                <p>Grand Total: <b style="font-size:20px" class="grandTotal">  R<?=$tPrice?></b></p>
                            </div>
                        </div>
                    </div>
                </div>
            <form action="shopping-cart.php"  method="post" id="order-form"> 
                <input type="hidden" name="action" value="submit_order">   
                <div class="ps-section__footer">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
<?php if (isset($_GET['msg_cart']) && $_GET['msg_cart']=='success') { ?> 
<div class="alert alert-success">
    <p class="text text-success" style="font-weight: bold;font-size: 16px;text-align:center">Cart Quantity updated Successfully!</p>
</div>
<?php } ?>
<?php  if (isset($_GET['msg_cart']) && $_GET['msg_cart']!='success') { $maxStock = base64_decode($_GET['msg_cart']); ?>
<div class="alert alert-danger">
    <p class="text text-danger" style="font-weight: bold;font-size: 16px;text-align: center">Only <?=$maxStock?> Unites available.Contact support for any inquiry</p>
</div>
<?php } ?>                            
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
                                    <td colspan="2" class="td-custom">
                                        <div class="ps-product--cart">
                                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="upload/product/200_<?=$data['image']?>" alt=""></a></div>
                                            <div class="ps-product__content"><a href="product-default.html"><?=$data['name']?>
                                                    
                                                </a>
                                                <p><?php

                                                    if (isset($data['sku'])) {
                                                    
                                                        echo '('.$data['sku'].')';
                                                    }
                                                ?></p>
                                                <p>
                                                    <div class="form-group--number">

                                                    <!-- Quantity Plus Button -->

                                                    <button class="up" id="up<?=$data['v_p_id']?>" type="button" onclick="add(this.id,<?=$data['product_id']?>,<?=$data['v_p_id']?>,<?=$data['price']?>,<?=$data['vendor_id']?>)">+</button>

                                                    <!-- Quantity Minus Button -->

                                                    <button class="down" id="down<?=$data['v_p_id']?>" type="button" onclick="minus(this.id,<?=$data['product_id']?>,<?=$data['v_p_id']?>,<?=$data['price']?>,<?=$data['vendor_id']?>)">-</button>

                                                    <!-- Quantity Input Box -->

                                                    <input class="form-control" type="text" placeholder="" onchange="updateQuantity(<?=$data['product_id']?>,<?=$data['v_p_id']?>,<?=$data['price']?>,<?=$data['vendor_id']?>)" value="<?=$data['quantity']?>" id="qty<?=$data['v_p_id']?>">
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="2" class="price td-custom text-right"><b>R<?=$data['price']?></b></td>
                                    <td colspan="3" class="td-custom text-right"><b>R<?php echo $data['price']*$data['quantity'] ?></b></td>
                                    <td colspan="1" class="td-custom"><a href="" onclick="remove_cart_items(<?=$data['v_p_id']?>)"><i class="icon-cross"></i></a></td>
                                </tr>
                            <?php 
                                    } 
                                } 
                            }
                            ?>
                            <tr>
                                <td colspan="7" class="text-right">Shipping:</td>
                                <td colspan="1" class="ShippingPrice">TBC</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">Total:</td>
                                <td colspan="1"><b class="grandTotal">R<?=$tPrice?></b></td>
                            </tr>
                        </table>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
<?php  if (isset($_GET['msg']) && $_GET['msg']=='error') { ?>
<div class="alert alert-danger">
    <p class="text text-danger" style="font-weight: bold;font-size: 16px;text-align: center">opps! Address is not added Successfully.</p>
</div>
<?php } ?>
                            <h3><b>Checkout</b></h3>
                            <div class="ps-block--shopping-total">
                                <h2><span style="font-weight: 800">1.</span>Delivery</h2><br>
                                <h5>Addresses</h5>
                                
                            <?php 
                                $sU    =   mysqli_query( $con ,  " SELECT * FROM user_addresses  where user_id = '".$_SESSION['id']."'" );
                                $tRows =   mysqli_num_rows($sU);
                                if ($tRows>0) {
                                   echo '<table class="usraddress">
                                    <tbody>';
                                   while ($rU = mysqli_fetch_array($sU)) {
                                        $u_a_id                 =   $rU['u_a_id'];
                                        $address                =   $rU['address'];
                                        $city                   =   $rU['city'];
                                        $state                  =   $rU['state'];
                                        $subrub                 =   $rU['subrub'];
                                        $zip_code               =   $rU['zip_code'];
                            ?>
                                        <tr>
                                            <td colspan="1"><input type="radio"  name="address" value="<?=$u_a_id?>" onclick="calculateShipping(<?=$u_a_id?>,<?=$tPrice?>)"></td>
                                            <input type="hidden" name="" id="address<?=$u_a_id?>" value="<?=$city?>">
                                            <td colspan="4" class="address"><?=$address?> ,<?=$city?> ,<?=ucfirst($state)?> ,<?=$subrub?> ,<?=$zip_code?> </td>
                                        </tr>
                            <?php } ?> 

                                    </tbody>
                                </table><br>
                                        <p class="text-center">
                                            <button class="ps-btn btn-warning offset-2" data-toggle="modal" type="button" data-target="#addressModel" style="color: #fff">update address</button>
                                        </p>
                                <?php }else{ ?> 
                                    <div class="none-address">
                                        <p class="text-center">
                                            <img src="https://images.onedayonly.co.za/resources/images/checkout/new/buildings.svg" style="width: 10rem;height: 10rem">
                                        </p>
                                        <p class="text-center">Your saved addresses will appear here.</p>
                                        <p class="text-center">
                                            <button class="ps-btn btn-warning offset-2" data-toggle="modal" type="button" data-target="#addressModel" style="color: #fff"> + add new address</button>
                                        </p>
                                    </div><br>
                               <?php } ?>
                               <?php 
                                        $sql = mysqli_query($con,"SELECT * FROM customers where id='".$_SESSION['id']."'");
                                        while($userData = mysqli_fetch_array($sql)){

                                            $name         = $userData['name'];
                                            $name         = explode(" ",$name,2);
                                            $f_name       = $name[0];
                                            $l_name       = $name[1];
                                            $wallet_price = $userData['wallet_price'];
                                        }
                                ?> 
                               <h2><span style="font-weight: 800">2.</span>Payment</h2><br>
                               <table>
                                   <tbody>
                                       <tr>
                                           <td><input type="checkbox" name="check_wallet_payment" value="wallet"></td>
                                           <td class="wallet"><img src="img/wallet.png" width="50"></td>
                                           <td class="wallet">
                                            <p>Buy from your own Wallet : <b style="font-size: 23px;">R<?=$wallet_price?></b></p>
                                            <input type="hidden" name="user_wallet" value="<?=$wallet_price?>">
                                           </td>
                                       </tr>
                                   </tbody>
                               </table>
                               <div style="padding:10px">
                                    <i class="fa fa-lock" style="font-size:20px; color:#999999"></i> Your data is secure and
                                    encrypted.
                                </div>
                               <table  class="payment">
                                   <tbody>
                                       <tr>
                                           <td class="eft"><input type="radio" name="payment_options" value="EFT"></td>
                                           <td class="eft"><img src="img/banktransfer.png" width="60"></td>
                                           <!-- <td>Our recommended: Send proof of payment within immediately to avoid cancellation</td> -->
                                       </tr>
                                       <tr>
                                           <td class="debit_visa"><input type="radio" name="payment_options" value="Debit"></td>
                                           <td class="debit_visa"><img src="img/visa_debit.jpg" width="60"></td>
                                       </tr>
                                       <tr>
                                           <td class="visa"><input type="radio" name="payment_options" value="Visa"></td>
                                           <td class="visa"><img src="img/visa.png" width="60"></td>
                                       </tr>
                                       <tr>
                                           <td class="master"><input type="radio" name="payment_options" value="Master"></td>
                                           <td class="master"><img src="img/mastercard.png" width="60"></td>
                                       </tr>
                                       <tr>
                                           <td class="ozow"><input type="radio" name="payment_options" value="Ozow_ipay"></td>
                                           <td class="ozow"><img src="img/ozow_ipay.png" width="60"></td>
                                       </tr>
                                   </tbody>
                               </table>  
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="total_order_price" id="orderGrandTotal">
                    <input type="hidden" name="total_shipping_price" id="orderShippingPrice">
                    <div class="row">
                        <div class="col-xl-3 offset-10">
                            <button class="ps-btn btn-warning btn-lg" onclick="return checkValidation()"  style="color: #fff;position:relative;top:15px;right:20px">Submit Order</button>
                        </div>
                    </div>
                </div>
            </form>    
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
                <form role="form" action="actions/userAdresses.php" method="post">
                    <input type="hidden" name="user_id" value="<?=$_SESSION['id']?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="f_name" class="form-control" value="<?=$f_name?>" placeholder="First Name" required="">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="l_name" class="form-control" value="<?=$l_name?>" placeholder="Last Name" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile" class="form-control" placeholder="Cell Number" required="">
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" class="form-control" placeholder="Address" required="">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="city" class="form-control" placeholder="City" required="">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="state" class="form-control" placeholder="State" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="subrub" class="form-control" placeholder="Subrub" required="">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="zip" class="form-control" placeholder="Zip" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="street" class="form-control" placeholder="Street" required="">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="route" class="form-control" placeholder="Route" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="country" class="form-control" placeholder="Country" required="">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <button  name="saveAddress" class="form-control btn btn-warning"  style="background: #e0a800;border: none;color: white">Save Address</button>
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

function calculateShipping(id,subTotal){

    var selectedCity = $("#address"+id).val();
    $.ajax({

            type      : 'post',
            url       : 'calculateShipping.php',
            data      : {city:selectedCity,subTotal:subTotal},
            dataType  : 'json',
            success   : function(data){

                $('.shippPrice').html('<b>Shipping:</b> R'+data[0]);
                $('.ShippingPrice').html('<b>R'+data[0]+'</b>');
                $('#orderShippingPrice').val(data[0]);
                $('.grandTotal').html('R'+data[1]);
                $('#orderGrandTotal').val(data[1]);
            }
    });
}

//====================================================//
//========= Check validation for order  =============//
//==================================================//

function checkValidation(){

    if ($("input:radio[name='address']").is(":checked")) {
        //its checked
    } else {

        swal("Please select delivery address or add new address");
        return false;
    }
    if ($("input:radio[name='payment_options']").is(":checked")) {
        

    } else {
        swal("Please select a Payment Method!");
        return false;
    }
    $('#order-form').submit();
}
</script>