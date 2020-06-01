
<?php
     

     function singleProductOtherOffers($productid,$vendorid,$con){

     	$vpsql = "SELECT id,price,quantity,ven_id,dispatched_days from vendor_product where prod_id='$productid' AND
             price != ( SELECT MIN(price)  FROM vendor_product where prod_id=$productid AND active='Y') OR
             price = ( SELECT MIN(price)  FROM vendor_product where prod_id=$productid AND active='Y')";
        $vpquery = mysqli_query($con,$vpsql);
        $tRows = mysqli_num_rows($vpquery); ?>

        <aside class="widget widget_same-brand">
                        <h3>Other Offers</h3>
                        <div class="widget__content">
                            <div id="other-offers" class="row">
    <?php                            
         while ($pro = mysqli_fetch_array($vpquery)) {

            $v_p_id = $pro['id'];

    // ================= Check product is in deal ===================== //

            $vpdSql = mysqli_query($con,"SELECT * FROM vendor_product_deals WHERE start_date < UNIX_TIMESTAMP() AND end_date > UNIX_TIMESTAMP() AND v_p_id = '$v_p_id' ");
            while($vpdRes = mysqli_fetch_array($vpdSql)){

                $price = $vpdRes['deal_price'];
            }

    // ================ end checking product is in deal or not ======= //

            if (empty($price)) {
                
                $price = $pro['price'];
            }
            
            $days = $pro['dispatched_days'];
            $ven_id = $pro['ven_id'];

            $vsql ="SELECT shop_name from vendor where id='$ven_id'";
            $vquery = mysqli_query($con,$vsql);
            $vres   = mysqli_fetch_array($vquery);
            $vendorname = $vres['shop_name'];
                       
            echo '<div class="col-md-12">
                    <h4><b>R'.$price.'</b><button class="btn btn-warning" style="float: right;color:#fff" onclick="addtoCart('.$productid.','.$ven_id.',0,1,'.$price.','.$v_p_id.')">Add to cart</button></h4>
                    <h5>By: <a href="#">'.$vendorname.'</a></h5>
                    <p>'.$days.'</p>
                  </div>'; 

                  $price = '';                    
         }
         ?>
         </div>
                        </div>
                    </aside>
<?php
     }


?>
