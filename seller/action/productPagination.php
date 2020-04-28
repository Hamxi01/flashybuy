<?php include("../../includes/db.php"); ?>
<?php
@session_start();
if (isset($_SESSION['id'])) 
 {
    $vendor_id = $_SESSION['id'];
 }
?>
<table class="table table-striped">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>In Stock</th>
                            <th>Quantity</th>
                            <th>Market Price</th>
                            <th>Selling Price</th>
                            <th>Status</th>
                        </tr>
                      </thead>
                      <tbody id="searchResult"> 

                        <!-- Fetch Products -->
<?php 

$limit = 10;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;

      $sql =  "SELECT 
                    VP.*,
                    PV.active,
                    P.name,
                    P.image1,
                    PV.sku as variant_Sku
                  FROM
                    vendor_product AS VP
                    LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id
                    INNER JOIN products AS P ON P.product_id = VP.prod_id
                    Where VP.ven_id = $vendor_id
                  ORDER BY
                    P.product_id DESC LIMIT $start_from, $limit";
    $query = mysqli_query($con,$sql);
 $i=1; 
 while($res = mysqli_fetch_array($query)) {

  $p_id = $res['prod_id'];
  $v_id = $res['variation_id'];
  $sku = $res['variant_Sku'];
  $sku = explode('-', $sku);
  $color = $sku[0];
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
    $countQuery = "SELECT  COUNT(*) AS total FROM vendor_product AS VP INNER JOIN vendor AS V ON V.id = VP.ven_id INNER Join product_variations AS PV ON PV.variation_id = VP.variation_id where PV.variation_id = '$v_id'";
  $resquery  = mysqli_query( $con , $countQuery );
  $resArray  = mysqli_fetch_array($resquery);
  $vCount    = $resArray["total"];
  

  $pvQuery  = "SELECT  COUNT(*) AS total FROM vendor_product AS VP INNER JOIN vendor AS V ON V.id = VP.ven_id  where VP.prod_id = '$p_id'";
  $resQuery = mysqli_query( $con , $pvQuery );
  $pquery   = mysqli_fetch_array($resQuery);
  $pvCount  = $pquery["total"];

  ?>
                      
                        <tr>
                          <td><?= $i++?></td>
                          <td><img alt="image" src="../upload/product/200_<?php echo $image;?>" width="35"
                              data-toggle="tooltip" title="<?=$res['name']?>">  <span style="margin-left: 5px"> <?=$res['name']?> <?=$res['variant_Sku']?></span> </td>
                          <input type="hidden" name="v_p_id[]" value="<?=$res['id']?>">
                          <td class="align-middle">
                            <select name="dispatch_days[]" class="form-control">
                              <option value="<?=$res['dispatched_days']?>" selected><?=$res['dispatched_days']?></option>
                              <option value="In Stock">In Stock</option>
                              <option value="1 day">1 day</option>
                              <option value="2 days">2 days</option>
                              <option value="3 days">3 days</option>
                              <option value="4 days">4 days</option>
                              <option value="5 days">5 days</option>
                            </select>
                          </td>
                          <td class="align-middle"><input type="number" name="qty[]" class="form-control"  value="<?=$res['quantity']?>"></td>
                          <td><input type="number" name="mk_price[]" class="form-control" value="<?=$res['mk_price']?>"></td>
                          <td><input type="number" name="price[]" class="form-control" value="<?=$res['price']?>"></td>
                          <!-- <td><?=$res['variant_Sku']?></td> -->

                          
                          
                          <td>
                            <?php  if($res['active'] == "N"){?>
                              <div class="badge badge-danger">pending</div>
                              <?php }else{     ?>
                                <div class="badge badge-success">Approved</div>
                              <?php } ?>  
                          </td>
                        </tr>
<?php }  ?>           
                      </tbody>             
                      </table>