<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
     
      $newOrderids ='OR';
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

    $ordrSql = "SELECT O.time_id , O.order_usr_address, O.order_status ,O.order_user_phone , O.order_user_name,O.order_token,O.order_status,O.order_id,O.order_ids, O.order_delivered,O.order_delivery_date,O.order_vendor_name,O.order_ven_prod,O.order_vendor_id,O.order_prod_id,O.order_prod_price,O.order_price,O.quantity,O.order_transaction,P.name,P.image1,C.email,C.mobile FROM orders AS O LEFT JOIN products AS P ON O.order_prod_id = P.product_id LEFT JOIN customers AS C ON O.order_user = C.id ORDER BY order_id DESC";

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
                              <?php if ($orderStatus == 'Completed') { ?>
                                   <div class="badge badge-warning"><?=$orderStatus?></div>
                              <?php }?>
                              <?php if ($orderStatus == 'Pending Payment') { ?>
                                   <div class="badge badge-info"><?=$orderStatus?></div>
                              <?php }?>
                              <?php if ($orderStatus == 'Cancel') { ?>
                                   <div class="badge badge-dark"><?=$orderStatus?></div>
                              <?php }?>
                              <?php if ($orderStatus == 'Inprogress') { ?>
                                   <div class="badge badge-secondary"><?=$orderStatus?></div>
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
        
              
      <?php include('includes/footer.php'); ?>
<script type="text/javascript">
 
  $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>