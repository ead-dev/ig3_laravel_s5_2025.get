<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    //
    protected $guarded = [];

    public function saison()
    {
        return $this->belongsTo('App\Models\Saison');
    }

    public function pps(){
        return $this->hasMany('App\Models\PaiementPart');
    }

    public function banque()
    {
        return $this->belongsTo('App\Models\Banque');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function paiements(){
        return $this->hasMany('App\Models\Paiement','contrat_id');
    }

    public function livraisons(){
        return $this->hasMany('App\Models\Livraison');
    }

    public function getQtylAttribute(){
        $livs = $this->livraisons->where('delivered_at','!=',null);
        return $livs->reduce(function($c,$i){
            return $c + $i->quantity;
        });
    }

    public function getPercentageAttribute(){
        
        return round($this->qtyl/$this->quantity * 100,2);
    }

    public function getStatusAttribute(){
        $data = [
            'name'=>'en cours',
            'color'=>'success'
        ];

        if($this->closed_at){
            $data = [
                'name'=>'clos',
                'color'=>'warning'
            ]; 
        }

        if(!$this->active){
            $data = [
                'name'=>'annulé',
                'color'=>'danger'
            ]; 
        }

        return $data;
    }


}
