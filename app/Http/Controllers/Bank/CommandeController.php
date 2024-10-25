<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\ExtendedController;
use App\Models\Contrat;
use App\Models\Order;
use App\Models\Precommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommandeController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Precommande::orderBy('created_at','DESC')->where('saison_id',$this->_saison->id)->get();
        return view('/Bank/Commandes/index')->with(compact('items'));
    }

    public function generate($token){
        

        Session::flash('success','Commande générée avec succès!');
        return back();
    }

    public function cancel($token){
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
		$item = Precommande::where('token',$token)->first();
        return view('/Bank/Commandes/show')->with(compact('item'));


	}


}
