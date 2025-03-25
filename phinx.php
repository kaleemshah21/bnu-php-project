<?php

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'cw2_students', // Your production database name
            'user' => 'root',         // Your MySQL username
            'pass' => '',             // Your MySQL password (empty if none)
            'port' => '3306',         // Default MySQL port
            'charset' => 'utf8',      // Charset for database connection
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'cw2_students',  // Your development database name
            'user' => 'root',          // Your MySQL username
            'pass' => '',              // Your MySQL password (empty if none)
            'port' => '3306',          // Default MySQL port
            'charset' => 'utf8',       // Charset for database connection
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'cw2_students',  // Your testing database name
            'user' => 'root',          // Your MySQL username
            'pass' => '',              // Your MySQL password (empty if none)
            'port' => '3306',          // Default MySQL port
            'charset' => 'utf8',       // Charset for database connection
        ],
    ],
    'version_order' => 'creation', // Ensures migrations are ordered by creation date
];
