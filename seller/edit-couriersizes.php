<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php');

     if(isset($_POST['update-couriersizes'])){

        $vid     = $_POST['id'];
        $sid      = $_POST['sid'];
        $size      = $_POST['size'];
        $city     = $_POST['city'];
       $price    = $_POST['price'];


        $linkid = base64_encode($_POST['id']);

        $sql = mysqli_query($con,"SELECT * from vendor_courier_sizes where id='$sid' AND size='$size' AND city='$city'");
        $rows = mysqli_num_rows($sql);
        if ($rows>0) {
        
          echo "<script>window.location.assign('edit-couriersizes.php?id=".$linkid."&msg=error');</script>";

        }
        else{

            $sql = "update vendor_courier_sizes SET vendor_id = '".$vid."',city = '".$city."',price= '".$price."',size='".$size."' where id='".$sid."'";
           
            if ($query =mysqli_query($con,$sql)) {

              echo "<script>window.location.assign('couriersizes.php');</script>";
            }

        }

     }
if (isset($_GET['id'])) {
  $id = base64_decode($_GET['id']);

    $fetchquery = mysqli_query($con,"SELECT * from vendor_courier_sizes where id = '$id'");
    while($result = mysqli_fetch_array($fetchquery)){

      $s_id = $result['id'];
      $size = $result['size'];
      $city = $result['city'];
      $price = $result['price']; 
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
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
          <span>Values are added successfully.</span>
        </div>
    </div>
</div>
<?php 
}
?>

<!-- End Message Alert -->            
            <div class="row">
              <div class="col-md-10 offset-md-1">
                <div class="card">
                  <form action="edit-couriersizes.php"  method="post">
                    <div class="card-header">
                      <h4>Add Courier Sizes and Cities</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group row">
                        <input type="hidden" name="id" value="<?=$vendor_id?>" id="id">
                        <input type="hidden" name="sid" value="<?=$s_id?>" id="id">
                        <div class="col-lg-4">
                          <label>Courier Size*</label>
                          <input type="text" name="size" class="form-control" placeholder="eg:small,large" required="" id="size" value="<?=$size?>">
                        </div>
                        <div class="col-lg-4">
                          <label>Price*</label>
                          <input type="number" name="price" class="form-control" required="" value="<?=$price?>">
                        </div>
                        <div class="col-lg-4">
                          <label>Courier City</label>
                          <input type="text" name="city" class="form-control" required="" id="city" value="<?=$city?>">
                        </div>
                      </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="submit" name="update-couriersizes">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>
        </section>
      </div>  
        <?php include('includes/footer.php') ?>
<script type="text/javascript">
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });

</script>        