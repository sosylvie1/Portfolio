<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reply;
    public $originalMessage;

    /**
     * Crée une nouvelle instance.
     */
    public function __construct($reply, $originalMessage)
    {
        $this->reply = $reply;
        $this->originalMessage = $originalMessage;
    }

    /**
     * Construire l'email.
     */
    public function build()
    {
        return $this->subject('Réponse : ' . ($this->originalMessage->subject ?? 'Sans sujet'))
                    ->markdown('emails.contact.reply');
    }
}
