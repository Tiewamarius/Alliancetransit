<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\expeditions; // Importez votre modèle Expeditions

class NouvelleExpedition extends Notification
{
    use Queueable;

    protected $expedition;

    public function __construct(expeditions $expedition)
    {
        $this->expedition = $expedition;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle expédition enregistrée')
            ->line("Bonjour Mme/Mr ". $this->expedition->nom_expediteur.",
            Alliance Transit vous informe que la livraison de votre colis s'effectuera demain. 
            Nous vous rappelons que toutes personnes injoignables passera au dépôt récupérer son coli.
            Merci de prendre vos dispositions pour la bonne réception du colis.
            code de suivi:". $this->expedition->numeroSuivi.".");
            // ->action('Voir l\'expédition', url('/admin/expeditions/' . $this->expedition->id)) // Adaptez l'URL
            
    }

    public function toArray($notifiable)
    {
        return [
            'expedition_id' => $this->expedition->id,
        ];
    }
}