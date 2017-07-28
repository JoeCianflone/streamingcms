<?php

namespace App\Console\Commands;

use Storage;
use App\Repositories\Stream;
use Illuminate\Console\Command;
use App\Transformers\PostsTransformer;

class GetPostsAndSave extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stream:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get X posts from Dropbox';

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
    public function handle(PostsTransformer $transformer, Stream $stream)
    {
         $allFiles = collect(Storage::disk('dropbox')->files(''));
         $posts = $allFiles->filter(function($value, $key) {
            return ends_with($value, '.md');
         });

         $stream->saveNewStreamItem($transformer->transform($posts));
    }
}
