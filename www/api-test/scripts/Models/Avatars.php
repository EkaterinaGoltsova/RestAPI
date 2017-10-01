<?php 
/**
 * Модель сущности "Автар автора"
 */
class Avatar
{

	/**
 	 * @var string
 	 */
	public $file = '';

	/**
 	 * @var int
 	 */
	public $width = 0;

	/**
 	 * @var int
 	 */
	public $height = 0;

	/**
 	 * @param string
 	 */
	public function setFile($file)
	{
		$this->file = $file;
	}

	/**
 	 * @param int
 	 */
	public function setWidth($width)
	{
		$this->width = $width;
	}

	/**
 	 * @param int
 	 */
	public function setHeight($height)
	{
		$this->height = $height;
	}
}