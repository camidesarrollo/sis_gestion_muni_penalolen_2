<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUser extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $clave;
    public $perfil;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $clave, $perfil)
    {
        $this->email =$email;
        $this->clave =$clave;
        $this->$perfil = $perfil;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))->to($this->email, 'xpersona')->view('email.crearUsuario')->subject('Creación de usuario');
    }
}
