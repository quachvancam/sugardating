<?php
/*
	This is PHP file that generates CAPTCHA image for the How to Create CAPTCHA Protection using PHP and AJAX Tutorial
	You may use this code in your own projects as long as this 
	copyright is left in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	For the rest of the code visit http://www.WebCheatSheet.com
	Copyright 2006 WebCheatSheet.com	
*/
//Start the session so we can store what the security code actually is
session_start();
//Send a generated image to the browser 
create_image(); 
exit(); 
function create_image(){ 

	$im = imagecreatetruecolor(100, 34);
	$white = imagecolorallocate($im, 255, 255, 255);
	$grey = imagecolorallocate($im, 50, 55, 55);
	$black = imagecolorallocate($im, 0, 65, 65);
	$bg = imagecolorallocate($im, 0, 0, 0);

	$font = 'monofont.ttf';
	$font = './monofont.ttf'; // LINUX
	// Make the background transparent
	imagecolortransparent($im, $bg);
	
	// The text to draw
	$md5_hash = md5(rand(0,999)); 
	//We don't need a 32 character long string so we trim it down to 6 
	$security_code1 = strtoupper(substr($md5_hash, 15, 3)); 
	$security_code2 = strtoupper(substr($md5_hash, 18, 3));
	
	//Set the session to store the security code
    $_SESSION["captchaCode"] = $security_code1.$security_code2;
	$arank = imagecolorallocate($im, 35, 35, 35);
	// Add background
	imagettftext($im, 25, 0, 1, 26, $arank, $font, "#######");
	// Add the first 3 letter
	imagettftext($im, 20, -10, 8, 20, $grey, $font, $security_code1);
	// Add the last 3 letter
	imagettftext($im, 20, 20, 50, 30, $black, $font, $security_code2); 
	// Save the image
    header("Content-Type: image/png"); 
	imagepng($im);
	imagedestroy($im);
} 
?>