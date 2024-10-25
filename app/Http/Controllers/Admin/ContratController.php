<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banque;
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
        $contrats = Contrat::orderBy('created_at','DESC')->get();
        $saisons = Saison::whereNull('closed_at')->get();
        $clients = Client::where('active',1)->get();
        $banques = Banque::where('active',1)->get();
        return view('/Admin/Contrats/index')->with(compact('contrats','clients','saisons','banques'));
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
                'banque_id'=>$data['banque_id'],
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
	public function show($id)
	{
		$contrat = Contrat::find($id);
		return view('/Admin/Contrats/show')->with(compact('contrat'));
	}


}
