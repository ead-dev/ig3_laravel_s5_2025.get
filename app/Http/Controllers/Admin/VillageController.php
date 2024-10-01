<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Village;
use App\Models\Region;
use App\User;
use Illuminate\Http\Request;

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
        $villages = Village::all();
        $regions = Region::all();
        return view('/Admin/Villages/index')->with(compact('villages','regions'));
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
        $village = Village::create(
            [
                'name'=>$data['name'],
                'latitude'=>$data['latitude'],
                'longitude'=>$data['longitude'],
                'region_id'=>$data['region_id'],
                'departement_id'=>$data['departement_id'],
                'arrondissement_id'=>$data['arrondissement_id'],
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
		$village = Village::find($id);
		return view('/Admin/Villages/show')->with(compact('village'));
	}


}
