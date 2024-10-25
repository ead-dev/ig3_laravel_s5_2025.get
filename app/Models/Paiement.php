<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    //
    protected $guarded = [];

    public function saison()
    {
        return $this->belongsTo('App\Models\Saison');
    }

    public function banque()
    {
        return $this->belongsTo('App\Models\Banque','banque_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    public function item(){
        return $this->belongsTo('App\Models\OrderItem','item_id');
    }

    public function parts(){
        return $this->belongsToMany('App\Models\Part','paiement_parts')->withPivot('montant','active','created_at','user_id');
    }

    public function pps(){
        return $this->hasMany('App\Models\PaiementPart');
    }

    public function getJustificatifAttribute(){
        $host = request()->getSchemeAndHttpHost();
        $path = $host.'/files/'.$this->document_uri;
        return $path;
    }


}
