<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\Arrondissement;
use App\Models\Departement;
use App\Models\Village;
use App\Models\Cooperative;
use Illuminate\Http\Request;

class SearchController extends Controller
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
}
