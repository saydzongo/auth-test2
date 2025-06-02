<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StageValideNotification extends Notification
{
    use Queueable;
    public $stage;
    public $email;
    public $nom;
    public $periode;
    public $partenaire_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($stage)
    {
        $this->stage = $stage;
        $this->email = $stage->email; 
        $this->nom = $stage->nom;
        $this->periode = $stage->periode;
        $this->partenaire_id = $stage->partenaire_id; // 🔥 Correction ici
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre stage a été validé!')
            ->greeting("Bonjour {$this->stage->nom},")
            ->line("Votre demande de stage a été validée avec succès.")
            ->line("Partenaire choisi: ID {$this->stage->partenaire_id}")
            ->line("Période: {$this->periode}")
            ->action('Voir votre stage', url('/stages/'.$this->stage->id))
            ->line('Merci de votre confiance!');
            
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
