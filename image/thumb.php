<?php
	/*压缩图片*/
	/*一.打开图片*/
	 //1.配置图片路径(就是你想要操作的图片的路径)
	$src         = "001.jpg";
	 //2.获取图片信息(通过GD库提供的方法,得到你想要处理的图片的信息)
	$size        = getimagesize($src);
	 //print_r($info);
	 //3.通过图片的编号来获取图像的类型
	$type        = image_type_to_extension($size[2],false);
	 //4.在内存中创建一个和我们图像类型一样的图像
	$fun         = "imagecreatefrom{$type}";//$fun=imagecreatefromjpeg;
	 //5.把图片复制到内存中
	$image       = $fun($src);
	/*二.操作图片*/
	 //1.在内存中简历一个宽300,高200的真色彩图片
	$width       = 150;
	$height      = 100;
	$image_thumb = imagecreatetruecolor($width, $height);
	 //2.核心步骤,将原图复制到新建的真色彩图片上,并且按照一定比例压缩
	imagecopyresampled($image_thumb, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
	imagedestroy($image);
	/*三.输出图片*/
	 //浏览器输出
	header("content-type:{$size['mime']}");
	$funs        = "image{$type}";
	$funs($image_thumb);
	 //保存图片
	$funs($image_thumb, '0012.'.$type);
	/*四.销毁图片在内存中*/
	imagedestroy($image);
	?>