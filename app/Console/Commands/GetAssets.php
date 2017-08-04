<?php

namespace App\Console\Commands;

use Storage;
use Illuminate\Console\Command;

class GetAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stream:assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull the Assets';

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
        $dropbox = Storage::disk('dropbox');
        $local = Storage::disk('assets');

        $assetList = collect($dropbox->allFiles('assets'));

        $assetList->each(function($asset) use ($dropbox, $local) {
           $dropFile = $dropbox->readStream($asset);
           $local->putStream(str_replace('assets/', '', $asset), $dropFile);
        });

    }
}
