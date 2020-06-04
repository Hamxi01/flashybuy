<?php
$con = mysqli_connect("localhost","root","" , "newflashybuy") or die("No server found here");
session_start();



///=============== All Couriers ============= //

$sCo = mysqli_query( $con , " SELECT * FROM couriers " );

while( $rCo = mysqli_fetch_array( $sCo )){
	$courierArr[$rCo["courier_id"]] = $rCo["courier_name"];
	$courierTrackingArr[$rCo["courier_id"]] = $rCo["tracking_url"];
}
 
///=============== All Couriers ============= //
?>



