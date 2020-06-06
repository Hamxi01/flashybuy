<?php
function subCategories($category_id,$con){
	$subSql = "SELECT DISTINCT SC.sub_cat_id,SC.name FROM vendor_product AS VP LEFT JOIN products AS P ON P.product_id = VP.prod_id LEFT JOIN sub_categories AS SC ON P.sub_cat_id = SC.sub_cat_id WHERE 1 = 1 AND VP.active = 'Y' AND VP.quantity > 0 AND VP.price > 0 AND SC.category_id ='$category_id'";

$subQuery = mysqli_query($con,$subSql);
while ($catRes = mysqli_fetch_array($subQuery)) {


?>
                                    <li class="current-menu-item"><a onclick="subCategoriesSearch(<?=$catRes['sub_cat_id']?>)" ><?=$catRes['name']?></a>
                                    </li>
<?php } }?>