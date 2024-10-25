<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    //
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\OrderItem','item_id');
    }

    public function exploitant()
    {
        return $this->belongsTo('App\Models\Exploitant');
    }

    public function saison()
    {
        return $this->belongsTo('App\Models\Saison');
    }

    public function cooperative()
    {
        return $this->belongsTo('App\Models\Cooperative');
    }

    public function paiements(){
        return $this->belongsToMany('App\Models\Paiement','paiement_parts')->withPivot('montant','active','created_at','user_id');
    }

    public function pps(){
        return $this->hasMany('App\Models\PaiementPart');
    }

    public function getQuantityAttribute(){
        return $this->grd1_qty + $this->grd2_qty + $this->hs_qty;
    }

    public function getTotalAttribute(){
        return $this->grd1_qty*$this->item->grd1_price*1000 + $this->grd2_qty*$this->item->grd2_price*1000 + $this->hs_qty*$this->item->hs_price*1000;
    }

    public function getVersementAttribute(){
        $ps = $this->paiements;
        return $ps->reduce(function($c,$p){
            return $c + $p->pivot->montant;
        });
    }

    public function getResteAttribute(){
        return $this->total - $this->versement;
    }

}
