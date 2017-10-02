<?php
/**
* Twitter用ルーティング設定
*/
$app->get('/mackerel/twitter/dmm/', function () {
    // TwitterAPIを実行
    $params = [
        'q'     => '検索ワード',
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
    $host = $this->mackerel->getHost('HOST_ID');
    $metric = [
        'hostId' => $host->id,
        'time' => time(),
        'name' => 'metric.twitter.検索ワード',
        'value' => $tweets->search_metadata->count,
    ];
    $this->mackerel->postMetrics([$metric]);
    echo sprintf("Get Twitter Count : %d¥nSet Mackerel Count : %d¥n", $tweets->search_metadata->count, $count);
});