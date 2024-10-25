<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\ExtendedController;
use App\Models\Order;
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
        $items = Order::orderBy('created_at','DESC')->get();
        return view('/Client/Orders/index')->with(compact('items'));
    }


    public function cancel($token){
    }

    public function agree($token){
        $item = Order::where('token',$token)->first();
        $item->client_validated_at = new \DateTime();
        $item->client_validated_by = auth()->user()->id;
        $item->save();
        Session::flash('success','Offre approuvée avec succès!');
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
        return view('/Client/Orders/show')->with(compact('item','regions'));


	}


}
