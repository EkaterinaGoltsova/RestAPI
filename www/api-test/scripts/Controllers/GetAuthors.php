<?php

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

require_once APP_PATH . 'DataSource/Authors.php';
require_once APP_PATH . 'DataSource/Avatars.php';
require_once APP_PATH . 'Normalizers/AuthorsNormalizer.php';
require_once APP_PATH . 'Normalizers/AvatarNormalizer.php';

/**
 * Контроллер для обработки действия "получить автора"
 */
class GetAuthors 
{
	/**
	 * @var Authors
	 */
	protected $sourceAuthors;

	/**
	 * @var Avatars
	 */
	protected $sourceAvatars;

	/**
	 * @var AuthorsNormalizer
	 */
	protected $normalizerAuthors;

	/**
	 * @var AvatarNormalizer
	 */
	protected $normalizerAvatar;

	/**
	 * @param Medoo\Medoo
	 */
	public function __construct(Medoo\Medoo $database)
	{
		$this->sourceAuthors = new Authors($database);
		$this->sourceAvatars = new Avatars($database);

		$this->normalizerAuthors = new AuthorNormalizer();
		$this->normalizerAvatar = new AvatarNormalizer();
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
			$data = $this->sourceAuthors->getById($id);
		} catch (Exception $e) {
			throw new Exception('Ошибка при работе с базой данных. Попробуйте позже!');
		}
		
		if (!$data) {
			throw new Exception('Автор не найден!');
		}

		$data['avatar'] = $this->getNormalizeAvatar($id);

		$result = $this->normalizerAuthors->normalize($data);
		return $response->withJson((array)$result, 200);
	}

	/**
	 * @param int $authorId
	 * @return Avatar
	 */
	protected function getNormalizeAvatar($authorId)
	{
		try {
			$avatar = $this->sourceAvatars->getByAuthorId($authorId);
		} catch (Exception $e) {
			throw new Exception('Ошибка при работе с базой данных. Попробуйте позже!');
		}

		return $this->normalizerAvatar->normalize($avatar);
	}
}