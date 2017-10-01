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
  $setting = file_get_contents(__DIR__  . '/config/db.json');
  $setting = json_decode($setting, true);

  return  new Medoo\Medoo([
      'database_type' => $setting['Mysql']['database_type'],
      'database_name' => $setting['Mysql']['database_name'],
      'server' => $setting['Mysql']['server'],
      'username' => $setting['Mysql']['username'],
      'password' => $setting['Mysql']['password'],
      'port' => $setting['Mysql']['port']
  ]);
};