<?php

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

require_once APP_PATH . 'DataSource/Authors.php';
require_once APP_PATH . 'DataSource/Avatars.php';

class PostAuthors 
{

	protected $database;

	protected $sourceAuthors;

	protected $sourceAvatars;

	public function __construct(Medoo\Medoo $database)
	{

		$this->sourceAuthors = new Authors($database);
		$this->sourceAvatars = new Avatars($database);
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$params = $request->getParsedBody();

		$id = $this->sourceAuthors->insert([
			"name" => $params['name'],
			"nameAblative" => $params['nameAblative']
		]);

		$file = $request->getUploadedFiles();
		$fileName = $this->getFileName($file);

		$this->sourceAvatars->insert([
			"file" => $fileName,
			"width" => $this->getImgWidth($fileName),
			"height" => $this->getImgHeight($fileName),
			'author_id' => $id
		]);

		return $response->withJson(['result' =>'Автор - ' . $id . ' добновлен!'], 200);
	}

	protected function getImgWidth($fileName)
	{
		$info = getimagesize($_SERVER['DOCUMENT_ROOT'] . $fileName);
		return $info[0];
	}

	protected function getImgHeight($fileName)
	{
		$info = getimagesize($_SERVER['DOCUMENT_ROOT'] . $fileName);
		return $info[1];
	}

	protected function getFileName($file)
	{
		if (empty($file)) {
			return '';
		}

		$file = reset($file);

		$name = $file->getClientFilename();
		$ext = pathinfo(trim($name), PATHINFO_EXTENSION);

		$fileName = '/static/images/' . uniqid(rand()) . '.' . $ext;

		file_put_contents($_SERVER['DOCUMENT_ROOT'] . $fileName, $file->getStream()->getContents());

		return $fileName;
	}
}