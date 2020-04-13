<?php
 
include('../includes/db.php');
include('includes/header.php');
include('includes/sidebar.php');
?>
<style type="text/css">
  .select2-container {
        min-width: 600px !important;
  }
  input#categorysearch,#subcategorysearch,#subsubcategorysearch {
      border: 1px solid;
      border-radius: 25px;
      width: 230px;
      position: relative;
      left: 10px;
      height: 35px;
  }
  #categories li{
        list-style: none;
        position: relative;
        left: -15px;
        top: 10px;
    }
    #categories li.selected {
        background: #4c5667;
        padding: 5px;
        color: #fff;
        border: 1px black solid;
        list-style: none;
        border-radius: 20px;
        text-align: center;    
    }
    #subcategories li{
        list-style: none;
        position: relative;
        left: -15px;
        top: 10px;
    }
    #subcategories li.selected {
        background: #4c5667;
        padding: 5px;
        color: #fff;
        border: 1px black solid;
        list-style: none;
        border-radius: 20px;
        text-align: center;    
    }
    #subsubcategories li{
        list-style: none;
        position: relative;
        left: -15px;
        top: 10px;
    }
    #subsubcategories li.selected {
        background: #4c5667;
        padding: 5px;
        color: #fff;
        border: 1px black solid;
        list-style: none;
        border-radius: 20px;
        text-align: center;    
    }
    .subcategories{

        border-left: 1px solid grey;
        min-height: 300px;
    }
    .subsubcategories{

        border-left: 1px solid grey;
        min-height: 300px;
    }
</style>
<?php
if (isset($_POST['update-product'])) {

  $product_id                      =     $_POST['id'];
  $name                            =     $_POST['name'];
  $category_id                     =     $_POST['cat_id'];
  $subcategory_id                  =     $_POST['sub_cat_id'];
  $subsubcategory_id               =     $_POST['sub_sub_cat_id'];
  $brand                           =     $_POST['brand'];
  $keyword                         =     $_POST['keyword'];
  $market_price                    =     $_POST['market_price'];  
  $selling_price                   =     $_POST['selling_price'];
  $quantity                        =     $_POST['quantity'];
  $width                           =     $_POST['width'];
  $height                          =     $_POST['height'];
  $length                          =     $_POST['length'];
  // $courier_size                 =     $_POST['courier_size'];
  $description                     =     $_POST['description'];
  $sku                             =     str_replace(" ","-", $name);

// upload and crop image1 //
if (isset($_FILES['file1']["name"]) && !empty($_FILES['file1']["name"])) {

    $filename = $_FILES["file1"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic1extension = strtolower($extension);
    $pic1 = time().rand();
    $pic1we=$pic1.".".$pic1extension;
    $location = "../../upload/product/".$pic1we;
    
  if(move_uploaded_file($_FILES["file1"]["tmp_name"], $location)){

          try {
            $image = new ImageResize($location);
            $image->quality_jpg = 85;
            $image->resizeToWidth(800);
            $image->resizeToHeight(800);
            $new_name = '800_' . $pic1 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
    
        } catch (ImageResizeException $e) {
            return null;
        }
      try {
            $image = new ImageResize($location);
            $image->quality_jpg = 85;
            $image->resizeToWidth(300);
            $image->resizeToHeight(300);
            $new_name = '300_' . $pic1 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
          
        } catch (ImageResizeException $e) {
            return null;
        }
      try {
            $image = new ImageResize($location);
            $image->quality_jpg = 85;
            $image->resizeToWidth(200);
            $image->resizeToHeight(150);
            $new_name = '200_' . $pic1 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
          
        } catch (ImageResizeException $e) {
            return null;
        }

  }
}

// upload and crop image2 //
if (isset($_FILES['file2']["name"]) && !empty($_FILES['file2']["name"])) {

    $filename = $_FILES["file2"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic2extension = strtolower($extension);
    $pic2 = time().rand();
    $pic2we=$pic2.".".$pic2extension;
    $location2 = "../../upload/product/".$pic2we;
    
  if(move_uploaded_file($_FILES["file2"]["tmp_name"], $location2)){

          try {
            $image = new ImageResize($location2);
            $image->quality_jpg = 85;
            $image->resizeToWidth(800);
            $image->resizeToHeight(800);
            $new_name = '800_' . $pic2 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
    
        } catch (ImageResizeException $e) {
            return null;
        }
      try {
            $image = new ImageResize($location2);
            $image->quality_jpg = 85;
            $image->resizeToWidth(300);
            $image->resizeToHeight(300);
            $new_name = '300_' . $pic2 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
          
        } catch (ImageResizeException $e) {
            return null;
        }
      try {
            $image = new ImageResize($location2);
            $image->quality_jpg = 85;
            $image->resizeToWidth(200);
            $image->resizeToHeight(150);
            $new_name = '200_' . $pic2 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
          
        } catch (ImageResizeException $e) {
            return null;
        }

  }
}
// upload and crop image3 //
if (isset($_FILES['file3']["name"]) && !empty($_FILES['file3']["name"])) {

    $filename = $_FILES["file3"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic3extension = strtolower($extension);
    $pic3 = time().rand();
    $pic3we=$pic3.".".$pic3extension;
    $location3 = "../../upload/product/".$pic3we;
    
  if(move_uploaded_file($_FILES["file3"]["tmp_name"], $location3)){

          try {
            $image = new ImageResize($location3);
            $image->quality_jpg = 85;
            $image->resizeToWidth(800);
            $image->resizeToHeight(800);
            $new_name = '800_' . $pic3 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
    
        } catch (ImageResizeException $e) {
            return null;
        }
      try {
            $image = new ImageResize($location3);
            $image->quality_jpg = 85;
            $image->resizeToWidth(300);
            $image->resizeToHeight(300);
            $new_name = '300_' . $pic3 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
          
        } catch (ImageResizeException $e) {
            return null;
        }
      try {
            $image = new ImageResize($location3);
            $image->quality_jpg = 85;
            $image->resizeToWidth(200);
            $image->resizeToHeight(150);
            $new_name = '200_' . $pic3 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
          
        } catch (ImageResizeException $e) {
            return null;
        }

  }
}
// upload and crop image1 //
if (isset($_FILES['file4']["name"]) && !empty($_FILES['file4']["name"])) {

    $filename = $_FILES["file4"]["name"];
    $extension = @end(explode('.', $filename)); // explode the image name to get the extension
    $pic4extension = strtolower($extension);
    $pic4 = time().rand();
    $pic4we=$pic4.".".$pic4extension;
    $location4 = "../../upload/product/".$pic4we;
    
  if(move_uploaded_file($_FILES["file4"]["tmp_name"], $location4)){

          try {
            $image = new ImageResize($location4);
            $image->quality_jpg = 85;
            $image->resizeToWidth(800);
            $image->resizeToHeight(800);
            $new_name = '800_' . $pic4 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
    
        } catch (ImageResizeException $e) {
            return null;
        }
      try {
            $image = new ImageResize($location4);
            $image->quality_jpg = 85;
            $image->resizeToWidth(300);
            $image->resizeToHeight(300);
            $new_name = '300_' . $pic4 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
          
        } catch (ImageResizeException $e) {
            return null;
        }
      try {
            $image = new ImageResize($location4);
            $image->quality_jpg = 85;
            $image->resizeToWidth(200);
            $image->resizeToHeight(150);
            $new_name = '200_' . $pic4 . '.jpg';
            $new_path = '../../upload/product/' . $new_name;
            $image->save($new_path, IMAGETYPE_JPEG);
          
        } catch (ImageResizeException $e) {
            return null;
        }

  }
}


     $query = "update products SET name='".$name."',cat_id='".$category_id."',sub_cat_id='".$subcategory_id."',sub_sub_cat_id='".$subsubcategory_id."',brand='".$brand."',quantity='".$quantity."',market_price='".$market_price."',selling_price='".$selling_price."',length='".$length."',width='".$width."',height='".$height."',keyword='".$keyword."',sku='".$sku."',image1='".$pic1."',image2='".$pic2."',image3='".$pic3."',image4='".$pic4."' Where product_id='".$product_id."'";

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
                      <form class="needs-validation" novalidate="" method="post" action="" enctype="multipart/form-data" id="product_form">
                        <div class="card-header">
                          <h4>Add Your Products</h4>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                              <label class="col-form-label">Product Name</label>
                                <input type="text" class="form-control" required="" name="name" value="">
                                <div class="invalid-feedback">
                                  What's Product name?
                                </div>
                          </div>  
                            <div class="form-group row"> 
                                
                                  <label>Choose Categories</label>
                                  <input type="text" parsley-trigger="change" required  class="form-control" data-toggle="modal" data-target=".bd-example-modal-lg" id="categories_name" value="Select Category">
                                  <input type="hidden" name="category_id" id="category_id" value="" required>
                                  <input type="hidden" name="subcategory_id" id="subcategory_id" value="" required>
                                  <input type="hidden" name="subsubcategory_id" id="subsubcategory_id" value="" required>
                            </div>
                            <div class="form-group row">
                                    <label>Choose Brands</label>
                                    <select class="form-control select2" required="" name="brand">
                                        
                                      <?php 

                                          $sql = mysqli_query($con, "SELECT * From brands where delte = 0");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['id']?>"><?=$res['name']?></option>
                                            
                                        <?php  }
                                      ?>
                                    </select>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-12">
                                <label class="col-form-label">Description</label>
                                    <textarea class="form-control" required="" name="description"></textarea>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-4">
                                  <div class="pretty p-switch">
                                    <input type="checkbox" value="Y"  id="variations" onchange="showVariations()"/>
                                    <div class="state p-warning">
                                        <label><b>Do you have product variations?</b></label>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-2"></div>   
                            </div>
                            <div class="form-group row" id="price_section">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>Market Price</label>
                                  <input type="number" name="market_price" required="" class="form-control" value="">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Selling Price</label>
                                  <input type="number" name="selling_price" required="" class="form-control" value="">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Quantity</label>
                                  <input type="number" name="quantity" required="" class="form-control" value="">
                                </div>
                              </div> 
                          </div>

                          <div class="form-group row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>Width</label>
                                  <input type="number" name="width" required="" class="form-control" value="">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Height</label>
                                  <input type="number" name="height" required="" class="form-control" value="">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Length</label>
                                  <input type="number" name="length" required="" class="form-control" value="">
                                </div>
                              </div> 
                          </div>
                          <div class="form-group row">
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label>Image1</label>
                                  <input type="file" name="file1" class="form-control" value="">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image2</label>
                                  <input type="file" name="file2" class="form-control" value="">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image3</label>
                                  <input type="file" name="file3" class="form-control" value="">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image4</label>
                                  <input type="file" name="file4" class="form-control" value="">
                                </div>
                              </div>  
                          </div>
                          <div class="form-group row">
                              <div class="col-md-4 offset-md-4">
                                <h3>Variations</h3>
                              </div>
                          </div>
                          <div class="form-group row" id="variations_value">
                            <div class="col-md-3">
                              <label>Product Variants (Options)</label>
                            </div>  
                            <div class="col-md-9">
                                <select class="form-control select2" required="" onchange="variationsName()" name="variationname[]" id="variations_name" placeholder="choose" multiple="">
                                </select>  
                            </div>
                          </div><br>
                          <div class="form-group row" id="varition-options">
                                                    
                          </div><br>
                          <div class="form-group row">
                            <table class="table table-bordered" id="variant_table" style="display: none;">
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
                                  </tr>
                              </thead>
                              <tbody id="variant_combinations">
                              </tbody>
                          </table>
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
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                      <form role="search" class="app-search" novalidate="">
                          <input type="text" placeholder="Search..." id="categorysearch" oninput="categorySearch()" class="form-control app-search-input" data-parsley-id="4">
                      </form>
                       <ul id="categories">
                          <?php

                              $sql = mysqli_query($con, "SELECT * From categories where delte = 0");
                              $row = mysqli_num_rows($sql);
                              while ($row = mysqli_fetch_array($sql)){
                                  
                          ?>
                           <li onclick="get_subcategories_by_category(this, <?php echo $row['cat_id']?>)"><?php echo $row['name']?></li>
                       <?php } ?>

                       </ul>
                    </div>
                    <div class="col-lg-4 subcategories">
                      <form role="search" class="app-search" novalidate="" style="display: none">
                          <input type="text" placeholder="Search..." id="subcategorysearch" oninput="subcategorySearch()" class="form-control app-search-input" data-parsley-id="4">
                      </form>
                        <ul id="subcategories">
                            
                        </ul>
                    </div>
                    <div class="col-lg-4 subsubcategories">
                          <form role="search" class="app-search" novalidate="" style="display: none">
                              <input type="text" placeholder="Search..." id="subsubcategorysearch" oninput="subsubcategorySearch()" class="form-control app-search-input" data-parsley-id="4">
                          </form>                                                        
                        <ul id="subsubcategories">
                            
                        </ul>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-2 col-sm-offset-9">
                        <button class="btn btn-success waves-effect w-md waves-light m-b-5" onclick="closeModal()">confirm</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
 
<?php include('includes/footer.php');?>
  <script src="assets/bundles/izitoast/js/iziToast.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/toastr.js"></script>
<script type="text/javascript">

        var category_name = "";
        var subcategory_name = "";
        var subsubcategory_name = "";

        var category_id = null;
        var subcategory_id = null;
        var subsubcategory_id = null;

            function list_item_highlight(el){
                $(el).parent().children().each(function(){
                    $(this).removeClass('selected');
                });
                $(el).addClass('selected');
            }
        function get_subcategories_by_category(el, cat_id){
            list_item_highlight(el);
            category_id = cat_id;
            category_name = $(el).html();
            $('#subcategories').html(null);
            $('#subsubcategories').html(null);
            $.ajax({
                type: "POST",
                url: 'action/getsubcategories.php',
                data: {category_id:category_id},
                success:function(data){

                        $('#subcategories').append(data);
                        $(".subcategories .app-search").css("display","");
                }
            });
        }
        function get_subsubcategories_by_subcategory(el, cat_id){
            list_item_highlight(el);
            subcategory_id = cat_id;
            subsubcategory_name = "";
            subsubcategory_id= null;
            sub_category_name = $(el).html();
            $('#subsubcategories').html(null);
            $.ajax({
                type: "POST",
                url: 'action/getsubsubcategories.php',
                data: {category_id:subcategory_id},
                success:function(data){
                
                        $('#subsubcategories').append(data);
                        $(".subsubcategories .app-search").css("display","");
                }
            });
        }
        function confirm_subsubcategory(el, subsubcat_id){
            list_item_highlight(el);
            subsubcategory_id = subsubcat_id;
            subsubcategory_name = $(el).html();
            fetch_Variations(subsubcategory_id);
            fetch_variant_options(subsubcategory_id);
        }
        function fetch_Variations(id){
            $('#variations_name').html(null);
            $.ajax({
                type: "POST",
                url: 'action/getvariations.php',
                data: {sub_sub_cat:id},
                success:function(data){
                
                        $('#variations_name').append(data);
                        // console.log(data);
                    
                }
            });


        }
////////////////////////

///////////////////////////////////////
////---- Variant Options ---------////
////////////////////////////////////// 

        function fetch_variant_options(id){
            // $('#variations_name').html(null);
            $.ajax({
                type: "POST",
                url: 'action/getvariantoptions.php',
                data: {subsubcategoryid:id},
                success:function(data){
                        // console.log(data);
                        $('#variant_options').append(data);
                        $('#custom_options').val('Y');
                    
                }
            });


        }
///////////////////////////////////////
////---- Variant Options ---------////
//////////////////////////////////////       
        function closeModal(){
            if(category_id > 0 && subcategory_id > 0 && subsubcategory_id > 0){
                $('#category_id').val(category_id);
                $('#subcategory_id').val(subcategory_id);
                $('#subsubcategory_id').val(subsubcategory_id);
                $('#categories_name').val(category_name+'>'+sub_category_name+'>'+subsubcategory_name);
                $('#categories_name').prop('readonly', true);
                $('.bd-example-modal-lg').modal('hide');
            }
            else{
                alert('Please choose categories...');
            }
        }
        $(".select2").select2();
        function showVariations(){

            var variations = $('#variations').val();
            if (variations=='Y') {

                $("#variations_value").css("display","");
                $("#price_section").css("display","none");
                $('#variations').val('N');
            }
            else{

                $("#variations_value").css("display","none");
                $("#price_section").css("display","");
                $('#variations').val('Y');
            }  
        }
/////////////////////////////////
    //Append attribute/////
////////////////////////////////
var i = 0;
function variationsName(){

    $('#varition-options').html(null);
    $("#variation_image").html(null);
    $("select#variations_name :selected").each(function() {
        vari = $(this).val();
        if (vari != null) {
            if(vari == 'Color'){
                $("#varition-options").append('<div class="form-group row '+vari+'"><div class="col-md-3"><input type="text"  value="'+vari+'" class="form-control" disabled=""><input type="hidden" name="vari[]" value="'+vari+'" class="form-control"><input type="hidden" name="vari_type[]" value="'+i+'" class="form-control"></div><div class="col-md-8"><input type="text" class="form-control tagsInput" onchange="update_sku();imagediv()" id="'+vari+'" name="options_'+i+'[]" value=""></div><div class="col-md-1"><button type="button" onclick="delete_row(this)" class="btn btn-danger text-danger"><i class="fas fa-trash-alt"></i></button></div></div><br>');
            }
            else{
                $("#varition-options").append('<div class="form-group row '+vari+'"><div class="col-md-3"><input type="text"  value="'+vari+'" class="form-control" disabled=""><input type="hidden" name="vari[]" value="'+vari+'" class="form-control"><input type="hidden" name="vari_type[]" value="'+i+'" class="form-control"></div><div class="col-md-8"><input type="text" class="form-control tagsInput" onchange="update_sku();" id="'+vari+'" name="options_'+i+'[]" value=""></div><div class="col-md-1"><button type="button" onclick="delete_row(this)" class="btn btn-danger text-danger"><i class="fas fa-trash-alt"></i></button></div></div><br>');
            }
                i++;
                $('.tagsInput').tagsinput('items');
                
        }
    });
    
        
}               

function delete_row(em){
            
     $(em).closest('.row').remove();
     var  va =$('.bootstrap-tagsinput').val(); 
     $("#variant_table").css("display","none");
     update_sku();
     imagediv();

}
function update_sku(){

    $.ajax({
                type: "POST",
                url: 'action/combinations.php',
                data: $('#product_form').serialize(),
                success:function(data){
                    // console.log(data);
                if (data != null) {

                    $("#variant_table").css("display","");
                    $('#variant_combinations').html(data);
                }

            }
    });
     
}

function imagediv(){
var s = new Array();
        $('#Color').on('itemAdded', function(event) {

           s =  $("#Color").val();
           $('#variation_image').html(null);
           var data = $('#product_form').serializeArray();
           data.push({name: 'color', value: s});
           // console.log(data);
           $.ajax({
                type: "POST",
                url: 'action/variant_image.php',
                data: data,
                success:function(data){
                    // console.log(data);
                     
                    $("#variation_image").append(data);
                    $("#images").css("display","none");

            }
        });
        });
        

} 

        //////////////////////////////////////////////////////
        //-----------  Category Search     ----------------//
        ////////////////////////////////////////////////////

        function categorySearch(){

           var keyword = $("#categorysearch").val();

                $.ajax({
                        type: "POST",
                        url: 'action/categorySearch.php',
                        data: {keyword:keyword},
                        success:function(data){
                            
                            $('#categories').html(null);
                            // swal("Congrats! SubCategories added succesfully")
                            $('#categories').append(data);
                            // console.log(data);

                        }
                });
           
        }


        //////////////////////////////////////////////////////
        //-------- End Category Search     ----------------//
        ////////////////////////////////////////////////////

        //////////////////////////////////////////////////////
        //-----------  SubCategory Search     -------------//
        ////////////////////////////////////////////////////

        function subcategorySearch(){

           var keyword = $("#subcategorysearch").val();

                $.ajax({
                        type: "POST",
                        url: 'action/subCategorySearch.php',
                        data: {keyword:keyword,id:category_id},
                        success:function(data){
                            
                            $('#subcategories').html(null);
                            // swal("Congrats! SubCategories added succesfully")
                            $('#subcategories').append(data);
                            // console.log(data);

                        }
                });
           
        }


        //////////////////////////////////////////////////////
        //-------- End subCategory Search    --------------//
        //////////////////////////////////////////////////// 

        //////////////////////////////////////////////////////
        //-----------  subSubCategory Search  -------------//
        ////////////////////////////////////////////////////

        function subsubcategorySearch(){

           var keyword = $("#subsubcategorysearch").val();

                $.ajax({
                        type: "POST",
                        url: 'action/subSubCategorySearch.php',
                        data: {keyword:keyword,id:subcategory_id},
                        success:function(data){
                            
                            $('#subsubcategories').html(null);
                            // swal("Congrats! SubCategories added succesfully")
                            $('#subsubcategories').append(data);
                            // console.log(data);

                        }
                });
           
        }


        //////////////////////////////////////////////////////
        //-------- End subsubCategory Search --------------//
        //////////////////////////////////////////////////// 


    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>  