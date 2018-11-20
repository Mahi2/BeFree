<?php

require __DIR__."/public/index.php";
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
            'connection' => $connection,
        ]
    ]
];