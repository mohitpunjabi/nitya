<?php namespace App\Commands;

use App\Commands\Command;

use App\Enquiry;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendEmail extends Command implements ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

    protected $enquiry;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Enquiry $enquiry)
	{
		$this->enquiry = $enquiry;
	}

}
