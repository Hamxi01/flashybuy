<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');

      $limit = 10;
      $prow ="SELECT  COUNT(P.product_id) AS pTotal  FROM products AS P  LEFT JOIN product_variations AS PV ON P.product_id = PV.product_id";
      $prow = mysqli_query($con,$prow);
      $row = mysqli_fetch_array($prow);
      $totalRow = $row['0'];
      $total_pages = ceil($totalRow / $limit);

      if (isset($_POST['update'])) {
        
          foreach ($_POST['v_p_id'] as $key => $value) {
            
              $approvquery = "update vendor_product SET quantity='".$_POST['qty'][$key]."',price='".$_POST['price'][$key]."',mk_price='".$_POST['mk_price'][$key]."',dispatched_days = '".$_POST['dispatch_days'][$key]."'  where id ='".$_POST['v_p_id'][$key]."'";
                mysqli_query($con,$approvquery);
          }
          echo "<script>window.location.assign('products.php?msg=success');</script>";
      }


?>

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
    <?php echo "<span>Data updated successfully...!!</span>"; ?>

        </div>
    </div>
</div>
<?php 
}?>
<!-- End Message Alert --> 
            <form action="products.php" method="post">
              <div class="row">
                <div class="col-11"></div>
                <div class="col-1">
                  <button class="btn btn-warning text-right" type="submit" name="update" style="position: relative;right: 20px;">update</button>
                </div>
              </div>
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
            </form>
          </div>
        </section>
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
$(document).ready(function() {

  setTimeout(function(){ $(".msg").hide(); }, 5000);
});
</script>