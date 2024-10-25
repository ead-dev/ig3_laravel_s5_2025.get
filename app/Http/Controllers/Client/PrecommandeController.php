<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Saison;
use App\Models\Contrat;
use App\Models\Precommande;
use App\Models\Client;
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
        $items = Precommande::orderBy('created_at','DESC')->where('client_id',auth()->user()->client_id)->get();
        $contrats = Contrat::orderBy('created_at','DESC')->where('client_id',auth()->user()->client_id)->where('saison_id',$this->_saison->id)->get();
        return view('/Client/Precommandes/index')->with(compact('items','contrats'));
    }

    public function cancel($token){
        $item = Precommande::where('token',$token)->first();
        $item->cancelled_at = new \DateTime();
        $item->cancelled_by = auth()->user()->id;
        $item->save();
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
        $data = $request->all();
        
        $data['client_id'] = auth()->user()->client_id;
        $data['token'] = sha1(time());
        $day = \Carbon\Carbon::parse($data['day']);
        $data['moi_id'] = $day->month;
        $data['semaine'] = $day->week;
        $data['annee'] = $day->year;
        $data['name'] = time();
        $data['saison_id'] = $this->_saison->id;

        $contrat = Precommande::create($data);
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
		$item = Precommande::where('token',$token)->first();
        if($item->client_id == auth()->user()->client_id){
            return view('/Client/Precommandes/show')->with(compact('item'));
        }
        return back();
		
	}


}
