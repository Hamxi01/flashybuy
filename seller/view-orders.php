<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
     
@session_start();
if (isset($_SESSION['id'])) 
 {
    $vendor_id = $_SESSION['id'];
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
                      </table>
                      <table class="table table-bordered" style="font-size: 12px">
                        
<?php 

    $ordrSql = "SELECT O.time_id , O.order_usr_address, O.order_status ,O.order_user_phone , O.order_user_name,O.order_token,O.order_status,O.order_id,O.order_ids, O.order_delivered,O.order_delivery_date,O.order_vendor_name,O.order_ven_prod,O.order_vendor_id,O.order_prod_id,O.order_prod_price,O.order_price,O.quantity,O.order_transaction,O.order_token,P.name,P.image1,C.email,C.mobile FROM orders AS O LEFT JOIN products AS P ON O.order_prod_id = P.product_id LEFT JOIN customers AS C ON O.order_user = C.id WHERE O.order_vendor_id = '$vendor_id' ORDER BY order_id DESC";

    $ordrQry = mysqli_query($con,$ordrSql);
    while( $ordrRes = mysqli_fetch_array($ordrQry)){
    
      $prod_name              = $ordrRes['name'];
      $order_qty              = $ordrRes['quantity'];
      $order_user_name        = $ordrRes['order_user_name'];
      $order_date             = $ordrRes['time_id'];
      $order_prod_id          = $ordrRes['order_prod_id'];
      $order_price            = $ordrRes['order_price'];
      $order_transaction      = $ordrRes['order_transaction'];
      $order_transaction_id   = $ordrRes['order_token'];
      $order_delivery_date    = $ordrRes['order_delivery_date'];

      $order_status           = $ordrRes['order_status'];

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

      $image                  = $ordrRes['image1'];
      $order_ven_prod         = $ordrRes['order_ven_prod'];
// ================================================================ //
//============== If product have variant ===========================//
//================================================================= //

      if (empty($image)) {
        
          $vpvSql = mysqli_query($con,"SELECT * FROM vendor_product WHERE id = '$order_ven_prod'");
          while($vpvRes = mysqli_fetch_array($vpvSql)){

              $variation_id = $vpvRes['variation_id'];

              $pvsSql       = mysqli_query($con,"SELECT * FROM product_variations WHERE variation_id ='$variation_id'");
              while($pvsRes = mysqli_fetch_array($pvsSql)){

                  $skuu  = $pvsRes['sku'];
                  $sku   = explode('-', $skuu);
                  $color = $sku[0];

                $piSql = mysqli_query($con,"SELECT * FROM product_variant_images WHERE variation_value ='$color' AND product_id ='$order_prod_id'");
                while($piRes = mysqli_fetch_array($piSql)){

                  $image = $piRes['main_img'];
                }

              }
          }
      }
    
    ?>                     
                        <thead>
                          <tr>
                            <th colspan="2"><?=$order_date?></th>
                            <th colspan="3">Customer : <?=$order_user_name?></th>
                            <th colspan="2"> order No : <?=$order_transaction?></th>
                          </tr>
                        </thead>
                        <tr  style="background:#EBFFE9 !important">
                          <td>Transaction ID</td>
                          <td>Due Days</td>
                          <td>Product ID</td>
                          <td>Product</td>
                          <td>Qty</td>
                          <td>Price</td>
                          <td>status</td>
                        </tr>
                          <tr>
                            <th><?=$order_transaction_id?></th>
                            <th><?=$order_delivery_date?></th>
                            <th><?=$order_prod_id?></th>
                            <th><img src="../upload/product/200_<?=$image?>" width='40'><a href=""><?=$prod_name?></a></th>
                            <th><?=$order_qty?></th>
                            <th><?=$order_price?></th>
                            <th><?=$orderStatus?></th>
                          </tr>
<?php } ?>                      
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