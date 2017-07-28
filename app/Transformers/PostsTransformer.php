<?php

namespace App\Transformers;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class PostsTransformer implements Transformer {

   public function transform($toTransform)
   {
      return $toTransform->map(function($tweet) {
         return [
            'id' => Uuid::uuid1()->toString(),
            'type' => 'post',
            'sub_type' => '',
            'meta_content' => '',
            'content' => '',
            'is_pinned' => '',
            'item_created_at' => Carbon::parse($tweet['created_at'])->timezone(env('APP_TIMEZONE')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ];
      });
   }


}
