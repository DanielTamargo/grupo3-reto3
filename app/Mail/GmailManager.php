<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// https://www.itsolutionstuff.com/post/laravel-8-send-mail-using-gmail-smtp-serverexample.html

class GmailManager extends Mailable
{
    use Queueable, SerializesModels;

    public $detalles;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detalles)
    {
        $this->detalles = $detalles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Utilizaremos una plantilla u otra dependiendo del destinatario
        if ($this->detalles["rol_destinatario"] == "cliente") {
            return $this->subject($this->detalles["asunto"])
                        ->view('emails.cliente');
        } else {
            return $this->subject($this->detalles["asunto"])
                        ->view('emails.tecnico');
        }
    }
}
