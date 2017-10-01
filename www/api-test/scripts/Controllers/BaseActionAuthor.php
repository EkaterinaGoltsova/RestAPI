<?php

class BaseActionAuthor
{

	/**
	 * @var string
	 */
	const FILE_PATH = '/static/images/';

	/**
	 * @var Medoo\Medoo
	 */
	protected $database;

	/**
	 * @var Authors
	 */
	protected $sourceAuthors;

	/**
	 * @var Avatars
	 */
	protected $sourceAvatars;

	/**
	 * @param Medoo\Medoo
	 */
	public function __construct(Medoo\Medoo $database)
	{
		$this->sourceAuthors = new Authors($database);
		$this->sourceAvatars = new Avatars($database);
	}

		/**
	 * @param array $files
	 * @return string
	 */
	protected function upload($files)
	{
		$file = reset($files);
		$fileName = $this->getFileName($file);

		$result = file_put_contents(
			$this->getDocumentRoot() . $fileName,
			$file->getStream()->getContents()
		);

		if (!$result) {
			throw new Exception('Не удалось загрузить файл!');
		}

		return $fileName;
	}

	/**
	 * @param File $file
	 * @return string
	 */
	protected function getFileName($file)
	{
		$name = $file->getClientFilename();
		$ext = pathinfo(trim($name), PATHINFO_EXTENSION);

		return self::FILE_PATH . uniqid(rand()) . '.' . $ext;
	}

	/**
	 * @param string $fileName
	 * @return int
	 */
	protected function getImgWidth($fileName)
	{
		$info = getimagesize($this->getDocumentRoot() . $fileName);
		return $info[0];
	}

	/**
	 * @param string $fileName
	 * @return int
	 */
	protected function getImgHeight($fileName)
	{
		$info = getimagesize($this->getDocumentRoot() . $fileName);
		return $info[1];
	}

	/**
	 * @return string
	 */
	protected function getDocumentRoot()
	{
		if (!empty($_SERVER['DOCUMENT_ROOT'])) {
			return $_SERVER['DOCUMENT_ROOT'];
		}
		
		return '';
	}
}