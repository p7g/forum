<?php
return [
    'dsn' => 'sqlite:' . \dirname(__DIR__) . '/test.db',
    'username' => '',
    'password' => '',
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
];
