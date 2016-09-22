<?php //添加文字水印
	require "image.class.php";
	$src = "001.jpg";
	//添加文字水印
	$col = array(
		0 => 255,
		1 => 255,
		2 => 255,
		3 => 20
		);
	$size      = 20;
	$angle     = 10;
	$localfont = array(
		"x" => 20,
		"y" => 50
		);
	$fontfile  = "msyh.ttf";
	$text      = "你好吗";
	//添加图片水印
	$src2      = "002.png";
	$locallogo = array(
		"x" => 150,
		"y" => 200
		);
	$alpha = 30;

	$image = new Image($src);
	$image -> fontMark($col, $size, $angle, $localfont, $fontfile, $text);//文字水印

	$image -> thumb(300, 250);//压缩图片

	$image -> imageMark($src2, $locallogo, $alpha);//图片水印

	$image -> show();
	$image -> save("0015");
?>