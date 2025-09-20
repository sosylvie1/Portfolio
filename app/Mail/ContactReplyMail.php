<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactMessage;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;
    public $replyContent;

    public function __construct(ContactMessage $messageData, string $replyContent)
    {
        $this->messageData  = $messageData;
        $this->replyContent = $replyContent;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->replyTo(config('mail.from.address')) // l’expéditeur (toi), pour que les réponses du visiteur reviennent dans ta boîte
                    ->subject('📩 Réponse à votre message - Portfolio')
                    ->view('emails.contact-reply')
                    ->with([
                        'messageData'  => $this->messageData,
                        'replyContent' => $this->replyContent,
                    ]);
    }
}
