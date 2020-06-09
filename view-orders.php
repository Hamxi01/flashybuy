<?php include('includes/db.php'); ?>
<?php include('includes/head.php'); ?>

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
                        <li><a href="my-account.php">Dashboard</a></li>
                        <li  class="active"><a href="view-addresses.php">My Addresses</a></li>
                        <li><a href="view-orders.php">view Orders</a></li>
                        <!-- <li><a href="#">Setting</a></li> -->
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
            <figure class="ps-block--vendor-status">
                <figcaption>Recent Orders</figcaption>
                <table class="table ps-table ps-table--vendor">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Totals</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#">MS46891357</a>
                                <p>Nov 4, 2017</p>
                            </td>
                            <td><a href="#">1 x Marshall Kilburn Portable...</a>
                                <p>Shipping</p>
                            </td>
                            <td>
                                <p>$295.47</p>
                                <p>$0.00</p>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="#">MS46891357</a>
                                <p>Nov 2, 2017</p>
                            </td>
                            <td><a href="#">1 x Unero Military Classical Ba...</a>
                                <p>Shipping</p>
                            </td>
                            <td>
                                <p>$45.39</p>
                                <p>$0.00</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="ps-block__footer"><a href="#">View All Orders</a></div>
            </figure>
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
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>