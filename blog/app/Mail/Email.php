<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Novo teste sistema mobe');
        $this->to($this->user['email']);
        if ($this->user['condicao'] === 'precadastro') {
          $pagina = 'precadastro';
        }else{
          $pagina = 'senha';
        }
        return $this->markdown('email.'.$pagina,[
            'user'=>$this->user,
        ]);
    }
}
