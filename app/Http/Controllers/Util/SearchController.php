<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\ExtendedController;
use App\Models\Arrondissement;
use App\Models\Departement;
use App\Models\Village;
use App\Models\Cooperative;
use App\Models\Calendrier;
use App\Models\Prevision;
use Illuminate\Http\Request;

class SearchController extends ExtendedController
{
    //
    public function getDepartementsByRegionId(){
        $id = request()->id;
        $departements = Departement::where('region_id',$id)->get();
        return response()->json($departements);
    }

    public function getArrondissementsByDepartementId(){
        $id = request()->id;
        $departements = Arrondissement::where('departement_id',$id)->get();
        return response()->json($departements);
    }

    public function getVillagesByArrondissementId(){
        $id = request()->id;
        $departements = Village::where('arrondissement_id',$id)->get();
        return response()->json($departements);
    }

    public function getCooperativesByArrondissementId(){
        $id = request()->id;
        $departements = Cooperative::where('arrondissement_id',$id)->get();
        return response()->json($departements);
    }

    public function getCalendarItemsByCooperativeId(){
        $id = request()->id;
        $calendar = Calendrier::where('cooperative_id',$id)->where('saison_id',$this->_saison->id)->first();
        $items = $calendar->items->map(function($item){
            $name = $item->lieu . ' - '. \Carbon\Carbon::parse($item->day)->format('d/m/y');
            if($item->prevision){
                $name = $name . ' - '. $item->prevision->reste . ' tonnes';
            }
            return [
                'id'=>$item->id,
                'name'=>$name,
            ];
        });
        return response()->json($items);
    }

    public function getPrevisionById(){
        $id = request()->id;
        $item = Prevision::find($id);
        return [
            'id'=>$item->id,
            'grd1_qty'=>$item->grd1_reste,
            'grd2_qty'=>$item->grd2_reste,
            'hs_qty'=>$item->hs_reste,
        ];
    }
}
