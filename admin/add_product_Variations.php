<?php
 
include('../includes/db.php');
include('includes/header.php');
include('includes/sidebar.php');
 
      if (isset($_POST['add-product-variants'])) {

        $id = $_POST['product_id'];

        $productSql = "UPDATE products SET quantity=0,selling_price=0,market_price=0 Where product_id ='$id'";
        mysqli_query($con,$productSql);

          if ($_POST['vari']) {
          
            foreach ($_POST['vari'] as $key => $value) {
            
                if ($value == "Color") {
                  
                  if(isset($_POST['variant_img1']) && !empty($_POST['variant_img1'])){

                      foreach ($_POST['variant_img1'] as $index => $value) {

                        $skuu         = $_POST['sku'][$index];
                        $skuu         = explode("-", $skuu);
                        $variantvalue = $skuu[0];

                        $sql = "INSERT into product_variant_images(product_id,variation_value,image1,main_img,image2,image3,image4) VALUES('".$id."','".$variantvalue."','".$_POST['variant_img1'][$index]."','".$_POST['variant_img1'][$index]."','".$_POST['variant_img2'][$index]."','".$_POST['variant_img3'][$index]."','".$_POST['variant_img3'][$index]."')";

                        mysqli_query($con,$sql);
                      }  
                  } 

                }
            }
          }
        foreach ($_POST['qty'] as $key => $value) {

            $variationname = $_POST['variationname'];
            // $variationname = explode($variationname);
            if (count($_POST['variationname'])==1) {

                $first_variation_name = $_POST['variationname'][0];

                $sku = $_POST['sku'][$key];
                $sku = explode("-",$sku);
                if (count($sku)==1) {
                
                  $first_variation_value = $sku[0];
                  $sql = "INSERT into product_variations(product_id,price,mk_price,quantity,sku,first_variation_name,first_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$first_variation_value."')";
                  
                  if (mysqli_query($con,$sql)) {

                    echo "<script>window.location.assign('product.php?msg=success');</script>";
                          
                  }
                  else{

                        echo "<script>window.location.assign('product.php?msg=erorr');</script>";
                  }
                }
            }
            if (count($_POST['variationname'])==2) {

                $first_variation_name = $_POST['variationname'][0];
                $second_variation_name = $_POST['variationname'][1];

                $sku = $_POST['sku'][$key];
                $sku = explode("-",$sku);
                if (count($sku)==2) {
                
                  $first_variation_value = $sku[0];
                  $second_variation_value = $sku[1];

                  $sql = "INSERT into product_variations(product_id,price,mk_price,quantity,sku,first_variation_name,second_variation_name,first_variation_value,second_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$second_variation_name."','".$first_variation_value."','".$second_variation_value."')";
                  if (mysqli_query($con,$sql)) {

                   echo "<script>window.location.assign('product.php?msg=success');</script>";
                          
                  }
                  else{

                        echo "<script>window.location.assign('product.php?msg=erorr');</script>";
                  }
                }
            }
            if (count($_POST['variationname'])==3) {

                $first_variation_name = $_POST['variationname'][0];
                $second_variation_name = $_POST['variationname'][1];
                $third_variation_name = $_POST['variationname'][2];

                $sku = $_POST['sku'][$key];
                $sku = explode("-",$sku);
                if (count($sku)==3) {
                
                  $first_variation_value  = $sku[0];
                  $second_variation_value = $sku[1];
                  $third_variation_value  = $sku[2];

                  $sql = "INSERT into product_variations(product_id,price,mk_price,quantity,sku,first_variation_name,second_variation_name,third_variation_name,first_variation_value,second_variation_value,third_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$second_variation_name."','".$third_variation_name."','".$first_variation_value."','".$second_variation_value."','".$third_variation_value."')";
                  
                  if (mysqli_query($con,$sql)) {

                      echo "<script>window.location.assign('product.php?msg=success');</script>";
                          
                  }
                  else{

                        echo "<script>window.location.assign('product.php?msg=erorr');</script>";
                  }
                }
            }
            if (count($_POST['variationname'])==4) {

                $first_variation_name = $_POST['variationname'][0];
                $second_variation_name = $_POST['variationname'][1];
                $third_variation_name = $_POST['variationname'][2];
                $forth_variation_name = $_POST['variationname'][3];

                $sku = $_POST['sku'][$key];
                $sku = explode("-",$sku);
                if (count($sku)==4) {
                
                  $first_variation_value = $sku[0];
                  $second_variation_value = $sku[1];
                  $third_variation_value  = $sku[2];
                  $forth_variation_value  = $sku[3];

                  $sql = "INSERT into product_variations(product_id,price,mk_price,quantity,sku,first_variation_name,second_variation_name,third_variation_name,forth_variation_name,first_variation_value,second_variation_value,third_variation_value,forth_variation_value) VALUES('".$id."','".$_POST['price'][$key]."','".$_POST['mk_price'][$key]."','".$_POST['qty'][$key]."','".$_POST['sku'][$key]."','".$first_variation_name."','".$second_variation_name."','".$third_variation_name."','".$forth_variation_name."','".$first_variation_value."','".$second_variation_value."','".$third_variation_value."','".$forth_variation_value."')";

                    if (mysqli_query($con,$sql)) {

                      echo "<script>window.location.assign('product.php?msg=success');</script>";
                          
                  }
                  else{

                        echo "<script>window.location.assign('product.php?msg=erorr');</script>";
                  }
                }
            }   
        }
      }
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
                      <form  action="add_product_Variations.php" method="post"  enctype="multipart/form-data" id="product_form">
                        <div class="card-header">
                          <h4>Add Your Variations</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="product_id" value="<?=$product_id?>">
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
                          <button class="btn btn-warning" type="submit" name="add-product-variants">Submit</button>
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
            }
        });
        });
        

} 
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
    


    ////////////////////////////////////////
    ///--------- upload image1 ----------//


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
