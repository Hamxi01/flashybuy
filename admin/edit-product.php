<?php
 
include('../includes/db.php');
include('includes/header.php');
include('includes/sidebar.php');
include("../thirdparty/image-resize/ImageResize.php");
include ("../thirdparty/image-resize/ImageResizeException.php");
use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;

if (isset($_GET['id']) && isset($_GET['sku'])) {
  
  $product_id = base64_decode($_GET['id']);
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
        $courier_size          = $result['courier_size'];
        $warranty              = $result['warranty'];
        $exclusive             = $result['exclusive'];
        $approved              = $result['approved'];
        $image1                = $result['image1'];
        $image2                = $result['image2'];
        $image3                = $result['image3'];
        $image4                = $result['image4'];
        $description           = $result['description'];
        $keyword               = $result['keyword'];
        $ven_id                = $result['ven_id'];
        $keyword               = explode(',',$keyword);
        $shortDesc             = $result['short_desc'];
  }
}
if (isset($_POST['action']) && $_POST['action'] == 'saveproduct') {

  $product_id                      =     addslashes($_POST['id']);
  $name                            =     addslashes($_POST['name']);
  $category_id                     =     addslashes($_POST['cat_id']);
  $subcategory_id                  =     addslashes($_POST['sub_cat_id']);
  $subsubcategory_id               =     addslashes($_POST['sub_sub_cat_id']);
  $brand                           =     addslashes($_POST['brand']);
  foreach ($_POST['keyword'] as $key => $value) {
            
    $keyword     =  implode(',' , $_POST['keyword']);

  }

  $width                           =     addslashes($_POST['width']);
  $height                          =     addslashes($_POST['height']);
  $length                          =     addslashes($_POST['length']);
  $courier_size                    =     addslashes($_POST['courier_size']);
  $warranty                        =     addslashes($_POST['warranty']);
  
 
  if (isset($_POST['exclusive'])) {
      
      $exclusive = $_POST['exclusive'];
  }else{

    $exclusive = 'N';
  }
  // $courier_size                 =     $_POST['courier_size'];
  $description                     =     addslashes($_POST['description']);
  $shortDesc                       =     addslashes($_POST['short_desc']);
  $sku                             =     str_replace(" ","-", $name);
  $image1                          =     $_POST['image1'];
  $image2                          =     $_POST['image2'];
  $image3                          =     $_POST['image3'];
  $image4                          =     $_POST['image4'];



     $query = "update products SET name='".$name."',cat_id='".$category_id."',sub_cat_id='".$subcategory_id."',sub_sub_cat_id='".$subsubcategory_id."',brand='".$brand."',length='".$length."',width='".$width."',height='".$height."',keyword='".$keyword."',sku='".$sku."',description='".$description."',short_desc='".$shortDesc."',image1='".$image1."',image2='".$image2."',image3='".$image3."',image4='".$image4."',exclusive='".$exclusive."',courier_size='".$courier_size."',warranty='".$warranty."' Where product_id='".$product_id."'";
     ///// Check product is already in vendors products or not////

      

      
  //----- Vendor product update and insert new data end ----////////////

     if (mysqli_query($con,$query)){

            echo "<script>window.location.assign('product.php');</script>";
    }else{

      echo "EROOR";
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'acceptproduct') {

  $product_id                      =     addslashes($_POST['id']);
  $name                            =     addslashes($_POST['name']);
  $category_id                     =     addslashes($_POST['cat_id']);
  $subcategory_id                  =     addslashes($_POST['sub_cat_id']);
  $subsubcategory_id               =     addslashes($_POST['sub_sub_cat_id']);
  $brand                           =     addslashes($_POST['brand']);
  foreach ($_POST['keyword'] as $key => $value) {
            
    $keyword     =  implode(',' , $_POST['keyword']);

  }
  $market_price                    =     addslashes($_POST['market_price']);  
  $selling_price                   =     addslashes($_POST['selling_price']);
  $quantity                        =     addslashes($_POST['quantity']);
  $width                           =     addslashes($_POST['width']);
  $height                          =     addslashes($_POST['height']);
  $length                          =     addslashes($_POST['length']);
  $courier_size                    =     addslashes($_POST['courier_size']);
  $warranty                        =     addslashes($_POST['warranty']);
  

    $approved = 'Y';
  
 
  if (isset($_POST['exclusive'])) {
      
      $exclusive = $_POST['exclusive'];
  }else{

    $exclusive = 'N';
  }
  // $courier_size                 =     $_POST['courier_size'];
  $description                     =     addslashes($_POST['description']);
  $shortDesc                       =     addslashes($_POST['short_desc']);
  $sku                             =     str_replace(" ","-", $name);
  $image1                          =     $_POST['image1'];
  $image2                          =     $_POST['image2'];
  $image3                          =     $_POST['image3'];
  $image4                          =     $_POST['image4'];



     $query = "update products SET name='".$name."',cat_id='".$category_id."',sub_cat_id='".$subcategory_id."',sub_sub_cat_id='".$subsubcategory_id."',brand='".$brand."',quantity='".$quantity."',market_price='".$market_price."',selling_price='".$selling_price."',length='".$length."',width='".$width."',height='".$height."',keyword='".$keyword."',sku='".$sku."',description='".$description."',short_desc='".$shortDesc."',image1='".$image1."',image2='".$image2."',image3='".$image3."',image4='".$image4."',approved='".$approved."',exclusive='".$exclusive."',courier_size='".$courier_size."',warranty='".$warranty."' Where product_id='".$product_id."'";
     ///// Check product is already in vendors products or not////

      $vpSql   = "SELECT * from vendor_product where prod_id = '$product_id'  AND ven_id='$ven_id'";
      $vpQuery = mysqli_query($con,$vpSql);
      $vpRows  = mysqli_num_rows($vpQuery);

      if ($vpRows>0) {
            
        $approvquery = "update vendor_product SET quantity='".$quantity."',price='".$selling_price."',mk_price='".$market_price."',active='".$approved."' where prod_id ='".$product_id."' AND ven_id ='".$ven_id."'";
        mysqli_query($con,$approvquery);

      }else{

        $approvquery = "INSERT into vendor_product (prod_id,ven_id,quantity,price,mk_price,active) VALUES ('$product_id','$ven_id','$quantity','$selling_price','$market_price','$approved')";
        mysqli_query($con,$approvquery);
      }
  //----- Vendor product update and insert new data end ----////////////

     if (mysqli_query($con,$query)){

            echo "<script>window.location.assign('product.php');</script>";
    }else{

      echo "EROOR";
    }
} 

if (isset($_POST['action']) && $_POST['action'] == 'rejectproduct') {

  $product_id                      =     addslashes($_POST['id']);
  $name                            =     addslashes($_POST['name']);
  $category_id                     =     addslashes($_POST['cat_id']);
  $subcategory_id                  =     addslashes($_POST['sub_cat_id']);
  $subsubcategory_id               =     addslashes($_POST['sub_sub_cat_id']);
  $brand                           =     addslashes($_POST['brand']);
  foreach ($_POST['keyword'] as $key => $value) {
            
    $keyword     =  implode(',' , $_POST['keyword']);

  }
  $market_price                    =     addslashes($_POST['market_price']);  
  $selling_price                   =     addslashes($_POST['selling_price']);
  $quantity                        =     addslashes($_POST['quantity']);
  $width                           =     addslashes($_POST['width']);
  $height                          =     addslashes($_POST['height']);
  $length                          =     addslashes($_POST['length']);
  $courier_size                    =     addslashes($_POST['courier_size']);
  $warranty                        =     addslashes($_POST['warranty']);
  

    $approved = 'N';
  
 
  if (isset($_POST['exclusive'])) {
      
      $exclusive = $_POST['exclusive'];
  }else{

    $exclusive = 'N';
  }
  // $courier_size                 =     $_POST['courier_size'];
  $description                     =     addslashes($_POST['description']);
  $shortDesc                       =     addslashes($_POST['short_desc']);
  $sku                             =     str_replace(" ","-", $name);
  $image1                          =     $_POST['image1'];
  $image2                          =     $_POST['image2'];
  $image3                          =     $_POST['image3'];
  $image4                          =     $_POST['image4'];



     $query = "update products SET name='".$name."',cat_id='".$category_id."',sub_cat_id='".$subcategory_id."',sub_sub_cat_id='".$subsubcategory_id."',brand='".$brand."',quantity='".$quantity."',market_price='".$market_price."',selling_price='".$selling_price."',length='".$length."',width='".$width."',height='".$height."',keyword='".$keyword."',sku='".$sku."',description='".$description."',short_desc='".$shortDesc."',image1='".$image1."',image2='".$image2."',image3='".$image3."',image4='".$image4."',approved='".$approved."',exclusive='".$exclusive."',courier_size='".$courier_size."',warranty='".$warranty."' Where product_id='".$product_id."'";
     ///// Check product is already in vendors products or not////

      $vpSql   = "SELECT * from vendor_product where prod_id = '$product_id'  AND ven_id='$ven_id'";
      $vpQuery = mysqli_query($con,$vpSql);
      $vpRows  = mysqli_num_rows($vpQuery);

      if ($vpRows>0) {
            
        $approvquery = "update vendor_product SET quantity='".$quantity."',price='".$selling_price."',mk_price='".$market_price."',active='".$approved."' where prod_id ='".$product_id."' AND ven_id ='".$ven_id."'";
        mysqli_query($con,$approvquery);

      }else{

        $approvquery = "INSERT into vendor_product (prod_id,ven_id,quantity,price,mk_price,active) VALUES ('$product_id','$ven_id','$quantity','$selling_price','$market_price','$approved')";
        mysqli_query($con,$approvquery);
      }
  //----- Vendor product update and insert new data end ----////////////

     if (mysqli_query($con,$query)){

            echo "<script>window.location.assign('product.php');</script>";
    }else{

      echo "EROOR";
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
                      <form class="needs-validation" novalidate="" method="post" action="" enctype="multipart/form-data" id="productForm">
                        <div class="card-header">
                          <h4>Edit Your Products</h4>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                            <div class="col-md-10">
                              <label class="col-form-label">Product Name</label>
                                <input type="text" class="form-control" required="" name="name" value="<?=$name?>">
                                <input type="hidden" name="id" value="<?=$product_id?>">
                                <div class="invalid-feedback">
                                  What's Product name?
                                </div>
                            </div>
                          </div>  
                          <input type="hidden" name="action" id="action">
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
                                <label class="col-form-label">Short Description</label>
                                    <textarea class="form-control" required="" name="short_desc"><?=$shortDesc?></textarea>
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
                                    
                                        <?php 

                                          $sql = mysqli_query($con, "SELECT * From brands where delte = 0 AND id ='$brand_id'");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            
                                            
                                      <input type="text" class="form-control"  value="<?=$res['name']?>" id="brandkeyword" oninput="searchBrands()"> 
                                      <input type="hidden" name="brand" id="brandid" value="<?=$res['id']?>">
                                      <?php  }?>
                                      <ul id="brandslist">
                                      </ul>
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
                        <?php  if($approved != "Y"){  ?>
                            <div class="form-group row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>Market Price</label>
                                  <input type="number" name="market_price" required="" class="form-control" value="<?=$market_price?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Selling Price</label>
                                  <input type="number" name="selling_price" required="" class="form-control" value="<?=$selling_price?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Quantity</label>
                                  <input type="number" name="quantity" required="" class="form-control" value="<?=$stock?>">
                                </div>
                              </div> 
                          </div>
                        <?php } ?>
                          <div class="form-group row">
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label>Image1</label>
                                  <input type="file" name="file1" class="form-control" value="" id="file1">
                                  <span id="uploaded_image1"><img src="../upload/product/200_<?=$image1?>" width="180" height="160"></span>
                                  <input type="hidden" name="image1" id="image1" value="<?=$image1?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image2</label>
                                  <input type="file" name="file2" class="form-control" id="file2">
                                  <span id="uploaded_image2"><img src="../upload/product/200_<?=$image2?>" width="180" height="160"></span>
                                  <input type="hidden" name="image2" id="image2" value="<?=$image2?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image3</label>
                                  <input type="file" name="file3" class="form-control" id="file3" >
                                  <span id="uploaded_image3"><img src="../upload/product/200_<?=$image3?>" width="180" height="160"></span>
                                  <input type="hidden" name="image3" id="image3" value="<?=$image3?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image4</label>
                                  <input type="file" name="file4" class="form-control" id="file4">
                                  <span id="uploaded_image4"><img src="../upload/product/200_<?=$image4?>" width="180" height="160"></span>
                                  <input type="hidden" name="image4" id="image4" value="<?=$image4?>">
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
                            <div class="col-md-5">
                              <div class="form-group">
                                <label>Warranty</label>
                                <select name="warranty" required="" class="form-control">
                                  <option value="<?=$warranty?>" selected><?=$warranty?></option>
                                  <option value="6 Months">6 Months</option>
                                  <option value="1 Year">1 Year</option>
                                  <option value="2 Years">2 Years</option>
                                  <option value="3 Years">3 Years</option>
                                  <option value="5 Years">5 Years</option>
                                  <option value="Lifetime">Lifetime</option>
                                </select>
                              </div>
                            </div>
                        <?php if(!empty($courier_size)){ ?>    
                            <div class="col-md-5">
                              <div class="form-group">
                                <label>Courier Size</label>
                                <select class="form-control" name="courier_size">
                                  <option value="<?=$courier_size?>" selected><?=$courier_size?></option>
                                  <?php 
                                        $sql = mysqli_query($con,"SELECT DISTINCT size from vendor_courier_sizes where vendor_id='$ven_id' AND delte = 0");
                                        $row = mysqli_num_rows($sql);
                                        while ($res = mysqli_fetch_array($sql)){

                                          echo '<option value="'.$res[0].'">'.$res[0].'</option>';
                                        }
                                  ?>
                                </select>
                              </div>
                            </div>
                        <?php } ?>    
                          </div>
                          <div class="form-group row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <div class="pretty p-switch">
                                  <input type="checkbox" value="Y" name="exclusive" <?php if($exclusive == 'Y'){ ?> checked <?php }?>/>
                                  <div class="state p-warning">
                                    <label>Exclusive</label>
                                  </div>
                                </div>
                            </div> 
                            <div class="col-md-2"></div>   
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <?php if($approved == 'N'){ ?>
                          <input type="button" class="btn btn-primary" type="submit" name="reject-product" onclick="rejectSubmit()" value="Reject your Product">  
                          <input type="button" class="btn btn-danger" type="submit" name="acceptproduct" onclick="formSubmit()" value="Approve your Product">
                        <?php }else{?>
                          <input type="button" class="btn btn-info" type="submit" name="update-product" value="Product is approved">
                        <?php } ?>
                          <input type="button" class="btn btn-warning" type="submit" name="update-product" onclick="submitBtn()" value="Submit"></button>
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
  function submitBtn(){

  $('#action').val('saveproduct');
  $('#productForm').submit();
}
function formSubmit(){

    $('#action').val('acceptproduct');
    $('#productForm').submit();

}
function rejectSubmit(){

  $('#action').val('rejectproduct');
    $('#productForm').submit();
}
    ///////-----------------Brands Add Function ------------////////

    function saveBrands(){

      $.ajax({
        type:"post",
        url:"action/saveBrands.php",
        data:$('#brand-form').serialize(),
        success:function(data){

            $("#brandsModel").modal('hide');

              alert("Brands Added Successfully");
              location.reload();
                 
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
              location.reload();
        }
      });
    }
    ////////////////////////////////////////
    ///--------- upload image1 ----------//

    $(document).ready(function(){
       $(document).on('change', '#file1', function(){
        var name = document.getElementById("file1").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        {
         alert("Invalid Image File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file1").files[0]);
        var f = document.getElementById("file1").files[0];
        var fsize = f.size||f.fileSize;
       
         form_data.append("file1", document.getElementById('file1').files[0]);
         $.ajax({
          url:"action/uploadimg1.php",
          method:"POST",
          data: form_data,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend:function(){
           $('#uploaded_image1').html("<label class='text-success'>Image Uploading...</label>");
          },   
          success:function(data)
          {
            $('#uploaded_image1').html(null);
           $('#uploaded_image1').html(data[0]);
           $('#image1').val(data[1]);
          }
         });
        
       });
    });
    ////////////////////////////////////////
    ///--------- upload image2 ----------//

    $(document).ready(function(){
       $(document).on('change', '#file2', function(){
        var name = document.getElementById("file2").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        {
         alert("Invalid Image File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file2").files[0]);
        var f = document.getElementById("file2").files[0];
        var fsize = f.size||f.fileSize;
       
         form_data.append("file2", document.getElementById('file2').files[0]);
         $.ajax({
          url:"action/uploadimg2.php",
          method:"POST",
          data: form_data,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend:function(){
           $('#uploaded_image2').html("<label class='text-success'>Image Uploading...</label>");
          },   
          success:function(data)
          {
           $('#uploaded_image2').html(data[0]);
           $('#image2').val(data[1]);
          }
         });
        
       });
    });
    ////////////////////////////////////////
    ///--------- upload image3 ----------//

    $(document).ready(function(){
       $(document).on('change', '#file3', function(){
        var name = document.getElementById("file3").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        {
         alert("Invalid Image File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file3").files[0]);
        var f = document.getElementById("file3").files[0];
        var fsize = f.size||f.fileSize;
       
         form_data.append("file3", document.getElementById('file3').files[0]);
         $.ajax({
          url:"action/uploadimg3.php",
          method:"POST",
          data: form_data,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend:function(){
           $('#uploaded_image3').html("<label class='text-success'>Image Uploading...</label>");
          },   
          success:function(data)
          {
           $('#uploaded_image3').html(data[0]);
           $('#image3').val(data[1]);
          }
         });
        
       });
    });
    ////////////////////////////////////////
    ///--------- upload image4 ----------//

    $(document).ready(function(){
       $(document).on('change', '#file4', function(){
        var name = document.getElementById("file4").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        {
         alert("Invalid Image File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file4").files[0]);
        var f = document.getElementById("file4").files[0];
        var fsize = f.size||f.fileSize;
       
         form_data.append("file4", document.getElementById('file4').files[0]);
         $.ajax({
          url:"action/uploadimg4.php",
          method:"POST",
          data: form_data,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend:function(){
           $('#uploaded_image4').html("<label class='text-success'>Image Uploading...</label>");
          },   
          success:function(data)
          {
           $('#uploaded_image4').html(data[0]);
           $('#image4').val(data[1]);
          }
         });
        
       });
    });


 //////////------------------- Brands Search Function -------------------- //////////////////


    function searchBrands(){

        var keyword = $('#brandkeyword').val();
        if (keyword.length>=3) {

            $.ajax({
              type: "POST",
              url: 'action/brandSearch.php',
              data: {keyword:keyword},
              success:function(data){

                  // console.log(data);
                  $('#brandslist').show();
                  $('#brandslist').html(data);
              }
            });
        }
    }

    function addBrand(el,id){

        var brand = $(el).html();
        $('#brandid').val(id);
        $('#brandkeyword').val(brand);
        $('#brandslist').html(null);
        $('#brandslist').hide();
        $('#brandkeyword').prop('readonly',true);
        
    }
    
///////////////////////////////////////////////////

</script>
