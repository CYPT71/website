<?php

$config = [
    'database' => [
        'host' => 'sql.mtxserv.com',
        'database' => '222505_sql',
        'username' => 'w_222505',
        'password' => 'Poulpito67',
    ]
];

$dsn = "mysql:host={$config['database']['host']};dbname={$config['database']['database']};charset=utf8";
$link = new PDO($dsn, $config['database']['username'], $config['database']['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
?>