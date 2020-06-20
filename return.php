<?php
include("includes/db.php");
session_start();

$user_id	= $_SESSION['id'];
$order_ids  = $_SESSION['order_ids'];
$total_wallet_price = $_SESSION['total_wallet_price'];
$total_price_get    = $_SESSION['total_price_get'];



$_SESSION['product_cart'] = '';
unset( $_SESSION['product_cart'] );

$tc = " SELECT * FROM orders WHERE order_ids = '$order_ids' LIMIT 1 ";
$sTc = mysqli_query( $con , $tc );
$rTc = mysqli_fetch_array( $sTc );
$order_token = $rTc["order_token"];




$sU = "UPDATE customer SET wallet_price = (wallet_price-$total_wallet_price) WHERE user_id = '$user_id' ";
mysqli_query( $con , $sU );

$t  = " select * from transaction where user_id = '$user_id' AND trans_type_user  = 'customer' order by transaction_id DESC LIMIT 1 ";
$sT = mysqli_query( $con , $t);
$rT = mysqli_fetch_array( $sT );
$lb = intval( $rT["user_transaction"] );

$vBalance = " user_transaction = ( $lb+$total_price_get) , "; $user_t_amount = " user_t_amount=$total_price_get,";

$sT = " INSERT INTO transaction SET time_id = unix_timestamp(), 
									user_id 			= '$user_id',
									trans_type 			= 'Order Transaction Credit Ref# $order_ids',
									
									$vBalance
									$user_t_amount
									note				= 'Order Transaction Credit Ref# $order_ids',
									
									order_transaction	= '$order_ids',
									order_token			= '$order_token', 
									
									
									
									trans_type_user     = 'customer',
									order_refund		= 'Y',
									transaction_type 	= 'auto'";

mysqli_query( $con , $sT );


$sP = "UPDATE orders SET order_status = 'inprog' , order_payment_time = UNIX_TIMESTAMP(), order_wallet_payed = '$total_wallet_price' ,order_payment_payed = '$total_price_get'  WHERE order_ids = '$order_ids'";
mysqli_query( $con , $sP );


$tc = " SELECT * FROM orders WHERE order_ids = '$order_ids' ";
$sTc = mysqli_query( $con , $tc );
while( $rTc = mysqli_fetch_array( $sTc ) ){

	$order_wallet_price =  $rTc["order_wallet_price"];	
	$order_pay_price    =  $rTc["order_pay_price"];
	
	$order_prod_name    =  $rTc["order_prod_name"];
	$order_token        =  $rTc["order_token"];	
	
	$courier_fees       =  $rTc["courier_fees"];	
	$order_price        =  $rTc["order_price"];	
	
	
	
	
	
	
	
	
	$orderDetail = 'Order Detail - ' . $order_prod_name . ' - ' . $order_token . '<br />' . 'Courier Fees : ' . $courier_fees . '<br /> Order Price : ' . $order_price;
	$orderDetail_wallet = 'Wallet : Order Detail - ' . $order_prod_name . ' - ' . $order_token . '<br />' . 'Courier Fees : ' . $courier_fees . '<br /> Order Price : ' . $order_price;
	
	
	if( $order_wallet_price > 0 ){
	
		$t  = " select * from transaction where user_id = '$user_id' AND trans_type_user  = 'customer' order by transaction_id DESC LIMIT 1 ";
		$sT = mysqli_query( $con , $t);
		$rT = mysqli_fetch_array( $sT );
		$lb = intval( $rT["user_transaction"] );	
		
		$vBalance = " user_transaction = ( $lb-$order_wallet_price) , "; $user_t_amount = " user_t_amount=$order_wallet_price,";
		
		$sT = " INSERT INTO sp_transaction SET time_id = unix_timestamp(), 
											user_id 			= '$user_id',
											trans_type 			= '$orderDetail_wallet',
											$vBalance
											$user_t_amount
											note				= '$orderDetail_wallet',
											trans_type_user     = 'customer',
											
											order_transaction	= '$order_ids',
											order_token			= '$order_token', 
											
											order_refund		= 'Y',
											transaction_type 	= 'auto'";
		mysqli_query( $con , $sT );
	}
	
	
	if( $order_pay_price > 0 ){
	
		
		$t  = " select * from transaction where user_id = '$user_id' AND trans_type_user  = 'customer' order by transaction_id DESC LIMIT 1 ";
		$sT = mysqli_query( $con , $t);
		$rT = mysqli_fetch_array( $sT );
		$lb = intval( $rT["user_transaction"] );
		
		$vBalance = " user_transaction = ( $lb-$order_pay_price) , "; $user_t_amount = " user_t_amount=$order_pay_price,";
		
		$sT = " INSERT INTO transaction SET time_id = unix_timestamp(), 
											user_id 			= '$user_id',
											trans_type 			= '$orderDetail',
											$vBalance
											$user_t_amount
											note				= '$orderDetail',
											trans_type_user     = 'customer',
											
											order_transaction	= '$order_ids',
											order_token			= '$order_token', 
											
											
											order_refund		= 'Y',
											transaction_type 	= 'auto'";
		
		
		mysqli_query( $con , $sT );
			
	}		
}

$order_pay_price = 0; $courier_fees = 0;
header("location:submit-order.php?id=$order_ids");
exit;
?>