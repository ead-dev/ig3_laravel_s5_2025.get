<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $guarded = [];

    public function pay()
    {
        return $this->belongsTo('App\Models\Pay');
    }

    public function contrats(){
        return $this->hasMany('App\Models\Contrat');
    }

    public function pps(){
        return $this->hasMany('App\Models\PaiementPart');
    }

    public function paiements(){
        return $this->hasMany('App\Models\Paiement','client_id');
    }

    public function livraisons(){
        return $this->hasMany('App\Models\Livraison');
    }

    public function getPhotoAttribute(){
        $host = request()->getSchemeAndHttpHost();
        if($this->photo_uri){
            $path = $host.'/img/'.$this->photo_uri;
        }else{
            $path = $host.'/img/logo.png';
        }
        return $path;

    }
}
