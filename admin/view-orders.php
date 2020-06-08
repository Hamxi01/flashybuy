<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
     
      $newOrderids ='OR';
            $limit = 10;
$prow ="SELECT count(*) as totalOrdr
                      FROM orders AS O LEFT JOIN products AS P ON O.order_prod_id = P.product_id 
                      LEFT JOIN customers AS C ON O.order_user = C.id
                      ORDER BY order_id DESC";

      $prow = mysqli_query($con,$prow);
      $row = mysqli_fetch_array($prow);
      $totalRow = $row['0'];
      $total_pages = ceil($totalRow / $limit);
?>
<?php 

if(isset( $_POST['action']) && $_POST['action'] == "set_process"){

  $refernce_number = addslashes( $_POST['refernce_number'] );
  $date_order      = strtotime( $_POST['date_order']);
  $notes           = addslashes($_POST['notes'] );
  

  $order_ids = $_POST['set_order_ids'];
  
    $sP = "UPDATE orders SET order_status = 'inprog' , order_payment_time = UNIX_TIMESTAMP() , refernce_number = '$refernce_number' , 
                        date_order_process = '$date_order' , notes = '$notes'  WHERE order_ids = '$order_ids'";
    
    mysqli_query( $con , $sP );
  
    $ik = 1;
  
    $tc = " SELECT * FROM orders WHERE order_ids = '$order_ids' ";
    $sTc = mysqli_query( $con , $tc );
    while( $rTc = mysqli_fetch_array( $sTc ) ){
    
      $order_wallet_price =  $rTc["order_wallet_price"];  
      $order_pay_price    =  $rTc["order_pay_price"];
      
      $order_prod_id    =  $rTc["order_prod_id"];

      $pSql = mysqli_query($con ,"SELECT * FROM products WHERE product_id ='$order_prod_id'");
      while ($pRes = mysqli_fetch_array($pSql)) {


        $order_prod_name = $pRes['name'];
      }
      $order_token        =  $rTc["order_token"]; 
      
      $courier_fees       =  $rTc["courier_fees"];  
      $order_price        =  $rTc["order_price"]; 
      $user_id          =  $rTc["order_user"];  
      
      $order_payment_payed = $rTc["order_payment_payed"]; 
      $order_wallet_payed  =  $rTc["order_wallet_payed"]; 
      
      
      
      if( $ik == 1 ){ 
      
        $t  = " select * from transaction where user_id = '$user_id' AND trans_type_user  = 'customer' order by transaction_id DESC LIMIT 1 ";
        $sT = mysqli_query( $con , $t);
        $rT = mysqli_fetch_array( $sT );
        $lb = intval( $rT["user_transaction"] );
                
        $user_transaction = intval($lb)-intval($order_wallet_price);
        
        $sT = " INSERT INTO transaction SET time_id = unix_timestamp(), 
                          user_id             = '$user_id',
                          trans_type          = 'Order Transaction Credit Ref# $order_ids',
                          user_transaction    = '$user_transaction',
                          user_t_amount       = '$order_wallet_price'
                          note                = 'Order Transaction',
                          trans_type_user     = 'customer',
                          
                          order_transaction   = '$order_ids',
                          order_token         = '$order_token',
                          
                          order_refund        = 'Y',
                          transaction_type    = 'auto'";
        
        mysqli_query( $con , $sT );
      
      }
      
      $ik++;
      
      
      $orderDetail = 'Order Detail - ' . $order_prod_name . ' - ' . $order_token . '<br />' . 'Courier Fees : ' . $courier_fees . '<br /> Order Price : ' . $order_price;
      $orderDetail_wallet = 'Wallet : Order Detail - ' . $order_prod_name . ' - ' . $order_token . '<br />' . 'Courier Fees : ' . $courier_fees . '<br /> Order Price : ' . $order_price;
      
      
      if( $order_wallet_price > 0 ){
      
        $t  = " select * from transaction where user_id = '$user_id' AND trans_type_user  = 'customer' order by transaction_id DESC LIMIT 1 ";
        $sT = mysqli_query( $con , $t);
        $rT = mysqli_fetch_array( $sT );
        $lb = intval( $rT["user_transaction"] );
                
        $user_transaction = intval($lb)-intval($order_wallet_price);
        
        $sT = " INSERT INTO transaction SET time_id = unix_timestamp(), 
                          user_id             = '$user_id',
                          trans_type          = 'Order Transaction Credit Ref# $order_ids',
                          user_transaction    = '$user_transaction',
                          user_t_amount       = '$order_wallet_price'
                          note                = 'Order Transaction',
                          trans_type_user     = 'customer',
                          
                          order_transaction   = '$order_ids',
                          order_token         = '$order_token',
                          
                          order_refund        = 'Y',
                          transaction_type    = 'auto'";
        echo "<br />";
        mysqli_query( $con , $sT );
      }
      
      
      if( $order_pay_price > 0 ){
      
        
        $t  = " select * from sp_transaction where user_id = '$user_id' AND trans_type_user  = 'customer' order by transaction_id DESC LIMIT 1 ";
        $sT = mysqli_query( $link , $t);
        $rT = mysqli_fetch_array( $sT );
        
        $lb = intval( $rT["user_transaction"] );
                
        $user_transaction = intval($lb)-intval($order_wallet_price);
        
        $sT = " INSERT INTO sp_transaction SET time_id = unix_timestamp(), 
                          user_id             = '$user_id',
                          trans_type          = 'Order Transaction Credit Ref# $order_ids',
                          user_transaction    = '$user_transaction',
                          user_t_amount       = '$order_wallet_price'
                          note                = 'Order Transaction',
                          trans_type_user     = 'customer',
                          
                          order_transaction   = '$order_ids',
                          order_token         = '$order_token',
                          
                          order_refund        = 'Y',
                          transaction_type    = 'auto'";
        
        echo "<br />";
        mysqli_query( $con , $sT );
          
      }   
    }
}    



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
                            <tr>
                              <th>All Orders</th>
                            </tr>
                            <!-- <tr>
                              <th><button class="btn" style="border: 1px grey solid" type="button">New Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Dispatched Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Completed Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Cancelled Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Pending Payment</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">All Orders</button></th>
                            </tr>
                          <tbody>
                          </tbody> -->
                      </table>
                      <table class="table table-bordered table-order">
                        
                      </table>
                      <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0" id="pagination">
                        <?php if(!empty($total_pages)){for($i=1; $i<=$total_pages; $i++){  
                            if($i == 1){?>
                              <li class="page-item active" id="<?php echo $i;?>"><a class="page-link" href="action/productPagination.php?page=<?php echo $i;?>"><?php echo $i;?><span class="sr-only">(current)</span></a></li> 
                                <?php } else{ ?>
                                  <li class="page-item" id="<?php echo $i;?>"><a class="page-link" href="action/productPagination.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                              <?php }?>      
                          <?php }}?>
                      </ul>
                    </nav>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
        <form id="form_order" name="form_order" method="post" >
 <input type="hidden" id="action" name="action"  value="set_process"  />
 <input type="hidden" id="set_order_ids" name="set_order_ids" value=""  />
  <div class="modal fade " id="orderModal">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body" >
    
    <div >
      <div class="row" style="" >
        <div class="col-lg-12" ><h4>Payment Confirmation</h4></div>
      </div>
      <div class="row" style="padding-top:10px" >
        <div class="col-lg-6" ><h4>To be Paid : <span id="spn_paid" ></span></h4></div>
        <div class="col-lg-6" ><h4>By Wallet Paid : <span id="spn_wallet" ></span></h4></div>
      </div>
      <div class="row" style="padding-top:10px" >
        <div class="col-lg-5" >Date</div>
        <div class="col-lg-7" ><input type="text" id="date_order" name="date_order"  value="" class="datepicker form-control" readonly=""  /></div>
      </div>
          <div class="row" style="padding-top:10px" >
        <div class="col-lg-5" >Payment Reference Number</div>
        <div class="col-lg-7" ><input type="text" id="refernce_number" name="refernce_number"  value=""  class="form-control" autocomplete="off" /></div>
      </div>
      <div class="row" style="padding-top:10px" >
        <div class="col-lg-5" >Note</div>
        <div class="col-lg-7" ><input type="text" id="notes" name="notes"  value=""  class="form-control" autocomplete="off" /></div>
      </div>
        <div class="row" style="padding-top:10px" >
        <div class="col-lg-12" align="center" ><input type="submit" class="btn btn-primary btn-lg" value="Process Order"  /></div>
      </div>
      
      </div>
        </div>
      </div>
    </div>
  </div>
  </form>
              
      <?php include('includes/footer.php'); ?>
<script type="text/javascript">
 
  $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
  });
  function showOModal( order_ids , payment_paid , wallet_paid ){
    $("#set_order_ids").val(order_ids);
    $("#orderModal").modal('show');
    
    $("#spn_paid").html(payment_paid);
    $("#spn_wallet").html(wallet_paid);
    
    
  }
  $(document).ready(function() {

    $(".table-order").load("action/orderPagination.php?page=1");
        $("#pagination li").on('click',function(e){
      e.preventDefault();
      $("#pagination li").removeClass('active');
      $(this).addClass('active');
      var pageNum = this.id;
      $(".table-order").load("action/orderPagination.php?page=" + pageNum);
    });
});
</script>