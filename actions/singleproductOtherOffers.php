<?php
     

     function singleProductOtherOffers($productid,$vendorid,$con){

     	$vpsql = "SELECT price,quantity,ven_id,dispatched_days from vendor_product where prod_id='$productid' AND ven_id !='$vendorid' AND active = 'Y'";
        $vpquery = mysqli_query($con,$vpsql);
        $tRows = mysqli_num_rows($vpquery);
        // $result   = mysqli_fetch_array($vpquery);
        
         while ($pro = mysqli_fetch_array($vpquery)) {

            $price = $pro['price'];
            $days = $pro['dispatched_days'];
            $ven_id = $pro['ven_id'];

            $vsql ="SELECT shop_name from vendor where id='$ven_id'";
            $vquery = mysqli_query($con,$vsql);
            $vres   = mysqli_fetch_array($vquery);
            $vendorname = $vres['shop_name'];
                       
            echo '<div class="col-md-12">
                    <h4><b>R'.$price.'</b><button class="btn btn-warning" style="float: right;color:#fff">Add to cart</button></h4>
                    <h5>By: <a href="#">'.$vendorname.'</a></h5>
                    <p>'.$days.'</p>
                  </div>';                     
         }
     }


?>