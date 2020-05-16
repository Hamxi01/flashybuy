<?php 


/// courier Packages ///

$sCo = mysqli_query( $con , " SELECT * FROM courier_package " );
while( $rCo = mysqli_fetch_array( $sCo )){
	$courWArr[$rCo["wieght"]] = $rCo["price"];
	$courWEArr[$rCo["wieght"]] = $rCo["extra_item"];
}
?>