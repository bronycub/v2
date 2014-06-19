<?php
  session_start();
  // $_SESSION['captcha'] = rand(1000,9999);
	$_SESSION['captcha'] = "";
	$b = array();
	for ($i=0 ; $i<5 ; $i++) {
		switch ((int)rand(0,1)) {
		case 0:
			$b[$i] = chr(48+rand(0,9));
			break;
		case 1:
			$b[$i] = chr(65+rand(0,25));
			break;
		}
	}
	$_SESSION['captcha'] = implode("", $b);

 $img = imagecreatetruecolor(100, 30);

 $fill_color=imagecolorallocate($img,255,255,255);
 imagefilledrectangle($img, 0, 0, 100, 30, $fill_color);
 $text_color=imagecolorallocate($img,10,10,10);
 $font = './28DaysLater.ttf';
 imagettftext($img, 23, 0, 5,30, $text_color, $font, $_SESSION['captcha']);

 header("Content-type: image/jpeg");
 imagejpeg($img);
 imagedestroy($img);
?>
