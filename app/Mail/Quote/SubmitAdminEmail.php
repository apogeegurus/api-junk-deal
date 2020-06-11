<?php

namespace App\Mail\Quote;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmitAdminEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $quote;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quote)
    {
        $this->quote = $quote;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.quote.submit_admin', ['quote' => $this->quote]);
    }
}
