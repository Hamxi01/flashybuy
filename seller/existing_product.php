<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');

@session_start();
if (isset($_SESSION['id'])) 
 {
    $vendor_id = $_SESSION['id'];
 }  
    
    if (isset($_GET['prod_id']) && isset($_GET['v_p_id'])) {
        
          $prod_id = $_GET['prod_id'];
          $v_p_id  = $_GET['v_p_id'];

          $sql =  "SELECT 
                    VP.*,
                    PV.active,
                    P.name,
                    P.description,
                    P.image1,
                    PV.sku as variant_Sku
                  FROM
                    vendor_product AS VP
                    LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id
                    INNER JOIN products AS P ON P.product_id = VP.prod_id
                    Where VP.id = $v_p_id
                    AND VP.prod_id = $prod_id";
          $query = mysqli_query($con,$sql);
          while ($rPd = mysqli_fetch_array($query)) {
            
              $p_id = $rPd['prod_id'];
              $v_id = $rPd['variation_id'];
              $skuu = $rPd['variant_Sku'];
              $sku = $rPd['variant_Sku'];
              $sku = explode('-', $sku);
              $color = $sku[0];
              $name = $rPd['name'];
              $description = $rPd['description'];

              if (empty($rPd['image1'])) {
                
                 $image = null;
                 $sqll   = "SELECT image1 from product_variant_images WHERE product_id = '$p_id' AND variation_value='$color'";
                 $quer = mysqli_query($con,$sqll);
                 while($result = mysqli_fetch_array($quer)){
                   
                   $image = $result['image1'];
                 }
                
              }else{

                $image = $rPd['image1'];
                   
                 
              }
          }
      }
?>
<!-- save Existing Product -->
<?php

if (isset($_POST['add-existing'])) {
   
   $mk_price        = $_POST['mk_price'];
   $quantity        = $_POST['quantity'];
   $price           = $_POST['price'];
   $variation_id    = $_POST['variation_id'];
   $prod_id         = $_POST['prod_id'];
   $dispatched_days = $_POST['dispatched_days'];
   $ven_id          = $_POST['ven_id'];
   $v_p_id          = $_POST['v_p_id'];

   $vpSql = "INSERT into vendor_product (ven_id,prod_id,variation_id,mk_price,price,quantity,dispatched_days) VALUES ('$ven_id','$prod_id','$variation_id','$mk_price','$price','$quantity','$dispatched_days')";

   if (mysqli_query($con,$vpSql)) {
     
      echo "<script>window.location.assign('existing_product.php?msg=success&prod_id=".$prod_id."&v_p_id=".$v_p_id."');</script>";
   }
 } 
?>   
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
<?php
if (isset($_GET['msg']) && $_GET['msg'] =="success") { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
          <span>Values are added successfully.</span>
        </div>
    </div>
</div>
<?php 
}
?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                    <form method='post' enctype="multipart/form-data">
                      <br><div class="row">
                        <div class="col-md-3">
                          <img src="../upload/product/200_<?=$image?>">
                        </div>
                        <div class="col-md-4">
                          <h4><?=$name?> <?=$skuu?></h4>
                        </div>
                        <input type="hidden" name="variation_id" value="<?=$v_id?>">
                        <input type="hidden" name="prod_id" value="<?=$p_id?>">
                        <input type="hidden" name="ven_id" value="<?=$vendor_id?>">
                        <input type="hidden" name="v_p_id" value="<?=$v_p_id?>">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Market Price</label>
                            <input type="number" min="1" class="form-control" name="mk_price" required="">
                          </div>
                          <div class="form-group">
                            <label>Selling Price</label>
                            <input type="number" min="1" class="form-control" name="price" required="">
                          </div>
                          <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" min="1" class="form-control" name="quantity" required="">
                          </div>
                          <div class="form-group">
                            <label>Dispatched Days</label>
                            <select class="form-control" name="dispatched_days">
                              <option value="In Stock">In Stock</option>
                              <option value="1 Day">1 Day</option>
                              <option value="2 Day">2 Day</option>
                              <option value="3 Day">3 Day</option>
                              <option value="4 Day">4 Day</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <button class="btn btn-warning" type="submit" name="add-existing">Save</button>
                          </div>
                        </div>
                      </div> 
                    </form>      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
        
              
      <?php include('includes/footer.php'); ?>
