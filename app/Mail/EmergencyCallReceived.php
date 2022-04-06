<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmergencyCallReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $distressCall;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clave)
    {
        $this->distressCall = $clave;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $hola=$this->distressCall;
        return $this->view('mails.emergency_call',compact('hola'));
    }
}
