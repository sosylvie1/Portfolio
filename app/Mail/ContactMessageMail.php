<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactMessage;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;

    public function __construct(ContactMessage $messageData)
    {
        $this->messageData = $messageData;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->replyTo($this->messageData->email) // on met seulement l’email (sinon Roundcube affiche juste le nom)
                    ->subject('📩 Nouveau message depuis le site portfolio')
                    ->view('emails.contact-message')
                    ->with([
                        'messageData' => $this->messageData,
                    ]);
    }
}
