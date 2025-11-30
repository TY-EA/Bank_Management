<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Champs autorisés pour créer ou modifier un client
    protected $fillable = ['nom', 'prenom', 'email'];

    // Relation : un client peut avoir plusieurs comptes
    public function comptes()
    {
        return $this->hasMany(Compte::class);
        
    }
}
