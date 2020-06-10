<?php
$con = mysqli_connect("localhost", "root","" , "newflashybuy") or die("No server found here");
session_start();



///=============== All Couriers ============= //

$sCo = mysqli_query( $con , " SELECT * FROM couriers " );

while( $rCo = mysqli_fetch_array( $sCo )){
	$courierArr[$rCo["courier_id"]] = $rCo["courier_name"];
	$courierTrackingArr[$rCo["courier_id"]] = $rCo["tracking_url"];
}
 
///=============== All Couriers ============= //
$sCt = mysqli_query( $con , " SELECT * FROM categories WHERE delte = 0");
while( $rCt = mysqli_fetch_array( $sCt )){ $catArr[$rCt["cat_id"]] = $rCt["name"]; $catArrName[$rCt["name"]] = $rCt["cat_id"]; $catP[$rCt["cat_id"]] = $rCt["commission"];  }
?>



