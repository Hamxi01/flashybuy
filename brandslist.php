<?php 

function brandsList($con){

	$bSql ="SELECT DISTINCT B.id,B.name FROM vendor_product AS VP LEFT JOIN products AS P ON P.product_id = VP.prod_id LEFT JOIN brands AS B ON P.brand = B.id WHERE 1 = 1 AND VP.active = 'Y' AND VP.quantity > 0 AND VP.price > 0 AND B.name IS NOT NULL";

	$bQuery = mysqli_query($con,$bSql);
	while ($bRes = mysqli_fetch_array($bQuery)) {
?>

<div class="ps-checkbox" onclick="brandproductSearch(<?=$bRes['id']?>)">
    <input class="form-control" type="checkbox"  onclick="brandproductSearch(<?=$bRes['id']?>)">
    <label for="brand-1"><?=$bRes['name']?></label>
</div>
<?php
}

}
?>