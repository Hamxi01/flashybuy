<?php
 
include('../includes/db.php');
include('includes/header.php');
include('includes/sidebar.php');

if (isset($_GET['id']) && isset($_GET['variant_sku'])) {
  
  echo $_GET['id'];
  echo $_GET['variant_sku'];
}
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
        $exclusive             = $result['exclusive'];
        $image1                = $result['image1'];
        $image2                = $result['image2'];
        $image3                = $result['image3'];
        $image4                = $result['image4'];
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
                      <form class="needs-validation" novalidate="">
                        <div class="card-header">
                          <h4>Edit Your Products</h4>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                            <div class="col-md-10">
                              <label class="col-form-label">Product Name</label>
                                <input type="text" class="form-control" required="" value="<?=$name?>">
                                <div class="invalid-feedback">
                                  What's Product name?
                                </div>
                            </div>
                          </div>  
                          <div class="form-group row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>Categories</label>
                                  <select class="form-control select2" required="">
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
                                  <select class="form-control select2" required="">
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
                                  <select class="form-control select2" required="">
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
                                  
                                    <textarea class="form-control" required=""></textarea>
                                  
                                  
                              </div>
                            </div>

                            <div class="form-group row">
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label>Brands</label><button type="button" class="btn btn-warning btn-sm text-right" data-toggle="modal" data-target="#brandsModel" style="margin-left: 10px;margin-bottom: 3px;position: relative;left: 89px">Add new Brand</button>
                                    <select class="form-control select2" required="">
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
                                    <select class="form-control select2" required="" multiple="">
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
                                  <label>Market Price</label>
                                  <input type="number" name="" required="" class="form-control" value="<?=$market_price?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Selling Price</label>
                                  <input type="number" name="" required="" class="form-control" value="<?=$selling_price?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Quantity</label>
                                  <input type="number" name="" required="" class="form-control" value="<?=$stock?>">
                                </div>
                              </div> 
                          </div>
                          <div class="form-group row">
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label>Image1</label>
                                  <input type="file" name="" required="" class="form-control" value="<?=$image1?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image2</label>
                                  <input type="file" name="" required="" class="form-control" value="<?=$image2?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image3</label>
                                  <input type="file" name="" required="" class="form-control" value="<?=$image3?>">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image4</label>
                                  <input type="file" name="" required="" class="form-control" value="<?=$image4?>">
                                </div>
                              </div>  
                          </div>
                          <div class="form-group row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>Width</label>
                                  <input type="number" name="" required="" class="form-control" value="<?=$width?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Height</label>
                                  <input type="number" name="" required="" class="form-control" value="<?=$height?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Length</label>
                                  <input type="number" name="" required="" class="form-control" value="<?=$length?>">
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
                            <div class="col-md-5">
                                <div class="pretty p-switch">
                                  <input type="checkbox" value="Y" id="variant_permission" />
                                  <div class="state p-warning">
                                      <label>Do you want to add variations?</label>
                                  </div>
                                </div>
                            </div>   
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <button class="btn btn-warning">Submit</button>
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
