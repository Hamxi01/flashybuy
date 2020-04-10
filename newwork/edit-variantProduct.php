<?php
 
include('../includes/db.php');
include('includes/header.php');
include('includes/sidebar.php');

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
  }
  $sql   = "SELECT * from product_variations where variation_id = '$variation_id'";
  $query = mysqli_query($con,$sql);
  while ($res = mysqli_fetch_array($query)) {
      
      $first_variation_name   = $res['first_variation_name'];
      $second_variation_name  = $res['second_variation_name'];
      $third_variation_name   = $res['third_variation_name'];
      $forth_variation_name   = $res['forth_variation_name'];
      $first_variation_value  = $res['first_variation_value'];
      $second_variation_value = $res['second_variation_value'];
      $third_variation_value  = $res['third_variation_value'];
      $forth_variation_value  = $res['forth_variation_value'];
      $sku                    = $res['sku'];
      $quantity               = $res['quantity'];
      $price                  = $res['price'];
      $active                 = $res['active'];
  }
}
if (isset($_POST['update-product'])) {

  $variation_id                    =     $_POST['variation_id'];
  $product_id                      =     $_POST['id'];
  $name                            =     $_POST['name'];
  $category_id                     =     $_POST['cat_id'];
  $subcategory_id                  =     $_POST['sub_cat_id'];
  $subsubcategory_id               =     $_POST['sub_sub_cat_id'];
  $brand                           =     $_POST['brand'];
  $keyword                         =     $_POST['keyword'];
  $quantity                        =     $_POST['quantity'];
  $width                           =     $_POST['width'];
  $height                          =     $_POST['height'];
  $length                          =     $_POST['length'];
  // $courier_size                 =     $_POST['courier_size'];
  $description                     =     $_POST['description'];

  $first_variation_value  = $_POST['first_variation_value'];
  $sku                    = $first_variation_value;

if (isset($_POST['second_variation_value'])) {  
  
  $second_variation_value = $_POST['second_variation_value'];
  $sku                    = $sku.'-'.$second_variation_value;
}
if (isset($_POST['third_variation_value'])) {
   
  $third_variation_value  = $_POST['third_variation_value'];
  $sku                    = $sku.'-'.$third_variation_value;
}
if (isset($_POST['forth_variation_value'])) {
   
  $forth_variation_value  = $_POST['forth_variation_value'];
  $sku                    = $sku.'-'.$forth_variation_value;
}
    $active                 = $_POST['active'];
    if ($active!="Y") {
      
        $active = 'N';
    }
// upload and crop image1 //
// if (isset($_FILES['file1']["name"]) && !empty($_FILES['file1']["name"])) {

//     $filename = $_FILES["file1"]["name"];
//     $extension = @end(explode('.', $filename)); // explode the image name to get the extension
//     $pic1extension = strtolower($extension);
//     $pic1 = time().rand();
//     $pic1we=$pic1.".".$pic1extension;
//     $location = "../../upload/product/".$pic1we;
    
//   if(move_uploaded_file($_FILES["file1"]["tmp_name"], $location)){

//           try {
//             $image = new ImageResize($location);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(800);
//             $image->resizeToHeight(800);
//             $new_name = '800_' . $pic1 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
    
//         } catch (ImageResizeException $e) {
//             return null;
//         }
//       try {
//             $image = new ImageResize($location);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(300);
//             $image->resizeToHeight(300);
//             $new_name = '300_' . $pic1 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
          
//         } catch (ImageResizeException $e) {
//             return null;
//         }
//       try {
//             $image = new ImageResize($location);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(200);
//             $image->resizeToHeight(150);
//             $new_name = '200_' . $pic1 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
          
//         } catch (ImageResizeException $e) {
//             return null;
//         }

//   }
// }

// upload and crop image2 //
// if (isset($_FILES['file2']["name"]) && !empty($_FILES['file2']["name"])) {

//     $filename = $_FILES["file2"]["name"];
//     $extension = @end(explode('.', $filename)); // explode the image name to get the extension
//     $pic2extension = strtolower($extension);
//     $pic2 = time().rand();
//     $pic2we=$pic2.".".$pic2extension;
//     $location2 = "../../upload/product/".$pic2we;
    
//   if(move_uploaded_file($_FILES["file2"]["tmp_name"], $location2)){

//           try {
//             $image = new ImageResize($location2);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(800);
//             $image->resizeToHeight(800);
//             $new_name = '800_' . $pic2 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
    
//         } catch (ImageResizeException $e) {
//             return null;
//         }
//       try {
//             $image = new ImageResize($location2);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(300);
//             $image->resizeToHeight(300);
//             $new_name = '300_' . $pic2 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
          
//         } catch (ImageResizeException $e) {
//             return null;
//         }
//       try {
//             $image = new ImageResize($location2);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(200);
//             $image->resizeToHeight(150);
//             $new_name = '200_' . $pic2 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
          
//         } catch (ImageResizeException $e) {
//             return null;
//         }

//   }
// }
// upload and crop image3 //
// if (isset($_FILES['file3']["name"]) && !empty($_FILES['file3']["name"])) {

//     $filename = $_FILES["file3"]["name"];
//     $extension = @end(explode('.', $filename)); // explode the image name to get the extension
//     $pic3extension = strtolower($extension);
//     $pic3 = time().rand();
//     $pic3we=$pic3.".".$pic3extension;
//     $location3 = "../../upload/product/".$pic3we;
    
//   if(move_uploaded_file($_FILES["file3"]["tmp_name"], $location3)){

//           try {
//             $image = new ImageResize($location3);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(800);
//             $image->resizeToHeight(800);
//             $new_name = '800_' . $pic3 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
    
//         } catch (ImageResizeException $e) {
//             return null;
//         }
//       try {
//             $image = new ImageResize($location3);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(300);
//             $image->resizeToHeight(300);
//             $new_name = '300_' . $pic3 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
          
//         } catch (ImageResizeException $e) {
//             return null;
//         }
//       try {
//             $image = new ImageResize($location3);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(200);
//             $image->resizeToHeight(150);
//             $new_name = '200_' . $pic3 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
          
//         } catch (ImageResizeException $e) {
//             return null;
//         }

//   }
// }
// upload and crop image1 //
// if (isset($_FILES['file4']["name"]) && !empty($_FILES['file4']["name"])) {

//     $filename = $_FILES["file4"]["name"];
//     $extension = @end(explode('.', $filename)); // explode the image name to get the extension
//     $pic4extension = strtolower($extension);
//     $pic4 = time().rand();
//     $pic4we=$pic4.".".$pic4extension;
//     $location4 = "../../upload/product/".$pic4we;
    
//   if(move_uploaded_file($_FILES["file4"]["tmp_name"], $location4)){

//           try {
//             $image = new ImageResize($location4);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(800);
//             $image->resizeToHeight(800);
//             $new_name = '800_' . $pic4 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
    
//         } catch (ImageResizeException $e) {
//             return null;
//         }
//       try {
//             $image = new ImageResize($location4);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(300);
//             $image->resizeToHeight(300);
//             $new_name = '300_' . $pic4 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
          
//         } catch (ImageResizeException $e) {
//             return null;
//         }
//       try {
//             $image = new ImageResize($location4);
//             $image->quality_jpg = 85;
//             $image->resizeToWidth(200);
//             $image->resizeToHeight(150);
//             $new_name = '200_' . $pic4 . '.jpg';
//             $new_path = '../../upload/product/' . $new_name;
//             $image->save($new_path, IMAGETYPE_JPEG);
          
//         } catch (ImageResizeException $e) {
//             return null;
//         }

//   }
// }


     $query = "update products SET name='".$name."',cat_id='".$category_id."',sub_cat_id='".$subcategory_id."',sub_sub_cat_id='".$subsubcategory_id."',brand='".$brand."',length='".$length."',width='".$width."',height='".$height."',keyword='".$keyword."' Where product_id='".$product_id."'";

     $vquery = "update product_variations SET first_variation_value='".$first_variation_value."',second_variation_value='".$second_variation_value."',third_variation_value='".$third_variation_value."',forth_variation_value='".$forth_variation_value."',quantity='".$quantity."',price='".$price."',sku='".$sku."',active='".$active."' Where variation_id='".$variation_id."'";

     if (mysqli_query($con,$query) && mysqli_query($con,$vquery)){

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
                                <input type="hidden" name="id" value="<?=$product_id?>">
                                <input type="hidden" name="variation_id" value="<?=$variation_id?>">
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
                                  
                                    <textarea class="form-control" required="" name="description"></textarea>
                                  
                                  
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
                                    <select class="form-control select2" name="keyword" required="" multiple="">
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
                            <div class="form-group row">
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
                          </div>
                          <div class="form-group row">
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
                          </div>
                          <!-- <div class="form-group row">
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
                          </div> -->
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
                            <div class="col-md-4">
                                <div class="pretty p-switch">
                                  <input type="checkbox" value="Y" name="active" <?php if($active == 'Y'){ ?> checked <?php }?>  />
                                  <div class="state p-warning">
                                      <label>Product variation Active</label>
                                  </div>
                                </div>
                            </div>  
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
