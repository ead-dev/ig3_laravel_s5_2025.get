<?php

namespace App\Http\Controllers\Operateur;

use App\Http\Controllers\ExtendedController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Prevision;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Order::orderBy('created_at','DESC')->where('user_id',auth()->user()->id)->get();
        return view('/Operateur/Commandes/index')->with(compact('items'));
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
        $prevision = Prevision::find($request->prevision_id);
        $order = Order::find($request->order_id);
        OrderItem::create([
            'name'=>time(),
            'client_id'=>$order->client_id,
            'order_id'=>$order->id,
            'saison_id'=>$this->_saison->id,
            'prevision_id'=>$prevision->id,
            'cooperative_id'=>$prevision->cooperative_id,
            'region_id'=>$prevision->cooperative->region_id,
            'departement_id'=>$prevision->cooperative->departement_id,
            'arrondissement_id'=>$prevision->cooperative->arrondissement_id,
            'grd1_qty'=>$request->grd1_qty,
            'grd2_qty'=>$request->grd2_qty,
            'hs_qty'=>$request->hs_qty,
            'grd1_price'=>$request->grd1_price,
            'grd2_price'=>$request->grd2_price,
            'hs_price'=>$request->hs_price,
            'day'=>$prevision->day,
            'lieu'=>$prevision->lieu,
            'token'=>sha1(time()),
        ]);

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
		$item = Order::where('token',$token)->first();
        $regions = Region::all();
        return view('/Operateur/Commandes/show')->with(compact('item','regions'));


	}


}
