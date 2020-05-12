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
            <div class="ps-section__header">
                <h3>Vendor Dasboard Pro</h3>
                <p>Designed base on WC Vendor Plugin. Martfury also fully comptatiable with other popular plugins as Dokan, YITH, etc .Can help you turns your site into multi-vendor eCommerce site.</p>
            </div>
            <div class="ps-section__content">
                <ul class="ps-section__links">
                    <li class="active"><a href="#">Dashboard</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Order</a></li>
                    <li><a href="#">Setting</a></li>
                    <li><a href="#">View Store</a></li>
                </ul>
                <form class="ps-form--vendor-datetimepicker" action="index.html" method="get">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" id="time-from">From</span></div>
                                <input class="form-control" aria-label="Username" aria-describedby="time-from">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" id="time-form">To</span></div>
                                <input class="form-control" aria-label="Username" aria-describedby="time-to">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                            <button class="ps-btn"><i class="icon-sync2"></i> Update</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <figure class="ps-block--vendor-status">
                            <figcaption>Commission Due</figcaption>
                            <table class="table ps-table ps-table--vendor-status">
                                <tbody>
                                    <tr>
                                        <td>Product</td>
                                        <td>$12.1010,444</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>$00.000</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td>$12.1010,444</td>
                                    </tr>
                                </tbody>
                            </table>
                        </figure>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <figure class="ps-block--vendor-status">
                            <figcaption>Commission Paid</figcaption>
                            <table class="table ps-table ps-table--vendor-status">
                                <tbody>
                                    <tr>
                                        <td>Product</td>
                                        <td>$12.1010,444</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>$00.000</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td>$12.1010,444</td>
                                    </tr>
                                </tbody>
                            </table>
                        </figure>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <figure class="ps-block--vendor-status">
                            <figcaption>Order Totals (25)</figcaption>
                            <canvas id="line-chart"></canvas>
                        </figure>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <figure class="ps-block--vendor-status">
                            <figcaption>Product Totals (3)</figcaption>
                            <canvas id="pie-chart"></canvas>
                        </figure>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
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
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <figure class="ps-block--vendor-status">
                            <figcaption>Recent Products</figcaption>
                            <table class="table ps-table ps-table--vendor">
                                <thead>
                                    <tr>
                                        <th><i class="icon-picture"></i></th>
                                        <th>Product</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#"><img src="img/products/electronic/1.jpg" alt="" width="50"></a></td>
                                        <td><a href="#">Marshall Kilburn Wireless...</a>
                                            <p>$295.47</p>
                                        </td>
                                        <td>
                                            <p class="ps-tag--in-stock">In Stock</p>
                                            <p>Published: Oct 10, 2018</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#"><img src="img/products/electronic/2.jpg" alt="" width="50"></a></td>
                                        <td><a href="#">Marshall Kilburn Wireless...</a>
                                            <p>$295.47</p>
                                        </td>
                                        <td>
                                            <p class="ps-tag--in-stock">In Stock</p>
                                            <p>Published: Oct 10, 2018</p>
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
    </div>
    <?php include('includes/footer.php') ?>
    