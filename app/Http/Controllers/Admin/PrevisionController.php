<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saison;
use App\Models\Contrat;
use App\Models\Precommande;
use App\Models\Prevision;
use App\User;
use Illuminate\Http\Request;

class PrevisionController extends Controller
{
    protected $_saison;

    public function __construct()
    {
        $this->_saison = Saison::whereNull('closed_at')->first();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Prevision::orderBy('created_at','DESC')->where('saison_id',$this->_saison->id)->get();
        return view('/Admin/Previsions/index')->with(compact('items'));
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
		$item = Prevision::where('token',$token)->first();
        return view('/Admin/Previsions/show')->with(compact('item'));
        
		
	}


}
