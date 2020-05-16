<?php   
$categoryQuery = 'SELECT  * from categories where banner!="" AND delte=0 limit 8';
$categorySql = mysqli_query($con,$categoryQuery);
while ( $categoryResult = mysqli_fetch_array($categorySql)) { ?>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 ">
                        <div class="ps-block--category"><a class="ps-block__overlay" href="shop-default.html"></a><img src="upload/category/170_<?=$categoryResult['banner'];?>" alt="">
                            <p><?=$categoryResult['name'];?></p>
                        </div>
                    </div>
<?php } ?>