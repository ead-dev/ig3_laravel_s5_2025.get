<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repas extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
