<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MagicLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $firstName;

    /**
     * Create a new message instance.
     */
    public function __construct($link, $firstName)
    {
        $this->link = $link;
        $this->firstName = $firstName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Magic Registeration Link')
                    ->markdown('emails.magiclink')
                    ->with([
                        'link' => $this->link,
                        'firstName' => $this->firstName,
                    ]);
    }
}
