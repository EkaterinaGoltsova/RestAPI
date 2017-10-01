<?php

/**
 * Базовый класс для работы с бд
 */
class Base
{
	/**
 	 * @var Medoo\Medoo
 	 */
	protected $database;

	/**
 	 * @param Medoo\Medoo
 	 */
	public function __construct($database)
	{
		$this->database = $database;
	}

	/**
	 * Возвращает одну запись по Id
	 * 
 	 * @param int $id
 	 * @param string $fields
 	 * @return array
 	 */
	public function getById($id, $fields = '*')
	{
		return $this->database->get(static::TABLE, $fields, ['id' => $id]);
	}

	/**
	 * Добавляет одну запись 
	 * 
 	 * @param array $data
 	 * @return int 
 	 */
	public function insert(array $data)
	{
		$this->database->insert(static::TABLE, $data);

		return $this->database->id();
	}

	/**
	 * Обновлет записи по условию 
	 * 
 	 * @param array $data
 	 * @param array $where
 	 */
	public function update(array $data, array $where)
	{
		$this->database->update(static::TABLE, $data, $where);
	}
}