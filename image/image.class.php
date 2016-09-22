<?php //封装成类-压缩图片
	class Image{
		/**
		*内存中的图片
		*/
		private $image;
		/**
		* 图片的基本信息
		*/
		private $size;

		/**
		* 打开一张图片,读取到内存中
		*/
		public function __construct($src){
			$size        = getimagesize($src);
			$this->size  = array(
				'width'  => $size[0],
				'height' => $size[1],
				'type'   => image_type_to_extension($size[2],false),
				'mime'   => $size['mime']
				);
			$fun         = "imagecreatefrom{$this->size['type']}";
			$this->image = $fun($src);
			}

		/**
		* 操作图片(压缩)
		*/

		public function thumb($width, $height){
			$image_thumb = imagecreatetruecolor($width, $height);
			imagecopyresampled($image_thumb, $this->image, 0, 0, 0, 0, $width, $height, $this->size['width'], $this->size['height']);
			imagedestroy($this->image);
			$this->image = $image_thumb;
		}

		/**
		* 操作图片(添加文字水印)
		*/
		public function fontMark($col, $size, $angle, $local, $fontfile, $text){
			$color    =imagecolorallocatealpha($this->image, $col[0], $col[1], $col[2], $col[3]);
			$fontfile ="msyh.ttf";
			$text     ="你好";
			imagettftext($this->image, $size, $angle, $local['x'], $local['y'], $color, $fontfile, $text);
		}

		/**
		* 操作图片(添加图片水印)
		*/
		public function imageMark($src2, $local, $alpha){
			//$src2="002.png";
	 		$size2 = getimagesize($src2);
			$type2 = image_type_to_extension($size2[2], false);
			$fun2  = "imagecreatefrom{$type2}";
			$logo  = $fun2($src2);
		 	imagecopymerge($this->image, $logo, $local['x'], $local['y'], 0, 0, $size2[0], $size2[1], $alpha);//
			imagedestroy($logo);
		}

		/**
		* 在浏览器中输出图片
		*/
		public function show(){
			header("content-type:{$this->size['mime']}");
			$funs = "image{$this->size['type']}";
			$funs($this->image);
		}
		/**
		* 把图片保存在硬盘中
		*/
		public function save($newname){
			$funs = "image{$this->size['type']}";
			$funs($this->image,$newname.'.'.$this->size['type']);
		}
		/**
		* 销毁图片
		*/
		public function __destruct(){
			imagedestroy($this->image);
		}
	}
?>