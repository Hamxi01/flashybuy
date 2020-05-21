<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');

@session_start();
if (isset($_SESSION['id'])) 
 {
    $vendor_id = $_SESSION['id'];
 }  
    
    if (isset($_POST['searchProduct'])) {
        
          $searchproductName = $_POST['p_name'];
          $searchproductId   = $_POST['p_id'];
          $sPQ = '';
          if( $searchproductId != "" ||  $searchproductName != "" ){
            
            if( $searchproductName != "" ){
              $sPQ .= "AND P.name LIKE '%$searchproductName%'";
            
            } 
            if( $searchproductId != "" ){
              $sPQ .= "AND P.product_id = '$searchproductId'";
            }
          }
      }
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                      <table class="table">
                        <form method="post" enctype="multipart/form-data">
                            <tr>
                              <th><button class="btn btn-warning"><a href="add-product.php" style="color: white;text-decoration: none">Add new Products</a></button></th>
                            </tr>
                            <tr>
                              <th><h3>Search Existing Products</h3></th>
                            </tr>
                            <tr>
                              <th>Product Name</th>
                              <th>Product ID#</th>
                              <th></th>
                            </tr>
                          <tbody>                          
                            <tr style="font-size:13px !important; font-weight:bold ">
                              <td><input type="text" name="p_name" class="form-control" placeholder="Search Product by Name"></td>
                              <td><input type="text" name="p_id" class="form-control" placeholder="Search Product by ID"></td>
                              <td><button class="btn btn-warning" type="submit" name="searchProduct">Search Products</button></td>
                            </tr>
                          </tbody> 
                      </form> 
                      </table>
                  </div>
                </div>
              
                <?php 

                  if( isset($_POST['p_name']) && $_POST['p_name'] != "" ||  isset($_POST['p_id']) && $_POST['p_id'] != "" ){
              ?>  
                <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                          <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th></th>
                            <th></th>
                          </tr>
                        <tbody>               
<?php 
$sPd    = mysqli_query($con ,"SELECT 
                    VP.*,
                    PV.active,
                    P.name,
                    P.image1,
                    PV.sku as variant_Sku
                  FROM
                    vendor_product AS VP
                    LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id
                    INNER JOIN products AS P ON P.product_id = VP.prod_id
                    Where VP.ven_id != $vendor_id 
                    AND VP.active = 'Y'
                     $sPQ GROUP By VP.variation_id");

while($rPd  =   mysqli_fetch_array( $sPd )) { 

  $p_id = $rPd['prod_id'];
  $v_id = $rPd['variation_id'];
  $sku = $rPd['variant_Sku'];
  $sku = explode('-', $sku);
  $color = $sku[0];

  if (!empty($v_id)) {
      
      $sPV = mysqli_query( $con , "SELECT * FROM vendor_product where prod_id = '$p_id' AND ven_id = '$vendor_id' AND variation_id = '$v_id'");
      $rPV = mysqli_fetch_array( $sPV  );
      $v_pid = $rPV["id"];
  }else{

      $sPV = mysqli_query( $con , "SELECT * FROM vendor_product where prod_id = '$p_id' AND ven_id = '$vendor_id'");
      $rPV = mysqli_fetch_array( $sPV  );
      $v_pid = $rPV["id"];
  }
              

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
?> 

                          <tr style="font-size:13px !important; font-weight:bold ">
                            <td></td>
                            <td><?=$rPd['prod_id']?></td>
                            <td><img src="../upload/product/200_<?=$image?>" width="30"> <?=$rPd['name']?></td>                           
                            <td> <?=$rPd['variant_Sku']?></td>

                          <?php if ($v_pid == 0) {?>

                            <td colspan="3"><button type="button" class="btn btn-info"><a href="existing_product.php?prod_id=<?=$p_id?>&v_p_id=<?=$rPd['id']?>" style="color: white;text-decoration: none">Sell your Product</a></button></td>

                          <?php }else{?>

                              <td colspan="3"><button type="button" class="btn btn-danger">Product is Active</button></td>

                          <?php } ?>  
                          </tr>
<?php } ?>                                                 
                        </tbody>  
                      </table>
                  </div>
                </div>
              <?php 
                    }
              ?>
                
              </div>
            </div>
          </div>
        </section>
      </div>
        
              
      <?php include('includes/footer.php'); ?>
