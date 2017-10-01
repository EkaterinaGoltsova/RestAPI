<?php 

require_once APP_PATH . 'Models/Authors.php';

class AuthorNormalizer
{

	public function normalize($data)
	{
		$author = new Author();

		if (!empty($data['name'])) {
			$author->setName($data['name']);
		}

		if (!empty($data['nameAblative'])) {
			$author->setNameAblative($data['nameAblative']);
		}

		if (!empty($data['avatar'])) {
			$author->setAvatar($data['avatar']);
		}

		return $author;
	}
}