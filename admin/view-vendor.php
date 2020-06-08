<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
?>      
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                          <tr>
                            <th></th>
                            <th>Active Date</th>
                            <th>Id#</th>
                            <th>Shop Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Verified</th>
                            <th>Products</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        <tbody> 
<?php 
$vSql   = "SELECT * FROM vendor";
$vQuery = mysqli_query($con,$vSql);

while($vRes = mysqli_fetch_array($vQuery)){

$shop_name = $vRes['shop_name'];
$ven_id    = $vRes['id'];
$name      = $vRes['name'].' '.$vRes['lastname'];
$email     = $vRes['email'];
$status    = $vRes['status'];
$date      = $vRes['create_at'];
$date      = explode(' ',$date);
$date      = $date[0];

$vpSql = mysqli_query($con,"SELECT COUNT(*) AS tProduct FROM vendor_product WHERE ven_id = '$ven_id' and quantity > 0  and active = 'Y'" );
$vpRes = mysqli_fetch_array( $vpSql );
$tP  = $vpRes[0];

$user_transaction_detailas=0;
$sCtas = mysqli_query( $con , " SELECT   user_transaction FROM transaction WHERE ven_id = '$ven_id' order by transaction_id DESC" ); 
$rCtas = mysqli_fetch_array(  $sCtas  );
$user_transaction_detailas = $rCtas["user_transaction"]; 
?>                                                 
                          <tr style="font-size:13px !important; font-weight:bold ">
                            <td><a href="vendor.php?vendor_id=<?=$ven_id?>"><i class="fa fa-edit"></i></a></td>
                            <td><?=$date?></td>
                            <td><?=$ven_id?></td>
                            <td><?=$shop_name?></td>
                            <td><?=$name?></td>
                            <td><?=$email?></td>
                            <td>
                              <?php if($status == 1){ ?>
                                <div class="badge badge-success">verified</div>
                              <?php }else{ ?>
                                <div class="badge badge-danger">Not-verified</div>
                              <?php } ?>
                            </td>
                            <td><?=$tP?></td>
                            
                            <td><?=$user_transaction_detailas?></td>
                            <td>
                              <?php if($vRes['deactive'] == 0){ ?>
                                <div class="badge badge-success">Yes</div>
                              <?php }else{ ?>
                                <div class="badge badge-danger">No</div>
                              <?php } ?>
                            </td>
                            <th><button class="btn btn-sm btn-primary"><a href="transaction_vendor.php?vendor_id=<?=$ven_id?>" style="text-decoration: none;color: #fff">Transaction</a></button></th>
                          </tr>
<?php } ?>                                                                        
                        </tbody>  
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
        
              
      <?php include('includes/footer.php'); ?>
