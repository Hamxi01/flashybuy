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
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
 <!-- Start Showing success or warning Msg -->
<?php
if (isset($_GET['msg']) && $_GET['msg'] ==  "error") {?>
    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <div class="alert alert-warning msg">    
    <?php echo "Something went wrong!"; ?>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo "<span>Data Inserted successfully...!!</span>"; ?>

        </div>
    </div>
</div>
<?php 
}?>
<!-- End Message Alert --> 
<?php
if (isset($_SESSION['id'])) 
 {
    $vendor_id = $_SESSION['id'];
 }
?>

           
            <div class="row">
              <div class="col-md-10 offset-md-1">
                
                    <div class="card">
                      <form  action="action/add_product.php" method="post"  enctype="multipart/form-data" id="product_form">
                        <div class="card-header">
                          <h4>Add Your Products</h4>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                            <input type="hidden" name="vendor_id" value="<?=$vendor_id?>">
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
                              <input type="text" name="" id="brandkeyword" class="form-control" oninput="searchBrands()">
                              <input type="hidden" name="brand" id="brandid" value="">
                              <ul id="brandslist">
                              </ul>
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
                                    <input type="checkbox" value="Y" name="variation_approval"  id="variations" onchange="showVariations()"/>
                                    <div class="state p-warning">
                                        <label><b>Do you have product variations?</b></label>
                                    </div>
                                  </div>
                              </div>
                              <?php 

                                    $sql = mysqli_query($con, "SELECT * From vendor where id = $vendor_id");
                                    $row = mysqli_num_rows($sql);
                                    while ($row = mysqli_fetch_array($sql)){
                                      if($row['exclusive_permission']=='Y'){

                              ?>
                              <div class="col-md-4">
                                  <div class="pretty p-switch">
                                    <input type="checkbox" value="Y" name="exclusive"  id="variations"/>
                                    <div class="state p-warning">
                                        <label><b>Exclusive</b></label>
                                    </div>
                                  </div>
                              </div>
                              <?php } }?>
                              <div class="col-md-2"></div>   
                            </div>
                            <div class="form-group row" id="price_section">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>Market Price</label>
                                  <input type="number" name="market_price"  class="form-control" value="">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Selling Price</label>
                                  <input type="number" name="selling_price"  class="form-control" value="">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Quantity</label>
                                  <input type="number" name="quantity"  class="form-control" value="">
                                </div>
                              </div> 
                          </div>
                          <?php 

                                $sql = mysqli_query($con, "SELECT * From vendor where id = $vendor_id");
                                $row = mysqli_num_rows($sql);
                                while ($row = mysqli_fetch_array($sql)){
                                  if($row['courier_permission']!='Y'){

                          ?>
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
                        <?php } } ?>
                          <div class="form-group row">
                            <?php 

                                    $sql = mysqli_query($con, "SELECT * From vendor where id = $vendor_id");
                                    $row = mysqli_num_rows($sql);
                                    while ($row = mysqli_fetch_array($sql)){
                                      if($row['courier_permission']=='Y'){

                              ?>
                                <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Courier Size</label>
                                      <select class="form-control" name="courier_size">
                                        <?php 
                                              $sql = mysqli_query($con,"SELECT DISTINCT size from vendor_courier_sizes where vendor_id='$vendor_id' AND delte = 0");
                                              $row = mysqli_num_rows($sql);
                                              while ($res = mysqli_fetch_array($sql)){

                                                echo '<option value="'.$res[0].'">'.$res[0].'</option>';
                                              }

                                        ?>
                                      </select>
                                    </div>
                                  </div>
                            <?php } } ?>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Warranty</label>
                                  <select name="warranty" required="" class="form-control">
                                    <option value="">Warranty</option>
                                    <option value="6 Months">6 Months</option>
                                    <option value="1 Year">1 Year</option>
                                    <option value="2 Years">2 Years</option>
                                    <option value="3 Years">3 Years</option>
                                    <option value="5 Years">5 Years</option>
                                    <option value="Lifetime">Lifetime</option>
                                  </select>
                                </div>
                              </div>
                              <!-- <div class="col-md-4">
                                <div class="form-group">
                                  <label>Length</label>
                                  <input type="number" name="length" required="" class="form-control" value="">
                                </div>
                              </div>  -->
                          </div>
                          <div class="form-group row" id="images">
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label>Image1</label>
                                  <input type="file" name="file1" class="form-control" value="" id="file1">
                                  <span id="uploaded_image"></span>
                                  <input type="hidden" name="image1" id="image1">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image2</label>
                                  <input type="file" name="file2" class="form-control" value="" id="file2">
                                  <span id="uploaded_image2"></span>
                                  <input type="hidden" name="image2" id="image2">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image3</label>
                                  <input type="file" name="file3" class="form-control" value="" id="file3">
                                  <span id="uploaded_image3"></span>
                                  <input type="hidden" name="image3" id="image3">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Image4</label>
                                  <input type="file" name="file4" class="form-control" value="" id="file4">
                                  <span id="uploaded_image4"></span>
                                  <input type="hidden" name="image4" id="image4">
                                </div>
                              </div>  
                          </div>
                          <div class="form-group row" id="variations_heading" style="display: none;">
                              <div class="col-md-4 offset-md-4">
                                <h3>Variations</h3>
                              </div>
                          </div>
                          <div class="form-group row" id="variations_value" style="display: none;">
                            <div class="col-md-3">
                              <label>Product Variants (Options)</label>
                            </div>  
                            <div class="col-md-9">
                                <select class="form-control select2"  onchange="variationsName()" name="variationname[]" id="variations_name" placeholder="choose" multiple="">
                                </select>  
                            </div>
                          </div>
                          <div class="form-group row" id="varition-options">
                                                    
                          </div>
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
                          <div class="form-group row" id="variation_image">
                                                
                          </div>
                              <input type="hidden" name="custom_options" id="custom_options" value="">
                          <div class="form-group" id="variant_options">
                              
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <button class="btn btn-warning" type="submit" name="add-product">Submit</button>
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
                $("#variations_heading").css("display","");
                $("#price_section").css("display","none");
                $('#variations').val('N');
            }
            else{

                $("#variations_value").css("display","none");
                $("#variations_heading").css("display","none");
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
           $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
          },   
          success:function(data)
          {
           $('#uploaded_image').html(data[0]);
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
    /////-------brands search ----- ///////

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
        
    }
    
</script>  