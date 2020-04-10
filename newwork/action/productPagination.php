<?php include("../../includes/db.php"); ?>
<table class="table table-striped">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Total Stock</th>
                            <th>Base Price</th>
                            <th>Variation</th>
                            <!-- <th>Today Deals</th> -->
                            <th>Assigned Vendor</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="searchResult">  
                        <!-- Fetch Products -->
<?php 

$limit = 10;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;

      $sql =  "SELECT
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
                  ORDER BY
                    P.product_id DESC LIMIT $start_from, $limit";
    $query = mysqli_query($con,$sql);
 $i=1; 
 while($res = mysqli_fetch_array($query)) {

  $v_id          = $res['variation_id'];
  $variation_id  = base64_encode($res['variation_id']);
  $id            = base64_encode($res['product_id']);
  $p_id          = $res['product_id'];

  // $countQuery = "SELECT  COUNT(*) AS total FROM vendor_product AS VP INNER JOIN vendor AS V ON V.id = VP.ven_id INNER Join product_variations AS PV ON PV.variation_id = VP.variation_id where VP.prod_id = '$p_id'";
  // $res    = mysqli_query( $con , $countQuery );
  // $query  = mysqli_fetch_array($res);
  // $vCount = $query["total"];

  // $pvQuery = "SELECT  COUNT(*) AS total FROM vendor_product AS VP INNER JOIN vendor AS V ON V.id = VP.ven_id  where VP.prod_id = '$p_id'";
  // $res     = mysqli_query( $con , $pvQuery );
  // $pquery  = mysqli_fetch_array($res);
  // $pvCount = $pquery["total"];
  if ($res['quantity'] == null) {
    
      $stock = $res['stock'];
  }else{

    $stock   = $res['quantity'];
  }

  if ($res['selling_price'] == null) {
    
      $price = $res['price'];
  }else{

    $price   = $res['selling_price'];
  }
  if ($res['approved'] =="N") {
    
    $approve = "Not Approdved";
  }else{

    $approve = "approved";    
  }



  ?>
                      
                        <tr>
                          <td><?= $i++?></td>
                          <td><img alt="image" src="../upload/product/200_<?php echo $res['image1'];?>" width="35"
                              data-toggle="tooltip" title="<?=$res['name']?>">  <span style="margin-left: 5px"> <?=$res['name']?> <?=$res['variant_Sku']?></span> </td>

                          <td class="align-middle"><?=$stock?></td>
                          <td><b>R</b><?=$price?></td>
                          <td><?=$res['variant_Sku']?></td>

                          <!-- Count Vendor -->
                            <td>2</td>
                          
                          <!-- end Count Vendor -->

                          <td>
                            <?php if($res['approved'] == "N"){?>
                              <div class="badge badge-danger">pending</div>
                            <?php }else{     ?>
                              <div class="badge badge-success">Approved<?=$total_pages?></div>
                            <?php } ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                              <div class="dropdown-menu">
                              <?php if (!empty($res['variant_Sku'])) { ?>  
                                <a href="#" class="dropdown-item has-icon" data-toggle="modal"
                                  data-target=".bd-example-modal-lg" onclick="variantprodImgPreview('<?=$id?>','<?=$res['variant_Sku']?>')"><i class="fas fa-eye"></i> 
                                    View
                                </a>
                                <?php }else{ ?>
                                      <a href="#" class="dropdown-item has-icon" data-toggle="modal"
                                        data-target=".bd-example-modal-lg" onclick="prodImgPreview('<?=$id?>')"><i class="fas fa-eye"></i> 
                                          View
                                      </a>
                                <?php } ?>
                                <?php if (!empty($res['variant_Sku'])) { ?>
                                        <a href="#" data-toggle="modal"
                                        data-target="#variationModel" class="dropdown-item has-icon" onclick="variationData('<?=$id?>','<?=$variation_id?>')"><i class="far fa-edit"></i>Add new Variation</a>
                                <?php } ?>
                                <?php if (!empty($res['variant_Sku'])) { ?>
                                    <a href="#" data-toggle="modal"
                                        data-target="#vendorModel" class="dropdown-item has-icon" onclick="variantProductAssign('<?=$id?>','<?=$variation_id?>')"><i class="far fa-edit"></i>Assign Vendor</a>
                                <?php }else{ ?>
                                    <a href="#" data-toggle="modal"
                                        data-target="#vendorModel" class="dropdown-item has-icon" onclick="productAssign('<?=$id?>')"><i class="far fa-edit"></i>Assign Vendor</a>
                                <?php } ?>     
                                <?php if (!empty($res['variant_Sku'])) { ?>
                                    <a href="edit-variantProduct.php?id=<?=$id?>&variant_id=<?=$variation_id?>" class="dropdown-item has-icon"><i class="far fa-edit"></i>Edit</a>
                                <?php }else{ ?>
                                    <a href="edit-product.php?id=<?=$id?>&sku=<?=$res['sku']?>" class="dropdown-item has-icon"><i class="far fa-edit"></i>Edit</a>
                                <?php } ?>        
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                  Delete</a>
                              </div>
                            </div>
                          </td>
                        </tr>
<?php }  ?>           
                      </tbody>             
                      </table>