<?php 
class Author
{

	public $name = '';

	public $nameAblative = '';

	public $avatar = null;

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setNameAblative($nameAblative)
	{
		$this->nameAblative = $nameAblative;
	}

	public function setAvatar($avatar)
	{
		$this->avatar = $avatar;
	}
}