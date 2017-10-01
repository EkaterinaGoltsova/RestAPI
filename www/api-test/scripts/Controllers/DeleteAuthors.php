<?php

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

require_once APP_PATH . 'DataSource/Authors.php';

/**
 * Контроллер для обработки действия "удалить автора"
 */
class DeleteAuthors 
{
	/**
	 * @var Medoo\Medoo
	 */
	protected $source;

	/**
	 * @param Medoo\Medoo
	 */
	public function __construct(Medoo\Medoo $database)
	{
		$this->source = new Authors($database);
	}

	/**
	 * @param Request
	 * @param Response
	 * @param array $args
	 * @return Response
	 */
	public function __invoke(Request $request, Response $response, array $args)
	{
		$id = $request->getAttribute('authorId');
		try {
			$this->source->delete($id);
		} catch (Exception $e) {
			throw new Exception('Ошибка при работе с базой данных. Попробуйте позже!');
		}
		 
		return $response->withJson(['result' =>'Автор - ' . $id . ' удален!'], 200);
	}
}