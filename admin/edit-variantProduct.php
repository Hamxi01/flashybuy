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
        $courier_size          = $result['courier_size'];
        $warranty              = $result['warranty'];
        $exclusive             = $result['exclusive'];
        $approved              = $result['approved'];
        $keyword               = $result['keyword'];
        $description           = $result['description'];
        $ven_id                = $result['ven_id'];
        $keywordid              = explode(',',$keyword);
  }
   
}
if (isset($_POST['action'])&& $_POST['action'] == "rejectproduct") {

  // $variation_id                    =     addslashes($_POST['variation_id']);
  $product_id                      =     addslashes($_POST['id']);
  $ven_id                          =     addslashes($_POST['ven_id']);
  $name                            =     addslashes($_POST['name']);
  $category_id                     =     addslashes($_POST['cat_id']);
  $subcategory_id                  =     addslashes($_POST['sub_cat_id']);
  $subsubcategory_id               =     addslashes($_POST['sub_sub_cat_id']);
  $brand                           =     addslashes($_POST['brand']);
  foreach ($_POST['keyword'] as $key => $value) {
            
    $keyword     =  implode(',' , $_POST['keyword']);

  }
  if (isset($_POST['width'])) {
    
      $width                           =     addslashes($_POST['width']);
      $height                          =     addslashes($_POST['height']);
      $length                          =     addslashes($_POST['length']);
  }
  if (isset($_POST['courier_size'])) {

       $courier_size                    =     addslashes($_POST['courier_size']);
  }
  
  $description                     =     addslashes($_POST['description']);
  $warranty                        =     addslashes($_POST['warranty']);
  $approved                        =     'N';
      
  if (isset($_POST['exclusive'])) { 

       $exclusive                       =  addslashes($_POST['exclusive']);
       
  }else{

    $exclusive = 'N';
  }




     $query = "update products SET name='".$name."',cat_id='".$category_id."',sub_cat_id='".$subcategory_id."',sub_sub_cat_id='".$subsubcategory_id."',brand='".$brand."',length='".$length."',width='".$width."',height='".$height."',keyword='".$keyword."',approved='".$approved."',exclusive='".$exclusive."',courier_size='".$courier_size."',warranty='".$warranty."' Where product_id='".$product_id."'";

    foreach ($_POST['sku'] as $key => $value) {
      
          $vquery = "update product_variations SET quantity='".$_POST['qty'][$key]."',mk_price='".$_POST['mk_price'][$key]."',price='".$_POST['price'][$key]."',sku='".$_POST['sku'][$key]."',active='".$_POST['active'][$key]."' Where variation_id='".$_POST['variation_id'][$key]."'";
          mysqli_query($con,$vquery);

    }
foreach ($_POST['vi_id'] as $key => $vImageid) {

     $imagequery = "update product_variant_images SET image1='".$_POST['variant_img1'][$key]."',image2='".$_POST['variant_img2'][$key]."',image3='".$_POST['variant_img3'][$key]."',image4='".$_POST['variant_img4'][$key]."' where id='".$_POST['vi_id'][$key]."'";
     mysqli_query($con,$imagequery);
}
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
                $approvquery = "update vendor_product SET quantity='".$_POST['qty'][$key]."',price='".$_POST['price'][$key]."',mk_price='".$_POST['mk_price'][$key]."',active='".$active[$key]."' where prod_id ='".$product_id."' AND variation_id='".$_POST['variation_id'][$key]."' AND ven_id ='".$ven_id."'";
                mysqli_query($con,$approvquery);

          }else{

            $approvquery = "INSERT into vendor_product (prod_id,ven_id,variation_id,quantity,price,mk_price,active) VALUES ('".$product_id."','".$ven_id."','".$_POST['variation_id'][$key]."','".$_POST['qty'][$key]."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['active'][$key]."')";
            mysqli_query($con,$approvquery);
          }
      }
      
  //----- Vendor product update and insert new data end ----////////////

     if (mysqli_query($con,$query)){

            echo "<script>window.location.assign('product.php');</script>";
        }
}
if (isset($_POST['action'])&& $_POST['action'] == "saveproduct") {

  // $variation_id                    =     addslashes($_POST['variation_id']);
  $product_id                      =     addslashes($_POST['id']);
  $ven_id                          =     addslashes($_POST['ven_id']);
  $name                            =     addslashes($_POST['name']);
  $category_id                     =     addslashes($_POST['cat_id']);
  $subcategory_id                  =     addslashes($_POST['sub_cat_id']);
  $subsubcategory_id               =     addslashes($_POST['sub_sub_cat_id']);
  $brand                           =     addslashes($_POST['brand']);
  foreach ($_POST['keyword'] as $key => $value) {
            
    $keyword     =  implode(',' , $_POST['keyword']);

  }
  if (isset($_POST['width'])) {
    
      $width                           =     addslashes($_POST['width']);
      $height                          =     addslashes($_POST['height']);
      $length                          =     addslashes($_POST['length']);
  }
  if (isset($_POST['courier_size'])) {

       $courier_size                    =     addslashes($_POST['courier_size']);
  }
  
  $description                     =     addslashes($_POST['description']);
  $warranty                        =     addslashes($_POST['warranty']);
  $approved                        =     'Y';
      
  if (isset($_POST['exclusive'])) { 

       $exclusive                       =  addslashes($_POST['exclusive']);
       
  }else{

    $exclusive = 'N';
  }




     $query = "update products SET name='".$name."',cat_id='".$category_id."',sub_cat_id='".$subcategory_id."',sub_sub_cat_id='".$subsubcategory_id."',brand='".$brand."',length='".$length."',width='".$width."',height='".$height."',keyword='".$keyword."',approved='".$approved."',exclusive='".$exclusive."',courier_size='".$courier_size."',warranty='".$warranty."' Where product_id='".$product_id."'";

    foreach ($_POST['sku'] as $key => $value) {
      
          $vquery = "update product_variations SET quantity='".$_POST['qty'][$key]."',mk_price='".$_POST['mk_price'][$key]."',price='".$_POST['price'][$key]."',sku='".$_POST['sku'][$key]."',active='".$_POST['active'][$key]."' Where variation_id='".$_POST['variation_id'][$key]."'";
          mysqli_query($con,$vquery);

    }
foreach ($_POST['vi_id'] as $key => $vImageid) {

     $imagequery = "update product_variant_images SET image1='".$_POST['variant_img1'][$key]."',image2='".$_POST['variant_img2'][$key]."',image3='".$_POST['variant_img3'][$key]."',image4='".$_POST['variant_img4'][$key]."' where id='".$_POST['vi_id'][$key]."'";
     // return;
     mysqli_query($con,$imagequery);
}
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
                $approvquery = "update vendor_product SET quantity='".$_POST['qty'][$key]."',price='".$_POST['price'][$key]."',mk_price='".$_POST['mk_price'][$key]."',active='".$active[$key]."' where prod_id ='".$product_id."' AND variation_id='".$_POST['variation_id'][$key]."' AND ven_id ='".$ven_id."'";
                mysqli_query($con,$approvquery);

          }else{

            $approvquery = "INSERT into vendor_product (prod_id,ven_id,variation_id,quantity,price,mk_price,active) VALUES ('".$product_id."','".$ven_id."','".$_POST['variation_id'][$key]."','".$_POST['qty'][$key]."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['active'][$key]."')";
            mysqli_query($con,$approvquery);
          }
      }
      
  //----- Vendor product update and insert new data end ----////////////

     if (mysqli_query($con,$query)){

            echo "<script>window.location.assign('product.php');</script>";
        }
}


if (isset($_POST['action']) && $_POST['action'] == "acceptproduct") {

  // $variation_id                    =     addslashes($_POST['variation_id']);
  $product_id                      =     addslashes($_POST['id']);
  $ven_id                          =     addslashes($_POST['ven_id']);
  $name                            =     addslashes($_POST['name']);
  $category_id                     =     addslashes($_POST['cat_id']);
  $subcategory_id                  =     addslashes($_POST['sub_cat_id']);
  $subsubcategory_id               =     addslashes($_POST['sub_sub_cat_id']);
  $brand                           =     addslashes($_POST['brand']);
  foreach ($_POST['keyword'] as $key => $value) {
            
    $keyword     =  implode(',' , $_POST['keyword']);

  }
  if (isset($_POST['width'])) {
    
      $width                           =     addslashes($_POST['width']);
      $height                          =     addslashes($_POST['height']);
      $length                          =     addslashes($_POST['length']);
  }
  if (isset($_POST['courier_size'])) {

       $courier_size                    =     addslashes($_POST['courier_size']);
  }
  
  $description                     =     addslashes($_POST['description']);
  $warranty                        =     addslashes($_POST['warranty']);
  $approved                        =     'Y';
      
  if (isset($_POST['exclusive'])) { 

       $exclusive                       =  addslashes($_POST['exclusive']);
       
  }else{

    $exclusive = 'N';
  }




     $query = "update products SET name='".$name."',cat_id='".$category_id."',sub_cat_id='".$subcategory_id."',sub_sub_cat_id='".$subsubcategory_id."',brand='".$brand."',length='".$length."',width='".$width."',height='".$height."',keyword='".$keyword."',approved='".$approved."',exclusive='".$exclusive."',courier_size='".$courier_size."',warranty='".$warranty."' Where product_id='".$product_id."'";

    foreach ($_POST['sku'] as $key => $value) {
      
          $vquery = "update product_variations SET quantity='".$_POST['qty'][$key]."',mk_price='".$_POST['mk_price'][$key]."',price='".$_POST['price'][$key]."',sku='".$_POST['sku'][$key]."',active='".$_POST['active'][$key]."' Where variation_id='".$_POST['variation_id'][$key]."'";
          mysqli_query($con,$vquery);

    }
foreach ($_POST['vi_id'] as $key => $vImageid) {

     $imagequery = "update product_variant_images SET image1='".$_POST['variant_img1'][$key]."',image2='".$_POST['variant_img2'][$key]."',image3='".$_POST['variant_img3'][$key]."',image4='".$_POST['variant_img4'][$key]."' where id='".$_POST['vi_id'][$key]."'";
     mysqli_query($con,$imagequery);
}
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
                $approvquery = "update vendor_product SET quantity='".$_POST['qty'][$key]."',price='".$_POST['price'][$key]."',mk_price='".$_POST['mk_price'][$key]."',active='".$active[$key]."' where prod_id ='".$product_id."' AND variation_id='".$_POST['variation_id'][$key]."' AND ven_id ='".$ven_id."'";
                mysqli_query($con,$approvquery);

          }else{

            $approvquery = "INSERT into vendor_product (prod_id,ven_id,variation_id,quantity,price,mk_price,active) VALUES ('".$product_id."','".$ven_id."','".$_POST['variation_id'][$key]."','".$_POST['qty'][$key]."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['active'][$key]."')";
            mysqli_query($con,$approvquery);
          }
      }
      
  //----- Vendor product update and insert new data end ----////////////

     if (mysqli_query($con,$query)){

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
                      <form class="needs-validation" novalidate=""  method="post" action="" enctype="multipart/form-data" id="productForm">
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
                                            
                                          $sql = mysqli_query($con, "SELECT * From keywords where delte = 0 AND keyword_id ='$keywordid[$key]'");
                                          
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
                                          <label for="" class="control-label">Market Price</label>
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
                                    <td><input type="number" name="mk_price[]" value="<?=$res['mk_price']?>" min="1" step="1" class="form-control" required></td>
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
                          <div class="form-group row">
                            <?php 
                                $sql   = "SELECT * from product_variant_images WHERE product_id='$product_id' GROUP BY id";
                                $query = mysqli_query($con,$sql);
                                while ( $imageRes = mysqli_fetch_array($query)) {
                                    
                                      $image1                = $imageRes['image1'];
                                      $image2                = $imageRes['image2'];
                                      $image3                = $imageRes['image3'];
                                      $image4                = $imageRes['image4'];
                                      $id                    = $imageRes['id'];
                                      $num=rand();
                                 ?>
                                 <input type="hidden" name="vi_id[]" value="<?=$id?>">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image1</label>
                                  <input type="file" name="<?=$num?>1" id="<?=$num?>1" class="form-control" value="">
                                  <span id="<?=$num?>11"><img src="../upload/product/200_<?=$image1?>" width="180" height="160">
                                    <input type="hidden" name="variant_img1[]" value="<?=$image1?>">
                                  </span>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image2</label>
                                  <input type="file" name="<?=$num?>2" id="<?=$num?>2"  class="form-control" value="">
                                  <span id="<?=$num?>12"><img src="../upload/product/200_<?=$image2?>" width="180" height="160">
                                    <input type="hidden" name="variant_img2[]" value="<?=$image2?>">
                                  </span>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image3</label>
                                  <input type="file" name="<?=$num?>3" id="<?=$num?>3"  class="form-control" value="">
                                  <span id="<?=$num?>13"><img src="../upload/product/200_<?=$image3?>" width="180" height="160">
                                    <input type="hidden" name="variant_img3[]" value="<?=$image3?>">
                                  </span>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image4</label>
                                  <input type="file" name="<?=$num?>4" id="<?=$num?>4"  class="form-control" value="">
                                  <span id="<?=$num?>14"><img src="../upload/product/200_<?=$image4?>" width="180" height="160">
                                    <input type="hidden" name="variant_img4[]" value="<?=$image4?>">
                                  </span>
                                </div>
                              </div>
<script type="text/javascript">
  $(document).ready(function(){
 $(document).on('change', '#<?=$num?>1', function(){
  var name = document.getElementById("<?=$num?>1").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("<?=$num?>1").files[0]);
  var f = document.getElementById("<?=$num?>1").files[0];
  var fsize = f.size||f.fileSize;

 // =========== image Size Check and ajax function ========== //

      if(fsize <=2048000){

         form_data.append("file", document.getElementById('<?=$num?>1').files[0]);
         $.ajax({
                  url:"action/variantuploadimg1.php",
                  method:"POST",
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend:function(){

                // ====== Loader ====== //
                    $('#<?=$num?>11').html('<img src="assets/img/loading.gif" class="img-responsive">');
                  },   
                  success:function(data)
                  {
                   $('#<?=$num?>11').html(data);
                   
                  }
         });

      }else{

        $('#<?=$num?>11').html('<label class="text-danger">Sorry!Image Size is greater than 2MB</label>');
      }

 // =========== End image Size Check and ajax function ========== //

 });
});
$(document).ready(function(){
 $(document).on('change', '#<?=$num?>2', function(){
  var name = document.getElementById("<?=$num?>2").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("<?=$num?>2").files[0]);
  var f = document.getElementById("<?=$num?>2").files[0];
  var fsize = f.size||f.fileSize;

 // =========== image Size Check and ajax function ========== //

      if (fsize <= 2048000) {
          form_data.append("file", document.getElementById('<?=$num?>2').files[0]);
           $.ajax({
                    url:"action/variantuploadimg2.php",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                     
                     // ============== Loader ========= //
                      $('#<?=$num?>12').html('<img src="assets/img/loading.gif" class="img-responsive">')
                    },  
                    success:function(data)
                    {
                      $('#<?=$num?>12').html(data);
                    }
           });
    }else{

        $('#<?=$num?>12').html('<label class="text-danger">Sorry!Image Size is greater than 2MB</label>');
    }

 // =========== End image Size Check and ajax function ========== //

 });
});
$(document).ready(function(){
 $(document).on('change', '#<?=$num?>3', function(){
  var name = document.getElementById("<?=$num?>3").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("<?=$num?>3").files[0]);
  var f = document.getElementById("<?=$num?>3").files[0];
  var fsize = f.size||f.fileSize;

 // =========== image Size Check and ajax function ========== //

      if (fsize <= 2048000) {

          form_data.append("file", document.getElementById('<?=$num?>3').files[0]);
           $.ajax({
                  url:"action/variantuploadimg3.php",
                  method:"POST",
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend:function(){

                    // ========== Image Loader =========== //

                    $('#<?=$num?>13').html('<img src="assets/img/loading.gif" class=img-responsive>')
                  },   
                  success:function(data)
                  {
                    $('#<?=$num?>13').html(data);
                  }
           });

      }else{

          $('#<?=$num?>13').html('<label class="text-danger">Sorry! Image Size is greater than 2MB</label>');
      }

 // =========== End image Size Check and ajax function ========== //      
 });
});
$(document).ready(function(){
 $(document).on('change', '#<?=$num?>4', function(){
  var name = document.getElementById("<?=$num?>4").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("<?=$num?>4").files[0]);
  var f = document.getElementById("<?=$num?>4").files[0];
  var fsize = f.size||f.fileSize;

// ====== image size check and ajax function ============= //

      if (fsize <= 2048000) {

           form_data.append("file", document.getElementById('<?=$num?>4').files[0]);
             $.ajax({
                      url:"action/variantuploadimg4.php",
                      method:"POST",
                      data: form_data,
                      contentType: false,
                      cache: false,
                      processData: false,
                      beforeSend:function(){

                        // =========== Image Loader ======== //

                        $('#<?=$num?>14').html('<img src="assets/img/loading.gif" class="img-responsive">')

                      },   
                      success:function(data)
                      {
                        $('#<?=$num?>14').html(data);
                      }
             });

      }else{

              $('#<?=$num?>14').html('<label class="text-danger">Sorry!Image Size is greater than 2MB</label>');
      }
 // =========== End image Size Check and ajax function ========== //       
 });
});
</script>
                             <?php  } ?> 
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
                            <div class="col-md-4">
                                <div class="pretty p-switch">
                                  <input type="checkbox" value="Y" name="exclusive" <?php if($exclusive == 'Y'){ ?> checked <?php }?>/>
                                  <div class="state p-warning">
                                    <label>Exclusive</label>
                                  </div>
                                </div>
                            </div> 
                            <!-- <div class="col-md-4">
                                <div class="pretty p-switch">
                                  <input type="checkbox" value="Y" name="approved" <?php if($approved == 'Y'){ ?> checked <?php }?>  />
                                  <div class="state p-warning">
                                      <label>Product Approved</label>
                                  </div>
                                </div>
                            </div> --> 
                          </div>
                        </div>
                        <input type="hidden" name="action" id="action">
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
////
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
