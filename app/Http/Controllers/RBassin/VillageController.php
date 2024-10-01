<?php

namespace App\Http\Controllers\RBassin;

use App\Http\Controllers\Controller;
use App\Models\Arrondissement;
use App\Models\Village;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $villages = Village::where('departement_id',auth()->user()->departement_id)->get();
        $arrondissements = Arrondissement::where('departement_id',auth()->user()->departement_id)->get();
        return view('/RBassin/Villages/index')->with(compact('villages','arrondissements'));
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $arrondissement = Arrondissement::find($data['arrondissement_id']);
        $village = Village::create(
            [
                'name'=>$data['name'],
                'latitude'=>$data['latitude'],
                'longitude'=>$data['longitude'],
                'region_id'=>$arrondissement->region_id,
                'departement_id'=>$arrondissement->departement_id,
                'arrondissement_id'=>$data['arrondissement_id'],
            ]
        );
        Session::flash('success','Enregistrement effectué avec succès!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($id)
	{
		$village = Village::find($id);
		return view('/RBassin/Villages/show')->with(compact('village'));
	}


}
