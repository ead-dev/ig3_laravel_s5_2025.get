<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    public function lignes(){
        return $this->hasMany('App\Models\Ligne');
    }

    public function getQuantityAttribute(){
        $lignes = $this->lignes;
        $s = 0;
        foreach($lignes as $lg){
            $s = $s + $lg->quantity;
        }
        return $s;
    }

    public function getTotalAttribute(){
        $lignes = $this->lignes;
        $s = 0;
        foreach($lignes as $lg){
            $s = $s + $lg->total;
        }
        return $s;
    }
}
