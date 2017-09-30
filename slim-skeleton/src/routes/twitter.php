<?php
/**
* Twitter用ルーティング設定
*/
$app->get('/twitter/search/', function ($request, $response, $args) {
    $params = [
        'q'     => '検索ワード',
        'count' => 100,
    ];
    $tweets = $this->twitter->get('search/tweets', $params);

    $host = $this->mackerel->getHost('HOST_ID');
    $metric = [
        'hostId' => $host->id,
        'time' => time(),
        'name' => 'metric.twitter.検索ワード',
        'value' => $tweets->search_metadata->count,
    ];
    $this->mackerel->postMetrics([$metric]);
});