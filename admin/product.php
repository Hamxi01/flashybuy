<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');

      $limit = 10;
      $prow ="SELECT  COUNT(P.product_id) AS pTotal  FROM products AS P  LEFT JOIN product_variations AS PV ON P.product_id = PV.product_id WHERE P.approved = 'Y'
";
      $prow = mysqli_query($con,$prow);
      $row = mysqli_fetch_array($prow);
      $totalRow = $row['0'];
      $total_pages = ceil($totalRow / $limit);


?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
<!-- Start Showing success or warning Msg -->

<?php
if (isset($_GET['error'])) {?>
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
if (isset($_GET['msg'])) { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo "<span>Data Inserted successfully...!!</span>"; ?>

        </div>
    </div>
</div>
<?php 
}
?>

<!-- End Message Alert -->  
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Products</h4>
                    <div class="card-header-form">
                      <form>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search" id="keyword" oninput="productSearch()">
                          <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0" id="pagination">
                        <?php if(!empty($total_pages)){for($i=1; $i<=$total_pages; $i++){  
                            if($i == 1){?>
                              <li class="page-item active" id="<?php echo $i;?>"><a class="page-link" href="action/productPagination.php?page=<?php echo $i;?>"><?php echo $i;?><span class="sr-only">(current)</span></a></li> 
                                <?php } else{ ?>
                                  <li class="page-item" id="<?php echo $i;?>"><a class="page-link" href="action/productPagination.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                              <?php }?>      
                          <?php }}?>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- View Model -->
        <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              
            </div>
          </div>
        </div>
        <!-- Vendor assign Model -->
        <div class="modal fade" id="vendorModel" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Asign to vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="vendor-form">
                    <div class="form-group">
                      <label>choose vendor name</label>
                        <select class="form-control select2" required="" name="vendor">

                            <option>choose vendor name</option>

                            <?php 

                                          $sql = mysqli_query($con, "SELECT * From vendor");
                                          
                                          while ($res = mysqli_fetch_array($sql)) {?>

                            <option value="<?=$res['id']?>"><?=$res['name']?></option>
                                            
                                        <?php  }?>
                        </select>
                    </div>    
                      <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="stock" id="stock" class="form-control">
                      </div>
                      <div class="form-group" id="marketPrice">
                        <label>Market Price</label>
                        <input type="number" name="market_price" id="mk_price" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Selling Price</label>
                        <input type="number" name="selling_price" id="selling_price" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Dispatched Days</label>
                        <input type="text" name="dispatched_days" id="dispatched_days" class="form-control">
                      </div>
                      <input type="hidden" name="variation_id" id="variation_id">
                      <input type="hidden" name="product_id" id="product_id">    
                  <button type="button" onclick="assignVendor()" class="btn btn-primary m-t-15 waves-effect">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Variation insertion Model -->
        <div class="modal fade" id="variationModel" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <h5 class="modal-title" id="formModal">Add new variation in this Product</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="variation-form">
                  
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Deal Modal -->
        <div class="modal fade" id="dealModel" tabindex="-1" role="dialog" aria-labelledby="dealModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Import this Variant into Deal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="deal-form">
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php include('includes/footer.php'); ?>
      <script>
$(document).ready(function() {

    $(".table-responsive").load("action/productPagination.php?page=1");
        $("#pagination li").on('click',function(e){
      e.preventDefault();
      $("#pagination li").removeClass('active');
      $(this).addClass('active');
      var pageNum = this.id;
      $(".table-responsive").load("action/productPagination.php?page=" + pageNum);
    });
});

/////////-------------------////////
//------ Product Preview -------///
function prodImgPreview(prodId){

    $.ajax({
      type:"post",
      url:"action/ajax_product_preview.php",
      data:{prodId:prodId},
      success:function(data){
        // console.log(data);
        $('#myModal >.modal-dialog >  .modal-content').empty();
        $('#myModal >.modal-dialog >  .modal-content').append(data);
      }
    });
}

/////////-------------------////////
//------ Product Preview -------///
function variantprodImgPreview(prodId,sku){

    $.ajax({
      type:"post",
      url:"action/ajax_variantproduct_preview.php",
      data:{prodId:prodId,sku,sku},
      success:function(data){
        // console.log(data);
        $('#myModal >.modal-dialog >  .modal-content').empty();
        $('#myModal >.modal-dialog >  .modal-content').append(data);
      }
    });
}
////-----------------------------------------////
//-----------Product Seacrh Function----------//

function productSearch(){

    var keyword = $('#keyword').val();
    $.ajax({
      type:"post",
      url:"action/productSearch.php",
      data:{keyword:keyword},
      success:function(data){
        // /console.log(data);
        // $('#myModal >.modal-dialog >  .modal-content').empty();
        $('#searchResult').html(null);
        $('#searchResult').append(data);
      }
    });
}



///////-------------End importing--------------------////
function assignVendor(){
    
      $.ajax({
        type:"post",
        url:"action/assignVariations.php",
        data:$('#vendor-form').serialize(),
        success:function(data){
            $("#vendorModel").modal('hide');
              alert("Product Assign Successfully");
        }
      });

}
///////--------------variantProduct value pass to modal////////

function productAssign(product_id){

      $("#product_id").val(product_id);
}
//////////////////////////////////////////////////////////////
///-------- Variation Modal Function ------- ////////////////
////////////////////////////////////////////////////////////
 function variationData(product_id,variation_id){

      // $("#product_id").val(product_id);
      $.ajax({
        type:"post",
        url:"action/getoldVariations.php",
        data:{variation_id:variation_id},
        success:function(data){
            // $("#vendorModel").modal('hide');
            //   alert("Product Assign Successfully");
            $("#variation-form").html(null);
            $("#variation-form").append(data);
        }
      });
}
//////////////////////////////////////////////////////////////
///-------- Save Variation  Function ------- ////////////////
////////////////////////////////////////////////////////////
 function saveVariant(){

      // $("#product_id").val(product_id);
      $.ajax({
        type:"post",
        url:"action/saveVariations.php",
        data:$('#variation-form').serialize(),
        success:function(data){
            $("#variationModel").modal('hide');
            alert("Variation Add Successfully");

        }
      });
}
</script>