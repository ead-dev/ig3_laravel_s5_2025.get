<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saison;
use App\Models\Contrat;
use App\Models\Precommande;
use App\User;
use Illuminate\Http\Request;

class PrecommandeController extends Controller
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
        $items = Precommande::orderBy('created_at','DESC')->get();
        return view('/Admin/Precommandes/index')->with(compact('items'));
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
        return view('/Admin/Precommandes/show')->with(compact('item'));
        
		
	}


}
