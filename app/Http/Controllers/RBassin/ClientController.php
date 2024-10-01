<?php

namespace App\Http\Controllers\RBassin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExtendedController;
use App\Models\Client;
use App\Models\Pay;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::all();
        return view('/RBassin/Clients/index')->with(compact('clients'));
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
        $client = new Client();
        $client->name = $data['name'];
        $client->email = $data['m-email'];
        $client->phone = $data['phone'];
        $client->token = sha1(time());
        $client->address = $data['address'];
        $client->pay_id = $data['pay_id'];
        $photo = request()->photo;
        if($photo){
            $client->photo_uri = $this->entityImgCreate($photo,'clients',$client->token);
        }
        $client->save();
        $user = new User();
        $user->role_id = 5;
        $user->name = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->token = sha1(time());
        $user->client_id = $client->id;
        $user->save();
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
		$item = Client::where('token',$token)->first();
		return view('/RBassin/Clients/show')->with(compact('item'));
	}


}
