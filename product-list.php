<?php  include('includes/db.php'); 
       include('includes/head.php');  
       include('subcategories.php');
       include('brandslist.php');

$limit=4;
?>

<?php
if (isset($_GET['search'])) { 
    
    $keyword = $_GET['search'];
    $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND (P.name like '%$keyword%'  OR P.description like '%$keyword%')";

    $link = "&search=".$keyword;                   

} 
if (isset($_GET['cat_id'])) { 
    
    $cat_id = $_GET['cat_id'];
    $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND P.cat_id = '$cat_id'";

    $link = "&cat_id=".$cat_id;                   

}
if (isset($_GET['subcat_id'])) {
    
    $subcat_id = $_GET['subcat_id'];
    $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP

                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND P.sub_cat_id = '$subcat_id'"; 
  $link = "&subcat_id=".$subcat_id;
    
}
if (isset($_GET['brand_id'])) {
    
    $brand_id = $_GET['brand_id'];
    $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP

                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND P.brand = '$brand_id'";

  $link = "&brand_id=".$brand_id;
    
}

if (isset($_GET['price_range'])) {
    
    $price_range = $_GET['price_range'];
    if ($price_range == '0_100') {

        $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP

                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      AND VP.price < 100";

    }
    if ($price_range == '100_250') {
        $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP

                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 100
                      AND VP.price < 250";
    }
    if ($price_range == '250_500') {
        $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP

                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 250
                      AND VP.price < 500";
    }
    if ($price_range == '500_750') {
        $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP

                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 500
                      AND VP.price < 750";
    }
    if ($price_range == '750_1000') {
        $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP

                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 750
                      AND VP.price < 1000";
    }
    if ($price_range == '=>1000') {
        $countSql =  "SELECT
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP

                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0
                      AND VP.price > 1000";
    }
    

  $link = "&price_range=".$price_range;
    
}
$totalCount = 0;


?>
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>Shop</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--shop">
        <div class="ps-container">
            
            <div class="ps-shop-categories">
               
            </div>
            <div class="ps-layout--shop">
                <div class="ps-layout__left">
                    <aside class="widget widget_shop">
                        <h4 class="widget-title">Categories</h4>
                        <ul class="ps-list--categories">
<?php 

$catSql = "SELECT DISTINCT C.cat_id as category_id,C.name FROM vendor_product AS VP LEFT JOIN products AS P ON P.product_id = VP.prod_id LEFT JOIN categories AS C ON P.cat_id = C.cat_id WHERE 1 = 1 AND VP.active = 'Y' AND VP.quantity > 0 AND VP.price > 0 AND C.name IS NOT NULL";
$catQuery = mysqli_query($con,$catSql);
while ($catRes = mysqli_fetch_array($catQuery)) {
     
    $category_id = $catRes['category_id'];

?>                            
                            <li class="current-menu-item menu-item-has-children"><a href="product-list.php?cat_id=<?=$category_id?>"><?=$catRes['name']?></a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                             
                                <ul class="sub-menu">
                                    <?php echo subCategories($category_id,$con); ?>
                                </ul>
                            </li>
<?php }  ?>                
                        </ul>
                    </aside>
                    <aside class="widget widget_shop">
                        <h4 class="widget-title">BY BRANDS</h4>
                        <!-- <form class="ps-form--widget-search" action="do_action" method="get">
                            <input class="form-control" type="text" placeholder="">
                            <button><i class="icon-magnifier"></i></button>
                        </form> -->
                        <figure class="ps-custom-scrollbar" data-height="250">
                            
                            <?php echo brandsList($con); ?>
                        </figure>
                        <figure>
                            <h4 class="widget-title">By Price</h4>
                            <div id="nonlinear"></div>
                            <ul>
                                <li><a onclick="productPriceSeacrh(100)" id="R100">R0-R100</a></li>
                                <li><a onclick="productPriceSeacrh(250)" id="R250">R100-R250</a></li>
                                <li><a onclick="productPriceSeacrh(500)" id="R500">R250-R500</a></li>
                                <li><a onclick="productPriceSeacrh(750)" id="R750">R500-R750</a></li>
                                <li><a onclick="productPriceSeacrh(900)" id="R900">R750-R1000</a></li>
                                <li><a onclick="productPriceSeacrh(1000)" id="R1000">Above R1000</a></li>
                            </ul>
                            
                            <!-- <p class="ps-slider__meta">Price:<span class="ps-slider__value">R0<span class="ps-slider__min"></span></span>-<span class="ps-slider__value">R100<span class="ps-slider__max"></span></span></p> -->
                        </figure>
                        <!-- <figure>
                            <h4 class="widget-title">By Price</h4>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-1" name="review">
                                <label for="review-1"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i></span><small>(13)</small></label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-2" name="review">
                                <label for="review-2"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i></span><small>(13)</small></label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-3" name="review">
                                <label for="review-3"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span><small>(5)</small></label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-4" name="review">
                                <label for="review-4"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span><small>(5)</small></label>
                            </div>
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="review-5" name="review">
                                <label for="review-5"><span><i class="fa fa-star rate"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span><small>(1)</small></label>
                            </div>
                        </figure> -->
                        <!-- <figure>
                            <h4 class="widget-title">By Color</h4>
                            <div class="ps-checkbox ps-checkbox--color color-1 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-1" name="size">
                                <label for="color-1"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-2 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-2" name="size">
                                <label for="color-2"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-3 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-3" name="size">
                                <label for="color-3"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-4 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-4" name="size">
                                <label for="color-4"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-5 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-5" name="size">
                                <label for="color-5"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-6 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-6" name="size">
                                <label for="color-6"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-7 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-7" name="size">
                                <label for="color-7"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-8 ps-checkbox--inline">
                                <input class="form-control" type="checkbox" id="color-8" name="size">
                                <label for="color-8"></label>
                            </div>
                        </figure> -->
                        <!-- <figure class="sizes">
                            <h4 class="widget-title">BY SIZE</h4><a href="#">L</a><a href="#">M</a><a href="#">S</a><a href="#">XL</a>
                        </figure> -->
                    </aside>
                </div>
                <div class="ps-layout__right">

                    <div class="ps-shopping ps-tab-root">
                        <div class="ps-shopping__header">
<?php 

  $productCount = mysqli_query($con,$countSql);

  while ($totalRes = mysqli_fetch_array($productCount)) {

        $totalCount  = $totalRes['total'];
        $total_pages = ceil($totalCount / $limit);
  }


?>                            
                            <p><strong> <?=$totalCount?></strong> Products found</p>
                            <div class="ps-shopping__actions">
                                <select class="ps-select" data-placeholder="Sort Items">
                                    <option>Sort by latest</option>
                                    <option>Sort by popularity</option>
                                    <option>Sort by average rating</option>
                                    <option>Sort by price: low to high</option>
                                    <option>Sort by price: high to low</option>
                                </select>
                                <div class="ps-shopping__view">
                                    <p>View</p>
                                    <ul class="ps-tab-list">
                                        <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                                        <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="list">
                        
<?php 


  $productSql = mysqli_query($con,$productQuery);
  while ( $productResult = mysqli_fetch_array($productSql)) {

        $product_id = $productResult['prod_id'];
  $name       = $productResult['name'];
  $min        = $productResult['min'];
  $max        = $productResult['max'];

  if (!empty($productResult['variation_id'])) {
    
  
      if ($max==$min) {
             
        $price = $min;
      }
      else{

        $price = $min."-".$max;
      }
  }else{

      $price = $productResult['price'];
  }     
  $image = $productResult['image1'];
  if (empty($image)) {
    
      $varaintImgQuery = "SELECT main_img from product_variant_images where product_id ='$product_id'";
      $varaintImgSql   = mysqli_query($con,$varaintImgQuery);
      while ($productVaraintImg = mysqli_fetch_array($varaintImgSql)) {

        $image = $productVaraintImg['main_img'];
      }
  }

?>
                                        
<?php   } 
?>
                                  
                            </div>
                            <div class="ps-pagination">
                                    <ul class="pagination" id="pagination">
                                    <?php if(!empty($total_pages)){for($i=1; $i<=$total_pages; $i++){  
                                        if($i == 1){?>
                                        <li class="active" id="<?php echo $i;?>"><a href="actions/productlistPagination.php?page=<?php echo $i;?><?=$link?>"><?php echo $i;?></a></li>
                                        <?php } else{ ?>
                                        <li id="<?php echo $i;?>"><a href="actions/productlistPagination.php?page=<?php echo $i;?><?=$link?>"><?php echo $i;?></a></li>
                                        <?php }?>      
                                    <?php }}?>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="shop-filter-lastest" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="list-group"><a class="list-group-item list-group-item-action" href="#">Sort by</a><a class="list-group-item list-group-item-action" href="#">Sort by average rating</a><a class="list-group-item list-group-item-action" href="#">Sort by latest</a><a class="list-group-item list-group-item-action" href="#">Sort by price: low to high</a><a class="list-group-item list-group-item-action" href="#">Sort by price: high to low</a><a class="list-group-item list-group-item-action text-center" href="#" data-dismiss="modal"><strong>Close</strong></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
<script type="text/javascript">
    function subCategoriesSearch(sub_cat_id){

        window.location.assign('product-list.php?subcat_id='+sub_cat_id);
    }
    function brandproductSearch(brand_id){

        window.location.assign('product-list.php?brand_id='+brand_id);
    }
    function productPriceSeacrh(val){

        if (val == '100') {


            window.location.assign('product-list.php?price_range='+'0_100');
        }
        if (val == '250') {


            window.location.assign('product-list.php?price_range='+'100_250');
        }
        if (val == '500') {


            window.location.assign('product-list.php?price_range='+'250_500');
        }
        if (val == '750') {


            window.location.assign('product-list.php?price_range='+'500_750');
        }
        if (val == '900') {


            window.location.assign('product-list.php?price_range='+'750_1000');
        }
        if (val == '1000') {


            window.location.assign('product-list.php?price_range='+'=>1000');
        }
    }
<?php 
if (isset($_GET['cat_id'])) { $cat_id = $_GET['cat_id'];?>


    $(document).ready(function() {

        $(".list").load("actions/productlistPagination.php?page=1&cat_id=<?=$cat_id?>");
            $("#pagination li").on('click',function(e){
          e.preventDefault();
          $("#pagination li").removeClass('active');
          $(this).addClass('active');
          var pageNum = this.id;
          $(".list").load("actions/productlistPagination.php?page=" + pageNum+"&cat_id=<?=$cat_id?>");
        });
    });

<?php } ?>    

<?php 
if (isset($_GET['subcat_id'])) { $subcat_id = $_GET['subcat_id'];?>


    $(document).ready(function() {

        $(".list").load("actions/productlistPagination.php?page=1&subcat_id=<?=$subcat_id?>");
            $("#pagination li").on('click',function(e){
          e.preventDefault();
          $("#pagination li").removeClass('active');
          $(this).addClass('active');
          var pageNum = this.id;
          $(".list").load("actions/productlistPagination.php?page=" + pageNum+"&subcat_id=<?=$subcat_id?>");
        });
    });

<?php } ?>

<?php 
if (isset($_GET['brand_id'])) { $brand_id = $_GET['brand_id'];?>


    $(document).ready(function() {

        $(".list").load("actions/productlistPagination.php?page=1&brand_id=<?=$brand_id?>");
            $("#pagination li").on('click',function(e){
          e.preventDefault();
          $("#pagination li").removeClass('active');
          $(this).addClass('active');
          var pageNum = this.id;
          $(".list").load("actions/productlistPagination.php?page=" + pageNum+"&brand_id=<?=$brand_id?>");
        });
    });

<?php } ?>

<?php 
if (isset($_GET['price_range'])) { $brand_id = $_GET['price_range'];?>


    $(document).ready(function() {

        $(".list").load("actions/productlistPagination.php?page=1&price_range=<?=$price_range?>");
            $("#pagination li").on('click',function(e){
          e.preventDefault();
          $("#pagination li").removeClass('active');
          $(this).addClass('active');
          var pageNum = this.id;
          $(".list").load("actions/productlistPagination.php?page=" + pageNum+"&price_range=<?=$price_range?>");
        });
    });

<?php } ?>
<?php 
if (isset($_GET['search'])) { $search = $_GET['search'];?>


    $(document).ready(function() {

        $(".list").load("actions/productlistPagination.php?page=1&search=<?=$search?>");
            $("#pagination li").on('click',function(e){
          e.preventDefault();
          $("#pagination li").removeClass('active');
          $(this).addClass('active');
          var pageNum = this.id;
          $(".list").load("actions/productlistPagination.php?page=" + pageNum+"&search=<?=$search?>");
        });
    });

<?php } ?>
</script>    