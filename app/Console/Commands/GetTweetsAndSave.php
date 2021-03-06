<?php

namespace App\Console\Commands;

use Twitter;
use App\Repositories\Stream;
use Illuminate\Console\Command;
use App\Transformers\TweetTransformer;

class GetTweetsAndSave extends Command
{
   /**
    * The name and signature of the console command.
    *
    *  @var string
    */
   protected $signature = 'stream:tweets { --count=5 } ';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Get X number of tweets for a user';

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
   public function handle(TweetTransformer $transformer, Stream $stream)
   {
      $tweets = Twitter::getUserTimeline([
         'count' => $this->option('count'),
         'format' => 'array',
         'tweet_mode' => 'extended'
      ]);

      $stream->saveNewStreamItems($transformer->transform(collect($tweets)));
   }
}
