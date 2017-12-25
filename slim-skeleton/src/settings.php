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
            'host'   => getenv('DB_HOST'),
            'user'   => getenv('DB_USER'),
            'pass'   => getenv('DB_PASS'),
            'dbname' => getenv('DB_NAME'),
        ],

        // TwitterAPI設定
        'twitter' => [
            'consumer_key'         => getenv('TWITTER_CONSUMER_KEY'),
            'consumer_secreat'     => getenv('TWITTER_CONSUMER_SECRET'),
            'access_token'         => getenv('TWITTER_ACCESS_TOKEN'),
            'access_token_secreat' => getenv('TWITTER_ACCESS_TOKEN_SECRET'),
        ],

        // mackerel設定
        'mackerel' => [
            'mackerel_api_key' => getenv('MACKEREL_API_KEY'),
        ],
    ],
];
