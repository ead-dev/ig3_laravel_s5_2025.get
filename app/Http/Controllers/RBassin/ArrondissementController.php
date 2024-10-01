<?php

namespace App\Http\Controllers\RBassin;

use App\Http\Controllers\Controller;
use App\Models\Arrondissement;
use App\Models\Departement;
use App\Models\Region;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArrondissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $arrondissements = Arrondissement::where('departement_id',auth()->user()->departement_id)->get();
        return view('/RBassin/Arrondissements/index')->with(compact('arrondissements'));
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
        $departement = Departement::find(auth()->user()->departement_id);
        $arrondissement = Arrondissement::create(
            [
                'name'=>$data['name'],
                'abb'=>$data['abb'],
                'departement_id'=>$departement->id,
                'region_id'=>$departement->region_id
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
		$arrondissement = Arrondissement::find($id);
		return view('/RBassin/Arrondissements/show')->with(compact('arrondissement'));
	}


}
