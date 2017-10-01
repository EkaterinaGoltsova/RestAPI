<?php

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

require_once APP_PATH . 'DataSource/Authors.php';

class DeleteAuthors 
{

	protected $source;


	public function __construct(Medoo\Medoo $database)
	{
		$this->source = new Authors($database);
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$id = $request->getAttribute('authorId');
		$this->source->delete($id);
		 
		return $response->withJson(['result' =>'Автор - ' . $id . ' удален!'], 200);
	}
}