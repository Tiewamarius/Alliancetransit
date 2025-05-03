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
    protected $destinataireType; // 'expediteur' ou 'destinataire'

    public function __construct(expeditions $expedition, string $destinataireType)
    {
        $this->expedition = $expedition;
        $this->destinataireType = $destinataireType;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->subject("Informations d'expédition - Alliance Transit");

        if ($this->destinataireType === 'expediteur') {
            $this->buildExpediteurEmailContent($mailMessage);
        } elseif ($this->destinataireType === 'destinataire') {
            $this->buildDestinataireEmailContent($mailMessage);
        }

        return $mailMessage;
    }

    protected function buildExpediteurEmailContent(MailMessage $mailMessage)
    {
        $dateChargement = $this->expedition->dateEnlev ? $this->expedition->dateEnlev->format('d/m/Y') : 'non spécifiée';
        $mailMessage->line("Bonjour Mr/Mme " . $this->expedition->nom_expediteur . ",");

        switch ($this->expedition->status) {
            case 'Non Traité':
                $mailMessage->line("Votre colis prévu pour le chargement du " . $dateChargement . " est en cours de traitement. Tout colis devra être réglé avant la livraison.");
                $mailMessage->line("Toutefois, tous les clients indisponibles lors de la livraison passeront récupérer leur colis au dépôt.");
                break;
            case 'Encour':
                $mailMessage->line("Votre colis avec le numéro de suivi " . $this->expedition->numeroSuivi . " est actuellement en cours de traitement dans nos locaux. Nous vous tiendrons informé de la prochaine étape.");
                break;
            case 'Livré':
                $mailMessage->line("Votre colis avec le numéro de suivi " . $this->expedition->numeroSuivi . " a été chargé pour la livraison prévue le " . ($this->expedition->dateLivr ? $this->expedition->dateLivr->format('d/m/Y') : 'prochainement') . ".");
                $mailMessage->line("Nous vous rappelons que tout colis devra être réglé avant la livraison.");
                break;
            case 'Depot':
                $mailMessage->line("Votre colis avec le numéro de suivi " . $this->expedition->numeroSuivi . " a été livré avec succès le " . ($this->expedition->dateLivr ? $this->expedition->dateLivr->format('d/m/Y') : 'inconnue') . ".");
                $mailMessage->line("Nous vous remercions pour votre confiance.");
                break;
            default:
                // Vous pouvez ajouter un message par défaut ici si nécessaire
                break;
        }

        $mailMessage->line("Merci pour votre compréhension.");
        $mailMessage->line("Votre N° de suivi : " . $this->expedition->numeroSuivi);
    }

    protected function buildDestinataireEmailContent(MailMessage $mailMessage)
    {
        $mailMessage->line("Bonjour Mme/Mr " . $this->expedition->nom_destinataire . ",");

        switch ($this->expedition->status) {
            case 'Non Traité':
                $mailMessage->line("Votre colis avec le numéro de suivi " . $this->expedition->numeroSuivi . " est en cours de préparation pour l'expédition. Nous vous informerons de la date de chargement prochainement.");
                break;
            case 'Encour':
                $mailMessage->line("Votre colis avec le numéro de suivi " . $this->expedition->numeroSuivi . " est actuellement en cours de traitement et sera expédié prochainement.");
                break;
            case 'Arrivé':
                $mailMessage->line("La livraison de votre colis avec le numéro de suivi " . $this->expedition->numeroSuivi . " est prévue pour le " . ($this->expedition->dateLivr ? $this->expedition->dateLivr->format('d/m/Y') : 'demain') . ".");
                $mailMessage->line("Nous vous rappelons que toutes personnes injoignables passeront au dépôt récupérer son coli.");
                $mailMessage->line("Merci de prendre vos dispositions pour la bonne réception du colis.");
                break;
            case 'Depot':
                $mailMessage->line("Votre colis avec le numéro de suivi " . $this->expedition->numeroSuivi . " a été livré avec succès le " . ($this->expedition->dateLivr ? $this->expedition->dateLivr->format('d/m/Y') : 'inconnue') . ".");
                break;
            default:
                // Vous pouvez ajouter un message par défaut ici si nécessaire
                break;
        }

        $mailMessage->line("Votre numéro de suivi : " . $this->expedition->numeroSuivi);
    }

    public function toArray($notifiable)
    {
        return [
            'expedition_id' => $this->expedition->id,
            'numeroSuivi' => $this->expedition->numeroSuivi,
            'destinataire_type' => $this->destinataireType,
        ];
    }
}