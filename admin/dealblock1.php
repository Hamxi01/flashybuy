<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');
?>      
<?php 
      if (isset($_GET['deal_No'])) {
        
        $deal_No = $_GET['deal_No'];
      }
?>
<?php
      if (isset($_POST['searchProduct'])) {
        
          $searchproductName = $_POST['p_name'];
          $searchproductId   = $_POST['p_id'];
          $sPQ = '';
          if( $searchproductId != "" ||  $searchproductName != "" ){
            
            if( $searchproductName != "" ){
              $sPQ .= "WHERE P.name LIKE '%$searchproductName%'";
            
            } 
            if( $searchproductId != "" ){
              $sPQ .= "WHERE P.product_id = '$searchproductId'";
            }
          }
      }

 if (isset($_REQUEST['action']) && $_REQUEST['action'] =='insert') {
        

        $v_p_id            = intval( $_REQUEST['v_p_id']);
        $start_date        = strtotime($_REQUEST['start_date']);
        $end_date          =  (strtotime($_REQUEST['end_date'])+86000);
        $deal_price        = ( $_REQUEST['deal_price']);
        $deal_quantity     = ( $_REQUEST['deal_quantity']);
        $deal_market_price = ( $_REQUEST['mk_price']);
        $deal_NO           = ( $_REQUEST['deal_NO']);

        $vpq = mysqli_query($con,"SELECT * FROM vendor_product where id='$v_p_id'");
         while( $rpq = mysqli_fetch_array($vpq)){

            $product_id   = $rpq['prod_id'];
            $variation_id = $rpq['variation_id'];
         }


        $p  = "INSERT INTO vendor_product_deals SET product_id = '$product_id' , deal_NO = '$deal_NO' , v_p_id = '$v_p_id' , start_date = '$start_date' , end_date = '$end_date', deal_price = '$deal_price', deal_quantity = '$deal_quantity', market_price = '$deal_market_price' ,variation_id='$variation_id'";
        $sP = mysqli_query( $con , $p  );
        echo "<script>window.location.assign('dealblock1.php?msg=success&deal_No".$deal_NO."');</script>";
        exit;
 }     
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo "<span>Data Inserted successfully...!!</span>"; ?>

        </div>
    </div>
</div>
<?php 
}?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                        <form method="post" enctype="multipart/form-data">
                            <tr>
                              <th>Search Products</th>
                            </tr>
                            <tr>
                              <th>Product Name</th>
                              <th>Product ID#</th>
                              <th></th>
                            </tr>
                          <tbody>                          
                            <tr style="font-size:13px !important; font-weight:bold ">
                              <td><input type="text" name="p_name" class="form-control" placeholder="Search Product by Name"></td>
                              <td><input type="text" name="p_id" class="form-control" placeholder="Search Product by ID"></td>
                              <td><button class="btn btn-warning" type="submit" name="searchProduct">Search Products</button></td>
                            </tr>
                          </tbody> 
                      </form> 
                      </table>
                  </div>
                </div>
              <?php 

                  if( isset($_POST['p_name']) && $_POST['p_name'] != "" ||  isset($_POST['p_id']) && $_POST['p_id'] != "" ){
              ?>  
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
                    $sPQ
                    AND P.approved = 'Y'
                    GROUP BY PV.variation_id ");

while($rPd  =   mysqli_fetch_array( $sPd )) { 

  $product_id = $rPd['product_id'];
  $variation_id = $rPd['variation_id'];
$vendorName = '';
if (!empty($variation_id)) {
  $sV = mysqli_query($con,"SELECT V.shop_name,VP.id,VP.quantity,VP.id FROM vendor_product AS VP 
                               INNER JOIN products AS P on P.product_id = VP.prod_id
                               INNER JOIN vendor  AS V on V.id = VP.ven_id
                             WHERE P.product_id = '$product_id' AND VP.variation_id ='$variation_id' ");
}
else{
  $sV = mysqli_query($con,"SELECT V.shop_name,VP.id,VP.quantity,VP.id FROM vendor_product AS VP 
                               INNER JOIN products AS P on P.product_id = VP.prod_id
                               INNER JOIN vendor  AS V on V.id = VP.ven_id
                             WHERE P.product_id = '$product_id'");
}
while ($rV = mysqli_fetch_array( $sV )){

  $quantity = $rV["quantity"];
  $v_p_id   = $rV['id'];
  $vendorName .= '<input type="radio" value="'.$rV["id"].'" name="ven_p_'.$product_id.'" >&nbsp;&nbsp;'.$rV["shop_name"] .'(Qty-'.$rV["quantity"]. ')<br />';
}
if (!empty($variation_id)) {
$s = "SELECT * FROM vendor_product_deals WHERE product_id = '$product_id' AND variation_id ='$variation_id'";

$sPV = mysqli_query( $con , $s);
$rPV = mysqli_fetch_array( $sPV );
if( $rPV > 0 ){
  $notShow = 1;
}
}else{

  $s = "SELECT * FROM vendor_product_deals WHERE product_id = '$product_id'";

$sPV = mysqli_query( $con , $s);
$rPV = mysqli_fetch_array( $sPV );
if( $rPV > 0 ){
  $notShow = 1;
}
}
?> 

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
<?php } ?>                                                 
                        </tbody>  
                      </table>
                  </div>
                </div>
              <?php 
                    }
              ?>
                <!-- Current Products in deals -->
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
$pQ =  "SELECT P.*,VPD.v_p_id,VPD.start_date,VPD.end_date,VPD.deal_price,VPD.deal_quantity,VPD.market_price   FROM products AS P INNER JOIN vendor_product_deals AS VPD ON P.product_id = VPD.product_id  WHERE VPD.deal_NO = '$deal_No'  ";
$sPd =   mysqli_query( $con ,$pQ);
while ($dpR = mysqli_fetch_array($sPd)) {
  
$v_p_id = $dpR['v_p_id'];
$vpSql = mysqli_query($con,"SELECT ven_id from vendor_product where id='$v_p_id'");
$vpRes = mysqli_fetch_array($vpSql);
$vendor_id = $vpRes[0];

$vSql = mysqli_query($con,"SELECT shop_name FROM vendor where id='$vendor_id'");
$vRes = mysqli_fetch_array($vSql);
$vendor = $vRes[0];

?>                                                 
                          <tr style="font-size:13px !important; font-weight:bold ">
                            <td></td>
                            <td><?=$dpR['name']?></td>
                            <td><?=$dpR['product_id']?></td>
                            <td><?=$vendor?></td>
                            <td><?php echo date("d-m-Y" ,$dpR['start_date'])?></td>
                            <td><?php echo date("d-m-Y" ,$dpR['end_date'])?></td>
                            <td><?=$dpR['market_price']?></td>
                            <td><?=$dpR['deal_price']?></td>
                            <td><?=$dpR['deal_quantity']?></td><!-- 
                            <td colspan="3"><button class="btn btn-warning" onclick="addDealProduct()">import</button></td> -->
                            <!-- <td><div class="badge badge-warning">edit</div></td> -->
                          </tr>  
<?php } ?>                                               
                        </tbody>  
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <input type="hidden" name="" value="<?=$deal_No?>" id="deal_NO">        
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
    var deal_NO             = $("#deal_NO").val();

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