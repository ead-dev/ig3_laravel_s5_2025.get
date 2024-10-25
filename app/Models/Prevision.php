<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Prevision extends Model
{
    //
    protected $guarded = [];


    public function calendrier()
    {
        return $this->belongsTo('App\Models\Calendrier');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\CalendrierItem','item_id');
    }

    public function cooperative()
    {
        return $this->belongsTo('App\Models\Cooperative');
    }

    public function saison()
    {
        return $this->belongsTo('App\Models\Saison');
    }

    public function order_items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function village()
    {
        return $this->belongsTo('App\Models\Village');
    }

    public function arrondissement()
    {
        return $this->belongsTo('App\Models\Arrondissement','arrondissement_id');
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    

    protected function day(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => \Carbon\Carbon::parse($value),
        );
    }

    public function getQuantityAttribute(){
        return $this->grd1_qty + $this->grd2_qty + $this->hs_qty;
    }

    public function getResteAttribute(){
        $items = $this->order_items;
        $qty = $items->reduce(function($c,$item){
            return $c + $item->grd1_qty + $item->grd2_qty + $item->hs_qty;
        });
        return $this->quantity - $qty;
    }

    public function getGrd1ResteAttribute(){
        $items = $this->order_items;
        $qty = $items->reduce(function($c,$item){
            return $c + $item->grd1_qty ;
        });
        return $this->grd1_qty - $qty;
    }

    public function getGrd2ResteAttribute(){
        $items = $this->order_items;
        $qty = $items->reduce(function($c,$item){
            return $c + $item->grd2_qty ;
        });
        return $this->grd2_qty - $qty;
    }

    public function getHsResteAttribute(){
        $items = $this->order_items;
        $qty = $items->reduce(function($c,$item){
            return $c + $item->hs_qty ;
        });
        return $this->hs_qty - $qty;
    }

}
