<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacionSolicitudObservada extends Mailable
{
    use Queueable, SerializesModels;

    public $distressCall;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($solicitud)
    {
        $this->distressCall = $solicitud;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $hola=$this->distressCall;
        return $this->view('mails.NotificacionSolicitudObservada',compact('hola'));
    }
}
