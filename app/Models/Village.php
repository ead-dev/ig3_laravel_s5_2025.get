<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    //
    protected $guarded = [];

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

    public function exploitants()
    {
        return $this->hasMany('App\Models\Exploitant');
    }

    public function arrondissement()
    {
        return $this->belongsTo('App\Models\Arrondissement');
    }
    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }
}
