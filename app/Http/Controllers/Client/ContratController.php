<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Saison;
use App\Models\Contrat;
use App\Models\Client;
use App\User;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contrats = Contrat::orderBy('created_at','DESC')->where('client_id',auth()->user()->client_id)->get();
        return view('/Client/Contrats/index')->with(compact('contrats'));
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
        $contrat = Contrat::create(
            [
                'client_id'=>$data['client_id'],
                'saison_id'=>$data['saison_id'],
                'quantity'=>$data['quantity'],
                'token'=>sha1(time()),
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
	public function show($token)
	{
		$contrat = Contrat::where('token',$token)->first();
		return view('/Client/Contrats/show')->with(compact('contrat'));
	}


}
