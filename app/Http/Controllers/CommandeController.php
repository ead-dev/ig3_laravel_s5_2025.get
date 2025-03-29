<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Ligne;
use App\Models\Repas;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $items = Commande::orderBy('created_at','DESC')->get();

       return view('Commandes.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $repas = Repas::all();
        return view('Commandes.create',compact('repas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        $cmd = new Commande();
        $cmd->name = rand(1000,5555);
        $cmd->save();

        $lgn = new Ligne();
        $lgn->commande_id = $cmd->id;
        $lgn->menu_id = $request->menu_id;
        $lgn->pu = $request->pu;
        $lgn->quantity = $request->quantity;
        $lgn->save();

        return redirect('/commandes');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
