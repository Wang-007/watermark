<?php
	/*文字水印*/
	/*一.打开图片*/
	 //1.配置图片路径(就是你想要操作的图片的路径)
	$src   = "001.jpg";
	 //2.获取图片信息(通过GD库提供的方法,得到你想要处理的图片的信息)
	$size  = getimagesize($src);
	 //print_r($info);
	 //3.通过图片的编号来获取图像的类型
	$type  = image_type_to_extension($size[2],false);
	 //4.在内存中创建一个和我们图像类型一样的图像
	$fun   = "imagecreatefrom{$type}";//$fun=imagecreatefromjpeg;
	 //5.把图片复制到我们的内存中
	$image = $fun($src);
	/*二.操作图片*/
	$size     = 20;
	$angle    = 0;
	$x        = 400;
	$y        = 350;
	$color    = imagecolorallocatealpha($image, 255, 255, 255, 50);//50为透明度
	$fontfile = "msyh.ttf";
	$text     = "你好";
	imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
	/*三.输出图片*/
	 //浏览器输出
	header("content-type:{$size['mime']}");
	imagejpeg($image);
	 //保存图片
	imagejpeg($image, '0010.'.$type);
	/*四.销毁图片*/
	imagedestroy($image);
?>