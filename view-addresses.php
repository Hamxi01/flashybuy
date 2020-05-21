<?php include('includes/db.php'); ?>
<?php include('includes/head.php'); ?>
<?php
@session_start();
    if(isset($_SESSION['id'])){

        $user_id = $_SESSION['id'];

    }else{
      header("Location: login.php");
    }

$action     = $_REQUEST['action'];    
if( isset( $action  ) && $action  == "delete" ){
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
    <div class="ps-vendor-dashboard pro">
        <div class="container">
            <br><br>
            <div class="row">
                <div class="col-md-3">
                    <div class="ps-section__content">
                        <ul class="ps-section__links">
                            <li class="active"><a href="#">Dashboard</a></li>
                            <li><a href="view-addresses.php">My Addresses</a></li>
                            <li><a href="#">view Orders</a></li>
                            <li><a href="#">Setting</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <table class="table table-stripped" border="1">
                        <thead>
                            <tr>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>Subrub</th>
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
                                <td><a href=""><i class="fa fa-edit"></i></a></td>
                                <td><a onclick="confirmDelete(<?=$uRes['u_a_id']?>)"><i class="fa fa-trash"></i></a></td>
                            </tr>
<?php } ?>                            
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
    <?php include('includes/footer.php') ?>
<script>
    function confirmDelete(u_a_id){
            var ask=confirm("Are you sure you want to delete address");
            if(ask){
                  window.location="view-addresses.php?action=delete&ui="+u_a_id;
             }
    }
</script>