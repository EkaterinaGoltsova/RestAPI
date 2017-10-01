<?php 

class Avatars 
{
	
	const TABLE = 'avatars';

	protected $database;

	public function __construct($database)
	{
		$this->database = $database;
	}

	public function getById($id, $fields = '*')
	{
		return $this->database->get(self::TABLE, $fields, ['id' => $id]);
	}

	public function delete($id)
	{
		$this->database->delete(self::TABLE, ['id' => $id]);
	}

	public function insert($data)
	{
		$this->database->insert(self::TABLE, $data);

		return $this->database->id();
	}

	public function update($data, $where)
	{
		$this->database->update(self::TABLE, $data, $where);
	}

	public function getByAuthorId($id, $fields = '*')
	{
		return $this->database->get(self::TABLE, $fields, ['author_id' => $id]);
	}
}