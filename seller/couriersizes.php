<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php');

    if(isset($_GET['id'])){

        $id = base64_decode($_GET['id']);
        
        $sql = "update vendor_courier_sizes SET delte = '1' WHERE id = $id";
        if(mysqli_query($con,$sql)){

             echo "<script>window.location.assign('couriersizes.php?msg=success');</script>";
        }
        else{

            echo "<script>window.location.assign('couriersizes.php?msg=error');</script>";
        }
    }
?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
 <!-- Start Showing success or warning Msg -->
<?php
if (isset($_GET['msg']) && $_GET['msg'] =="error") {?>
    <div class="row">
        <div class="col-lg-4 col-sm-offset-3">
            <div class="alert alert-danger msg">    
              <span>These values are already Exists.</span>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($_GET['msg']) && $_GET['msg'] =="success") { ?>
<div class="row">
    <div class="col-lg-4 col-sm-offset-3">
        <div class="alert alert-success msg">    
          <span>Data Deleted successfully...!!</span>
        </div>
    </div>
</div>
<?php 
}
?>
<?php
if (isset($_GET['msg']) && $_GET['msg'] =="successadd") { ?>
<div class="row">
    <div class="col-lg-4 col-sm-offset-3">
        <div class="alert alert-success msg">    
          <span>Values Saved successfully...!!</span>
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