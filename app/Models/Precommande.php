<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precommande extends Model
{
    //
    protected $guarded = [];

    public function order()
    {
        return $this->hasOne('App\Models\Order');
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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getStatusAttribute(){
        $data = [
            'name'=>'non traitée',
            'color'=>'warning',
            'code'=>0
        ];

        if($this->closed_at){
            $data = [
                'name'=>'traitée',
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

    public function getQuantityAttribute(){
        return $this->grd1_qty + $this->grd2_qty + $this->hs_qty;
    }

}
