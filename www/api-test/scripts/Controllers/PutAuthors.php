<?php

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

require_once APP_PATH . 'DataSource/Authors.php';

class PutAuthors 
{

	protected $database;

	public function __construct(Medoo\Medoo $database)
	{
		$this->source = new Authors($database);
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$params = $request->getParsedBody();
		$file = $request->getUploadedFiles();

		if (!empty($file)) {
			$fileName = $this->getFileName($file);
			$params = array_merge($params, ['avatar' => $fileName]);
		}

		$id = $request->getAttribute('authorId');
		$test = $this->source->update($params, ['id' => $id]);

		return $response->withJson(['result' =>'Автор - ' . $id . ' добновлен!'], 200);
	}

	protected function getFileName($file)
	{
		$file = reset($file);

		$name = $file->getClientFilename();
		$ext = pathinfo(trim($name), PATHINFO_EXTENSION);

		$fileName = '/static/images/' . uniqid(rand()) . '.' . $ext;

		file_put_contents($_SERVER['DOCUMENT_ROOT'] . $fileName, $file->getStream()->getContents());

		return $fileName;
	}
}