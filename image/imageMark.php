<?php
	/*图片水印*/
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
	 //5.把图片复制到内存中
	$image = $fun($src);
	/*二.操作图片*/
	 //1.设置水印路径
	$src2  = "002.png";
	 //2.获取水印图片的基本信息
	$size2 = getimagesize($src2);
	 //3.通过水印的图片的编号来获取图片的类型
	$type2 = image_type_to_extension($size2[2],false);
	 //4.在内存中创建一个和我们水印图像一致的图像类型
	$fun2  = "imagecreatefrom{$type2}";
	 //5.把水印图片复制到内存中
	$logo  = $fun2($src2);
	 //6.给图片添加水印
	imagecopymerge($image, $logo, 350, 320, 0, 0, $size2[0], $size2[1], 30);//30为透明度
	 //7.销毁水印图片
	imagedestroy($logo);
	/*三.输出图片*/
	 //浏览器输出
	header("content-type:{$size['mime']}");
	$funs  = "image{$type}";
	$funs($image);
	 //保存图片
	$funs($image, '0011.'.$type);
	/*四.销毁图片在内存中*/
	imagedestroy($image);
?>