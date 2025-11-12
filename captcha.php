<?php
session_start();

// طول کپچا
$length = 5;
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$captcha_code = '';
for ($i = 0; $i < $length; $i++) {
    $captcha_code .= $chars[rand(0, strlen($chars)-1)];
}

// ذخیره در سشن
$_SESSION['captcha'] = $captcha_code;

// اندازه تصویر
$width = 120;
$height = 40;
$image = imagecreate($width, $height);

// رنگ‌ها
$bg_color = imagecolorallocate($image, 230, 230, 230);
$text_color = imagecolorallocate($image, 0, 0, 0);

// پر کردن پس‌زمینه
imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// نوشتن متن کپچا
$font_size = 5;
imagestring($image, $font_size, 20, 10, $captcha_code, $text_color);

// ارسال تصویر
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
?>
