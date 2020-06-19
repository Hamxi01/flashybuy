<?php 
include("includes/db.php");

$total_price_get = $_SESSION['total_price_get'];
$order_ids		 = $_SESSION['order_ids'];

$user_id    = $_SESSION['id'];
$user_name  = $_SESSION['name'];

$sL   = " SELECT * FROM customers WHERE id = '$user_id' ";
$sQry = mysqli_query( $con , $sL );
$rQry = mysqli_fetch_array( $sQry );

$user_email         = $rQry["email"];
$payment_method = $_REQUEST['payment_method'];
?>

<form action="https://sandbox.payfast.co.za/eng/process" method="POST" id="form_payment">
<input type="hidden" name="merchant_id" value="10000100">
<input type="hidden" name="merchant_key" value="46f0cd694581a">
<!-- <input type="hidden" name="return_url" value="return.php"> -->
<!-- <input type="hidden" name="cancel_url" value="cancel.php"> -->
<!-- <input type="hidden" name="notify_url" value="notify.php"> -->
<input type="hidden" name="name_first" value="<?=$user_name?>">
<input type="hidden" name="email_address" value="<?=$user_email?>">

<input type="hidden" name="m_payment_id" value="<?=$order_ids?>">
<input type="hidden" name="amount" value="<?=number_format( $total_price_get , 2 )?>">
<input type="hidden" name="item_name" value="Order by <?=$user_name?> <?=$order_ids?>">
<input type="hidden" name="item_description" value="Order by <?=$user_name?> , for <?=$order_ids?> ">


<input type="hidden" name="email_confirmation" value="1">
<input type="hidden" name="confirmation_address" value="<?=$user_email?>">


<input type="hidden" name="payment_method" value="<?=$payment_method?>">


</form>

<script>
	  document.getElementById("form_payment").submit();  
</script>