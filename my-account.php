<?php include('includes/db.php'); ?>
<?php include('includes/head.php'); 


@session_start();
    if(isset($_SESSION['id'])){

        $user_id = $_SESSION['id'];

    }else{

      echo '<script type="text/javascript">window.location.href = "userlogin.php"</script>';
    }
$new_order_ids = 'OR';    
?>
    <div class="ps-page--single">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="index.html">Pages</a></li>
                    <li><a href="vendor-store.html">Vendor Pages</a></li>
                    <li>Vendor Dashboard Pro</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="ps-vendor-dashboard pro">
        <div class="container">
            <br><br>
            <div class="row">
                <div class="col-md-3">
                    <div class="ps-section__content">
                        <ul class="ps-section__links">
                            <li class="active"><a href="#">Dashboard</a></li>
                            <li><a href="view-addresses.php">My Addresses</a></li>
                            <li><a href="#">view Orders</a></li>
                            <!-- <li><a href="#">Setting</a></li> -->
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <table class="table table-bordered" border="1">
                        <thead>
<?php 
$oSql  = "SELECT time_id , order_usr_address , order_usr_address , order_token,order_status,order_id,order_ids,
             order_delivered,order_vendor_name,order_ven_prod,order_vendor_id,order_prod_id,order_prod_price,order_price,quantity,order_transaction
            FROM orders AS O 
            WHERE O.order_user = '$user_id'
            ORDER BY order_id DESC";

$oQ = mysqli_query( $con , $oSql );
while ($oR = mysqli_fetch_array($oQ)) {

    $order_ids             = $oR['order_ids'];
    $order_token           = $oR['order_token'];
    $quantity              = $oR['quantity'];
    $order_vendor_name     = $oR['order_vendor_name'];
    $order_status          = $oR["order_status"];
    $order_price           = $oR["order_price"];

  
    $setClose = 0;

    if( $order_status == 'inprog'){
        $orderStatus    = 'In-progress';
    }
    if( $order_status == 'comp'){
        $orderStatus    = 'Completed';
    }
    if( $order_status == 'reverse'){
        $orderStatus    = 'Reverse';
    }
    if( $order_status == 'cancel'){
        $orderStatus    = 'Cancel';
    }
    if( $order_status == 'recieve'){
        $orderStatus    = 'Recieve';
    }

    $order_ven_prod = $oR['order_ven_prod'];

    $ores = mysqli_query($con,"SELECT prod_id,variation_id FROM vendor_product where id ='$order_ven_prod'");

    while($idsRes = mysqli_fetch_array($ores)){

        $product_id = $idsRes['prod_id'];
        $psql       = mysqli_query($con,"SELECT name,image1 FROM products where product_id='$product_id'");

        while ($pnameRes   = mysqli_fetch_array($psql)) {
            
            $productname = $pnameRes['name'];
            $image       = $pnameRes['image1'];
        }
        $variation_id = $idsRes['variation_id'];
        if (!empty($variation_id)) {

                $skusql = mysqli_query($con,"SELECT sku FROM product_variations where variation_id='$variation_id'");
                while ($skuRes = mysqli_fetch_array($skusql)) {
                    
                    $sku = $skuRes['sku'];
                    $skuArray = explode("-",$sku);
                    $color = $skuArray[0];

                    $vColorSql = mysqli_query($con,"SELECT image1 FROM product_variant_images where variation_value ='$color' AND product_id='$product_id'");
                    while ($colorRes = mysqli_fetch_array($vColorSql)) {
                        
                        $image = $colorRes['image1'];
                    }
                }
        }
    }

if ($order_ids != $new_order_ids) {
?>                            
                            <tr>
                                <th style="background: #c8c5c5" colspan="4"><b>Date : <?=$oR['time_id']?></b></th>
                                <th style="background: #c8c5c5" colspan="4"><b>Order No : <?=$order_ids?></b></th>
                            </tr>
<?php

    $new_order_ids = $order_ids;
    $setClose = 1;
}             
?>
                            <tr>
                                <th colspan="1"><img src="upload/product/200_<?=$image?>" width="100"></th>
                                <th colspan="4"> <?=$productname?> <?php if(isset($sku)){ echo '( '.$sku.' )';}?>
                                    <p>Product Order No. <?=$order_token?></p> Qty : <?=$quantity?><br>
                                    <b>price : R</b><?=$order_price?>
                                </th>
                                <th colspan="3"><button class="btn btn-warning">Order Detail</button><br>
                                    Seller : <b><?=$order_vendor_name?></b><br>
                                    Delievery Status : <?=$order_status?>
                                </th>
                                
                            </tr>
<?php } ?>                            
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php') ?>
    