<?php

namespace App\Http\Controllers\Operateur;

use App\Http\Controllers\ExtendedController;
use App\Models\Contrat;
use App\Models\Order;
use App\Models\Precommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrecommandeController extends ExtendedController
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
        return view('/Operateur/Precommandes/index')->with(compact('items'));
    }

    public function generate($token){
        $item = Precommande::where('token',$token)->first();
        $contrat = Contrat::find($item->contrat_id);
        Order::create([
            'precommande_id'=>$item->id,
            'client_id'=>$item->client_id,
            'user_id'=>auth()->user()->id,
            'saison_id'=>$item->saison_id,
            'contrat_id'=>$item->contrat_id,
            'banque_id'=>$contrat->banque_id,
            'moi_id'=>date('m'),
            'annee'=>date('Y'),
            'day'=>$item->day,
            'name'=>time(),
            'token'=>sha1(time().auth()->user()->id),
        ]);
        $item->closed_at = new \DateTime();
        $item->closed_by = auth()->user()->id;
        $item->save();

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
        return view('/Operateur/Precommandes/show')->with(compact('item'));


	}


}
