<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:twitter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Twitter Search Exec';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $twitter = new TwitterOAuth(env('TWITTER_CONSUMER_KEY'), env('TWITTER_CONSUMER_SECRET'),
            env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));

        $searchWord = $this->_getTwitterSearchWord();
        echo 'searchWord : ' . $searchWord . PHP_EOL;
        $params = [
            'q'     => $searchWord . ' filter:images',
            'count' => 100,
        ];
        $tweets = $twitter->get('search/tweets', $params);

        if (!$tweets || !property_exists($tweets, 'statuses')) {
            echo 'No Tweet' . PHP_EOL;
            return false;
        }

        $imageList = [];
        foreach ($tweets->statuses AS $tweet) {
            if (!property_exists($tweet, 'extended_entities')
                || !property_exists($tweet->extended_entities, 'media')
            ) {
                continue;
            }
            foreach ($tweet->extended_entities->media AS $media) {
                if (!property_exists($media, 'media_url_https')) {
                    continue;
                }
                if (empty($media->media_url_https)) {
                    continue;
                }
                //echo $media->media_url_https . PHP_EOL;
                $imageList[] = $media->media_url_https;
            }
        }

        $imageUrl = $imageList[rand(0, (count($imageList)))];
        echo $imageUrl . PHP_EOL;
        info($imageUrl);

        return true;
    }

    private function _getTwitterSearchWord()
    {
        $list = explode(',', env('TWITTER_SEARCH_WORD'));
        return $list[rand(0, (count($list) - 1))];
    }
}
