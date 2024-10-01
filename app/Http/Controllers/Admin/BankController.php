<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banque;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banques = Banque::all();
        return view('/Admin/Banques/index')->with(compact('banques'));
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
        $banque = new Banque();
        $banque->name = $data['name'];
        $banque->email = $data['m-email'];
        $banque->phone = $data['phone'];
        $banque->token = sha1(time());
        $banque->address = $data['address'];
        $banque->abb = $data['abb'];
        $banque->save();
        $user = new User();
        $user->role_id = 3;
        $user->name = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->token = sha1(time());
        $user->bank_id = $banque->id;
        $user->save();
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
		$item = Banque::find($id);
		return view('/Admin/Banques/show')->with(compact('item'));
	}


}
