<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendrier extends Model
{
    //
    protected $guarded = [];

    public function cooperative()
    {
        return $this->belongsTo('App\Models\Cooperative');
    }

    public function items()
    {
        return $this->hasMany('App\Models\CalendrierItem','calendrier_id');
    }



}
