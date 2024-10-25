<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    protected $guarded = [];
    protected $table ='order_items';

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function prevision()
    {
        return $this->belongsTo('App\Models\Prevision');
    }

    public function cooperative()
    {
        return $this->belongsTo('App\Models\Cooperative');
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }

    public function arrondissement()
    {
        return $this->belongsTo('App\Models\Arrondissement');
    }

    public function contrat()
    {
        return $this->belongsTo('App\Models\Contrat');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function saison()
    {
        return $this->belongsTo('App\Models\Saison');
    }

    public function paiements(){
        return $this->hasMany('App\Models\Paiement','item_id');
    }

    public function parts(){
        return $this->hasMany('App\Models\Part','item_id');
    }

    public function pps(){
        return $this->hasMany('App\Models\PaiementPart','item_id');
    }


    public function getVersementAttribute(){
        $items = $this->paiements;
        return $items->reduce(function($c,$p){
            return $c + $p->montant;
        });
    }

    public function getResteAttribute(){
       return  $this->total - $this->versement;
    }

    public function getQuantityAttribute(){
        return $this->grd1_qty + $this->grd2_qty + $this->hs_qty;
    }

    public function getTotalAttribute(){
        return $this->grd1_qty*$this->grd1_price*1000 + $this->grd2_qty*$this->grd2_price*1000 + $this->hs_qty*$this->hs_price*1000;
    }

}
