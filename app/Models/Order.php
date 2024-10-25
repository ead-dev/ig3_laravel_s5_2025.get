<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded = [];

    public function precommande()
    {
        return $this->belongsTo('App\Models\Precommande');
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

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function paiements(){
        return $this->hasMany('App\Models\Paiement','order_id');
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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function pps(){
        return $this->hasMany('App\Models\PaiementPart','order_id');
    }

    public function getStatusAttribute(){
        $data = [
            'name'=>'non validée',
            'color'=>'warning',
            'code'=>0
        ];

        if($this->client_validated_at){
            $data = [
                'name'=>'validée par le client',
                'color'=>'blue',
                'code'=>1
            ];
        }

        if($this->validated_at){
            $data = [
                'name'=>'validée',
                'color'=>'success',
                'code'=>1
            ];
        }

        if($this->cancelled_at){
            $data = [
                'name'=>'annulée',
                'color'=>'danger',
                'code'=>-1
            ];
        }

        return $data;
    }

    public function getGrad1QtyAttribute(){
        $items = $this->items;
        return $items->reduce(function($c,$i){
            return $c + $i->grd1_qty;
        });
    }

    public function getGrad2QtyAttribute(){
        $items = $this->items;
        return $items->reduce(function($c,$i){
            return $c + $i->grd2_qty;
        });
    }

    public function getHsQtyAttribute(){
        $items = $this->items;
        return $items->reduce(function($c,$i){
            return $c + $i->hs_qty;
        });
    }

    public function getQuantityAttribute(){
        $items = $this->items;
        return $items->reduce(function($c,$i){
            return $c + $i->quantity;
        });
    }

    public function getTotalAttribute(){
        $items = $this->items;
        return $items->reduce(function($c,$i){
            return $c + $i->total;
        });
    }

}
