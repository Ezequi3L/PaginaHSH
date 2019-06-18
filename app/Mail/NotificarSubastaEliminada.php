<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class NotificarSubastaEliminada extends Mailable
{
    use Queueable, SerializesModels;

    private $destinatarios;
    private $otros;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($destinatarios)
    {
        $this->destinatarios = unserialize($destinatarios); 
        $this->otros = array();
        foreach ($this->destinatarios as $id) {
            array_push($this->otros, User::find(array_shift($this->destinatarios))->email);
        }
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('emails.subastaEliminada')
            ->from(\Auth::user()->email)
            ->cc($this->otros)
            ->subject('Subasta eliminada');
    }
}