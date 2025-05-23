<?php

namespace App\Exports;

use App\Models\StageValide;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class StagesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
{
    return StageValide::with('partenaire') // Charge les partenaires associés
        ->get()
        ->map(function ($stage) {
            return [
                'matricule' => $stage->matricule,
                'nom' => $stage->nom,
                'prenom' => $stage->prenom,
                'filiere' => $stage->filiere,
                'campus' => $stage->campus,
                'annee' => $stage->annee,
                'periode' => $stage->periode,
                'partenaire_choisi' => $stage->partenaire ? $stage->partenaire->nom : 'Aucun', // Ajoute le nom du partenaire
                'date_validation' => $stage->date_validation,
            ];
        });
    }


    public function headings(): array
    {
        return [
            'matricule',
            'nom',
            'prenom',
            'filiere',
            'campus',
            'annee',
            'periode',
            'partenaire_choisi',
            'date_validation',
        ];
    }
 
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FF0000FF']]],
        ];
    }


    public function map($stage): array
    {
        return [
            $stage->matricule,
            $stage->nom,
            $stage->prenom,
            $stage->filiere,
            $stage->campus,
            $stage->annee,
            $stage->periode,
            $stage->partenaire ? $stage->partenaire->nom : 'Aucun',
            $stage->date_validation,
        ];
    }


    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';', // Délimiteur clair pour Excel
            'use_bom' => true, // Ajout du BOM UTF-8 pour Excel
        ];
    }



}
