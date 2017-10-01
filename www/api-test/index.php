<?php
/**
 * Authors Rest Api
 * @version 1.0.0
 */

define('APP_PATH', __DIR__ . '/scripts' . DIRECTORY_SEPARATOR);

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/scripts/Controllers/GetAuthors.php';
require_once __DIR__ . '/scripts/Controllers/PostAuthors.php';
require_once __DIR__ . '/scripts/Controllers/DeleteAuthors.php';
require_once __DIR__ . '/scripts/Controllers/PutAuthors.php';


$app = new Slim\App();
$container = $app->getContainer();

require_once __DIR__ . '/dependencies.php';
require_once __DIR__ . '/routes.php';

$app->run();


