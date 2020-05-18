<?php 
include("includes/db.php");



$SiteCode = "FLA-FLA-001";
$CountryCode = "ZA";
$CurrencyCode = "ZAR";
$Amount = $total_price_get;
$TransactionReference = $order_ids;
$BankReference = $order_ids;
$Optional1 = $order_ids;
$Customer = $user_name;
$IsTest = "false";

$hash_check = $SiteCode.$CountryCode.$CurrencyCode.$Amount.$TransactionReference.$BankReference.$Optional1.$Customer.$CancelUrl.$ErrorUrl.$SuccessUrl.$NotifyUrl.$IsTest;
$private_key = 'ta9uMlRNxcFpbr6VsIuosIFC4FJPItVi';

$hash_check = hash('sha512', strtolower( $hash_check . $private_key));

	
?>		


<form id="ipay_form" method="post" action="https://i-pay.co.za/payment">
<input type="hidden" name="SiteCode" value="FLA-FLA-001">
<input type="hidden" name="CountryCode" value="ZA">
<input type="hidden" name="CurrencyCode" value="ZAR">
<input type="hidden" name="Amount" value="<?=$total_price_get?>">
<input type="hidden" name="TransactionReference" value="<?=$order_ids?>">
<input type="hidden" name="BankReference" value="<?=$order_ids?>">
<input type="hidden" name="Optional1" value="<?=$order_ids?>">
<input type="hidden" name="Customer" value="<?=$user_name?>">

<input type="hidden" name="IsTest" value="true">
<input type="hidden" name="HashCheck" value="<?=$hash_check?>">
</form>
<script>
    document.getElementById("ipay_form").submit();  
</script>