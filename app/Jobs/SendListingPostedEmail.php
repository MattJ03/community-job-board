<?php

namespace App\Jobs;

use App\Mail\ListingPosted;
use App\Models\Company;
use App\Models\Listing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendListingPostedEmail implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue, Dispatchable;

    public Listing $listing;
    public Company $company;
    public function __construct(Listing $listing, Company $company)
    {
        $this->listing = $listing;
        $this->company = $company;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->company->email)->send(new ListingPosted($this->listing, $this->company));
        Log::info('email sent to ' . $this->company->email);

    }
}
