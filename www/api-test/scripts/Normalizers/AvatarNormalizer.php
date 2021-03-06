<?php 

require_once APP_PATH . 'Models/Avatars.php';

/**
 * Класс для нормализации сущности "Аватар"
 */
class AvatarNormalizer
{
	/**
 	 * @param array
	 */
	public function normalize(array $data)
	{
		$avatar = new Avatar();

		if (!empty($data['file'])) {
			$avatar->setFile($data['file']);
		}

		if (!empty($data['width'])) {
			$avatar->setWidth($data['width']);
		}

		if (!empty($data['height'])) {
			$avatar->setHeight($data['height']);
		}

		return $avatar;
	}
}