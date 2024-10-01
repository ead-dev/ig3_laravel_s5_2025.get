<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Protocole extends Model
{
    //
    protected $guarded = [];

    public function saison()
    {
        return $this->belongsTo('App\Models\Saison');
    }

    public function cooperative()
    {
        return $this->belongsTo('App\Models\Cooperative');
    }

    public function calendrier()
    {
        return $this->hasOne('App\Models\Calendrier');
    }

    public function livraisons(){
        return $this->hasMany('App\Models\Livraison','protocole_id');
    }

    public function getQtylAttribute(){
        $livs = $this->livraisons->whereNotNull('delivered_at');
        
        if($livs->count()){
            return $livs->reduce(function($c,$i){
                return $c + $i->quantity;
            });
        }else{
            return 0;
        }


        
    }

    public function getNameAttribute(){
        
        return $this->cooperative->name .' - '.$this->saison->name;
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
