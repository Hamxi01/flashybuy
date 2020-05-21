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

$sliderQuery = "SELECT * from tbl_slider where start <= NOW() AND end >= NOW() AND status=1 $addQuery";
$sliderSql = mysqli_query($con,$sliderQuery);
while ( $sliderResult = mysqli_fetch_array($sliderSql)) {
    ?>
    
    <div class="ps-banner"><a href="<?=$sliderResult['url']?>"><img src="img/crousel/<?=$sliderResult['image']?>" alt=""></a></div>

<?php } ?>