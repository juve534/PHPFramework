<?php
// DIC configuration
$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// DB接続
$container['db'] = function ($c) {
    $dsn = 'mysql:host=%s;dbname=%s;charset=utf8mb4';
    $db  = $c['settings']['db'];
    $pdo = new PDO(sprintf($dsn, $db['host'], $db['dbname']),
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// twitterクライアント
use Abraham\TwitterOAuth\TwitterOAuth;
$container['twitter'] = function ($c) {
    $settings = $c->get('settings')['twitter'];
    return new TwitterOAuth($settings['consumer_key'], $settings['consumer_secreat'],
        $settings['access_token'], $settings['access_token_secreat']);
};

// mackerelクライアント
$container['mackerel'] = function ($c) {
    $settings = $c->get('settings')['mackerel'];
    $client = new \Mackerel\Client([
        'mackerel_api_key' => $settings['mackerel_api_key'],
    ]);
    return $client;
};