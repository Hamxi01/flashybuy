<?php
$curentdate=date('Y-m-d');
$currentday=date("l");
if($currentday == 'Monday'){
    $addQuery='AND monday=1';

}
else if($currentday == 'Tuesday'){
    $addQuery='AND tuesday=1';
}
else if($currentday == 'Wednesday'){
    $addQuery='AND wednesday=1';
}
else if($currentday == 'Thursday'){
    $addQuery='AND thursday=1';
}
else if($currentday == 'Friday'){
    $addQuery='AND friday=1';
}
else if($currentday == 'Saturday'){
    $addQuery='AND saturday=1';
}
else if($currentday == 'Sunday'){
    $addQuery='AND sunday=1';
}

$sliderQuery = "SELECT * from tbl_banner where start <= NOW() AND end >= NOW() AND active=1 $addQuery AND id=4";
$sliderSql = mysqli_query($con,$sliderQuery);
if (mysqli_num_rows($sliderSql) > 0) {
while ( $sliderResult = mysqli_fetch_array($sliderSql)) {
    ?>
    
    <a class="ps-collection" href="<?=$sliderResult['url']?>"><img src="img/banner/<?=$sliderResult['primary_image']?>" alt=""></a>

<?php } }
else{
    $sliderQuery1 = "SELECT * from tbl_banner where  id=4";
    $sliderSql1 = mysqli_query($con,$sliderQuery1);
while ( $sliderResult1 = mysqli_fetch_array($sliderSql1)) {  ?>
  <a class="ps-collection" href="<?=$sliderResult1['url1']?>"><img src="img/banner/<?=$sliderResult1['secondry_image']?>" alt=""></a>
<?php }
}
?>