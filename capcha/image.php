<?php
// Start a session to store the CAPTCHA answer
session_start();

/**
 * Generate a random CAPTCHA code.
 *
 * @param int $length The length of the CAPTCHA code.
 * @return string The generated CAPTCHA code.
 */
function generate_captcha_code($length = 6)
{
    $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
    $captcha_code = '';
    for ($i = 0; $i < $length; $i++) {
        $captcha_code .= $characters[mt_rand(0, strlen($characters) - 1)];
    }
    return $captcha_code;
}

// Generate a random CAPTCHA code
$captcha_code = generate_captcha_code();

// Store the CAPTCHA code in the session
$_SESSION['captcha'] = $captcha_code;

// Create an image
$image_width = 120;
$image_height = 40;
$image = imagecreate($image_width, $image_height);

// Set background color
$background_color = imagecolorallocate($image, 255, 255, 255); // White

// Set text color
$text_color = imagecolorallocate($image, 0, 0, 0); // Black

// Add noise (lines)
for ($i = 0; $i < 5; $i++) {
    imageline(
        $image,
        mt_rand(0, $image_width),
        mt_rand(0, $image_height),
        mt_rand(0, $image_width),
        mt_rand(0, $image_height),
        $text_color
    );
}

// Add the CAPTCHA code to the image
$font_size = 20;
$font = realpath('./arial.ttf'); // Path to a TrueType font
imagettftext($image, $font_size, 0, 10, 30, $text_color, $font, $captcha_code);

// Set the content type to output an image
header('Content-Type: image/png');

// Output the image as a PNG
imagepng($image);

// Clean up
// imagedestroy($image);
