<?php
/**
 * Twitter用ルーティング設定
 */
$app->get('/twitter/search/', function ($request, $response, $args) {
    $params = [
        'q'     => '艦これ',
        //'count' => 5,
    ];
    $tweets = $this->twitter->get('search/tweets', $params);
    var_dump($tweets->search_metadata->count);

    var_dump($this->mackerel->getHost('HOST_ID'));
});