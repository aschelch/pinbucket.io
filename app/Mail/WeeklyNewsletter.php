<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\Team;
use Illuminate\Database\Eloquent\Collection;

class WeeklyNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The team instance.
     *
     * @var Team
     */
    public $team;

    /**
     * The links added last week
     *
     * @var $links;
     */
     public $links;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Team $team, Collection $links)
    {
        $this->team = $team;
        $this->links = $links;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@pinbucket.io', config('app.name'))
                    ->markdown('emails.newsletter.weekly');
    }
}
