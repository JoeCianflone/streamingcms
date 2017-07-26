<?php

namespace App\Transformers;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class TweetTransformer implements Transformer {

   public function transform($toTransform)
   {
      return $toTransform->map(function($tweet) {
         return [
            'id' => Uuid::uuid1()->toString(),
            'type' => 'tweet',
            'sub_type' => isset($raw['retweet_status']) ? 'retweet' : null,
            'content' => json_encode($this->getTweetContent($tweet)),
            'item_created_at' => Carbon::parse($tweet['created_at'])->timezone(env('APP_TIMEZONE')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ];
      });
   }

   private function getTweetContent($raw)
   {
      $tweet = $raw;
      if (isset($raw['retweet_status'])) {
         $tweet = $raw['retweet_status'];
      }

      return [
         'user' => [
            'screen_name' => $tweet['user']['screen_name'],
            'name' => $tweet['user']['name'],
            'avatar' => $tweet['user']['profile_image_url_https'],
         ],
         'text' => $tweet['full_text'],
         'media' => isset($tweet['media']) ? $tweet['media'] : null,
      ];
   }
}
