<?php 
include('../../includes/db.php');
@session_start();
if (isset($_SESSION['id'])) 
 {
    $vendor_id = $_SESSION['id'];
 }
$limit = 10;
if (isset($_POST['keyword'])) {
	
	$keyword = $_POST['keyword'];

	if ($keyword != null) {


		$sql = "SELECT
                    P.*,
                    PV.first_variation_value,
                    PV.first_variation_name,
                    PV.second_variation_value,
                    PV.price,
                    PV.variation_id,
                    PV.quantity as stock,
                    PV.sku as variant_Sku
                  FROM
                    products AS P
                    LEFT JOIN product_variations AS PV ON PV.product_id = P.product_id
                    where P.name like '%$keyword%'
                    OR P.product_id like '%$keyword%'
                    AND P.ven_id = $vendor_id
                    AND P.approved = 'N'
                  ORDER BY
                    P.product_id DESC LIMIT $limit";
        $query = mysqli_query($con,$sql);
        $i=1;
        while ($res = mysqli_fetch_array($query)) {

          $v_id          = $res['variation_id'];
          $variation_id  = base64_encode($res['variation_id']);
          $id            = base64_encode($res['product_id']);
          $p_id          = $res['product_id'];
          $v_sku          = $res['variant_Sku'];
          $v_sku         = explode("-", $v_sku);
          $color         = $v_sku[0]; 

			  $id = base64_encode($res['product_id']);
			  if ($res['quantity'] == 0) {
			    
			      $stock = $res['stock'];
			  }else{

			    $stock   = $res['quantity'];
			  }

			  if ($res['selling_price'] == 0) {
			    
			      $price = $res['price'];
			  }else{

			    $price   = $res['selling_price'];
			  }
			  if ($res['approved'] =="N") {
			    
			    $approve = "Not Approdved";
			  }else{

			    $approve = "approved";    
			  }
          if (empty($res['image1'])) {
    
             $image = null;
             $sqll   = "SELECT image1 from product_variant_images WHERE product_id = '$p_id' AND variation_value='$color'";
             $quer = mysqli_query($con,$sqll);
             while($result = mysqli_fetch_array($quer)){
               
               $image = $result['image1'];
             }
            
          }else{

            $image = $res['image1'];
               
             
          }

        	?>
        		<tr>
                          <td><?= $i++?></td>
                          <td><img alt="image" src="../upload/product/200_<?php echo $image;?>" width="35"
                              data-toggle="tooltip" title="<?=$res['name']?>">  <span style="margin-left: 5px"> <?=$res['name']?> <?=$res['variant_Sku']?></span> </td>

                          <td class="align-middle"><?=$stock?></td>
                          <td><b>R</b><?=$price?></td>
                          <td><?=$res['variant_Sku']?></td>
                          <td>
                            <?php if($res['approved'] == "N"){?>
                              <div class="badge badge-danger">pending</div>
                              <?php }else{     ?>
                                <div class="badge badge-success">Approved</div>
                              <?php } ?>
                          </td>
                          
                        </tr>
<?php        	
    	}
	}else{


		$sql = "SELECT
                    P.*,
                    PV.first_variation_value,
                    PV.first_variation_name,
                    PV.second_variation_value,
                    PV.price,
                    PV.variation_id,
                    PV.quantity as stock,
                    PV.sku as variant_Sku
                  FROM
                    products AS P
                    LEFT JOIN product_variations AS PV ON PV.product_id = P.product_id
                    WHERE P.ven_id = $vendor_id
                    AND P.approved = 'N'
                  ORDER BY
                    P.product_id DESC LIMIT $limit";
        $query = mysqli_query($con,$sql);
        $i=1;
        while ($res = mysqli_fetch_array($query)) {

          $v_id          = $res['variation_id'];
          $variation_id  = base64_encode($res['variation_id']);
          $id            = base64_encode($res['product_id']);
          $p_id          = $res['product_id'];
          $v_sku          = $res['variant_Sku'];
          $v_sku         = explode("-", $v_sku);
          $color         = $v_sku[0];

			  $id = base64_encode($res['product_id']);
			  if ($res['quantity'] == 0) {
			    
			      $stock = $res['stock'];
			  }else{

			    $stock   = $res['quantity'];
			  }

			  if ($res['selling_price'] == 0) {
			    
			      $price = $res['price'];
			  }else{

			    $price   = $res['selling_price'];
			  }
			  if ($res['approved'] =="N") {
			    
			    $approve = "Not Approdved";
			  }else{

			    $approve = "approved";    
			  }
        if (empty($res['image1'])) {
    
             $image = null;
             $sqll   = "SELECT image1 from product_variant_images WHERE product_id = '$p_id' AND variation_value='$color'";
             $quer = mysqli_query($con,$sqll);
             while($result = mysqli_fetch_array($quer)){
               
               $image = $result['image1'];
             }
            
          }else{

            $image = $res['image1'];
               
             
          }
        	?>
        		<tr>
                          <td><?= $i++?></td>
                          <td><img alt="image" src="../upload/product/200_<?php echo $image;?>" width="35"
                              data-toggle="tooltip" title="<?=$res['name']?>">  <span style="margin-left: 5px"> <?=$res['name']?> <?=$res['variant_Sku']?></span> </td>

                          <td class="align-middle"><?=$stock?></td>
                          <td><b>R</b><?=$price?></td>
                          <td><?=$res['variant_Sku']?></td>
                          <td>
                            <?php if($res['approved'] == "N"){?>
                              <div class="badge badge-danger">pending</div>
                              <?php }else{     ?>
                                <div class="badge badge-success">Approved</div>
                              <?php } ?>
                          </td>
                        </tr>
<?php
}


}



}
?>