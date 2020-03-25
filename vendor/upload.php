<?php
include("../thirdparty/image-resize/ImageResize.php");
include ("../thirdparty/image-resize/ImageResizeException.php");
use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;

try {
    $image = new ImageResize('../upload/product/aa.png');
    $image->quality_jpg = 85;
    $image->resizeToWidth(800);
    $image->resizeToHeight(800);
    $new_name = '800_' . rand() . '.jpg';
    $new_path = '../upload/product/' . $new_name;
    $image->save($new_path, IMAGETYPE_JPEG);
  
} catch (ImageResizeException $e) {
    return null;
}
try {
    $image = new ImageResize('../upload/product/aa.png');
    $image->quality_jpg = 85;
    $image->resizeToWidth(300);
    $image->resizeToHeight(300);
    $new_name = '300_' . rand() . '.jpg';
    $new_path = '../upload/product/' . $new_name;
    $image->save($new_path, IMAGETYPE_JPEG);
  
} catch (ImageResizeException $e) {
    return null;
}
try {
    $image = new ImageResize('../upload/product/aa.png');
    $image->quality_jpg = 85;
    $image->resizeToWidth(200);
    $image->resizeToHeight(150);
    $new_name = '200_' . rand() . '.jpg';
    $new_path = '../upload/product/' . $new_name;
    $image->save($new_path, IMAGETYPE_JPEG);
  
} catch (ImageResizeException $e) {
    return null;
}
?>