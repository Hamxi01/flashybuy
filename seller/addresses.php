<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


     if(isset($_POST['update-address'])){

        $id                 = $_POST['id'];
        $address            = $_POST['address'];
        $city               = $_POST['city'];
        $state              = $_POST['state'];
        $street             = $_POST['street'];
        $subrub             = $_POST['subrub'];
        $zip                = $_POST['zip'];
        $country            = $_POST['country'];
        $waddress           = $_POST['waddress'];
        $wcity              = $_POST['wcity'];
        $wstate             = $_POST['wstate'];
        $wstreet            = $_POST['wstreet'];
        $wsubrub            = $_POST['wsubrub'];
        $wzip               = $_POST['wzip'];
        $wcountry           = $_POST['wcountry'];

        

            $sql = "update vendor SET address='".$address."',city='".$city."',state='".$state."',street='".$street."',subrub='".$subrub."',zip='".$zip."',country='".$country."',waddress='".$waddress."',wcity='".$wcity."',wstate='".$wstate."',wstreet='".$wstreet."',wsubrub='".$wsubrub."',wzip='".$wzip."',wcountry='".$wcountry."' Where id='".$id."'";


            if (mysqli_query($con,$sql)) {

              $vaSql = mysqli_query($con,"INSERT into vendor_activity (description,ven_id) VALUES ('You changed your addresses','$id')");
             
              echo "<script>window.location.assign('addresses.php?msg=success');</script>";
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
<?php 

$vSql = mysqli_query($con,"SELECT * FROM vendor where id='$vendor_id'");
while ($vRes = mysqli_fetch_array($vSql)) {
 
            $address              = $vRes['address'];
            $city                 = $vRes['city'];
            $state                = $vRes['state'];
            $street               = $vRes['street'];
            $subrub               = $vRes['subrub'];
            $zip                  = $vRes['zip'];
            $country              = $vRes['country'];
            $waddress             = $vRes['waddress'];
            $wcity                = $vRes['wcity'];
            $wstate               = $vRes['wstate'];
            $wstreet              = $vRes['wstreet'];
            $wsubrub              = $vRes['wsubrub'];
            $wzip                 = $vRes['wzip'];
            $wcountry             = $vRes['wcountry'];
}

?>
<!-- End Message Alert --> 

          <form action="addresses.php"  method="post">           
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4>Edit Your Business Addresses</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?=$vendor_id?>">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="<?=$address?>">
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" value="<?=$city?>">
                      </div>
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" class="form-control" value="<?=$state?>">
                      </div>
                      <div class="form-group">
                        <label>Street</label>
                        <input type="text" name="street" class="form-control" value="<?=$street?>">
                      </div>
                      <div class="form-group">
                        <label>Subrub</label>
                        <input type="text" name="subrub" class="form-control" value="<?=$subrub?>">
                      </div>
                      <div class="form-group">
                        <label>Zip</label>
                        <input type="text" name="zip" class="form-control" value="<?=$zip?>">
                      </div>
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control" value="<?=$country?>">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4>Edit Your WareHouse Address</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="waddress" class="form-control" value="<?=$waddress?>">
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" name="wcity" class="form-control" value="<?=$wcity?>">
                      </div>
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" name="wstate" class="form-control" value="<?=$wstate?>">
                      </div>
                      <div class="form-group">
                        <label>Street</label>
                        <input type="text" name="wstreet" class="form-control" value="<?=$wstreet?>">
                      </div>
                      <div class="form-group">
                        <label>Subrub</label>
                        <input type="text" name="wsubrub" class="form-control" value="<?=$wsubrub?>">
                      </div>
                      <div class="form-group">
                        <label>Zip</label>
                        <input type="text" name="wzip" class="form-control" value="<?=$wzip?>">
                      </div>
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="wcountry" class="form-control" value="<?=$wcountry?>">
                      </div>

                    </div> 
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="submit" name="update-address">Submit</button>
                    </div>
                </div>
              </div>
          </div>
         </form>
        </section>
      </div>  
        <?php include('includes/footer.php') ?>
<script type="text/javascript">
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });

</script>        