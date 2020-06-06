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

$pDCnt ="SELECT COUNT(*) as total FROM vendor_product AS VP LEFT JOIN products AS P ON P.product_id = VP.prod_id 
                            WHERE   1 = 1 
                            $construct
                                    AND VP.active = 'Y'
                                    AND VP.quantity > 0
                                    AND VP.price > 0
                                    GROUP BY prod_id
                                    ";
         
$sPdCt      =   mysqli_query( $con ,  $pDCnt  );
$rPdCt      =   mysqli_fetch_array( $sPdCt );

$total      =   $rPdCt["total"];
if(!empty($total)){
$sql_fetch="SELECT VP.*,VP.id,VP.quantity,VP.price,P.name,P.product_id,P.image1  FROM vendor_product AS VP LEFT JOIN products AS P ON P.product_id = VP.prod_id 
                            WHERE   1 = 1 
                            $construct
                                    AND VP.active = 'Y'
                                    AND VP.quantity > 0
                                    AND VP.price > 0
                                    limit $limit";
            $result_ps = mysqli_query($con,$sql_fetch);                                
            while($rC = mysqli_fetch_array(  $result_ps  )){

                    $prod_id   = $rC['product_id'];
                    $prod_name = $rC['name'];
                    $img = $rC['image1'];
                    if (empty($img)) {
    
                      $varaintImgQuery = "SELECT main_img from product_variant_images where product_id ='$prod_id'";
                      $varaintImgSql   = mysqli_query($con,$varaintImgQuery);
                      while ($productVaraintImg = mysqli_fetch_array($varaintImgSql)) {

                        $img = $productVaraintImg['main_img'];
                      }
                    }
                    $price = $rC['price'];

                    // $price = $rC['price'];
                    // if( $img == "" ){  $img  = "../img/no_img.png"; }else{ $img = "../upload_images/".$img;}
                    // $imgName = file_ext_strip($img).'_130.'.file_ext($img);

                ?>
            <div class="item  col-sm-4">
            <a href="product.php?id=<?=base64_encode($prod_id)?>&name=<?=str_replace(' ','-',$prod_name)?>">
            <div class="thumbnail">
                <div class="upper_image">
                <img class="group list-group-image" width="100%" src="upload/product/200_<?=$img?>" alt="" />
                </div>
                <div class="caption caption-for-search">
                    <?php if (strlen($prod_name) > 40){

                          $prod_name = substr($prod_name, 0, 40) . '...';
                      }    
                ?>
                    <h4 class="group  list-group-item-heading"><?=$prod_name?></h4>
                    <!-- <p class="group inner list-group-item-text">
                        Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                        sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> -->
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            
                            <p class="lead"><b>
                                R<?=$price?></b></p>
                            
                        </div>
                      
                    </div>
                </div>
            </div>
        </a>
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