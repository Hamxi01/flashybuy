<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php');

    if(isset($_GET['id'])){

        $id = base64_decode($_GET['id']);
        
        $sql = "update vendor_courier_sizes SET delte = '1' WHERE id = $id";
        if(mysqli_query($con,$sql)){

            $msg = "<span>Data Deleted successfully...!!</span>";
        }
        else{

            $error = "<span>Something went wrong...!!</span>";
        }
    }
?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
<!-- Start Message -->
<?php
if (isset($error)) {?>
    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <div class="alert alert-warning msg">    
    <?php echo $error; ?>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($msg)) { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo $msg; ?>

        </div>
    </div>
</div>
<?php 
}
?>
<!-- End Message  -->            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Variations</h4>
                    <div class="card-header-form">
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-stripped">
                      <thead>
                        <tr>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>City</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </tr>
                      </thead>
                      <tbody>
<!-- Fetch variations -->
<?php

    $sql = mysqli_query($con, "SELECT * From vendor_courier_sizes Where delte = 0 AND vendor_id='$vendor_id'");
    $i = 0;
    $row = mysqli_num_rows($sql);
    while ($row = mysqli_fetch_array($sql)){
        $id = base64_encode($row['id']);
        $i++;
?>
                        <tr>
                          <td></td>
                          <td><?=$i?></td>
                          <td><?=$row['city']?></td>
                          <td><?=$row['size']?></td>
                          <td><?=$row['price']?></td>
                           <td>
                              <div class="btn-group mb-2">
                                  <button class="btn btn-dark btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Actions
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="edit-couriersizes.php?id=<?=$id?>">Edit</a>
                                    <a class="dropdown-item" href="couriersizes.php?id=<?=$id?>">Delete</a>
                                  </div>
                              </div>
                           </td>
                        </tr>
<?php } ?>
<!-- End variations fetch  -->                        
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