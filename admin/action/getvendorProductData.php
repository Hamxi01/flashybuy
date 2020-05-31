<?php include('../../includes/db.php');

if (isset($_POST['product_id'])) {

	$product_id = $_POST['product_id'];

$sPd    = mysqli_query($con ,"SELECT
                    P.*,
                    PV.first_variation_value,
                    PV.first_variation_name,
                    PV.second_variation_value,
                    PV.price,
                    PV.variation_id,
                    PV.quantity as stock,
                    PV.sku as variant_Sku
                  FROM
                    products AS P
                    LEFT JOIN product_variations AS PV ON PV.product_id = P.product_id
                    WHERE P.product_id = '$product_id'
                    AND P.approved = 'Y'");


while($rPd  =   mysqli_fetch_array( $sPd )) { 


print_r($rPd);
 //    $sV = mysqli_query($con,"SELECT V.shop_name,VP.id,VP.quantity,VP.id FROM vendor_product AS VP 
 //                               INNER JOIN products AS P on P.product_id = VP.prod_id
 //                               INNER JOIN vendor  AS V on V.id = VP.ven_id
 //                             WHERE P.product_id = '$product_id'");
 //  	while ($rV = mysqli_fetch_array( $sV )){

	//   $quantity = $rV["quantity"];
	//   $v_p_id   = $rV['id'];
	//   echo '<input type="radio" value="'.$rV["id"].'" name="ven_p_'.$product_id.'" >&nbsp;&nbsp;'.$rV["shop_name"] .'(Qty-'.$rV["quantity"]. ')<br />';
	// }

}
// echo $vendorName;
}
?>