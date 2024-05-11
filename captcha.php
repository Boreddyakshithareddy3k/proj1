<?php
session_start();

// Generate captcha code
$captcha_length = 8; // Increase the captcha length for better security
$captcha_code = bin2hex(random_bytes($captcha_length / 2)); // Generate hexadecimal code

// Assign captcha in session
$_SESSION['captcha'] = $captcha_code;

// Create captcha image
$layer = imagecreatetruecolor(168, 37);
$captcha_bg = imagecolorallocate($layer, 247, 174, 71);
imagefill($layer, 0, 0, $captcha_bg);
$captcha_text_color = imagecolorallocate($layer, 0, 0, 0);

// Use a different font and apply distortion for better security
// Example: imagettftext($layer, $font_size, $angle, $x, $y, $captcha_text_color, $font_file, $captcha_code);

// Draw captcha text
imagestring($layer, 5, 55, 10, $captcha_code, $captcha_text_color);

// Output image
header("Content-type: image/jpeg");
imagejpeg($layer);

// Free up memory
imagedestroy($layer);
?>
