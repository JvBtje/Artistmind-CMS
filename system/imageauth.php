<?php
session_start(); 

// generate the verication code 
$rand = substr(str_shuffle("ABCDEFHJKLMNPQRSTUVWXYZ2345789"), 0, 5);


// create the hash for the random number and put it in the session
$_SESSION['SystemImgPas'] = $rand;

// create the image
$image = imagecreate(250, 125);

// use white as the background image
$bgColor = imagecolorallocate ($image, 255, 255, 255); 

// the text color is black
$textColor = imagecolorallocate ($image, 150, 150, 150); 



// write the random number

$font = 'CHOWFUN_.TTF'; 
$fontsize = 35; 
$smfontsize = 8; 
imagesetthickness($image, 2);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);
//imageline($image, rand(-300,500), rand(-300,500), rand(-300,500), rand(-300,500), $textColor);

$spacex=10;
$spacey=rand(60,90);
for ($i=0; $i <= strlen($rand); $i++){
$charachter = $rand[$i];
$spacex = $spacex + 38;
$spacey = 70;
ImageTTFText($image, $fontsize, rand(-5,5), $spacex, $spacey, $textColor, $font, $charachter);
}
//imagestring ($image, 5, 5, 8, $rand, $textColor); 

//imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR,30);
//imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR,30);
//imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR,30);
//imagefilter($image, IMG_FILTER_MEAN_REMOVAL);
// send several headers to make sure the image is not cached 
// taken directly from the PHP Manual

// Date in the past 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

// always modified 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 

// HTTP/1.1 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 

// HTTP/1.0 
header("Pragma: no-cache"); 


// send the content type header so the image is displayed properly
header('Content-type: image/jpeg');

// send the image to the browser
imagejpeg($image);

// destroy the image to free up the memory
imagedestroy($image);
?>
