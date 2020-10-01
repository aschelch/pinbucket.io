<?php

namespace App\Console\Commands;

use App\Link;
use App\Jobs\ProcessLink;
use Illuminate\Console\Command;

class ProcessOldLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'link:old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process old link without preview';

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
        $links = Link::where('preview', NULL)->get();
        foreach ($links as $link) {
            ProcessLink::dispatch($link);
        }
    }
}
