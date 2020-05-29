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
                            <tr>
                              <th><button class="btn" style="border: 1px grey solid" type="button">New Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Dispatched Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Completed Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Cancelled Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Pending Payment</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">All Orders</button></th>
                            </tr>
                          <tbody>
                          </tbody>
                      </table>
                      <table class="table table-light table-bordered">
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

    $ordrSql = "SELECT O.time_id , O.order_usr_address ,O.order_user_phone , O.order_user_name,O.order_token,O.order_status,O.order_id,O.order_ids, O.order_delivered,O.order_vendor_name,O.order_ven_prod,O.order_vendor_id,O.order_prod_id,O.order_prod_price,O.order_price,O.quantity,O.order_transaction,P.name,P.image1,C.email,C.mobile FROM orders AS O LEFT JOIN products AS P ON O.order_prod_id = P.product_id LEFT JOIN customers AS C ON O.order_user = C.id ORDER BY order_id DESC";

    $ordrQry = mysqli_query($con,$ordrSql);

    while ( $ordrRes = mysqli_fetch_array($ordrQry)){

      $order_ids           = $ordrRes['order_ids'];
      $order_token         = $ordrRes['order_token'];
      $order_user_name     = $ordrRes['order_user_name'];
      $order_qty           = $ordrRes['quantity'];
      $order_user_address  = $ordrRes['order_usr_address'];
      $user_mobile         = $ordrRes['order_user_phone'];
      $order_vendor_name   = $ordrRes['order_vendor_name'];
      $order_price         = $ordrRes['order_price'];
      $user_email          = $ordrRes['email'];

      $image               = $ordrRes['image1'];
      if (empty($image)) {
        
          
      }

      $setClose            = 0;
      if( $order_ids != $newOrderids ){
?>
                          <tr style="background: aliceblue">
                            <td colspan="8" style="text-align: center;font-weight: bold;">Order No : <?=$order_ids?></td>
                          </tr>
<?php

    $newOrderids = $order_ids;
    $setClose = 1;
}             
?>                          
                          <tr style="background:#cbdae6 !important;">
                            <td colspan="8"><b>Customer information</b><br>
                                <p style="color:#e83c0a;">Customer : <?=$order_user_name?> Address: <?=$order_user_address?>  City: Mtubatuba Subrbu: Mtubatuba Phone No: <?=$user_mobile?>  Zipcode: 3935 Email: <?=$user_email?></p>
                            </td>
                          </tr>
                          <tr style="background: #e2dada80 !important">
                            <td>15-12-2019</td>
                            <td> 
                              <a href="">Mini LED Projector with LCD Image System - White</a> <br>
                              <img src="../upload/product/200_<?=$image?>" width="60"> token : <?=$order_token?>
                            </td>
                            <td><?=$order_qty?></td>
                            <td>PayFast</td>
                            <td><?=$order_price?></td>
                            <td>2 days</td>
                            <td>Seller : <b style="color:#e83c0a; "><?=$order_vendor_name?></b></td>
                            <td><div class="badge badge-success">Completed</div></td>
                          </tr>
<?php    }  ?>                          
                        </tbody>
                      </table>
                  </div>
                </div>
                <!-- Current Products in deals -->
                <!-- <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                          <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Id</th>
                            <th>Vendor</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Market Price</th>
                            <th>Deal price</th>
                            <th>Quantity</th>
                            <th></th>
                            <th></th>
                          </tr>
                        <tbody>                                                 
                          <tr style="font-size:13px !important; font-weight:bold ">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>                                                
                        </tbody>  
                      </table>
                  </div>
                </div> -->
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