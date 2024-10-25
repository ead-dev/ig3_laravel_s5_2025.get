<?php

namespace App\Http\Controllers\Cooperative;

use App\Http\Controllers\ExtendedController;
use App\Models\Cooperative;
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
        $coop = Cooperative::find(auth()->user()->cooperative_id);
        $villages = Village::where('arrondissement_id',$coop->arrondissement_id)->get();
        $niveaux = Niveau::all();
        return view('/Cooperative/Members/index')->with(compact('villages','items','niveaux'));
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
        $data = $request->except('photo');
        $data['token'] = sha1(time().auth()->user()->id);
        $coop = Cooperative::find(auth()->user()->cooperative_id);
        $data['cooperative_id'] = $coop->id;
        $data['arrondissement_id'] = $coop->arrondissement_id;
        $data['departement_id'] = $coop->departement_id;
        $data['region_id'] = $coop->region_id;
        if($request->photo){
            $data['photo_uri'] = $this->entityImgCreate($request->photo,'members',$data['token']);
        }
        Exploitant::create($data);
        Session::flash('success','Nouvel adherent créé avec succès!');
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
		$item = Exploitant::where('token',$token)->first();
        $parts = Part::where('saison_id',$this->_saison->id)->where('exploitant_id',$item->id)->get();
        $pps = PaiementPart::where('saison_id',$this->_saison->id)->where('exploitant_id',$item->id)->get();
		return view('/Cooperative/Members/show')->with(compact('item','parts','pps'));
	}


}
