<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    //
    protected $guarded = [];

    public function paiements(){
        return $this->hasMany('App\Models\Paiement','banque_id');
    }

    public function contrats(){
        return $this->hasMany('App\Models\Contrat','banque_id');
    }

    public function pps(){
        return $this->hasMany('App\Models\PaiementPart');
    }

}
