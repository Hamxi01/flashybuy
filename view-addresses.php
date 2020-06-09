<?php include('includes/db.php'); ?>
<?php include('includes/head.php'); ?>
<?php
@session_start();
    if(isset($_SESSION['id'])){

        $user_id = $_SESSION['id'];

    }else{

      echo '<script type="text/javascript">window.location.href = "userlogin.php"</script>';
    }

if( isset( $_REQUEST['action']  ) && $_REQUEST['action']  == "delete" ){
    $u_a_id     = $_REQUEST['ui'];
    mysqli_query( $con,"DELETE FROM user_addresses WHERE u_a_id = '$u_a_id'" );
}

?>
    <div class="ps-page--single">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="index.html">Pages</a></li>
                    <li><a href="vendor-store.html">Vendor Pages</a></li>
                    <li>Vendor Dashboard Pro</li>
                </ul>
            </div>
        </div>
    </div>
<?php  if (isset($_GET['msg']) && $_GET['msg']=='success') { ?>
<div class="alert alert-danger">
    <p class="text text-danger" style="font-weight: bold;font-size: 16px;text-align: center">opps! Address is not added Successfully.</p>
</div>
<?php } ?>
<?php  if (isset($_GET['msg']) && $_GET['msg']=='error') { ?>
<div class="alert alert-danger">
    <p class="text text-danger" style="font-weight: bold;font-size: 16px;text-align: center">opps! Address is not added Successfully.</p>
</div>
<?php } ?>
    <div class="ps-vendor-dashboard pro">
        <div class="container">
            <br><br>
            <div class="row">
                <div class="col-md-3">
                    <div class="ps-section__content">
                        <ul class="ps-section__links">
                            <li><a href="my-account.php">Dashboard</a></li>
                            <li  class="active"><a href="view-addresses.php">My Addresses</a></li>
                            <li><a href="view-orders.php">view Orders</a></li>
                            <!-- <li><a href="#">Setting</a></li> -->
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <table class="table table-bordered" border="1">
                        <thead>
                            <tr>
                                <th><b>Address</b></th>
                                <th><b>City</b></th>
                                <th><b>State</b></th>
                                <th><b>Zip</b></th>
                                <th><b>Subrub</b></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
<?php 
$uSql = mysqli_query($con,"SELECT * FROM user_addresses Where user_id ='$user_id'");
while($uRes = mysqli_fetch_array($uSql)){
?>                            
                            <tr>
                                <td><?=$uRes['address']?></td>
                                <td><?=$uRes['city']?></td>
                                <td><?=$uRes['state']?></td>
                                <td><?=$uRes['zip_code']?></td>
                                <td><?=$uRes['subrub']?></td>
                                <td><a><i class="fa fa-edit" data-toggle="modal" data-target="#addressModel<?=$uRes['u_a_id']?>"></i></a></td>
                                <td><a onclick="confirmDelete(<?=$uRes['u_a_id']?>)"><i class="fa fa-trash"></i></a></td>
                            </tr>
    
<?php } ?>                            
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
<?php 
$uSql = mysqli_query($con,"SELECT * FROM user_addresses Where user_id ='$user_id'");
while($uRes = mysqli_fetch_array($uSql)){
    $name         = $uRes['name'];
    $name         = explode(" ",$name,2);
    $f_name       = $name[0];
    $l_name       = $name[1];
?>    
    <div class="modal fade" id="addressModel<?=$uRes['u_a_id']?>" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add new Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form role="form" action="actions/userUpdateAdresses.php" method="post">
                    <input type="hidden" name="user_id" value="<?=$user_id?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="f_name" class="form-control" value="<?=$f_name?>" placeholder="First Name" required="">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="l_name" class="form-control" value="<?=$l_name?>" placeholder="Last Name" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile" class="form-control" placeholder="Cell Number" required="" value="<?=$uRes['mobile']?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" class="form-control" placeholder="Address" required="" value="<?=$uRes['address']?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="city" class="form-control" placeholder="City" required="" value="<?=$uRes['city']?>">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="state" class="form-control" placeholder="State" required="" value="<?=$uRes['state']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="subrub" class="form-control" placeholder="Subrub" required="" value="<?=$uRes['subrub']?>">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="zip" class="form-control" placeholder="Zip" required="" value="<?=$uRes['zip_code']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="street" class="form-control" placeholder="Street" required="" value="<?=$uRes['street']?>">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <input type="text" name="route" class="form-control" placeholder="Route" required="" value="<?=$uRes['route']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="country" class="form-control" placeholder="Country" required="" value="<?=$uRes['country']?>">
                            </div>
                        </div>    
                        <div class="col-md-6">    
                            <div class="form-group">
                                <button  name="saveAddress" class="form-control btn btn-warning"  style="background: #e0a800;border: none;color: white">Save Address</button>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
    </div>
<?php } ?>    
    <?php include('includes/footer.php') ?>
<script>
    function confirmDelete(u_a_id){
            var ask=confirm("Are you sure you want to delete address");
            if(ask){
                  window.location="view-addresses.php?action=delete&ui="+u_a_id;
             }
    }
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>