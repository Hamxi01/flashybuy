<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
include('includes/db.php');

global $construct,$search_each;

if(isset($_POST['keyword'])){
    
$keyword=$_POST['keyword'];
$keyword1=$_POST['keyword'];
$keywords = explode(" ", $keyword); 

$x =count($keywords);
foreach( $keywords as $search_each ) {
if( $x == 1 ){

  $construct .= "AND (P.name like '%$keyword%'  OR P.description like '%$keyword1%')";

   }else{ 

    $construct .= "AND  (P.name like '%$search_each%'  OR P.description like '%$keyword1%')";

    } 
}

$limit = 12;

$pDCnt ="SELECT 
                    COUNT(DISTINCT(VP.prod_id)) as total 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      $construct
                      ";
         
$sPdCt      =   mysqli_query( $con ,  $pDCnt  );
$rPdCt      =   mysqli_fetch_array( $sPdCt );

$total      =   $rPdCt["total"];
if(!empty($total)){
$sql_fetch="SELECT 
                      VP.*, 
                      P.name, 
                      P.image1, 
                      min(VP.price) as min, 
                      max(VP.price) as max, 
                      PV.sku as variant_Sku 
                    FROM 
                      vendor_product AS VP 
                      LEFT JOIN product_variations AS PV ON PV.variation_id = VP.variation_id 
                      INNER JOIN products AS P ON P.product_id = VP.prod_id 
                    where 
                      VP.active = 'Y'
                      AND VP.quantity > 0 
                      AND VP.price > 0
                      $construct
                    GROUP BY 
                      VP.prod_id LIMIT  $limit";
            $result_ps = mysqli_query($con,$sql_fetch);                                
            while($rC = mysqli_fetch_array(  $result_ps  )){

                    $prod_id   = $rC['prod_id'];
                    $prod_name = $rC['name'];
                    $img = $rC['image1'];
                    if (empty($img)) {
    
                      $varaintImgQuery = "SELECT main_img from product_variant_images where product_id ='$prod_id'";
                      $varaintImgSql   = mysqli_query($con,$varaintImgQuery);
                      while ($productVaraintImg = mysqli_fetch_array($varaintImgSql)) {

                        $img = $productVaraintImg['main_img'];
                        $variant = "Variant Product";
                      }
                    }
                    $price = $rC['price'];

                ?>
            <div class="col-xs-4 col-lg-4 mb-3 px-2">


            <div class="card-group">

                <a href="product.php?id=<?=base64_encode($prod_id)?>&name=<?=str_replace(' ','-',$prod_name)?>">

                    <div class="card">
                        <img class="card-img-top img-fluid p-5" src="upload/product/200_<?=$img?>" alt="" />
                        <div class="card-body">
                            <h4 class="card-title text-center mb-3" style="min-height: 73px !important;">
                                <?php if (strlen($prod_name) > 40){
                                    $prod_name = substr($prod_name, 0, 40) . '...';
                                }    
                                ?>
                                <?= $prod_name ?>
                            </h4>
                            <?php if (isset($variant)) {
                                echo $variant;
                                $variant = '';
                            }?>
                            <p class="text-muted text-center lead text-dark mt-5">
                                <b> R<?=$price?> </b>
                            </p>
                           
                        </div>
                    </div>

                </a>

            </div>
        </div>



        
<?php

}
echo "<div id='result'>$total</div>";
if($limit>$total){

    echo "<div id='resultcount'>$total / </div>";

}else{

  echo "<div id='resultcount'>$limit / </div>";

}
}else{

    echo "<h3 align='center'>No Result Found</h3>";
}
}
?>