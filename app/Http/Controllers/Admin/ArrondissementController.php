<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arrondissement;
use App\Models\Region;
use App\User;
use Illuminate\Http\Request;

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
        $arrondissements = Arrondissement::all();
        $regions = Region::all();
        return view('/Admin/Arrondissements/index')->with(compact('arrondissements','regions'));
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
        $arrondissement = Arrondissement::create(
            [
                'name'=>$data['name'],
                'abb'=>$data['abb'],
                'region_id'=>$data['region_id'],
                'departement_id'=>$data['departement_id']
            ]
        );
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
		return view('/Admin/Arrondissements/show')->with(compact('arrondissement'));
	}


}
