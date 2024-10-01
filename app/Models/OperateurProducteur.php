<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperateurProducteur extends Model
{
    //
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'operateurs_producteurs';

    public function operateur()
    {
        return $this->belongsTp('App\Models\User','operateur_id');
    }

    public function producteur()
    {
        return $this->belongsTp('App\Models\Cooperative','producteur_id');
    }
}
