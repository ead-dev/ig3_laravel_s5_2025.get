<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CalendrierItem extends Model
{
    //
    protected $guarded = [];

    protected $table = 'calendrier_items';

    public function calendrier()
    {
        return $this->belongsTo('App\Models\Calendrier');
    }

    public function cooperative()
    {
        return $this->belongsTo('App\Models\Cooperative');
    }

    public function saison()
    {
        return $this->belongsTo('App\Models\Saison');
    }

    public function livraisons()
    {
        return $this->hasMany('App\Models\Livraison','item_id');
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

    public function getQtylAttribute(){
        $livs = $this->livraisons->where('delivered_at','!=',null);
        if($livs->count()){
            return $livs->reduce(function($c,$i){
                return $c + $i->quantity;
            });
        }else{
            return 0;
        }
        
    }

    public function getPercentageAttribute(){
        
        return round($this->qtyl/$this->quantity * 100,2);
    }

    protected function day(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => \Carbon\Carbon::parse($value),
        );
    }

}
