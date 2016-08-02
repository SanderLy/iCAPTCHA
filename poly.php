<?php
// assignment of sides from database || for testing purposes, value is manually assigned; $sides value can be set from 3 to 10
$sides = 3;
// set up array of points for polygon: array(x of point 1, y of point 1, x of point 2, y of point 2 . . .)
if ($sides == 3){
	$coords = array(10, 285, 290, 285, 150, 15);}
elseif ($sides == 4){
	$coords = array(15, 285, 285, 285, 285, 15, 15, 15);}
elseif ($sides == 5){
	$coords = array(66, 280, 233, 280, 290, 120, 150, 18, 10, 120);}
elseif ($sides == 6){
	$coords = array(75, 275, 225, 275, 295, 150, 225, 25, 75, 25, 7, 150);}
elseif ($sides == 7){
	$coords = array(85, 285, 215, 285, 290, 185, 260, 66, 150, 15, 38, 66, 10, 185);}
elseif ($sides == 8){
	$coords = array(95, 285, 205, 285, 280, 205, 280, 90, 205, 18, 95, 18, 18, 90, 18, 205);}
elseif ($sides == 9){			
	$coords = array(100, 285, 200, 285, 270, 227, 290, 128, 242, 42, 150, 9, 57, 42, 9, 128, 28, 227);}
elseif ($sides == 10){
	$coords = array(100, 285, 200, 285, 270, 228, 295, 150, 266, 66, 200, 15, 100, 15, 33, 66, 5, 150, 28, 228);}

// create image
$image = imagecreatetruecolor(300, 300);

// set transparent background
$transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparency);
imagesavealpha($image, true);

// set bg color of polygon
$blue = imagecolorallocate($image, 50, 50, 155);

// draw the polygon
imagefilledpolygon($image, $coords, $sides, $blue);

// flush image
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>