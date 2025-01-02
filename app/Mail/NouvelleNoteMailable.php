<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvelleNoteMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $noteDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($noteDetails)
    {
        $this->noteDetails = $noteDetails;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nouvelle Note Saisie')
                    ->view('emails.nouvelle_note');
    }
}