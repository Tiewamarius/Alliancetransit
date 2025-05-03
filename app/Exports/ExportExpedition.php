<?php
namespace App\Exports;

use App\Models\Expeditions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExpedition implements FromCollection, WithHeadings
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
        // Définissez ici les noms des colonnes de votre fichier Excel
        return [
            'Date',
            'Expediteur',
            'Numero Expediteur',
            'Destinataire',
            'Numero Destinataire',
            'Designation',
            'Credit',
            // Ajoutez les autres colonnes que vous souhaitez exporter
        ];
    }

    public function map($expedition): array
    {
        return [
            $expedition->dateEnlev,
            $expedition->nom_expediteur,
            $expedition->numero_expediteur,
            $expedition->email_expediteur,
            $expedition->nom_destinataire,
            $expedition->numero_destinataire,
            $expedition->designation,
            $expedition->credit,
            // Mappez ici les colonnes spécifiques que vous voulez pour l'export A en utilisant $expedition->votre_colonne
        ];
    }
}