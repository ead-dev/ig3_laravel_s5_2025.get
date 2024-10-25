<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaiementPart extends Model
{
    //
    protected $guarded = [];
    protected $table = 'paiement_parts';

    public function paiement()
    {
        return $this->belongsTo('App\Models\Paiement');
    }

    public function part()
    {
        return $this->belongsTo('App\Models\Part');
    }

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    public function item(){
        return $this->belongsTo('App\Models\OrderItem');
    }

    public function exploitant(){
        return $this->belongsTo('App\Models\Exploitant');
    }

    public function cooperative(){
        return $this->belongsTo('App\Models\Cooperative');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function contrat(){
        return $this->belongsTo('App\Models\Contrat');
    }

    public function saison(){
        return $this->belongsTo('App\Models\Saison');
    }

    public function banque(){
        return $this->belongsTo('App\Models\Banque');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
