<?php   
$categoryQuery = 'SELECT  * from categories where banner!="" AND delte=0 limit 8';
$categorySql = mysqli_query($con,$categoryQuery);
while ( $categoryResult = mysqli_fetch_array($categorySql)) { ?>
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 ">
        <div class="ps-block--category">
            <a class="ps-block__overlay" href="product-list.php?cat_id=<?=$categoryResult['cat_id']?>"></a>
                <img src="upload/category/170_<?=$categoryResult['banner'];?>" class="img-fluid" style="height: 150px; object-fit: cover;" alt="">
            <p>
                <?php 
                $prod_name = $categoryResult['name'];
                if (strlen($categoryResult['name']) > 12){
                    $prod_name = substr($categoryResult['name'], 0, 12) . '..';
                }    
                ?>
                <?= $prod_name; ?>
            </p>
        </div>
    </div>
<?php } ?>