<?php

namespace App\Exports;

use App\Models\Expeditions;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExpeditionLivraison implements FromCollection
{
    protected $annee;

    public function __construct(int $annee)
    {
        $this->annee = $annee;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Expeditions::whereYear('created_at', $this->annee)->get();
    }

    public function headings(): array
    {
        return [
            'Numéro de suivi',
            'Désignation',
            'Date d\'enlèvement',
            'Date de livraison',
            'Montant total',
            'Statut',
            // Ajoutez ici les colonnes spécifiques que vous voulez pour l'export B
        ];
    }

    /**
    * @param Expeditions $expedition
    * @return array
    */
    public function map($expedition): array
    {
        return [
            $expedition->numeroSuivi,
            $expedition->designation,
            $expedition->dateEnlev ? $expedition->dateEnlev->format('Y-m-d') : '',
            $expedition->dateLivr ? $expedition->dateLivr->format('Y-m-d') : '',
            $expedition->montant_total,
            $expedition->status,
            // Mappez ici les colonnes spécifiques que vous voulez pour l'export B en utilisant $expedition->votre_colonne
        ];
    }
}