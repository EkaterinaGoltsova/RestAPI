<?php 
require_once APP_PATH . 'DataSource/Base.php';

/**
 * Класс для работы с данными сущности "Автор"
 */
class Authors extends Base
{
	/**
 	 * Таблица в БД
 	 */
	const TABLE = 'authors';

	/**
	 * Удаляет одну запись по Id
	 * 
 	 * @param int $id
 	 */
	public function delete($id)
	{
		$this->database->delete(self::TABLE, ['id' => $id]);
	}
}