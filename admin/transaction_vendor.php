<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
  
  if (isset($_GET['vendor_id'])) {
    
      $ven_id = intval( $_GET['vendor_id']);
      $show   = $_GET['show'];
  }
?>
<style type="text/css">
  .accordion {
    border: none;
    background: #F5F5F5 !important;
    color: #7E7E7E !important;
    padding: 10px;
    border: 1px solid #E7E7E7;
}
</style>      
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                    <?php if (empty($show)) { ?>
                      <table class="table table-bordered">
                          <tr>
                            <th colspan="1"><button class="accordion" onclick="window.location.href='transaction_vendor.php?show=transactions&vendor_id=<?=$ven_id?>'">Transactions Details</button></th>
                          </tr>
                          <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Shop Name</th>
                            <th>Bank</th>
                            <th>Account</th>
                            <th>Branch Name</th>
                            <th>Branch Code</th>
                            <th>Balance</th>
                          </tr>
                        <tbody> 
<?php 
$vSql = mysqli_query( $con,"SELECT * FROM vendor  WHERE id = '$ven_id'"); 
$vRes = mysqli_fetch_array($vSql);

$user_transaction_detailas=0;
$sCtas = mysqli_query( $con , " SELECT   user_transaction FROM transaction WHERE ven_id = '$ven_id' order by transaction_id DESC" ); 
$rCtas = mysqli_fetch_array(  $sCtas  );
$user_transaction_detailas = $rCtas["user_transaction"];
?>                                                 
                          <tr style="font-size:13px !important; font-weight:bold ">
                            <td><?=$vRes['id']?></td>
                            <td><?=$vRes['email']?></td>
                            <td><?=$vRes['shop_name']?></td>
                            <td><?=$vRes['bank_name']?></td>
                            <td><?=$vRes['bank_account']?></td>
                            <td><?=$vRes['bank_branch']?></td>
                            <td><?=$vRes['branch_code']?></td>
                            <td><?=$user_transaction_detailas?></td>
                          </tr>                                                         
                        </tbody>
                      </table>
<?php }
if ($show == "transactions") { ?>
                        <table class="table table-responsive table-bordered">
                          <tr>
                            <th colspan="3"><button class="accordion" onclick="window.location.href='transaction_vendor.php?show=transactions&vendor_id=<?=$ven_id?>'">Transactions Details</button></th>
                          </tr>
                          <tr>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th width="7%">Prod ID</th>
                            <th width="7%">Customer ID</th>
                            <th>Note</th>
                            <th>Title</th>
                            <th>image</th>
                            <th width="7%">Prod Price</th>
                            <th>Order ID</th>
                            <th>Order Token</th>
                            <th>Trans</th>
                            <th>Deduct </th>
                            <th>Commission Deduction</th>
                            <th>Box Price</th>
                            <th>Transaction</th>
                            <th>Reference</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Balance</th>
                          </tr>
                          <tbody>
<?php 
$vtSql  = "SELECT 
                  transaction_id, 
                  time_id, 
                  product_id, 
                  transfer_amount, 
                  ven_id, 
                  note, 
                  order_transaction, 
                  order_token, 
                  ref_transaction, 
                  deduct_amount, 
                  order_id, 
                  product_price, 
                  box_price, 
                  cat_percent, 
                  cat_price, 
                  trans_type, 
                  box_price, 
                  user_name, 
                  user_id, 
                  transaction_type, 
                  user_transaction, 
                  user_t_amount 
                FROM 
                  transaction 
                WHERE 
                  trans_type != 'courier' 
                  AND ven_id = '$ven_id' 
                  AND order_refund != 'Y'  
                order by 
                  transaction_id DESC";
$sC = mysqli_query( $con ,  $vtSql  ); 
while($rC = mysqli_fetch_array(  $sC  )){
    
  
  $transaction_id     = $rC["transaction_id"];
  $time_id            = $rC["time_id"];
  $prod_id            = $rC["product_id"];
  $transfer_amount    = $rC["transfer_amount"];
  $deduct_amount      = $rC["deduct_amount"];
  $order_id           = $rC["order_transaction"];
  $order_token        = $rC["order_token"];
  $prod_pirce         = $rC["product_price"];
  $cat_perc           = $rC["cat_percent"];
  $cat_price          = $rC["cat_price"];
  $trans_type         = $rC["trans_type"];
  $transaction_type   = $rC["transaction_type"];
  $user_transaction   = $rC["user_transaction"];
  $user_t_amount      = $rC["user_t_amount"];
  $box_price          = $rC["box_price"];
  $ven_id             = $rC["ven_id"];
  $note               = $rC["note"];
  
  $user_id            = $rC["user_id"];
  $user_name          = $rC["user_name"];
  $ref_transaction    = $rC["ref_transaction"];

  $pSql = mysqli_query($con,"SELECT * FROM products where product_id ='$prod_id'");
  while($pRes = mysqli_fetch_array($pSql)){

      $title = $pRes['name'];
      $img   = $pRes['image1'];
      if (empty($img)) {

        $varaintImgQuery = "SELECT main_img from product_variant_images where product_id ='$prod_id'";
        $varaintImgSql   = mysqli_query($con,$varaintImgQuery);
        while ($productVaraintImg = mysqli_fetch_array($varaintImgSql)) {

          $img = $productVaraintImg['main_img'];
        }
      }
  }
?>
                          <tr>
                        <td><?=date("d-m-Y" , $time_id)?></td>
                        <td><?=$transaction_id?></td>
                        <td><?=$prod_id?></td>
                        <td><?=$user_id?>-<?=$user_name?></td>
                        <td><?=$note?><br/>
                           <!-- <button style="margin-left:32%;margin-top:3px;" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="prodImgPreview('<?=$prod_id?>')"><i class="fa fa-eye"></i></button> --> 
                         </td>

                         <td><?=$title?></td>
                         <td><img src="../upload/product/200_<?=$img?>" width="50" height="50" style="border-radius:4px; border:1px solid #CCCCCC"/></td>
                       
                        <td><?=$prod_pirce?></td>
                        <td><?=$order_id?></td>
                        <td><?=$order_token?></td>
                        <td><?=$transfer_amount?></td>
                        <td><?=$deduct_amount?></td>
                        
                        <td><?=$cat_price?></td>
                        <td><?=$box_price?></td>
                        
                        <td><?=str_replace("_" , " " , $trans_type)?></td>
                        <td><?=$ref_transaction?></td>
                        <td><?=$transaction_type?></td>
                        
                        
                        <td><?=$user_t_amount?></td>
                        <td><?=$user_transaction?></td>
                        
                                            </tr>
<?php } ?>                                            
                          </tbody>
                        </table>                            
<?php }?>                          
                      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
        
              
      <?php include('includes/footer.php'); ?>
