<?php 
/**
 * Модель сущности "Автор"
 */
class Author
{
	/**
 	 * @var string
 	 */
	public $name = '';

	/**
 	 * @var string
 	 */
	public $nameAblative = '';

	/**
 	 * @var Avatar
 	 */
	public $avatar = null;

	/**
 	 * @param string
 	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
 	 * @param string
 	 */
	public function setNameAblative($nameAblative)
	{
		$this->nameAblative = $nameAblative;
	}

	/**
 	 * @param Avatar
 	 */
	public function setAvatar($avatar)
	{
		$this->avatar = $avatar;
	}
}