<?php include('includes/db.php'); ?>
<?php include('includes/head.php'); ?>

    <div id="homepage-1">
        <div class="ps-home-banner ps-home-banner--1">
            <div class="ps-container">
                <div class="ps-section__left">
                    <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php include('includes/slider.php'); ?>  
                    </div>
                </div>
                <div class="ps-section__right">
                <?php include('includes/banner1.php'); ?> 
                <?php include('includes/banner2.php'); ?> 
           
                </div>
            </div>
        </div>
        <div class="ps-site-features">
            <div class="ps-container">
                <div class="ps-block--site-features">
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-rocket"></i></div>
                        <div class="ps-block__right">
                            <h4>Free Delivery</h4>
                            <p>For all oders over $99</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-sync"></i></div>
                        <div class="ps-block__right">
                            <h4>90 Days Return</h4>
                            <p>If goods have problems</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-credit-card"></i></div>
                        <div class="ps-block__right">
                            <h4>Secure Payment</h4>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                        <div class="ps-block__right">
                            <h4>24/7 Support</h4>
                            <p>Dedicated support</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-gift"></i></div>
                        <div class="ps-block__right">
                            <h4>Gift Service</h4>
                            <p>Support gift service</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-deal-of-day">
            <div class="ps-container">
                <div class="ps-section__header">
                    <div class="ps-block--countdown-deal">
                        <div class="ps-block__left">
                            <h3>Deals of the day</h3>
                        </div>
                        <div class="ps-block__right">
                            <figure>
                                <figcaption>End in:</figcaption>
                                <ul class="ps-countdown" data-time="July 21, 2020 15:37:25">
                                    <li><span class="days"></span></li>
                                    <li><span class="hours"></span></li>
                                    <li><span class="minutes"></span></li>
                                    <li><span class="seconds"></span></li>
                                </ul>
                            </figure>
                        </div>
                    </div><a href="#">View all</a>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php include('includes/deal1.php'); ?>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-home-ads">
            <div class="ps-container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <?php include('includes/banner3.php'); ?> 
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <?php include('includes/banner4.php'); ?> 
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <?php include('includes/banner5.php'); ?> 
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-top-categories">
            <div class="ps-container">
                <h3>Top categories of the month</h3>
                <div class="row">
                <?php include('includes/top_categories.php')?>
                   
                  
                </div>
            </div>
        </div>
        <div class="ps-product-list ps-clothings">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>Latest Selling Products</h3>
                    <!-- <ul class="ps-section__links">
                        <li><a href="shop-grid.html">New Arrivals</a></li>
                        <li><a href="shop-grid.html">Best seller</a></li>
                        <li><a href="shop-grid.html">Must Popular</a></li>
                        <li><a href="shop-grid.html">View All</a></li>
                    </ul> -->
                </div>
                <?php include('includes/product_section.php')?>
            </div>
        </div>
        <div class="ps-product-list ps-clothings">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>Deal 2</h3>
                    <ul class="ps-section__links">
                        <!-- <li><a href="shop-grid.html">New Arrivals</a></li>
                        <li><a href="shop-grid.html">Best seller</a></li>
                        <li><a href="shop-grid.html">Must Popular</a></li>
                        <li><a href="shop-grid.html">View All</a></li> -->
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--responsive owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="2" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        <?php include('includes/deal2.php'); ?>
                        <!-- <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product.php"><img src="img/products/clothing/7.jpg" alt=""></a>
                                <div class="ps-product__badge">-46%</div>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php">MVMTH Classical Leather Watch In Black</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>02</span>
                                    </div>
                                    <p class="ps-product__price sale">$42.00 <del>$60.00 </del></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product.php">MVMTH Classical Leather Watch In Black</a>
                                    <p class="ps-product__price sale">$42.00 <del>$60.00 </del></p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-product-list ps-garden-kitchen">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>Deal 3</h3>
                    <ul class="ps-section__links">
                        <!-- <li><a href="shop-grid.html">New Arrivals</a></li>
                        <li><a href="shop-grid.html">Best seller</a></li>
                        <li><a href="shop-grid.html">Must Popular</a></li>
                        <li><a href="shop-grid.html">View All</a></li> -->
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--responsive owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        <?php include('includes/deal3.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-home-ads">
            <div class="ps-container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">  <?php include('includes/banner6.php'); ?> 
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">  <?php include('includes/banner7.php'); ?> 
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-download-app">
            <div class="ps-container">
                <div class="ps-block--download-app">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                <div class="ps-block__thumbnail"><img src="img/app.png" alt=""></div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                <div class="ps-block__content">
                                    <h3>Download Martfury App Now!</h3>
                                    <p>Shopping fastly and easily more with our app. Get a link to download the app on your phone</p>
                                    <form class="ps-form--download-app" action="do_action" method="post">
                                        <div class="form-group--nest">
                                            <input class="form-control" type="Email" placeholder="Email Address">
                                            <button class="ps-btn">Subscribe</button>
                                        </div>
                                    </form>
                                    <p class="download-link"><a href="#"><img src="img/google-play.png" alt=""></a><a href="#"><img src="img/app-store.png" alt=""></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-product-list ps-new-arrivals">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>Hot New Arrivals</h3>
                    <ul class="ps-section__links">
                        <!-- <li><a href="shop-grid.html">Technologies</a></li>
                        <li><a href="shop-grid.html">Electronic</a></li>
                        <li><a href="shop-grid.html">Furnitures</a></li>
                        <li><a href="shop-grid.html">Clothing & Apparel</a></li>
                        <li><a href="shop-grid.html">Health & Beauty</a></li>
                        <li><a href="shop-grid.html">View All</a></li> -->
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        <?php include('includes/recentaddedproduct.php') ?>
                        <!-- <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-product--horizontal">
                                <div class="ps-product__thumbnail"><a href="product.php"><img src="img/products/arrivals/1.jpg" alt=""></a></div>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php">Apple iPhone Retina 6s Plus 32GB</a>
                                    <p class="ps-product__price">$990.50</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-product--horizontal">
                                <div class="ps-product__thumbnail"><a href="product.php"><img src="img/products/arrivals/1.jpg" alt=""></a></div>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php">Apple iPhone Retina 6s Plus 64GB</a>
                                    <p class="ps-product__price">$1120.50</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-product--horizontal">
                                <div class="ps-product__thumbnail"><a href="product.php"><img src="img/products/arrivals/1.jpg" alt=""></a></div>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php">Apple iPhone Retina 6s Plus 128GB</a>
                                    <p class="ps-product__price">$1220.50</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-product--horizontal">
                                <div class="ps-product__thumbnail"><a href="product.php"><img src="img/products/arrivals/2.jpg" alt=""></a></div>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php">Marshall Kilburn Portable Wireless Speaker</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$36.78 – $56.99</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-product--horizontal">
                                <div class="ps-product__thumbnail"><a href="product.php"><img src="img/products/arrivals/3.jpg" alt=""></a></div>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php">Herschel Leather Duffle Bag In Brown Color</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>02</span>
                                    </div>
                                    <p class="ps-product__price">$125.30</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-product--horizontal">
                                <div class="ps-product__thumbnail"><a href="product.php"><img src="img/products/arrivals/4.jpg" alt=""></a></div>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php">Xbox One Wireless Controller Black Color</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>02</span>
                                    </div>
                                    <p class="ps-product__price">$55.30</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-product--horizontal">
                                <div class="ps-product__thumbnail"><a href="product.php"><img src="img/products/arrivals/5.jpg" alt=""></a></div>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php">Grand Slam Indoor Of Show Jumping Novel</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>02</span>
                                    </div>
                                    <p class="ps-product__price sale">$41.27 <del>$52.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-product--horizontal">
                                <div class="ps-product__thumbnail"><a href="product.php"><img src="img/products/arrivals/6.jpg" alt=""></a></div>
                                <div class="ps-product__content"><a class="ps-product__title" href="product.php">Sound Intone I65 Earphone White Version</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$41.27 <del>$62.39 </del></p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/deal1Quickview.php');    ?>
        <?php include('includes/deal2Quickview.php');    ?>
        <?php include('includes/deal3Quickview.php');    ?>
        <?php include('includes/psectionquickview.php'); ?>
<?php include('includes/footer.php'); ?>