<?php
/**
* Twitter用ルーティング設定
*/
$app->get('/mackerel/twitter/dmm/', function () {
    // TwitterAPIを実行
    $search = getenv('TWITTER_SEARCH_WORD');
    $params = [
        'q'     => $search,
        'count' => 100,
    ];
    $tweets = $this->twitter->get('search/tweets', $params);

    // 集計時間から5分以内の呟きのみカウントする
    $count = 0;
    $targetEnd   = time();
    $targetBegin = $targetEnd - 300;
    foreach ($tweets->statuses AS $tweet) {
        if ($targetBegin < strtotime($tweet->created_at)
            && strtotime($tweet->created_at) < $targetEnd
        ) {
            $count++;
        }
    }

    // Mackerelにカウント数を登録
    $hostId = getenv('MACKEREL_HOST_ID');
    $host   = $this->mackerel->getHost($hostId);
    $metric = [
        'hostId' => $host->id,
        'time' => time(),
        'name' => 'custom.metric.twitter.検索ワード',
        'value' => $count,
    ];
    $this->mackerel->postMetrics([$metric]);
    echo sprintf("Get Twitter Count : %d¥nSet Mackerel Count : %d¥n", $tweets->search_metadata->count, $count);
});

$app->get('/twitter/search/', function () {
    $search = getenv('TWITTER_SEARCH_WORD');
    $params = [
        'q'     => $search,
        'count' => 5,
    ];
    $tweets = $this->twitter->get('search/tweets', $params);
    var_dump($tweets);
});