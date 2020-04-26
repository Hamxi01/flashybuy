<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');

  if (isset($_GET['id'])) {

        $id = base64_decode($_GET['id']);

        $psql    = "SELECT * FROM products where product_id='$id'";
        $pquery  = mysqli_query($con,$psql);
        while ($pres = mysqli_fetch_array($pquery)) {
          
            $product_id         = $pres['product_id'];
            $product_name       = $pres['name'];
            $category_id        = $pres['cat_id'];
            $subcategory_id     = $pres['sub_cat_id'];
            $subsubcategory_id  = $pres['sub_sub_cat_id'];
            $approved           = $pres['approved'];

            //--- fetch category by product -------//

            $catsql   = "SELECT name FROM categories where cat_id='$category_id'";
            $catquery = mysqli_query($con,$catsql);
            while ($catres = mysqli_fetch_array($catquery)) {

                $categoryName = $catres['name'];
            }
            //--- fetch Sub category by product -------//
            $subcatsql   = "SELECT name FROM sub_categories where sub_cat_id='$subcategory_id'";
            $subcatquery = mysqli_query($con,$subcatsql);
            while ($subcatres = mysqli_fetch_array($subcatquery)) {

                $subCategoryName = $subcatres['name'];
            }

            //--- fetch Sub sub category by product -------//
            $subsubcatsql   = "SELECT name FROM sub_sub_categories where sub_sub_cat='$subsubcategory_id'";
            $subsubcatquery = mysqli_query($con,$subsubcatsql);
            while ($subsubcatres = mysqli_fetch_array($subsubcatquery)) {

                $subsubCategoryName = $subsubcatres['name'];
            }
            //--- fetch vendor variation by product -------//

            $pvsql   = "SELECT variation_id FROM vendor_product where prod_id='$product_id'";
            $pvquery = mysqli_query($con,$pvsql);
            $pvrows = mysqli_num_rows($pvquery);
            if($pvrows>0){
              while ($pvres = mysqli_fetch_array($pvquery)) {

                  $variation_id = $pvres['variation_id'];
                  if (empty($variation_id)) {
                      
                      $sku     = $pres['sku'];
                  }
                  else{
                        $vsql   = "SELECT sku FROM product_variations where product_id='$product_id' AND variation_id = '$variation_id'";
                        $vquery = mysqli_query($con,$vsql);
                        while ($vres = mysqli_fetch_array($vquery)) {

                          $sku = $vres['sku'];
                        }

                  }
              }
            }else{

              $sku     = $pres['sku'];
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
                      <table class="table table-bordered">
                          <tr>
                            <th>ID#</th>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Status</th>
                          </tr>
                        <tbody>                          
                          <tr style="font-size:13px !important; font-weight:bold ">
                            <td><?=$product_id?></td>
                            <td><?=$product_name?></td>
                            <td><?=$sku?></td>
                            <td><?=$categoryName?></td>
                            <td><?=$subCategoryName?> <b>></b> <?=$subsubCategoryName?></td>
                            <?php if ($approved == 'N') {
                              echo '<td><div class="badge badge-danger">NO</div></td>';
                            }else{
                              echo '<td><div class="badge badge-success">YES</div></td>';
                            }
                            ?>
                            
                          </tr>
                        </tbody>  
                      </table>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                          <tr>
                            <th>Ven Id#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Quantity</th>
                            <th>Market Price</th>
                            <th>Selling Price</th>
                            <th>Active</th>
                            <th>Disable</th>
                            <th>Comments</th>
                            <th>Edit</th>
                          </tr>
                        <tbody>
<?php 

  if (empty($variation_id)) {
    
      $vendVariSql  =  "SELECT
                        VP.id,  
                        VP.comments,
                        VP.quantity as vendor_stock, 
                        VP.price,
                        VP.mk_price,
                        VP.active,
                        V.id as vend_id,
                        V.name,
                        V.email 
                          From vendor_product as VP
                          INNER JOIN vendor as V on V.id = VP.ven_id
                          where VP.prod_id ='$product_id'
                          GROUP BY VP.ven_id";
  }
  else{

      $vendVariSql  =  "SELECT
                        VP.id,
                        VP.comments,
                        VP.quantity as vendor_stock, 
                        VP.price,
                        VP.mk_price,
                        VP.active,
                        V.id as vend_id,
                        V.name,
                        V.email 
                          From vendor_product as VP
                          INNER JOIN vendor as V on V.id = VP.ven_id
                          where VP.prod_id ='$product_id'
                          AND VP.variation_id='$variation_id'
                          GROUP BY VP.ven_id";
  }

    $vendVariQuery = mysqli_query($con,$vendVariSql);
    while ( $vendVariResult= mysqli_fetch_array($vendVariQuery)) {

      $v_p_id    = $vendVariResult['id'];
      $vendor_id = $vendVariResult['vend_id'];
      $name      = $vendVariResult['name'];
      $email     = $vendVariResult['email'];
      $quantity  = $vendVariResult['vendor_stock'];
      $mk_price  = $vendVariResult['mk_price'];
      $price     = $vendVariResult['price'];
      $active    = $vendVariResult['active'];
      $comment   = $vendVariResult['comments'];
    ?>                          
                          <tr style="font-size:13px !important; font-weight:bold ">
                            <td><?=$vendor_id?></td>
                            <td><?=$name?></td>
                            <td><?=$email?></td>
                            <td><?=$quantity?></td>
                            <td><?=$mk_price?></td>
                            <td><?=$price?></td>
                            <?php if ($active == 'N') {
                              echo '<td><div class="badge badge-danger">NO</div></td>';
                            }else{
                              echo '<td><div class="badge badge-success">YES</div></td>';
                            }
                            ?>
                            <td>
                              <select class="form-control" onchange="showcommetsModal('<?=$v_p_id?>')" id="comments_<?=$v_p_id?>">
                                <?php if ($active == 'N') {
                                  echo '<option value="N" selected>YES</option><option value="Y">NO</option>';
                                }else{
                                  echo '<option value="Y" selected>NO</option><option value="N">YES</option>';
                                }
                                ?>
                              </select>
                            </td>
                            <td><?=$comment?></td>
                            <td>
                              <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal<?php echo $vendor_id?>" aria-labelledby="formModal"
          aria-hidden="true">Edit</button>
                            </td>
                          </tr>
                          
  <?php } ?>                        
                        </tbody>  
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
        <!-- Vendor assign Model -->
        <div class="modal fade" id="vendorModel" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add your Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <div align="center" style="margin:0px !important; padding:0px !important; " > <i class="mdi mdi-checkbox-marked-circle-outline" style="font-size:200px; color:#7A7EE3; line-height:200px;"></i> 
                   </div>
                  <div class="row" >
                    <div align="center" class="col-lg-12" >
                      <input type="hidden" id="v_p_ids" name="v_p_ids" value=""  /> 
                      <textarea id="disable_comments" name="disable_comments" placeholder="Enter inactive products" class="form-control" style="height:150px;" ></textarea>
                    </div>
                  </div>
                  <div class="row" >
                    <div align="center" class="col-lg-12" style="padding-top:10px" >
                      <input type="submit" id="btn_comp" name="btn_comp" value="Add your comments"  class="btn btn-warning btn-md" onClick="validation_disable();"  />
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
<?php 

  if (empty($variation_id)) {
    
      $vendVariSql  =  "SELECT
                        VP.id,  
                        VP.comments,
                        VP.quantity as vendor_stock, 
                        VP.price,
                        VP.mk_price,
                        VP.active,
                        V.id as vend_id,
                        V.name,
                        V.email 
                          From vendor_product as VP
                          INNER JOIN vendor as V on V.id = VP.ven_id
                          where VP.prod_id ='$product_id'
                          GROUP BY VP.ven_id";
  }
  else{

      $vendVariSql  =  "SELECT
                        VP.id,
                        VP.comments,
                        VP.quantity as vendor_stock, 
                        VP.price,
                        VP.mk_price,
                        VP.active,
                        V.id as vend_id,
                        V.name,
                        V.email 
                          From vendor_product as VP
                          INNER JOIN vendor as V on V.id = VP.ven_id
                          where VP.prod_id ='$product_id'
                          AND VP.variation_id='$variation_id'
                          GROUP BY VP.ven_id";
  }

    $vendVariQuery = mysqli_query($con,$vendVariSql);
    while ( $vendVariResult= mysqli_fetch_array($vendVariQuery)) {

      $v_p_id    = $vendVariResult['id'];
      $vendor_id = $vendVariResult['vend_id'];
      $name      = $vendVariResult['name'];
      $email     = $vendVariResult['email'];
      $quantity  = $vendVariResult['vendor_stock'];
      $mk_price  = $vendVariResult['mk_price'];
      $price     = $vendVariResult['price'];
      $active    = $vendVariResult['active'];
      $comment   = $vendVariResult['comments'];
    ?>        
        <!-- Edit Model -->
        <div class="modal fade" id="myModal<?php echo $vendor_id?>" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Update Prices</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                <div class="modal-body">
                 
                  
                  <form action="action/vendorProductEdit.php" method="post">
                    <div class="form-group">
                      <input type="hidden" name="product_id" value="<?=$id?>">
                      <input type="hidden" name="v_p_id"  value="<?=$v_p_id?>"/>
                      <label for="ac">Actual Price:</label>
                      <input type="text" class="form-control" id="price" name="price" value="<?=$price?>">
                    </div>
                    <div class="form-group">
                      <label for="ac">Market Price:</label>
                      <input type="text" class="form-control" id="mk_price" name="mk_price" value="<?=$mk_price?>">
                    </div>
                    <div class="form-group">
                      <label for="ac">Quantity:</label>
                      <input type="text" class="form-control" id="qa" name="quantity" value="<?=$quantity?>">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-warning" name="update-vendor-product">Update</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                </form>
              </div>
            </div>
        </div>
<?php } ?>        
      <?php include('includes/footer.php'); ?>
      <script type="text/javascript">
        function showcommetsModal(v_p_id){

            $("#vendorModel").modal('show');
            $("#v_p_ids").val(v_p_id);
        }
        function validation_disable(){

          var v_p_id           = $("#v_p_ids").val();
          var disable_val      = $("#comments_" + v_p_id).val();
          var disable_comments = $("#disable_comments").val();

         
          if( disable_comments == ''  ){
            alert("Please enter disable comments");
            return false;
          }
          else{

              $.ajax({
                type : "POST",
                url : 'action/productDisableComments.php',
                data: {id:v_p_id,active:disable_val,comments:disable_comments},  
                success: function(data) {
                  
                  
                    location.reload(true);

                }
              });  
          }
          
        }
      </script>