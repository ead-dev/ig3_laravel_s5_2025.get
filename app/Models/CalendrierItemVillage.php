<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CalendrierItemVillage extends Model
{
    //
    protected $guarded = [];

    protected $table = 'calendrier_items_villages';
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo('App\Models\CalendrierItem','item_id');
    }

    public function village()
    {
        return $this->belongsTo('App\Models\Village','village_id');
    }
}
