<?php
session_start();
$random_alpha = md5(rand());
$randomNumber = substr($random_alpha, 0, 6);
$_SESSION['captcha_code'] = $randomNumber;
header('Content-Type: image/png');
$image = imagecreatetruecolor(200, 38);
$bgColor = imagecolorallocate($image, 19, 80, 41);
$txtColor = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, 200, 38, $bgColor);
$font = dirname(__FILE__) . '/fonts/planob1.ttf';
imagettftext($image, 20, 0, 60, 28, $txtColor, $font, $randomNumber);
imagepng($image);
imagedestroy($image);
?>
