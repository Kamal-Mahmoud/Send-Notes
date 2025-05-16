<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Note $note) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl = config('app.url') . "/notes/" . $this->note->id;
        $emailContent = "Hello , You received a new note:{$noteUrl}";
        Mail::raw($emailContent, function ($message) {
            $message->from("ikamalm7moud95@yahoo.com", 'Sendnotes')
                ->to($this->note->recipient)
                ->subject('You received a new note from ' . $this->note->user->name);
        });
    }
    public function retryUntill()
    {
        return now()->addMinute(1);
    }
}
