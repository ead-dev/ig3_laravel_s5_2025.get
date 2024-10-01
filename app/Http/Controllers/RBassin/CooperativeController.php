<?php

namespace App\Http\Controllers\RBassin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExtendedController;
use App\Models\Arrondissement;
use App\Models\Cooperative;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CooperativeController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cooperatives = Cooperative::where('departement_id',auth()->user()->departement_id)->get();
        $arrondissements = Arrondissement::where('departement_id',auth()->user()->departement_id)->get();
        return view('/RBassin/Cooperatives/index')->with(compact('cooperatives','arrondissements'));
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
        //dd($data);
        $arrondissement = Arrondissement::find($data['arrondissement_id']);
        $banque = new Cooperative();
        $banque->name = $data['name'];
        $banque->email = $data['m-email'];
        $banque->phone = $data['phone'];
        $banque->token = sha1(time());
        $banque->address = $data['address'];
        $banque->immatriculation = $data['immatriculation'];
        $banque->region_id = $arrondissement->region_id;
        $banque->departement_id = $arrondissement->departement_id;
        $banque->arrondissement_id = $data['arrondissement_id'];
        $photo = request()->photo;
        if($photo){
            $banque->photo_uri = $this->entityImgCreate($photo,'cooperatives',$banque->token);
        }
        $banque->save();
        $user = new User();
        $user->role_id = 4;
        $user->name = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->token = sha1(time());
        $user->cooperative_id = $banque->id;
        $user->departement_id = $arrondissement->departement_id;
        $user->region_id = $arrondissement->region_id;
        $user->save();
        Session::flash('success','Enregistrement effectué avec succès!');
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
		$item = Cooperative::where('token',$token)->first();
		return view('/RBassin/Cooperatives/show')->with(compact('item'));
	}


}
