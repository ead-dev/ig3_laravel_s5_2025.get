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

    public function villages()
    {
        return $this->belongsToMany('App\Models\Village','calendrier_items_villages','item_id');
    }

    public function livraisons()
    {
        return $this->hasMany('App\Models\Livraison','item_id');
    }

    public function prevision()
    {
        return $this->hasOne('App\Models\Prevision','item_id');
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

    public function getJourAttribute(){
        return \Carbon\Carbon::parse($this->day);
    }

}
