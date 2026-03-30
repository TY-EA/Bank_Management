<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virement extends Model
{
    use HasFactory;

    protected $fillable = [
        'rib_source',
        'rib_target',
        'montant',
        // 'date_virement',
        'description',
        'statut',
    ];

    protected $casts = [
        'date_virement' => 'datetime',
        'montant' => 'decimal:2',
    ];

    /**
     * Relation: Get the source account via RIB
     */
    public function compteSource()
    {
        return $this->hasOne(Compte::class, 'rib', 'rib_source');
    }

    /**
     * Relation: Get the destination account via RIB
     */
    public function compteDestination()
    {
        return $this->hasOne(Compte::class, 'rib', 'rib_target');
    }
}
