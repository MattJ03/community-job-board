<?php

namespace App\Jobs;

use App\Mail\ListingPosted;
use App\Models\Listing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendListingPostedEmail implements ShouldQueue
{
    use Queueable, Dispatchable;

    public Listing $listing;
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->listing->load('company');
        Mail::to($this->listing->company->email)->send(new ListingPosted($this->listing));
        Log::info('email sent to ' . $this->listing->company->email);

    }
}
