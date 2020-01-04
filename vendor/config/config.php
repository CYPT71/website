<?php

$config = [
    'database' => [
        'host' => 'dbseverhost',
        'database' => 'database',
        'username' => 'username',
        'password' => 'password',
    ]
];

$dsn = "mysql:host={$config['database']['host']};dbname={$config['database']['database']};charset=utf8";
$link = new PDO($dsn, $config['database']['username'], $config['database']['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
?>