<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    //
    protected $guarded = [];

    protected $table = 'livraisons';

    public function calendrier()
    {
        return $this->belongsTo('App\Models\Calendrier');
    }

    public function contrat()
    {
        return $this->belongsTo('App\Models\Contrat');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function saison()
    {
        return $this->belongsTo('App\Models\Saison');
    }

    public function cooperative()
    {
        return $this->belongsTo('App\Models\Cooperative');
    }

    public function protocole()
    {
        return $this->belongsTo('App\Models\Protocole');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\CalendrierItem','item_id');
    }

    public function village()
    {
        return $this->belongsTo('App\Models\Village');
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

    protected function day(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => \Carbon\Carbon::parse($value),
        );
    }

    public function getAcceptedDtAttribute(){
        return \Carbon\Carbon::parse($this->accepted_at);
    }

    public function getDeliveredDtAttribute(){
        return \Carbon\Carbon::parse($this->delivered_at);
    }

    public function getCloseDtAttribute(){
        return \Carbon\Carbon::parse($this->closed_at);
    }

    public function getJourAttribute(){
        return \Carbon\Carbon::parse($this->day)->format('d/m/Y');
    }



   /*  protected function delivered_at(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => \Carbon\Carbon::parse($value),
        );
    } */

    /* protected function closed_at(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => \Carbon\Carbon::parse($value),
        );
    } */

    public function getStatusAttribute(){
        $data = [
            'name'=>'non validé',
            'code'=>-1,
            'color'=>'danger'
        ];
        if($this->accepted_at){
            $data = [
                'name'=>'non livré',
                'code'=>0,
                'color'=>'warning'
            ];
        }

        if($this->delivered_at){
            $data = [
                'name'=>'livré',
                'code'=>1,
                'color'=>'success'
            ];
        }

        return $data;
    }

    public function getTotalAttribute(){
        return $this->price * $this->quantity*1000;
    }

}
