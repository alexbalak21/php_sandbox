<?php
function compressImage($source, $destination, $quality) {
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);
    else 
        die('Unknown image file format');

    imagejpeg($image, $destination, $quality);

    return $destination;
}

$source = 'path/to/source/image.jpg'; // Source image
$destination = 'path/to/destination/compressed_image.jpg'; // Destination compressed image
$quality = 75; // Quality of the compressed image (0-100)

compressImage($source, $destination, $quality);
?>
