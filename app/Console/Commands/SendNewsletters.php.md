##  Send Newsletters Command Documentation 
<br>

**Table of Contents**

* [Command Overview](#command-overview)
* [Command Signature and Description](#command-signature-and-description)
* [Command Logic](#command-logic)
    * [Retrieving Teams and Progress Bar](#retrieving-teams-and-progress-bar)
    * [Iterating Through Teams](#iterating-through-teams)
    * [Finding Links for the Week](#finding-links-for-the-week)
    * [Sending Emails](#sending-emails)
    * [Progress Bar Updates](#progress-bar-updates)
* [Code Snippet](#code-snippet)

<br>

### Command Overview 
This command sends a weekly newsletter to all users in each team. The newsletter includes links that have been added to the team within the past week. 

<br>

### Command Signature and Description
* **Signature:** `newsletter:send`
* **Description:** Sends team's weekly newsletter

<br>

### Command Logic

#### Retrieving Teams and Progress Bar
1. **Retrieve all teams:**  The command fetches all teams from the database using `Team::all()`.
2. **Initialize progress bar:** A progress bar is created using `$this->output->createProgressBar()` with a total number of steps equal to the count of teams. The progress bar is then started using `$bar->start()`.

#### Iterating Through Teams
1. **Loop through teams:** The code iterates through each team retrieved in the previous step.

#### Finding Links for the Week
1. **Calculate last Monday:** The code calculates the date of the last Monday using `Carbon::parse("last monday")->toDateString()`.
2. **Retrieve team links:** The code queries for all links associated with the current team that were created on or after last Monday.
3. **Check for links:** If no links are found for the team, the progress bar is advanced and the loop continues to the next team.

#### Sending Emails
1. **Retrieve team users:** The code retrieves all users associated with the current team.
2. **Send email to each user:** For each user in the team, the code sends an email using `Mail::to($user)->send(new WeeklyNewsletter($team, $links))`. The `WeeklyNewsletter` class is responsible for creating the email content using the team and its links.

#### Progress Bar Updates
1. **Advance progress bar:** After each team is processed, the progress bar is advanced using `$bar->advance()`.
2. **Finish progress bar:** When all teams have been processed, the progress bar is finished using `$bar->finish()`.

<br>

### Code Snippet
```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Team;
use Carbon\Carbon;
use App\Mail\WeeklyNewsletter;
use Exception;
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

            if (count($links) == 0) {
                $bar->advance();
                continue;
            }

            $users = $team->users()->get();
            foreach ($users as $user) {
                Mail::to($user)->send(new WeeklyNewsletter($team, $links));
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
```
