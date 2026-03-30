<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_compte',
        'rib',
        'solde',
        'client_id',
    ];

    protected $casts = [
        'solde' => 'decimal:2',
    ];

    /**
     * Relation: Compte belongs to Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relation: Get all virements where this account is source
     */
    public function virementsEnvoyes()
    {
        return $this->hasMany(Virement::class, 'rib_source', 'rib');
    }

    /**
     * Relation: Get all virements where this account is destination
     */
    public function virementsRecus()
    {
        return $this->hasMany(Virement::class, 'rib_target', 'rib');
    }
}
