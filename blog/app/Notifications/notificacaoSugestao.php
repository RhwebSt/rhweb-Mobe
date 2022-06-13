<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notificacaoSugestao extends Notification
{
    use Queueable;
    private $usuarios,$empresa,$dados;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($usuario,$empresa,$dados)
    {
        $this->usuarios = $usuario;
        $this->empresa = $empresa;
        $this->dados = $dados;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Novo teste sistema mobe')
                    ->line('Usuario '.$this->usuarios->name)
                    ->line('A empresa '.$this->empresa->esnome)
                    // ->action('Notification Action', url('/'))
                    ->line('Menssagem '.$this->dados['feedbackText'])
                    ->line('Avaliação '.$this->dados['icon']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
