<?php

namespace App\Http\Controllers\Operateur;

use App\Http\Controllers\Controller;
use App\Models\Saison;
use App\Models\Livraison;
use App\Models\Client;
use App\User;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $livraisons = Livraison::orderBy('created_at','DESC')->where('operateur_id',auth()->user()->id)->get();
        return view('/Operateur/Livraisons/index')->with(compact('livraisons'));
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
		$livraison = Livraison::find($id);
		return view('/Operateur/Livraisons/show')->with(compact('livraison'));
	}


}
