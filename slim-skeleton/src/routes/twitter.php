<?php
/**
 * Twitter用ルーティング設定
 */
$app->get('/twitter/search/', function ($request, $response, $args) {
    // Sample log message
    $params = [
        'q'     => '艦これ',
        'count' => 5,
    ];
    $tweet = $this->twitter->get('search/tweets', $params);
    var_dump($tweet);
});