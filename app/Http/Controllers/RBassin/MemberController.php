<?php

namespace App\Http\Controllers\RBassin;

use App\Http\Controllers\ExtendedController;
use App\Models\Exploitant;
use App\Models\Niveau;
use App\Models\PaiementPart;
use App\Models\Part;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MemberController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Exploitant::all();
        return view('/RBassin/Members/index')->with(compact('items'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($token)
	{
		$item = Exploitant::where('token',$token)->first();
        $parts = Part::where('saison_id',$this->_saison->id)->where('exploitant_id',$item->id)->get();
        $pps = PaiementPart::where('saison_id',$this->_saison->id)->where('exploitant_id',$item->id)->get();
		return view('/RBassin/Members/show')->with(compact('item','parts','pps'));
	}


}
