<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
     
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
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
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                        <form method="post" enctype="multipart/form-data">
                            <tr>
                              <th>All Orders</th>
                            </tr>
                            <tr>
                              <th><button class="btn" style="border: 1px grey solid" type="button">New Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">new</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">new</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">new</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">new</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">new</button></th>
                            </tr>
                          <tbody>                          
                            <!-- <tr style="font-size:13px !important; font-weight:bold ">
                              <td><input type="text" name="p_name" class="form-control" placeholder="Search Product by Name"></td>
                              <td><input type="text" name="p_id" class="form-control" placeholder="Search Product by ID"></td>
                              <td><button class="btn btn-warning" type="submit" name="searchProduct">Search Products</button></td>
                            </tr> -->
                          </tbody> 
                      </form> 
                      </table>
                  </div>
                </div>
                <!-- Current Products in deals -->
                <!-- <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                          <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Id</th>
                            <th>Vendor</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Market Price</th>
                            <th>Deal price</th>
                            <th>Quantity</th>
                            <th></th>
                            <th></th>
                          </tr>
                        <tbody>                                                 
                          <tr style="font-size:13px !important; font-weight:bold ">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>                                                
                        </tbody>  
                      </table>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </section>
      </div>
        
              
      <?php include('includes/footer.php'); ?>
<script type="text/javascript">
 
  $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>