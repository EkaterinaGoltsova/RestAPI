<?php

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

require_once APP_PATH . 'DataSource/Authors.php';
require_once APP_PATH . 'DataSource/Avatars.php';
require_once APP_PATH . 'Normalizers/AuthorsNormalizer.php';
require_once APP_PATH . 'Normalizers/AvatarNormalizer.php';

class GetAuthors 
{

	protected $sourceAuthors;

	protected $normalizerAuthors;

	protected $normalizerAvatar;


	public function __construct(Medoo\Medoo $database)
	{
		$this->sourceAuthors = new Authors($database);
		$this->sourceAvatars = new Avatars($database);

		$this->normalizerAuthors = new AuthorNormalizer();
		$this->normalizerAvatar = new AvatarNormalizer();
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$id = $request->getAttribute('authorId');
		$data = $this->sourceAuthors->getById($id);

		$avatar = $this->sourceAvatars->getByAuthorId($id);
		$data2 = $this->normalizerAvatar->normalize($avatar);

		$data['avatar'] = $data2;

		$data = $this->normalizerAuthors->normalize($data);

		return $response->withJson((array)$data, 200);
	}
}