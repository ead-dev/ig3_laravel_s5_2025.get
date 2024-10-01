<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $livraisons = Livraison::orderBy('created_at','DESC')->where('client_id',auth()->user()->client_id)->whereNotNull('accepted_at')->get();
        return view('/Client/Livraisons/index')->with(compact('livraisons'));
    }

    public function valider()
	{
        $token = request()->token;
		$livraison = Livraison::where('token',$token)->first();
        $livraison->delivered_at = new \DateTime();
        $livraison->save();
        Session::flash('success','Livraison validée avec succès!');
		return back();
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
	public function show($token)
	{
		$livraison = Livraison::where('token',$token)->first();
		return view('/Client/Livraisons/show')->with(compact('livraison'));
	}


}
