<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Link;
use App\Events\LinkPreviewUpdated;
use Exception;

class ProcessLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $link;

    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $key = env('GOOGLE_API_KEY');

        $curl_init = curl_init("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$this->link->url}&screenshot=true&key={$key}");
        curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl_init);
        curl_close($curl_init);
        $googlepsdata = json_decode($response, true);
        $preview = $googlepsdata['lighthouseResult']['audits']['final-screenshot']['details']['data'];

        $this->link->preview = $preview;
        $this->link->save();

        event(new LinkPreviewUpdated($this->link));
    }

    /**
     * The job failed to process. We provide a placeholder. 
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        $preview = "data:image/png;base64,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";
        $this->link->preview = $preview;
        $this->link->save();

        event(new LinkPreviewUpdated($this->link));
    }
}
