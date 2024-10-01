<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cooperative extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['dtn'];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }

    public function arrondissement()
    {
        return $this->belongsTo('App\Models\Arrondissement');
    }

    public function livraisons(){
        return $this->hasMany('App\Models\Livraison');
    }

    public function exploitants(){
        return $this->hasMany('App\Models\Exploitant');
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
