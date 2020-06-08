<?php include("../../includes/db.php"); ?>
<thead>
                          <tr>
                            <th>Order Date</th>
                            <th>Product Title</th>
                            <th>Qty</th>
                            <th>Payment_Method</th>
                            <th>Order_Price</th>
                            <th>Due Days</th>
                            <th>Seller_Detail</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php 

$limit = 10;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;

    $ordrSql = "SELECT O.time_id, 
                      O.order_usr_address, 
                      O.order_status, 
                      O.order_user_phone, 
                      O.order_user_name, 
                      O.order_token, 
                      O.order_status, 
                      O.order_id, 
                      O.order_ids, 
                      O.order_delivered, 
                      O.order_delivery_date, 
                      O.order_vendor_name, 
                      O.order_ven_prod, 
                      O.order_vendor_id, 
                      O.order_prod_id, 
                      O.order_prod_price,
                      O.order_courier_no, 
                      O.order_courier, 
                      O.order_price,
                      O.order_transaction, 
                      O.quantity,
                      O.order_req_deliver,
                      O.order_transaction,
                      O.set_req_waybill,
                      O.set_waybill_doc,
                      O.order_shipped,
                      O.order_payment_payed,
                      O.order_wallet_payed,
                      O.order_status_dispatch,
                      P.name,
                      P.image1,
                      C.email,
                      C.mobile
                      FROM orders AS O LEFT JOIN products AS P ON O.order_prod_id = P.product_id 
                      LEFT JOIN customers AS C ON O.order_user = C.id
                      ORDER BY order_id DESC LIMIT $start_from, $limit";

    $ordrQry = mysqli_query($con,$ordrSql);

    while ( $ordrRes = mysqli_fetch_array($ordrQry)){

      $order_ids             = $ordrRes['order_ids'];
      $order_date            = $ordrRes['time_id'];
      $order_token           = $ordrRes['order_token'];
      $prod_name             = $ordrRes['name'];
      $order_user_name       = $ordrRes['order_user_name'];
      $order_qty             = $ordrRes['quantity'];
      $order_user_address    = $ordrRes['order_usr_address'];
      $user_mobile           = $ordrRes['order_user_phone'];
      $order_vendor_name     = $ordrRes['order_vendor_name'];
      $order_price           = $ordrRes['order_price'];
      $user_email            = $ordrRes['email'];
      $image                 = $ordrRes['image1'];
      $order_delievery_date  = $ordrRes['order_delivery_date'];
      $order_payment_payed   = $ordrRes["order_payment_payed"];
      $order_wallet_payed    = $ordrRes["order_wallet_payed"];

      if ($order_delievery_date == 'InStock' || $order_delievery_date == 'In Stock') {
        
          $order_delievery_date = '1 Day';
      }else{

        $order_delievery_date  = $ordrRes['order_delivery_date'];
      }

      $order_ven_prod   = $ordrRes['order_ven_prod'];
      $order_product_id = $ordrRes['order_prod_id'];

  // ============================================================== //
  //====================== variant image code ======================//
  // ============================================================== //    

      if (empty($image)) {
        
        $vpvSql = mysqli_query($con,"SELECT * FROM vendor_product WHERE id = '$order_ven_prod'");
        while ($vpvRes = mysqli_fetch_array($vpvSql)) {

            $variation_id = $vpvRes['variation_id'];

            $pvsSql       = mysqli_query($con,"SELECT * FROM product_variations WHERE variation_id ='$variation_id'");
            while($pvsRes = mysqli_fetch_array($pvsSql)){

                $skuu  = $pvsRes['sku'];
                $sku   = explode('-', $skuu);
                $color = $sku[0];

              $piSql = mysqli_query($con,"SELECT * FROM product_variant_images WHERE variation_value ='$color' AND product_id ='$order_product_id'");
              while($piRes = mysqli_fetch_array($piSql)){

                $image = $piRes['main_img'];
              }

            } 
        }
      }

  // =============================================================== //
  //=================== End Code For variant Images =================//
  // =============================================================== //

  
//=============================================================//
// ======================  order status ====================== //
//=============================================================//      

      $order_status = $ordrRes['order_status'];
      if( $order_status == 'inprog'){
        $orderStatus  = 'Inprogress';
      }
      if( $order_status == 'comp'){
        $orderStatus  = 'Completed';
      }
      if( $order_status == 'reverse'){
        $orderStatus  = 'Reverse';
      }
      if( $order_status == 'cancel'){
        $orderStatus  = 'Cancel';
      }
      if( $order_status == 'recieve'){
        $orderStatus  = 'Recieve';
      }
      if( $order_status == 'pending_payment'){
        $orderStatus  = 'Pending Payment';
      }

//=================================================================//
// ======================= order Status End ====================== //
//=================================================================//      
      $setClose            = 0;
      if( $order_ids != $newOrderids ){
?>
                          <tr style="background: aliceblue">
                            <td colspan="8" style="text-align: center;font-weight: bold;">Order No : <?=$order_ids?></td>
                          </tr>
                          <tr style="background:#cbdae6 !important;">
                            <td colspan="8"><b>Customer information</b><br>
                                <p style="color:#e83c0a;">Customer : <?=$order_user_name?> Address: <?=$order_user_address?>  City: Mtubatuba Subrbu: Mtubatuba Phone No: <?=$user_mobile?>  Zipcode: 3935 Email: <?=$user_email?></p>
                            </td>
                          </tr>
<?php

    $newOrderids = $order_ids;
    $setClose = 1;
}             
?>                          
                          
                          <tr style="background: #e2dada80 !important;padding: 15px">
                            <td><?=$order_date?></td>
                            <td> 
                              <a href=""><?=$prod_name?></a> <br>
                              <img src="../upload/product/200_<?=$image?>" width="40"><p>token : <?=$order_token?></p>
                            </td>
                            <td><?=$order_qty?></td>
                            <td>PayFast</td>
                            <td><?=$order_price?></td>
                            <td><?=$order_delievery_date?></td>
                            <td>Seller : <b style="color:#e83c0a; "><?=$order_vendor_name?></b></td>
                            <td>
                              <?php 

                                  if($order_status == "pending_payment"   ){ ?>

                                 <input type="button" id="payment_status" class="btn btn-sm btn-dark" name="payment_status" value="Process Order" onclick="showOModal('<?=$order_ids?>','<?=number_format(floatval($order_payment_payed),2)?>' , '<?=number_format(floatval($order_wallet_payed),2)?>');"  /> <?php }else{ ?>
                                
                                
                                <?php }    ?>
                              <?php if ($orderStatus == 'Completed') { ?>
                                   <br><div class="badge badge-warning"><?=$orderStatus?></div>
                              <?php }?>
                              <?php if ($orderStatus == 'Pending Payment') { ?>
                                   <br><div class="badge badge-info"><?=$orderStatus?></div>
                              <?php }?>
                              <?php if ($orderStatus == 'Cancel') { ?>
                                   <br><div class="badge badge-dark"><?=$orderStatus?></div>
                              <?php }?>
                              <?php if ($orderStatus == 'Inprogress') { ?>
                                   <br><div class="badge badge-secondary"><?=$orderStatus?></div>
                              <?php }?>
                            </td>
                          </tr>
<?php    }  ?>                          
                        </tbody>