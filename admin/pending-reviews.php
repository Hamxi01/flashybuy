<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php');

      
      if (isset($_GET['id']) && $_GET['action']) {
        
          $p_r_id = $_GET['id'];
          $action = $_GET['action'];

          if ($action == 'accept') {
            
              $prSql = "UPDATE product_reviews SET approved = 'Y' WHERE p_r_id = '$p_r_id'";
              if (mysqli_query($con,$prSql)) {
                
                echo "<script>window.location.assign('all-reviews.php?msg=success');</script>";
              }
          }
          if ($action == 'reject') {
            
              $prSql = "UPDATE product_reviews SET reject = 'Y' WHERE p_r_id = '$p_r_id'";
              if (mysqli_query($con,$prSql)) {
                
                echo "<script>window.location.assign('all-reviews.php?msg=reject');</script>";
              }
          }
      }

?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">           
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Reviews</h4>
                    <div class="card-header-form">
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Prodcut ID</th>
                            <th>Product Name</th>
                            <th>User Name</th>
                            <th>Description</th>
                            <th>Rating</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
<?php 
$prSql = mysqli_query($con,"SELECT * FROM product_reviews WHERE approved ='N' AND reject = 'N'");
while($prRes = mysqli_fetch_array($prSql)){

  $product_id  = $prRes['product_id'];
  $user_name   = $prRes['user_name'];
  $description = $prRes['description'];
  $rating      = $prRes['rating'];
  $prid        = $prRes['p_r_id'];

  $pSql = mysqli_query($con,"SELECT * FROM products where product_id='$product_id'");
  while ($pRes = mysqli_fetch_array($pSql)) {
    
      $name = $pRes['name'];
  }
?>                          
                          <tr>
                            <td><?=$product_id?></td>
                            <td><?=$name?></td>
                            <td><?=$user_name?></td>
                            <td><?=$description?></td>
                            <td class="align-middle">
                              <?php if ($rating == 5) { ?>

                                <div class="progress-text">5 Star</div>
                                <div class="progress" data-height="6" style="height: 6px;">
                                  <div class="progress-bar bg-success" data-width="100%" style="width: 40%;"></div>
                                </div>

                             <?php } ?>
                             <?php if ($rating == 4) { ?>

                                <div class="progress-text">4 Star</div>
                                <div class="progress" data-height="6" style="height: 6px;">
                                  <div class="progress-bar bg-info" data-width="80%" style="width: 40%;"></div>
                                </div>
                                
                             <?php } ?> 
                             <?php if ($rating == 3) { ?>

                                <div class="progress-text">3 Star</div>
                                <div class="progress" data-height="6" style="height: 6px;">
                                  <div class="progress-bar bg-info" data-width="60%" style="width: 40%;"></div>
                                </div>
                                
                             <?php } ?>
                             <?php if ($rating == 2) { ?>

                                <div class="progress-text">2 Star</div>
                                <div class="progress" data-height="6" style="height: 6px;">
                                  <div class="progress-bar bg-warning" data-width="40%" style="width: 40%;"></div>
                                </div>
                                
                             <?php } ?>
                             <?php if ($rating == 1) { ?>

                                <div class="progress-text">1 Star</div>
                                <div class="progress" data-height="6" style="height: 6px;">
                                  <div class="progress-bar bg-danger" data-width="20%" style="width: 40%;"></div>
                                </div>
                                
                             <?php } ?>
                            </td>
                            <td><button class="btn btn-success"><a href="pending-reviews.php?id=<?=$prid?>&action=accept" style="color:#fff"><i class="fas fa-check"></i></a></button></td>
                            <td><button class="btn btn-danger"><a href="pending-reviews.php?id=<?=$prid?>&action=reject" style="color:#fff"><i class="fas fa-window-close"></i></a></button></td>
                          </tr>
<?php } ?>                            
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include('includes/footer.php') ?> 
      <!-- View Model -->
<script type="text/javascript">
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>