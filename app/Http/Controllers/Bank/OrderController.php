<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\ExtendedController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Paiement;
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
        $items = Order::orderBy('created_at','DESC')->where('banque_id',auth()->user()->bank_id)->get();
        return view('/Bank/Orders/index')->with(compact('items'));
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
        $item = OrderItem::find($request->id);
        $data = [
            'name'=>time(),
            'item_id'=>$item->id,
            'order_id'=>$item->order_id,
            'banque_id'=>auth()->user()->bank_id,
            'day'=>$request->day,
            'montant'=>$request->montant,
            'token'=>sha1(time().$item->id),
            'client_id'=>$item->order->client_id,
            'saison_id'=>$item->order->saison_id,
            'contrat_id'=>$item->order->contrat_id,
            'cooperative_id'=>$item->cooperative_id,
            'user_id'=>auth()->user()->id,
            'compte'=>$request->compte,
        ];
        if($request->document){
            $data['document_uri'] = $this->entityDocumentCreate($request->document,'paiements',$data['token']);
        }
        Paiement::create($data);
        Session::flash('success','Enregistrement du paiement effectué avec succès!');
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
        return view('/Bank/Orders/show')->with(compact('item'));


	}


}
