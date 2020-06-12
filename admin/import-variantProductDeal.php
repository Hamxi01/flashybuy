<?php include('../includes/db.php');
      include('includes/header.php');
      include('includes/sidebar.php');

 if (isset($_REQUEST['action']) && $_REQUEST['action'] =='insert') {
        

        $v_p_id            = intval( $_REQUEST['v_p_id']);
        $start_date        = strtotime($_REQUEST['start_date']);
        $end_date          =  (strtotime($_REQUEST['end_date'])+86000);
        $deal_price        = ( $_REQUEST['deal_price']);
        $deal_quantity     = ( $_REQUEST['deal_quantity']);
        $deal_market_price = ( $_REQUEST['mk_price']);
        
        $deal_NO           = ( $_REQUEST['deal_NO']);

        $vpq = mysqli_query($con,"SELECT * FROM vendor_product where id='$v_p_id' ");
         while( $rpq = mysqli_fetch_array($vpq)){

            $product_id   = $rpq['prod_id'];
            $variation_id = $rpq['variation_id'];
         }


        $p  = "INSERT INTO vendor_product_deals SET product_id = '$product_id' , deal_NO = '$deal_NO' , v_p_id = '$v_p_id' , start_date = '$start_date' , end_date = '$end_date', deal_price = '$deal_price', deal_quantity = '$deal_quantity', market_price = '$deal_market_price' ,variation_id='$variation_id'";
        $sP = mysqli_query( $con , $p  );
        echo "<script>window.location.assign('product.php?msg=success');</script>";
        exit;
 }     
?>
?>
<div class="main-content">
        <section class="section">
          <div class="section-body">
          	<div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
              		<table class="table table-bordered">
                          <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Id</th>
                            <th>Vendor</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Market Price</th>
                            <th>Deal price</th>
                            <th>Quantity</th>
                            <th></th>
                            <th></th>
                          </tr>
                        <tbody>
<?php 
if (isset($_GET['id'])) {

	$product_id   = base64_decode($_GET['id']);
	$variation_id = base64_decode($_GET['variation_id']);

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
                    AND PV.variation_id ='$variation_id'
                    AND P.approved = 'Y'");


while($rPd  =   mysqli_fetch_array( $sPd )) { 

    $sV = mysqli_query($con,"SELECT V.shop_name,VP.id,VP.quantity,VP.id FROM vendor_product AS VP 
                               INNER JOIN products AS P on P.product_id = VP.prod_id
                               INNER JOIN vendor  AS V on V.id = VP.ven_id
                             WHERE P.product_id = '$product_id' AND VP.variation_id ='$variation_id' ");
  	while ($rV = mysqli_fetch_array( $sV )){

	  $quantity = $rV["quantity"];
	  $v_p_id   = $rV['id'];
	  $vendorName = '<input type="radio" value="'.$rV["id"].'" name="ven_p_'.$product_id.'" >&nbsp;&nbsp;'.$rV["shop_name"] .'(Qty-'.$rV["quantity"]. ')<br />';
	}


$s = "SELECT * FROM vendor_product_deals WHERE product_id = '$product_id' AND variation_id = $variation_id AND start_date < UNIX_TIMESTAMP()  AND end_date   > UNIX_TIMESTAMP()";

$sPV = mysqli_query( $con , $s);
$rPV = mysqli_fetch_array( $sPV );
if( $rPV > 0 ){
  $notShow = 1;
}
?>                        <tr>
                          <td colspan="4"> Select Deal</td>
                          <td colspan="6">
<?php 
$dSql = mysqli_query($con,"SELECT * FROM deals_links");
while ($dRes = mysqli_fetch_array($dSql)) {
 
$deal_No =  filter_var($dRes['deal_url'], FILTER_SANITIZE_NUMBER_INT);
                              
                            echo  '<input type="radio" value="'.$deal_No.'" name="dealno_'.$product_id.'" >&nbsp;&nbsp;'.$dRes['deal_name'] .')<br />';
 } ?>                              
                            
                          </td>
                        </tr><br>	
                        	<tr style="font-size:13px !important; font-weight:bold ">
                            <td></td>
                            <td><?=$rPd['name']?> <?=$rPd['variant_Sku']?></td>
                            <td><?=$rPd['product_id']?></td>                           
                            <td><?=$vendorName?></td>
                            <td><input type="text" class="form-control datepicker" name="start_date_<?=$product_id?>" value="" id="start<?=$product_id?>"></td>
                            <td><input type="text" class="form-control datepicker" name="end_date_<?=$product_id?>" value="" id="end<?=$product_id?>"></td>
                            <td><input type="text" min="1" name="mk_price_<?=$product_id?>" class="form-control" value="" id="mk_price<?=$product_id?>"></td>
                            <td><input type="text" min="1" name="deal_price_<?=$product_id?>" class="form-control" value="" id="price<?=$product_id?>"></td>
                            <td><input type="text" min="1" name="deal_quantity_<?=$product_id?>" value="<?=$quantity?>"  class="form-control" id="qty<?=$product_id?>"></td>
                            <?php if(!isset($notShow)){?>
                            <td colspan="3"><button type="button" class="btn btn-warning" onclick="addDealProduct(<?=$product_id?>)">import</button></td>
                            <?php }else{ ?>
                              <td><button type="button" id="" name="" class="btn btn-danger btn-xs">Accepted</td>
                            <?php } ?>

<?php if ($rPd['approved'] =='Y') {?>

                            <td><div class="badge badge-info">YES</div></td>
<?php } ?>                            
                          </tr>
<?php } } ?>                          
                        </tbody>
                    </table>    
              	  </div>
              	</div>
               </div>
            </div>   	  
      	  </div>
        </section>  	
</div>          	
<?php include('includes/footer.php'); ?>
<script type="text/javascript">
  function addDealProduct(v_p_id){

    var v_pid = $("input[name='ven_p_"+v_p_id+"']:checked").val();

    if( isNaN(parseInt(v_pid)) ){
      swal("Vendor Not Added");
      return false;
    }
    var start_date          = $("input[name='start_date_"+v_p_id+"']").val();
    var end_date            = $("input[name='end_date_"+v_p_id+"']").val();
    var deal_price          = $("input[name='deal_price_"+v_p_id+"']" ).val();
    var deal_quantity       = $("input[name='deal_quantity_"+v_p_id+"']").val();
    var deal_market_price   = $("input[name='mk_price_"+v_p_id+"']").val();
    var deal_NO             = $("input[name='dealno_"+v_p_id+"']:checked").val();

    if(start_date == "" ){
      swal("Enter Start Date");
      return false;
    }
    if(end_date == "" ){
      swal("Enter End Date");
      return false;
    }
    if (start_date == end_date) {
      swal("Enter Differ Date");
      return false;
    }

    var url_link = "?prod_id="+v_p_id+"&action=insert&v_p_id="+v_pid + "&start_date=" + start_date + "&end_date=" + end_date + "&deal_price=" + deal_price + "&deal_quantity=" + deal_quantity+ "&mk_price=" + deal_market_price+ "&deal_NO=" + deal_NO;
    window.location.href = url_link;
    return false; 
  }
  $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>