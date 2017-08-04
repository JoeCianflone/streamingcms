<?php

namespace App\Transformers;

use Storage;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Mni\FrontYAML\Parser as YAMLParser;

class PostsTransformer implements Transformer
{

    private $parser;

    public function __construct(YAMLParser $parser)
    {
        $this->parser = $parser;
    }

    public function transform($toTransform)
    {
        return $toTransform->map(function ($post) {
            $file = Storage::disk('dropbox')->get($post);

            $parsed = $this->parser->parse($file);
            $yaml = $parsed->getYaml();
            $content = $parsed->getContent();

            return [
            'id' => Uuid::uuid1()->toString(),
            'type' => 'post',
            'slug' => $this->getSlug($yaml, $post),
            'sub_type' => $yaml['tag'] ?? null,
            'meta_content' => json_encode($this->getMetaContent($yaml)),
            'content' => json_encode($this->getPostContent($yaml, $content)),
            'is_pinned' => $yaml['pinned'] ?? false,
            'item_created_at' => Carbon::parse($yaml['published'])->timezone(env('APP_TIMEZONE')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ];
        });
    }

    private function getPostContent($yaml, $content)
    {
        return [
         'headline' => $yaml['title'] ?? null,
         'summary' => $yaml['summary'] ?? null,
         'body' => $content,
         'hero_image_url' => $yaml['image_url'] ?? null
        ];
    }

    private function getMetaContent($yaml)
    {
       return [
         'author' => $yaml['author'] ?? env('DEFAULT_POST_AUTHOR')
       ];
    }

    private function getSlug($yaml, $filename)
    {
      if (isset($yaml['slug'])) {
         return $yaml['slug'];
      }

      return  str_replace(env('DROPBOX_POSTS_EXTENSION'), '', str_replace(env('DROPBOX_POSTS_FOLDER').'/', '', $filename));
    }
}
