<?php

$container['GetAuthors'] = function ($c) {
      return new GetAuthors($c->Database);
};

$container['PostAuthors'] = function ($c) {
      return new PostAuthors($c->Database);
};

$container['DeleteAuthors'] = function ($c) {
      return new DeleteAuthors($c->Database);
};

$container['PutAuthors'] = function ($c) {
      return new PutAuthors($c->Database);
};

$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $c['response']->withStatus(400)
                             ->withHeader('Content-Type', 'text/html')
                             ->write($exception->getMessage());
    };
};

$container['Database'] = function ($c) {
  $settings = file_get_contents(__DIR__  . '/config/db.json');
  $settings = json_decode($settings, true);

  return new Medoo\Medoo([
      'database_type' => $settings['Mysql']['type'],
      'database_name' => $settings['Mysql']['name'],
      'server' => $settings['Mysql']['server'],
      'username' => $settings['Mysql']['username'],
      'password' => $settings['Mysql']['password'],
      'port' => $settings['Mysql']['port']
  ]);
};