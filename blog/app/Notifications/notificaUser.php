<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
class notificaUser extends Notification
{
    use Queueable;
    private $usuario,$senha;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $usuario,$senha)
    {
        $this->usuario = $usuario;
        $this->senha = $senha;
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
                    ->line('Enviado email de teste.')
                    ->subject('Login cadastramento')
                    ->greeting('Usuario:'.$this->usuario->name.' <br>Senha:'.$this->senha)
                    ->action('Entrar no sistema', route('user.edit',$this->usuario->id))
                    ->line('Obrigado por usar o sistema');
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
