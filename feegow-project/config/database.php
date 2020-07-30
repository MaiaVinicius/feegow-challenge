<?php

Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();

return
[
    'paths' => [
        'migrations' => dirname(__DIR__, 1) . '/database/migrations',
        'seeds' => dirname(__DIR__, 1) . '/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'database',
        'database' => [
            'adapter' => getenv('DB_DRIVER'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USERNAME'),
            'pass' => getenv('DB_PASSWORD'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];
