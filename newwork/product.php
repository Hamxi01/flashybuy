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


?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Simple Table</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-md">
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Created At</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Irwansyah Saputra</td>
                          <td>2017-01-09</td>
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                          <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Hasan Basri</td>
                          <td>2017-01-09</td>
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                          <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Kusnadi</td>
                          <td>2017-01-11</td>
                          <td>
                            <div class="badge badge-danger">Not Active</div>
                          </td>
                          <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Rizal Fakhri</td>
                          <td>2017-01-11</td>
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                          <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                        <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1 <span
                              class="sr-only">(current)</span></a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Full Width</h4>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-md">
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Created At</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Irwansyah Saputra</td>
                          <td>2017-01-09</td>
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                          <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Hasan Basri</td>
                          <td>2017-01-09</td>
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                          <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Kusnadi</td>
                          <td>2017-01-11</td>
                          <td>
                            <div class="badge badge-danger">Not Active</div>
                          </td>
                          <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Rizal Fakhri</td>
                          <td>2017-01-11</td>
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                          <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Isnap Kiswandi</td>
                          <td>2017-01-17</td>
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                          <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                        <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1 <span
                              class="sr-only">(current)</span></a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div> -->
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
</script>