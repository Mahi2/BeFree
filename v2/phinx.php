<?php

use Befree\Database\DatabaseInterface;

require __DIR__."/index.php";
$connection = $container->get(DatabaseInterface::class)->getPdo();

return  [
    'paths' => [
        'migrations' => __DIR__ ."/data/migrations",
        'seeds' => __DIR__."/data/seeds",
    ],

    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'development',
        'development' => [
            'name' => 'befree',
            'table_prefix' => $container->get('database.prefix'),
            'connection' => $connection,
        ]
    ]
];