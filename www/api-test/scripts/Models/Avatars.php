<?php 
class Avatar
{

	public $file = '';

	public $width = 0;

	public $height = 0;

	public function setFile($file)
	{
		$this->file = $file;
	}

	public function setWidth($width)
	{
		$this->width = $width;
	}

	public function setHeight($height)
	{
		$this->height = $height;
	}
}