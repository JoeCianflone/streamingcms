<?php

namespace App\Transformers;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class YouTubeTransformer implements Transformer {

   public function transform($toTransform)
   {
      return $toTransform->map(function($video) {
         return [
            'id' => Uuid::uuid1()->toString(),
            'type' => 'video',
            'sub_type' => 'youtube',
            'content' => json_encode($this->getVideoContent($video)),
            'item_created_at' => Carbon::parse($video->snippet->publishedAt)->timezone(env('APP_TIMEZONE')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ];
      });
   }

   private function getVideoContent($raw)
   {
      return [
         'video_id' => $raw->id->videoId,
         'title' => $raw->snippet->title,
         'description' => $raw->snippet->description,
         'image' => [
            'url' => $raw->snippet->thumbnails->high->url,
            'width' => $raw->snippet->thumbnails->high->width,
            'height' => $raw->snippet->thumbnails->high->height,
         ],
      ];
   }
}
