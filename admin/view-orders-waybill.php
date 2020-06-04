<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
     
      $prev_transaction ='OR';
?>
<?php 

//============= order Dispatch ===================== ///

if( isset( $_REQUEST['status_dispatch']) && $_REQUEST['status_dispatch'] != "" ){


  $status_dispatch   = $_REQUEST['status_dispatch'];
  $order_transaction = $_REQUEST['order_transaction'];

  $sO = "UPDATE orders SET order_status_dispatch = '$status_dispatch' WHERE order_transaction = '$order_transaction' AND order_status != 'cancel'";
  mysqli_query( $con , $sO);
}

//============= order Dispatch ===================== ///


if( isset( $_POST['action'] ) && $_POST['action'] == 'order_save' ){
  

  
  $order_get_id = intval( $_REQUEST['order_get_id']);
  
  $tracking   = $_REQUEST['tracking_' . $order_get_id];
  $courier  = $_REQUEST['courier_' . $order_get_id];
  
  if($_FILES['set_waybill_doc_' . $order_get_id]['name'] != '')
  {
    $order_doc          = time().'_'.$_FILES['set_waybill_doc_' .  $order_get_id ]['name'];
    $location = "../upload/waybill/".$order_doc;
    move_uploaded_file($_FILES['set_waybill_doc_' . $order_get_id]["tmp_name"], $location);
    $uploadDocument     = " set_waybill_doc = '$order_doc',";
  }
  
  
  $oT = "UPDATE orders SET order_courier = '$courier',order_courier_no = '$tracking', $uploadDocument order_courier_date = UNIX_TIMESTAMP() , order_shipped = 'Y' WHERE order_transaction = '$order_get_id' 
           AND order_status != 'cancel'
      ";
  mysqli_query( $con , $oT); 
  echo '<script type="text/javascript">window.location.href = "view-orders-waybill.php?msg=order"</script>';
  exit;
}

////=================== order delivered ========================= //
if( isset($_REQUEST['order_deliver']) &&  isset($_REQUEST['order_deliver'])  == 'Y'){

  $order_transaction     = $_REQUEST['order_transaction'];
  
  $orderQ = " SELECT
          O.order_ids,
          P.cat_id,
          O.order_id,
          O.order_prod_price,
          O.order_price,
          
          O.order_transaction,
          O.order_token,
          
          O.order_user_name ,
          
          order_prod_id,
          order_user,
          order_vendor_name,
          order_vendor_id,
          courier_fees
        FROM 
            orders AS O
              INNER JOIN products  AS P 
            ON O.order_prod_id = P.product_id
        WHERE order_transaction = '$order_transaction'  AND order_status != 'cancel'
           ";
  $sOd   = mysqli_query( $con , $orderQ );
  while( $rOd   = mysqli_fetch_array( $sOd )){
  
    
    // $oBoxSize       = $rOd["prod_box_size"];
    // $oBoxPrice      = intval( $shpBoxPriceArr[$rOd["prod_box_size"]] );
    
    
    
     
    $cat_id         = $rOd["cat_id"];
    $order_user_name  = $rOd["order_user_name"];
    
    
    $sCtP = mysqli_query( $con , " SELECT commission FROM `categories` WHERE `subcat_id` = '$cat_perc' ;");
    $rCtP = mysqli_fetch_array( $sCtP );
    $category_perc     =  $rCtP["commission"];
    

    
    
    $oCat_id             = $catP[$category_perc];
    $oPrice              = $rOd["order_price"];
    $order_vendor_id     = $rOd["order_vendor_id"];
    $order_user          = $rOd["order_user"];
    $cat_id              = $rOd["cat_id"];
    $prod_id             = $rOd["order_prod_id"];
    $ven_name            = $rOd["order_vendor_name"];
    $courier_fees        = $rOd["courier_fees"];
    $order_id            = $rOd["order_id"];
    
    $order_transaction   = $rOd["order_transaction"];
    $order_token         = $rOd["order_token"];
    $order_ids           = $rOd["order_ids"];
    
    
     
    
    $price_cat      = ($oPrice*$oCat_id/100);
    $price_cat_vat  = (($price_cat*15)/100);
    $price_cat      = $price_cat+$price_cat_vat;
    
    //cat_price
    
    
    $t  = " select * from transaction where ven_id = '$order_vendor_id' order by transaction_id DESC LIMIT 1 ";
    $sT = mysqli_query( $con , $t);
    $rT = mysqli_fetch_array( $sT );
    $lb = ( $rT["user_transaction"] );
    
    

    $vBalance = " user_transaction = ( $lb ) , "; $user_t_amount = " user_t_amount = $courier_fees,";
    
    $transaction_note = 'Courier Fees for (' . $order_ids . ')';
    
    $sDelivery = " INSERT INTO transaction SET time_id = unix_timestamp(), product_id = '$prod_id', prod_pirce = '$oPrice', ven_id = '$order_vendor_id', $vBalance $user_t_amount  
                            deduct_amount = '0',ven_name = '$ven_name',   order_transaction  = '$order_ids',order_token  = '$order_token',
                            note        = '$transaction_note',trans_type        = 'courier',user_name = '$order_user_name',
            order_id = '$order_id', box_size = '',box_price = '$courier_fees',user_id = '$order_user'" ;
            

    mysqli_query( $con , $sDelivery );   
    
    
    
    $t  = " select * from transaction where ven_id = '$order_vendor_id' order by transaction_id DESC LIMIT 1 ";
    $sT = mysqli_query( $con , $t);
    $rT = mysqli_fetch_array( $sT );
    $lb = ( $rT["user_transaction"] );
    
    
    $vBalance = " user_transaction = ( $lb-$price_cat) , "; $user_t_amount = " user_t_amount = -$price_cat,"; 
    
    $transaction_note = 'Success Fees for ' . $catArr[$category_perc] . ' - ' . $oCat_id . '%' . '- (' . $order_ids . ')' ;
    $sCategory  = " INSERT INTO transaction SET time_id = unix_timestamp(), prod_id = '$prod_id', prod_pirce = '$oPrice', ven_id = '$order_vendor_id', $vBalance $user_t_amount  
                                deduct_amount = '$price_cat',ven_name = '$ven_name',order_transaction  = '$order_ids',order_token  = '$order_token',
                                note        = '$transaction_note',trans_type        = '$transaction_note',user_name = '$order_user_name',
                  order_id = '$order_id',cat_id = '$category_perc',cat_perc = '$oCat_id', cat_price = '$price_cat' , transaction_vat = '$price_cat_vat' , user_id = '$order_user'" ;
    
    

    mysqli_query( $con , $sCategory ); 
    
    
    $t  = " select * from transaction where ven_id = '$order_vendor_id' order by transaction_id DESC LIMIT 1 ";
    $sT = mysqli_query( $con , $t);
    $rT = mysqli_fetch_array( $sT );
    $lb = ( $rT["user_transaction"] );
    
    
    $vBalance = " user_transaction = ( $lb+$oPrice) , "; $user_t_amount = " user_t_amount=$oPrice,";
    $transaction_note = 'Order Amount for (' . $order_ids . ')';

    $sAmount  = " INSERT INTO transaction SET time_id = unix_timestamp(), prod_id = '$prod_id', prod_pirce = '$oPrice', transfer_amount = '$oPrice', $vBalance $user_t_amount  
                    ven_id = '$order_vendor_id',ven_name = '$ven_name',order_transaction  = '$order_ids',order_token  = '$order_token',user_name = '$order_user_name',
                    note        = '$transaction_note', trans_type = 'vend_payment',
                order_id = '$order_id',user_id = '$order_user'" ;
    
    mysqli_query( $con , $sAmount );                         
    
    
    $sO = "UPDATE orders SET order_delivered = 'Y', order_status = 'comp' WHERE order_id = '$order_id'";
    mysqli_query( $con , $sO);
  
  }
    echo '<script type="text/javascript">window.location.href = "view-orders-waybill.php?msg=order-deliver"</script>';
    exit;
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
                      <form id="form1" name="form1" method="post" enctype="multipart/form-data" >
                        <input type="hidden" id="action" name="action" value="order_save" >
                        <input type="hidden" id="order_get_id" name="order_get_id" value="0"/>
<?php 

    $ordrSql = "SELECT 
                      O.time_id, 
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
                      C.mobile,
                      V.shop_name,
                      V.email as v_email,
                      V.mobile as v_mobile 
                    FROM 
                      orders AS O 
                      LEFT JOIN products AS P ON O.order_prod_id = P.product_id 
                      LEFT JOIN customers AS C ON O.order_user = C.id
                      INNER JOIN vendor as V ON  O.order_vendor_id  = V.id 
                      WHERE order_req_waybill = 'Y' AND O.order_status != 'cancel' 
                    ORDER BY 
                      set_req_waybill DESC
                    ";

    $ordrQry = mysqli_query($con,$ordrSql);

    while ( $ordrRes = mysqli_fetch_array($ordrQry)){

      $order_ids             = $ordrRes['order_ids'];
      $order_date            = $ordrRes['time_id'];
      $order_token           = $ordrRes['order_token'];
      $prod_name             = $ordrRes['name'];
      $order_user_name       = $ordrRes['order_user_name'];
      $order_qty             = $ordrRes['quantity'];
      $order_transaction     = $ordrRes["order_transaction"];
      $order_user_address    = $ordrRes['order_usr_address'];
      $user_mobile           = $ordrRes['order_user_phone'];
      $order_vendor_name     = $ordrRes['order_vendor_name'];
      $order_price           = $ordrRes['order_price'];
      $user_email            = $ordrRes['email'];
      $order_prod_price      = $ordrRes['order_prod_price'];
      $shop_name             = $ordrRes['shop_name'];
      $v_email               = $ordrRes['v_email'];
      $v_mobile              = $ordrRes['v_mobile'];
      $order_shipped         = $ordrRes["order_shipped"];
      $order_courier_no      = $ordrRes['order_courier_no'];
      $order_courier         = $ordrRes['order_courier'];
      $set_req_waybill       = $ordrRes["set_req_waybill"];
      $set_waybill_doc       = $ordrRes["set_waybill_doc"];
      $order_req_deliver     = $ordrRes["order_req_deliver"];
      $order_payment_payed   = $ordrRes["order_payment_payed"];
      $order_wallet_payed    = $ordrRes["order_wallet_payed"];
      $order_payment_payed   = intval($order_payment_payed);
      $order_wallet_payed    = intval($order_wallet_payed);
      $order_status_dispatch = $ordrRes["order_status_dispatch"];

      $image                 = $ordrRes['image1'];
      $order_delievery_date  = $ordrRes['order_delivery_date'];

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

      if($order_status_dispatch == 'ready' ){   $readyBG = 'black';}
      if($order_status_dispatch == 'dispatch' ){  $dispatchBG = 'black';}
      if($order_status_dispatch == 'collect' ){   $colectBG = 'black';}
//=================================================================//
// ======================= order Status End ====================== //
//=================================================================// 

if( $order_transaction != $prev_transaction  ){      
      
?>
                        <thead>
                            <tr style="background:#cbdae6 !important;">
                              <td colspan="1"><?=$order_date?></td>
                              <td colspan="3">
                                  <b>Customer : <?=$order_user_name?><br> <?=$user_email?><br> <?=$user_mobile?><br> <?=$order_user_address?></b>
                              </td>
                              <td colspan="3">
                                  <b>Seller : <?=$shop_name?><br> <?=$v_email?><br> <?=$v_mobile?><br></b>
                              </td>
                              <td  colspan="2"><b><?=$order_ids?></b></td>
                            </tr>
                        </thead>
                          
                          
                          <tr style="background: #e2dada80 !important;padding: 15px">
                            <td><input type="text" id="tracking_<?=$order_transaction?>" name="tracking_<?=$order_transaction?>" value="<?=$order_courier_no?>"></td>
                            <td> 
                              <select id="courier_<?=$order_transaction?>" name="courier_<?=$order_transaction?>" class="form-control">
                                <option value="" >Select</option>
                                <?php foreach( $courierArr as $c => $cour){ ?>
                                  <option value="<?=$c?>"  <?=($c == $order_courier ? "selected=selected" : ""  ) ?>>
                                  <?=$cour?>
                                  </option>
                                  <?php } ?>
                              </select>
                            </td>
                            <td>
                                <?php if( $set_waybill_doc != "" ){ ?>
                                <a href="../upload_images/<?=$set_waybill_doc?>" target="_blank" >View</a>
                                <?php }else{ ?>
                                <input type="file" id="set_waybill_doc_<?=$order_transaction?>" name="set_waybill_doc_<?=$order_transaction?>" value="Upload Document" style="margin-top:5px;" />
                                <?php } ?>
                                &nbsp;&nbsp;
                                <?=($order_req_deliver == "Y" ? "<b>Delivered by Seller</b>" : "" )?>
                            </td>
                            <td colspan="1">
                                <?php if( $order_shipped == 'N'){ ?>
                                <input type="button" id="btn" class="btn btn-primary btn-sm" value="Update"  onclick="set_order('<?php echo $order_transaction?>')" />
                                <?php   } ?>
                            </td>
                            <td colspan="4">
                               <?php if($order_req_deliver == "Y"){ ?>
                                <?php }else{ ?>
                              <button class="btn btn-sm" type="button" style="background: <?=$readyBG?>;color: #fff">Ready</button>
                              <button class="btn btn-sm" type="button" style="background:<?=$dispatchBG ?> ;color:#fff"<?php if($order_status_dispatch != 'collect' && $order_status_dispatch != 'dispatch'){?> onclick="window.location.href='?status_dispatch=dispatch&order_transaction=<?=$order_transaction?>'" <?php } ?>>Dispatched
                              </button>
                              <button class="btn btn-sm" type="button" style="background:<?=$colectBG?> ;color:#fff" <?php if($order_status_dispatch != 'collect'&& $order_status_dispatch != 'ready' ){?>  onclick="getOD(<?=$order_transaction?>)" <?php }else{ ?> onclick="alert('Order dispatch is collected or not dispatch');" <?php } ?>>Delivered</button><br><br>
                              <button class="btn btn-sm" type="button" style="background: #c4c1c1;color: #fff">Notes</button>
                              <?php } ?>
                              <button class="btn btn-sm" type="button" style="background: #ffc107;color: #fff">Courier Comments</button>
                            </td>
                            <td colspan="1">
                              R<?=number_format($order_payment_payed+$order_wallet_payed,2)?>
                            </td>
                          </tr>
                          <tr style="background:#F5F5F5" >
                              <th style="font-size:13px !important" width="6%" colspan="1">Date</th>
                              <th style="font-size:13px !important" width="6%" colspan="1">Transaction</th>
                              <th style="font-size:13px !important" width="5%" colspan="1">Token</th>
                              <th style="font-size:13px !important" width="6%" colspan="1">Due</th>
                              <th style="font-size:13px !important"  colspan="3">Product</th>
                              <th style="font-size:13px !important" width="5%" colspan="1">Qty</th>
                              <th style="font-size:13px !important" width="5%" colspan="1">Price</th>
                          </tr>
                  <?php  
                        }
                     ?>
                     <tr style="font-size:11px; background:<?=( $order_status == 'cancel' ? "#FFEFEF" : "#fff")?>" >
                        <td  colspan="1"><?=date("Y-m-d" , $set_req_waybill )?></td>
                        <td colspan="1"><?=$order_transaction?></td>
                        <td colspan="1"><span class="badge badge-warning">
                          <?=ucfirst( $orderStatus )?>
                          &nbsp;</span> <br />
                          <?=$order_token?>
                        </td>
                        <td colspan="1"><?=$order_delievery_date?></td>
                        <td colspan="3"><a href="../product.php?prod_id=<?=$prod_id?>" target="_blank" >
                          
                          <img src="../upload/product/200_<?=$image?>" width="40" style="border-radius:4px; border:1px solid #CCCCCC"   id="p_img1" />
                          
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>
                          <?=$prod_name?>
                          </b></a></td>
                        <td colspan="1"><?=$order_qty?></td>
                        <td colspan="1"><?=$order_prod_price?></td>
                      </tr>
<?php    }  ?>        
                        </form>          
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
        
              
      <?php include('includes/footer.php'); ?>
<script type="text/javascript">
 
  $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
  });

  function set_order( order_id ){

  
    var courier = $("#courier_" + order_id).val();
    var set_waybill_doc = $("#set_waybill_doc_" + order_id).val();

    if( courier == ""){
      alert("Select courier");
      return false;
    }
    
    if( set_waybill_doc == ""){
      alert("Select Waybill document");
      return false;
    }
    
    $("#order_get_id").val( order_id );
    $("#form1").submit();
  }

// =========================== Delivered Order Function ============================= ///
  function getOD( order_id ){
    window.location.href='view-order-waybill.php?order_deliver=Y&deliver=Y&status_dispatch=collect&order_transaction=' + order_id;
  }

</script>