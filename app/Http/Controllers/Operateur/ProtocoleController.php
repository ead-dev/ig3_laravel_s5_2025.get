<?php

namespace App\Http\Controllers\Operateur;

use App\Http\Controllers\Controller;
use App\Models\Arrondissement;
use App\Models\Calendrier;
use App\Models\CalendrierItem;
use App\Models\Saison;
use App\Models\Protocole;
use App\Models\Client;
use App\Models\Contrat;
use App\Models\Cooperative;
use App\Models\Livraison;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProtocoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::find(auth()->user()->id);
        $ids = $user->producteurs->pluck('id');
        $saisons = Saison::whereNull('closed_at')->get();
        $sids = $saisons->pluck('id');
        $protocoles = Protocole::orderBy('created_at','DESC')
        ->whereIn('cooperative_id',$ids)
        ->whereIn('saison_id',$sids)
        ->get();
        $cooperatives = Cooperative::where('active',1)->get();
        return view('/Operateur/Protocoles/index')->with(compact('protocoles','cooperatives','saisons'));
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
        $protocole = Protocole::create(
            [
                'cooperative_id'=>$data['cooperative_id'],
                'saison_id'=>$data['saison_id'],
                'quantity'=>$data['quantity'],
                'token'=>sha1(time()),
            ]
        );
        Session::flash('success','Opération effectuée avec succès!');
        return back();
    }

    public function generateCalendar($token){
        $protocole = Protocole::where('token',$token)->first();
        if($protocole){
            Calendrier::create([
                'protocole_id'=>$protocole->id,
                'saison_id'=>$protocole->saison_id,
                'cooperative_id'=>$protocole->cooperative_id,
                'token'=>sha1(time() . rand(0,9999)),
            ]);
        }
        Session::flash('success','Opération effectuée avec succès!');
        return back();
    }

    public function setCalendarItem(){
        $data = request()->all();
        $cal = Calendrier::find($data['calendrier_id']);
        $item = new CalendrierItem();
        $item->token = sha1(time() . rand(0,9999));
        $item->quantity = $data['quantity'];
        $item->day = $data['day'];
        $item->region_id = $data['region_id'];
        $item->departement_id = $data['departement_id'];
        $item->arrondissement_id = $data['arrondissement_id'];
        $item->village_id = $data['village_id']?$data['village_id']:0;
        $item->calendrier_id = $data['calendrier_id'];
        $item->cooperative_id = $cal->cooperative_id;
        $item->saison_id = $cal->saison_id;
        $item->save();
        Session::flash('success','Enregistrement effectué avec succès!');
        return back();
    }

    public function initLivraison(){
        $data = request()->all();
        $item = CalendrierItem::find($data['item_id']);
        $contrat = Contrat::find($data['contrat_id']);
        $cal = Calendrier::find($item->calendrier_id);
        $arrondissement = Arrondissement::find($data['arrondissement_id']);
        $liv = new Livraison();
        $liv->item_id = $item->id;
        $liv->contrat_id = $contrat->id;
        $liv->client_id = $contrat->client_id;
        $liv->protocole_id = $cal->protocole_id;
        $liv->cooperative_id = $cal->cooperative_id;
        $liv->calendrier_id = $cal->id;
        $liv->saison_id = $cal->saison_id;
        $liv->day = $data['day'];
        $liv->price = $data['price'];
        $liv->village_id = $data['village_id']?$data['village_id']:0;
        //dd($data['village_id']);
        $liv->arrondissement_id = $data['arrondissement_id'];
        $liv->departement_id = $arrondissement->departement_id;
        $liv->region_id = $arrondissement->region_id;
        $liv->token = sha1(time() . rand(0,9999));
        $liv->quantity = $data['quantity'];
        $liv->operateur_id = auth()->user()->id;
        $liv->user_id = auth()->user()->id;
        $liv->save();

        Session::flash('success','Ordre de préparation envoyé avec succès!');
        return back();
    }

    public function showCalendarItem($token){
        $item = CalendrierItem::where('token',$token)->first();
        $contrats = Contrat::where('saison_id',$item->saison_id)->get();
        $arrondissements = Arrondissement::where('departement_id',$item->departement_id)->get();
        return view('/Operateur/Protocoles/calendar_item')->with(compact('item','arrondissements','contrats'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($token)
	{
		$protocole = Protocole::where('token',$token)->first();
        $regions = Region::all();
		return view('/Operateur/Protocoles/show')->with(compact('protocole','regions'));
	}


}
