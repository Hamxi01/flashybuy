<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
     
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
                            <tr>
                              <th><button class="btn" style="border: 1px grey solid" type="button">New Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Dispatched Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Completed Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Cancelled Orders</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">Pending Payment</button></th>
                              <th><button class="btn" style="border: 1px grey solid" type="button">All Orders</button></th>
                            </tr>
                          <tbody>
                          </tbody>
                      </table>
                      <table class="table table-light table-bordered">
                        <thead>
                          <tr>
                            <th>Order Date</th>
                            <th>Product Title</th>
                            <th>Qty</th>
                            <th>Payment_Method</th>
                            <th>Order_Price</th>
                            <th>Due Days</th>
                            <th>Seller_Detail</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php 

    $ordrSql = "SELECT time_id , order_usr_address , order_usr_address , order_token,order_status,order_id,order_ids,
             order_delivered,order_vendor_name,order_ven_prod,order_vendor_id,order_prod_id,order_prod_price,order_price,quantity,order_transaction
            FROM orders AS O 
            LEFT JOIN
                     products AS P 
            ON O.product_id = P.product_id
            ORDER BY order_id DESC";

    $ordrQry = mysqli_query($con,$ordrSql);
    $ordrRes = mysqli_fetch_array($ordrQry);
    echo "<pre>";
    print($ordrRes);
?>
                          <tr>
                            <td colspan="8" style="text-align: center;font-weight: bold;">Order No : OR_895671</td>
                          </tr>
                          <tr>
                            <td colspan="8"><b>Customer information</b><br>
                                <p>Customer : khaya Dlabane Address: 121 St. Lucia road  City: Mtubatuba Subrbu: Mtubatuba Phone No: 0726177354  Zipcode: 3935 Email: khayadlabane@gmail.com</p>
                            </td>
                          </tr>
                          <tr>
                            <td>15-12-2019</td>
                            <td> 
                              <a href="">Mini LED Projector with LCD Image System - White</a> <br>
                              <img src="ddd.jpg"> token : 14-4-543
                            </td>
                            <td>12</td>
                            <td>PayFast</td>
                            <td>799.0</td>
                            <td>2 days</td>
                            <td>Seller : MULTIJUNCTION</td>
                            <td><div class="badge badge-success">Completed</div></td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
                <!-- Current Products in deals -->
                <!-- <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                          <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Id</th>
                            <th>Vendor</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Market Price</th>
                            <th>Deal price</th>
                            <th>Quantity</th>
                            <th></th>
                            <th></th>
                          </tr>
                        <tbody>                                                 
                          <tr style="font-size:13px !important; font-weight:bold ">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>                                                
                        </tbody>  
                      </table>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </section>
      </div>
        
              
      <?php include('includes/footer.php'); ?>
<script type="text/javascript">
 
  $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>