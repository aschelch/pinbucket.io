## SendNewsletters Command Documentation

**Table of Contents:**

* [1. Overview](#1-overview)
* [2. Command Signature and Description](#2-command-signature-and-description)
* [3. Code Walkthrough](#3-code-walkthrough)
    * [3.1. Constructor](#31-constructor)
    * [3.2. Handle Method](#32-handle-method)

## 1. Overview

This command is responsible for sending weekly newsletters to each team's users. The newsletter includes links created within the last week. 

## 2. Command Signature and Description

| Attribute | Value |
|---|---|
| Signature | `newsletter:send` |
| Description | Send team's weekly newsletter |

## 3. Code Walkthrough

### 3.1 Constructor

The constructor initializes the parent command class.

```php
    public function __construct()
    {
        parent::__construct();
    }
```

### 3.2 Handle Method

The handle method retrieves all teams and iterates through them. For each team, it gets all links created since the last Monday. If there are no links, the process skips to the next team. Otherwise, it retrieves all users associated with the team and sends a `WeeklyNewsletter` email to each user.

```php
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
                Mail::to($user)->send(new WeeklyNewsletter($team, $links));
            }

            $bar->advance();
        }

        $bar->finish();
    }
```
