
<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

return [
    'secret' => $_ENV['JWT_SECRET'] ?? '',
    'algo' => $_ENV['JWT_ALGO'] ?? 'HS256',
];
