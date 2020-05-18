<?php 
include("includes/db.php");

?>

<form action="https://www.payfast.co.za/eng/process" method="POST" id="form_payment">
<input type="hidden" name="merchant_id" value="10342468">
<input type="hidden" name="merchant_key" value="1mdam9p1e1u9z">

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