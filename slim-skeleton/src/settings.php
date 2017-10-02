<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        // db接続情報
        'db' => [
            'host'   => 'localhost',
            'user'   => 'ユーザ名',
            'pass'   => 'パスワード',
            'dbname' => 'DB名',
        ],

        // TwitterAPI設定
        'twitter' => [
            'consumer_key'         => 'consumer_key',
            'consumer_secreat'     => 'consumer_secreat',
            'access_token'         => 'access_token',
            'access_token_secreat' => 'access_token_secreat',
        ],

        // mackerel設定
        'mackerel' => [
            'mackerel_api_key' => '',
        ],

        // redis設定
        'redis' => [
            'host' => '',
            'port' => '',
        ],
    ],
];
