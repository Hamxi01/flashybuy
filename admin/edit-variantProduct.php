<?php
 
include('../includes/db.php');
include('includes/header.php');
include('includes/sidebar.php');
// --- pic crop plugin library ------//
include("../thirdparty/image-resize/ImageResize.php");
include ("../thirdparty/image-resize/ImageResizeException.php");
use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;
// --------- end library files

if (isset($_GET['id']) && isset($_GET['variant_id'])) {
  
  $product_id    = base64_decode($_GET['id']);
  $variation_id  = base64_decode($_GET['variant_id']);
  $sql   = "SELECT * from products where product_id = '$product_id'";
  $query = mysqli_query($con,$sql);
  while($result = mysqli_fetch_array($query)){

        $name                  = $result['name'];
        $category_id           = $result['cat_id'];
        $subcategory_id        = $result['sub_cat_id'];
        $subsubcategory_id     = $result['sub_sub_cat_id'];
        $brand_id              = $result['brand'];
        $market_price          = $result['market_price'];
        $selling_price         = $result['selling_price'];
        $stock                 = $result['quantity'];
        $width                 = $result['width'];
        $height                = $result['height'];
        $length                = $result['length'];
        $exclusive             = $result['exclusive'];
        $approved              = $result['approved'];
        $keyword               = $result['keyword'];
        $description           = $result['description'];
        $ven_id                = $result['ven_id'];
        $keyword               = explode(',',$keyword);
  }
  // $sql   = "SELECT * from product_variations where variation_id = '$variation_id'";
  // $query = mysqli_query($con,$sql);
  // while ($res = mysqli_fetch_array($query)) {
      
  //     $first_variation_name   = $res['first_variation_name'];
  //     $second_variation_name  = $res['second_variation_name'];
  //     $third_variation_name   = $res['third_variation_name'];
  //     $forth_variation_name   = $res['forth_variation_name'];
  //     $first_variation_value  = $res['first_variation_value'];
  //     $second_variation_value = $res['second_variation_value'];
  //     $third_variation_value  = $res['third_variation_value'];
  //     $forth_variation_value  = $res['forth_variation_value'];
  //     $sku                    = $res['sku'];
  //     $quantity               = $res['quantity'];
  //     $price                  = $res['price'];
  //     $active                 = $res['active'];
  //     $skuColor               = explode('-',$sku);

  // }
  //     $color                  = $skuColor[0];

  // $sql   = "SELECT * from product_variant_images WHERE product_id='$product_id' AND variation_value ='$color'";
  // $query = mysqli_query($con,$sql);
  // while ( $imageRes = mysqli_fetch_array($query)) {
      
  //       $image1                = $imageRes['image1'];
  //       $image2                = $imageRes['image2'];
  //       $image3                = $imageRes['image3'];
  //       $image4                = $imageRes['image4'];
  // }
}
if (isset($_POST['update-product'])) {

  $variation_id                    =     $_POST['variation_id'];
  $product_id                      =     $_POST['id'];
  $ven_id                          =     $_POST['ven_id'];
  $name                            =     $_POST['name'];
  $category_id                     =     $_POST['cat_id'];
  $subcategory_id                  =     $_POST['sub_cat_id'];
  $subsubcategory_id               =     $_POST['sub_sub_cat_id'];
  $brand                           =     $_POST['brand'];
  $market_price                    =     $_POST['market_price'];
  $price                           =     $_POST['price'];
  $stock                           =     $_POST['quantity'];
  foreach ($_POST['keyword'] as $key => $value) {
            
    $keyword     =  implode(',' , $_POST['keyword']);

  }
  $quantity                        =     $_POST['quantity'];
  $width                           =     $_POST['width'];
  $height                          =     $_POST['height'];
  $length                          =     $_POST['length'];
  // $courier_size                 =     $_POST['courier_size'];
  $description                     =     $_POST['description'];

  if (isset($_POST['approved'])) { 

      $approved                        =     $_POST['approved'];
      
  }else{

    $approved = 'N';
  }
  if (isset($_POST['exclusive'])) { 

       $exclusive                       =     $_POST['exclusive'];
       
  }else{

    $exclusive = 'N';
  }

$description =     $_POST['description'];



     $query = "update products SET name='".$name."',cat_id='".$category_id."',sub_cat_id='".$subcategory_id."',sub_sub_cat_id='".$subsubcategory_id."',brand='".$brand."',length='".$length."',width='".$width."',height='".$height."',keyword='".$keyword."',approved='".$approved."',exclusive='".$exclusive."' Where product_id='".$product_id."'";

    foreach ($_POST['sku'] as $key => $value) {
      
          $vquery = "update product_variations SET quantity='".$_POST['qty'][$key]."',price='".$_POST['price'][$key]."',sku='".$_POST['sku'][$key]."',active='".$_POST['active'][$key]."' Where product_id='".$product_id."'";

    }
     // $vquery = "update product_variations SET first_variation_value='".$first_variation_value."',second_variation_value='".$second_variation_value."',third_variation_value='".$third_variation_value."',forth_variation_value='".$forth_variation_value."',quantity='".$stock."',price='".$price."',sku='".$sku."',active='".$active."' Where variation_id='".$variation_id."'";

     // $imagequery = "update product_variant_images SET image1='".$pic1we."',image2='".$pic2we."',image3='".$pic3we."',image4='".$pic4we."' where product_id='".$product_id."'";

      ///// Check product is already in vendors products or not////
      foreach ($_POST['variation_id'] as $key => $id) {
        
          $vpSql   = "SELECT * from vendor_product where variation_id = '".$_POST['variation_id'][$key]."'  AND prod_id = '".$product_id."'  AND ven_id ='".$ven_id."'";
          $vpQuery = mysqli_query($con,$vpSql);
          $vpRows  = mysqli_num_rows($vpQuery);
          if ($vpRows>0) {
              if (isset($_POST['active'])) {
                  
                  $active = $_POST['active'];
                }else{

                  $active = 'N';
                }  
                $approvquery = "update vendor_product SET quantity='".$_POST['qty'][$key]."',price='".$_POST['price'][$key]."',mk_price='".$market_price."',active='".$active[$key]."' where prod_id ='".$product_id."' AND variation_id='".$_POST['variation_id'][$key]."' AND ven_id ='".$ven_id."'";
                mysqli_query($con,$approvquery);

          }else{

            $approvquery = "INSERT into vendor_product (prod_id,ven_id,variation_id,quantity,price,mk_price,active) VALUES ('".$product_id."','".$ven_id."','".$_POST['variation_id'][$key]."','".$_POST['qty'][$key]."','".$_POST['price'][$key]."','".$market_price."','".$_POST['active'][$key]."')";
            mysqli_query($con,$approvquery);
          }
      }
      
  //----- Vendor product update and insert new data end ----////////////

     if (mysqli_query($con,$query) && mysqli_query($con,$vquery) ){

            echo "<script>window.location.assign('product.php');</script>";
        }
}  
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-md-10 offset-md-1">
                
                    <div class="card">
                      <form class="needs-validation" novalidate="" method="post" action="" enctype="multipart/form-data">
                        <div class="card-header">
                          <h4>Edit Your Products</h4>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                            <div class="col-md-10">
                              <label class="col-form-label">Product Name</label>
                                <input type="text" class="form-control" required="" name="name" value="<?=$name?>">
                                <input type="hidden" name="ven_id" value="<?=$ven_id?>">
                                <input type="hidden" name="id" value="<?=$product_id?>">
                                <div class="invalid-feedback">
                                  What's Product name?
                                </div>
                            </div>
                          </div>  
                          <div class="form-group row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>Categories</label>
                                  <select class="form-control select2" required="" name="cat_id">
                                    <?php
                                      $sql = mysqli_query($con, "SELECT * From categories where cat_id = '$category_id' AND delte =0");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>
                                    
                                    <option value="<?=$res['cat_id']?>" selected><?=$res['name']?></option>
                                  <?php }?>
                                    <?php 

                                          $sql = mysqli_query($con, "SELECT * From categories where delte = 0");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['cat_id']?>"><?=$res['name']?></option>
                                            
                                        <?php  }
                                      ?>
                                  </select>
                                </div>
                              </div>  
                              <div class="invalid-feedback">
                                Oh no! Categories is invalid.
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>SubCategories</label>
                                  <select class="form-control select2" required="" name="sub_cat_id">
                                      <?php
                                          $sql = mysqli_query($con, "SELECT * From sub_categories where sub_cat_id = '$subcategory_id' AND delte =0");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>
                                    
                                          <option value="<?=$res['sub_cat_id']?>" selected><?=$res['name']?></option>
                                      <?php }?>
                                      <?php 

                                          $sql = mysqli_query($con, "SELECT * From sub_categories where delte = 0");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['sub_cat_id']?>"><?=$res['name']?></option>
                                            
                                        <?php  }
                                      ?>
                                  </select>
                                </div>
                              </div>  
                              <div class="invalid-feedback">
                                Oh no! SubCategories is invalid.
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Sub-subCategories</label>
                                  <select class="form-control select2" required="" name="sub_sub_cat_id">
                                      <?php
                                          $sql = mysqli_query($con, "SELECT * From sub_sub_categories where sub_sub_cat = '$subsubcategory_id' AND delte =0");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>
                                    
                                          <option value="<?=$res['sub_sub_cat']?>" selected><?=$res['name']?></option>
                                      <?php }?>
                                    <?php 

                                          $sql = mysqli_query($con, "SELECT * From sub_sub_categories where delte = 0");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['sub_sub_cat']?>"><?=$res['name']?></option>
                                            
                                        <?php  }
                                      ?>
                                  </select>
                                </div>
                              </div>  
                              <div class="invalid-feedback">
                                Oh no! Sub-subCategories is invalid.
                              </div>
                          </div>
                            <div class="form-group row">
                              <div class="col-md-12">
                                <label class="col-form-label">Description</label>
                                  
                                    <textarea class="form-control" required="" name="description"><?=$description?></textarea>
                                  
                                  
                              </div>
                            </div>

                            <div class="form-group row">
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label>Brands</label><button type="button" class="btn btn-warning btn-sm text-right" data-toggle="modal" data-target="#brandsModel" style="margin-left: 10px;margin-bottom: 3px;position: relative;left: 89px">Add new Brand</button>
                                    <select class="form-control select2" required="" name="brand">
                                        <?php 

                                          $sql = mysqli_query($con, "SELECT * From brands where delte = 0 AND id ='$brand_id'");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['id']?>" selected><?=$res['name']?></option>
                                            
                                        <?php  }?>
                                      <?php 

                                          $sql = mysqli_query($con, "SELECT * From brands where delte = 0");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['id']?>"><?=$res['name']?></option>
                                            
                                        <?php  }
                                      ?>
                                    </select>
                                  </div>
                                </div>  
                                <div class="invalid-feedback">
                                  Oh no! Categories is invalid.
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">
                                    <label>Add Keywords</label><button type="button" class="btn btn-warning btn-sm text-right" data-toggle="modal" data-target="#keywordModel" style="margin-left: 10px;margin-bottom: 3px;position: relative;left: 309px">Add new Keyword</button>
                                    <select class="form-control select2" name="keyword[]" required="" multiple="">
                                      <?php 
                                        foreach ($keyword as $key => $value) {
                                            
                                          $sql = mysqli_query($con, "SELECT * From keywords where delte = 0 AND keyword_id ='$keyword[$key]'");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['keyword_id']?>" selected><?=$res['keyword']?></option>
                                            
                                        <?php }  }?>
                                      <?php 

                                          $sql = mysqli_query($con, "SELECT * From keywords where delte = 0");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['keyword_id']?>"><?=$res['keyword']?></option>
                                            
                                        <?php  }
                                      ?>
                                    </select>
                                  </div>
                                </div>  
                                <div class="invalid-feedback">
                                  Oh no! SubCategories is invalid.
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>SKU</label>
                                  <input type="text" name="sku" required="" class="form-control" value="<?=$sku?>">
                              </div>
                            </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Price</label>
                                  <input type="number" name="price" required="" class="form-control" value="<?=$price?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Quantity</label>
                                  <input type="number" name="quantity" required="" class="form-control" value="<?=$quantity?>">
                                </div>
                              </div> 
                          </div> -->
                          <div class="form-group row">
                            <table class="table table-bordered" id="variant_table">
                              <thead>
                                  <tr>
                                      <td class="text-center">
                                          <label for="" class="control-label">Variant</label>
                                      </td>
                                      <td class="text-center">
                                          <label for="" class="control-label">Variant Price</label>
                                      </td>
                                      <td class="text-center">
                                          <label for="" class="control-label">SKU</label>
                                      </td>
                                      <td class="text-center">
                                          <label for="" class="control-label">Quantity</label>
                                      </td>
                                      <td class="text-center"><label>active</label></td>
                                  </tr>
                              </thead>
                              <tbody id="variant_combinations">
                                <?php 

                                  $sql   = "SELECT * from product_variations where product_id = '$product_id'";
                                  $query = mysqli_query($con,$sql);
                                  while ($res = mysqli_fetch_array($query)) {

                                ?>
                                  <tr>
                                    <input type="hidden" name="variation_id[]" value="<?=$res['variation_id']?>">
                                    <td><label for="" class="control-label"><?=$res['sku']?></label></td>
                                    <td><input type="number" name="price[]" value="<?=$res['price']?>" min="1" step="1" class="form-control" required></td>
                                    <td><input type="text" name="sku[]" value="<?=$res['sku']?>" class="form-control" required></td>
                                    <td><input type="number" name="qty[]"  min="1" value="<?=$res['quantity']?>" step="1" class="form-control" required></td>
                                    <td class="pretty p-switch">
                                      <br>
                                      <input type="checkbox" value="Y" name="active[]" <?php if($res['active'] == 'Y'){ ?> checked <?php }?>  />
                                      <div class="state p-warning">
                                          <label>Active</label>
                                      </div>
                                    </td>
                                  </tr>
                              <?php } ?>    
                              </tbody>
                          </table>
                          </div>
                          <!-- <div class="form-group row">
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label><?=$first_variation_name?></label>
                                  <input type="text" name="first_variation_value" class="form-control" value="<?=$first_variation_value?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label><?=$second_variation_name?></label>
                                  <input type="text" name="second_variation_value" class="form-control" value="<?=$second_variation_value?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label><?=$third_variation_name?></label>
                                  <input type="text" name="third_variation_name" class="form-control" value="<?=$third_variation_value?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label><?=$forth_variation_name?></label>
                                  <input type="text" name="forth_variation_value" class="form-control" value="<?=$forth_variation_value?>">
                                </div>
                              </div>  
                          </div> -->
                          <div class="form-group row">
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label>Image1</label>
                                  <input type="file" name="file1" class="form-control" value="<?=$image1?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image2</label>
                                  <input type="file" name="file2" class="form-control" value="<?=$image2?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image3</label>
                                  <input type="file" name="file3" class="form-control" value="<?=$image3?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image4</label>
                                  <input type="file" name="file4" class="form-control" value="<?=$image4?>">
                                </div>
                              </div>  
                          </div>
                          <div class="form-group row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>Width</label>
                                  <input type="number" name="width" required="" class="form-control" value="<?=$width?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Height</label>
                                  <input type="number" name="height" required="" class="form-control" value="<?=$height?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Length</label>
                                  <input type="number" name="length" required="" class="form-control" value="<?=$length?>">
                                </div>
                              </div> 
                          </div>
                          <div class="form-group row">
                            <div class="col-md-4">
                                <div class="pretty p-switch">
                                  <input type="checkbox" value="Y" name="exclusive" <?php if($exclusive == 'Y'){ ?> checked <?php }?>/>
                                  <div class="state p-warning">
                                    <label>Exclusive</label>
                                  </div>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="pretty p-switch">
                                  <input type="checkbox" value="Y" name="approved" <?php if($approved == 'Y'){ ?> checked <?php }?>  />
                                  <div class="state p-warning">
                                      <label>Product Approved</label>
                                  </div>
                                </div>
                            </div>
                           <!--  <div class="col-md-4">
                                <div class="pretty p-switch">
                                  <input type="checkbox" value="Y" name="active" <?php if($active == 'Y'){ ?> checked <?php }?>  />
                                  <div class="state p-warning">
                                      <label>Product variation Active</label>
                                  </div>
                                </div>
                            </div> -->  
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <button class="btn btn-warning" type="submit" name="update-product">Submit</button>
                        </div>
                      </form>  
                    </div>
                    
                </div>
            </div>
          </div>
        </section>
      </div>  
        <!-- Brands Model -->
        <div class="modal fade" id="brandsModel" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add new Brands</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="brand-form">
                  <div class="form-group">
                    <label>Enter Brand name</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Brand Name" name="name">
                    </div>
                  </div>
                  <button type="button" onclick="saveBrands()" class="btn btn-primary m-t-15 waves-effect">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div> 

        <!-- Keywords Model -->
        <div class="modal fade" id="keywordModel" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add new Keywords</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="keyword-form">
                  <div class="form-group">
                    <label>Enter Keyword</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Keywords Name" name="keyword">
                    </div>
                  </div>
                  <button type="button" onclick="saveKeywords()" class="btn btn-primary m-t-15 waves-effect">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>    
<?php include('includes/footer.php');?>
  <script src="assets/bundles/izitoast/js/iziToast.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/toastr.js"></script>
<script>
    ///////-----------------Brands Add Function ------------////////

    function saveBrands(){

      $.ajax({
        type:"post",
        url:"action/saveBrands.php",
        data:$('#brand-form').serialize(),
        success:function(data){

            $("#brandsModel").modal('hide');

              alert("Brands Added Successfully");
                 
        }
      });
    }

    //////--------------- Save keyword Function -----------///////////

    function saveKeywords(){

      $.ajax({
        type:"post",
        url:"action/saveKeywords.php",
        data:$('#keyword-form').serialize(),
        success:function(data){

            $("#keywordModel").modal('hide');

              alert("Keywords Added Successfully");
        }
      });
    }
</script>
