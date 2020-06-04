<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
     
      $newOrderids ='OR';
?>
<?php 

if(isset( $_POST['action']) && $_POST['action'] == "set_process"){

  $refernce_number = addslashes( $_POST['refernce_number'] );
  $date_order      = strtotime( $_POST['date_order']);
  $notes           = addslashes($_POST['notes'] );
  

  $order_ids = $_POST['set_order_ids'];
  
    $sP = "UPDATE orders SET order_status = 'inprog' , order_payment_time = UNIX_TIMESTAMP() , refernce_number = '$refernce_number' , 
                        date_order_process = '$date_order' , notes = '$notes'  WHERE order_ids = '$order_ids'";
    
    mysqli_query( $con , $sP );
  
    $ik = 1;
  
    $tc = " SELECT * FROM orders WHERE order_ids = '$order_ids' ";
    $sTc = mysqli_query( $con , $tc );
    while( $rTc = mysqli_fetch_array( $sTc ) ){
    
      $order_wallet_price =  $rTc["order_wallet_price"];  
      $order_pay_price    =  $rTc["order_pay_price"];
      
      $order_prod_id    =  $rTc["order_prod_id"];

      $pSql = mysqli_query($con ,"SELECT * FROM products WHERE product_id ='$order_prod_id'");
      while ($pRes = mysqli_fetch_array($pSql)) {


        $order_prod_name = $pRes['name'];
      }
      $order_token        =  $rTc["order_token"]; 
      
      $courier_fees       =  $rTc["courier_fees"];  
      $order_price        =  $rTc["order_price"]; 
      $user_id          =  $rTc["order_user"];  
      
      $order_payment_payed = $rTc["order_payment_payed"]; 
      $order_wallet_payed  =  $rTc["order_wallet_payed"]; 
      
      
      
      if( $ik == 1 ){ 
      
        $t  = " select * from transaction where user_id = '$user_id' AND trans_type_user  = 'customer' order by transaction_id DESC LIMIT 1 ";
        $sT = mysqli_query( $con , $t);
        $rT = mysqli_fetch_array( $sT );
        $lb = intval( $rT["user_transaction"] );
                
        $user_transaction = intval($lb)-intval($order_wallet_price);
        
        $sT = " INSERT INTO transaction SET time_id = unix_timestamp(), 
                          user_id             = '$user_id',
                          trans_type          = 'Order Transaction Credit Ref# $order_ids',
                          user_transaction    = '$user_transaction',
                          user_t_amount       = '$order_wallet_price'
                          note                = 'Order Transaction',
                          trans_type_user     = 'customer',
                          
                          order_transaction   = '$order_ids',
                          order_token         = '$order_token',
                          
                          order_refund        = 'Y',
                          transaction_type    = 'auto'";
        
        mysqli_query( $con , $sT );
      
      }
      
      $ik++;
      
      
      $orderDetail = 'Order Detail - ' . $order_prod_name . ' - ' . $order_token . '<br />' . 'Courier Fees : ' . $courier_fees . '<br /> Order Price : ' . $order_price;
      $orderDetail_wallet = 'Wallet : Order Detail - ' . $order_prod_name . ' - ' . $order_token . '<br />' . 'Courier Fees : ' . $courier_fees . '<br /> Order Price : ' . $order_price;
      
      
      if( $order_wallet_price > 0 ){
      
        $t  = " select * from transaction where user_id = '$user_id' AND trans_type_user  = 'customer' order by transaction_id DESC LIMIT 1 ";
        $sT = mysqli_query( $con , $t);
        $rT = mysqli_fetch_array( $sT );
        $lb = intval( $rT["user_transaction"] );
                
        $user_transaction = intval($lb)-intval($order_wallet_price);
        
        $sT = " INSERT INTO transaction SET time_id = unix_timestamp(), 
                          user_id             = '$user_id',
                          trans_type          = 'Order Transaction Credit Ref# $order_ids',
                          user_transaction    = '$user_transaction',
                          user_t_amount       = '$order_wallet_price'
                          note                = 'Order Transaction',
                          trans_type_user     = 'customer',
                          
                          order_transaction   = '$order_ids',
                          order_token         = '$order_token',
                          
                          order_refund        = 'Y',
                          transaction_type    = 'auto'";
        echo "<br />";
        mysqli_query( $con , $sT );
      }
      
      
      if( $order_pay_price > 0 ){
      
        
        $t  = " select * from sp_transaction where user_id = '$user_id' AND trans_type_user  = 'customer' order by transaction_id DESC LIMIT 1 ";
        $sT = mysqli_query( $link , $t);
        $rT = mysqli_fetch_array( $sT );
        
        $lb = intval( $rT["user_transaction"] );
                
        $user_transaction = intval($lb)-intval($order_wallet_price);
        
        $sT = " INSERT INTO sp_transaction SET time_id = unix_timestamp(), 
                          user_id             = '$user_id',
                          trans_type          = 'Order Transaction Credit Ref# $order_ids',
                          user_transaction    = '$user_transaction',
                          user_t_amount       = '$order_wallet_price'
                          note                = 'Order Transaction',
                          trans_type_user     = 'customer',
                          
                          order_transaction   = '$order_ids',
                          order_token         = '$order_token',
                          
                          order_refund        = 'Y',
                          transaction_type    = 'auto'";
        
        echo "<br />";
        mysqli_query( $con , $sT );
          
      }   
    }
}    



?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo "<span>Data Inserted successfully...!!</span>"; ?>

        </div>
    </div>
</div>
<?php 
}?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                            <tr>
                              <th>All Orders</th>
                            </tr>
                            <!-- <tr>
                              <th><button class="btn" style="border: 1px grey solid" type="button">New Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Dispatched Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Completed Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Cancelled Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Pending Payment</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">All Orders</button></th>
                            </tr>
                          <tbody>
                          </tbody> -->
                      </table>
                      <table class="table table-bordered">
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
                      ORDER BY order_id DESC";

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
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
        <form id="form_order" name="form_order" method="post" >
 <input type="hidden" id="action" name="action"  value="set_process"  />
 <input type="hidden" id="set_order_ids" name="set_order_ids" value=""  />
  <div class="modal fade " id="orderModal">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body" >
    
    <div >
      <div class="row" style="" >
        <div class="col-lg-12" ><h4>Payment Confirmation</h4></div>
      </div>
      <div class="row" style="padding-top:10px" >
        <div class="col-lg-6" ><h4>To be Paid : <span id="spn_paid" ></span></h4></div>
        <div class="col-lg-6" ><h4>By Wallet Paid : <span id="spn_wallet" ></span></h4></div>
      </div>
      <div class="row" style="padding-top:10px" >
        <div class="col-lg-5" >Date</div>
        <div class="col-lg-7" ><input type="text" id="date_order" name="date_order"  value="" class="datepicker form-control" readonly=""  /></div>
      </div>
          <div class="row" style="padding-top:10px" >
        <div class="col-lg-5" >Payment Reference Number</div>
        <div class="col-lg-7" ><input type="text" id="refernce_number" name="refernce_number"  value=""  class="form-control" autocomplete="off" /></div>
      </div>
      <div class="row" style="padding-top:10px" >
        <div class="col-lg-5" >Note</div>
        <div class="col-lg-7" ><input type="text" id="notes" name="notes"  value=""  class="form-control" autocomplete="off" /></div>
      </div>
        <div class="row" style="padding-top:10px" >
        <div class="col-lg-12" align="center" ><input type="submit" class="btn btn-primary btn-lg" value="Process Order"  /></div>
      </div>
      
      </div>
        </div>
      </div>
    </div>
  </div>
  </form>
              
      <?php include('includes/footer.php'); ?>
<script type="text/javascript">
 
  $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
  });
  function showOModal( order_ids , payment_paid , wallet_paid ){
    $("#set_order_ids").val(order_ids);
    $("#orderModal").modal('show');
    
    $("#spn_paid").html(payment_paid);
    $("#spn_wallet").html(wallet_paid);
    
    
  }
</script>