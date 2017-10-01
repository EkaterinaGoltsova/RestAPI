<?php 

require_once APP_PATH . 'DataSource/Base.php';

/**
 * Класс для работы с данными сущности "Аватар"
 */
class Avatars extends Base
{
	/**
 	 * Таблица в БД
 	 */
	const TABLE = 'avatars';

	/**
	 * Возвращает одну запись по id автора
	 * 
 	 * @param int $id
 	 * @param string $fields
 	 * @return array
 	 */
	public function getByAuthorId($id, $fields = '*')
	{
		return $this->database->get(self::TABLE, $fields, ['author_id' => $id]);
	}
}