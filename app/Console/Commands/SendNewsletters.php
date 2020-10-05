<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Team;
use Carbon\Carbon;
use \App\Mail\WeeklyNewsletter;
use Illuminate\Support\Facades\Mail;

class SendNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send team\'s weekly newsletter';

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
        $teams = Team::all();

        $bar = $this->output->createProgressBar(count($teams));
        $bar->start();

        foreach ($teams as $team) {

            $lastMonday = Carbon::parse("last monday")->toDateString();
            $links = $team->links()->where('created_at', '>=', $lastMonday)->get();

            if(count($links) == 0){
                $bar->advance();
                continue;
            }

            $users = $team->users()->get();
            foreach ($users as $user) {            
                var_dump($user);
                Mail::to($user)->send(new WeeklyNewsletter($team, $links));
            }

            $bar->advance();
        }

        $bar->finish();


    }
}
