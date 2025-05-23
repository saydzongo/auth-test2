<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StageHistorique extends Model
{
    //
    use HasFactory;
    protected $table = 'stages_historiques';

    protected $fillable = [
        'stage_id', 'ancien_statut', 'nouveau_statut', 'date_changement'
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
