<?php include('../../includes/db.php');

if (isset($_POST['variation_id'])) {
	

	$variation_id = base64_decode($_POST['variation_id']);

	$query = mysqli_query($con, "SELECT * From product_variations where variation_id = '$variation_id'");
	while ($row = mysqli_fetch_array($query)){

		$first_variation_name  = $row['first_variation_name'];
		$second_variation_name = $row['second_variation_name'];
		$third_variation_name  = $row['third_variation_name'];
		$forth_variation_name  = $row['forth_variation_name'];
		$product_id            = $row['product_id'];
	}
}
?>
<?php if (!empty($first_variation_name)) { ?>
	<div class="form-group">
    	<label><?php echo $first_variation_name;  ?></label>
    	<input type="text" name="first_variation_value" id="stock" class="form-control">
	</div>
<?php } ?>
<?php if (!empty($second_variation_name)) { ?>
	<div class="form-group">
    	<label><?php echo $second_variation_name;  ?></label>
    	<input type="text" name="second_variation_value" id="stock" class="form-control">
	</div>
<?php } ?>
<?php if (!empty($third_variation_name)) { ?>
	<div class="form-group">
    	<label><?php echo $third_variation_name;  ?></label>
    	<input type="text" name="third_variation_value" id="stock" class="form-control">
	</div>
<?php } ?>
<?php if (!empty($forth_variation_name)) { ?>
	<div class="form-group">
    	<label><?php echo $forth_variation_name;  ?></label>
    	<input type="text" name="forth_variation_value" id="stock" class="form-control">
	</div>
<?php } ?>
<div class="form-group">
    <label>Quantity</label>
    <input type="number" name="stock" id="stock" class="form-control">
</div>
<div class="form-group">
	<label>Price</label>
	<input type="number" name="price" id="selling_price" class="form-control">
</div>
<input type="hidden" name="product_id" value="<?=$product_id?>">
<input type="hidden" name="first_variation_name" value="<?=$first_variation_name?>">
<input type="hidden" name="second_variation_name" value="<?=$second_variation_name?>">
<input type="hidden" name="forth_variation_name" value="<?=$forth_variation_name?>">
<input type="hidden" name="product_id" value="<?=$product_id?>">
<button type="button" onclick="saveVariant()" class="btn btn-primary m-t-15 waves-effect">Save</button>