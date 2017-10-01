<?php

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

require_once APP_PATH . 'DataSource/Authors.php';
require_once APP_PATH . 'DataSource/Avatars.php';
require_once APP_PATH . 'Controllers/BaseActionAuthor.php';

/**
 * Контроллер для обработки действия "добавить автора"
 */
class PostAuthors extends BaseActionAuthor
{

	/**
	 * @param Request
	 * @param Response
	 * @param array $args
	 * @return Response
	 */
	public function __invoke(Request $request, Response $response, array $args)
	{
		$params = $request->getParsedBody();
		
		try {
			$authorId = $this->sourceAuthors->insert([
				"name" => $params['name'],
				"nameAblative" => $params['nameAblative']
			]);
		} catch (Exception $e) {
			throw new Exception('Ошибка при работе с базой данных. Попробуйте позже!');
		}

		$file = $request->getUploadedFiles();
		if ($file) {
			$fileName = $this->upload($file);
			try {
				$this->sourceAvatars->insert([
					"file" => $fileName,
					"width" => $this->getImgWidth($fileName),
					"height" => $this->getImgHeight($fileName),
					'author_id' => $authorId
				]);
			} catch (Exception $e) {
				throw new Exception('Ошибка при работе с базой данных. Попробуйте позже!');
			}
		}

		return $response->withJson(['result' =>'Автор - ' . $authorId . ' добавлен!'], 200);
	}
}