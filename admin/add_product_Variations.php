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
if (isset($_GET['id'])) 
 {
    $product_id = base64_decode($_GET['id']);

 }
?>

           
            <div class="row">
              <div class="col-md-10 offset-md-1">
                
                    <div class="card">
                      <form  action="action/add_product.php" method="post"  enctype="multipart/form-data" id="product_form">
                        <div class="card-header">
                          <h4>Add Your Variations</h4>
                        </div>
                        <div class="card-body">
                            
                          <div class="form-group row" id="variations_value">
                            <div class="col-md-3">
                              <label>Product Variants (Options)</label>
                            </div>  
                            <div class="col-md-9">
                                <select class="form-control select2"  onchange="variationsName()" name="variationname[]" id="variations_name" placeholder="choose" multiple="">
                                  <?php 
                                        $subSql = mysqli_query($con,"SELECT sub_sub_cat_id FROM products where product_id = '$product_id'");
                                        $subRes = mysqli_fetch_array($subSql);
                                        $subsubid = $subRes[0];
                                        echo $subsubid;
                                        $vSql = mysqli_query($con,"SELECT variation_id from sub_sub_categories where sub_sub_cat='$subsubid'");
                                        $vRes = mysqli_fetch_array($vSql);
                                        $vid = $vRes[0];
                                        $vid = explode(',',$vid);

                                  foreach ($vid as $key => $value) {
                                            
                                          $sql = mysqli_query($con, "SELECT * From variations where delte = 0 AND id ='$vid[$key]'");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                                            <option value="<?=$res['variation_name']?>"><?=$res['variation_name']?></option>
                                            
                                        <?php }  }?>
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
//---- On press Enter form not submit Fuction --- ////    
$('#product_form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
//---- On press Enter form not submit Fuction --- //// 
</script> 
