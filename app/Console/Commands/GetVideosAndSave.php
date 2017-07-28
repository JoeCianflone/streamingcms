<?php

namespace App\Console\Commands;

use YouTube;
use App\Repositories\Stream;
use App\Transformers\YouTubeTransformer;
use Illuminate\Console\Command;

class GetVideosAndSave extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stream:videos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get X latest videos from YouTube';

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
    public function handle(YouTubeTransformer $transformer, Stream $stream)
    {
      $videos = Youtube::listChannelVideos('UCF2kiwbx3jhogRvkTNDkebA', 5);

      $stream->saveNewStreamItems($transformer->transform(collect($videos)));
    }
}
