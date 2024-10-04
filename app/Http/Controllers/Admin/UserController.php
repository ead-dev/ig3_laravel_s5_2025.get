<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arrondissement;
use App\Models\Region;
use App\Models\OperateurProducteur;
use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('/Admin/Users/index')->with(compact('users'));
    }

    public function getOperateurs()
    {
        //
        $operateurs = User::orderBy('created_at','DESC')->where('role_id',6)->get();
        return view('/Admin/Users/operateurs')->with(compact('operateurs'));
    }

    public function getOperateur($token)
    {
        //
        $operateur = User::where('token',$token)->first();
        $regions = Region::all();
        return view('/Admin/Users/operateur')->with(compact('operateur','regions'));
    }

    public function linkOperateurToCooperative(){
       $item = new OperateurProducteur();
       $item->operateur_id = request()->operateur_id;
       $item->producteur_id = request()->producteur_id;
       $item->save();
       Session::flash('success','Enregistrement effectué avec succès!');
        return back();
    }


    public function saveOperateur(Request $request)
    {
        $user = new User();
        $user->name = request()->name;
        $user->token = sha1(date('Yhmdsi'). auth()->user()->id);
        $user->password = bcrypt(request()->password);
        $user->role_id = 6;
        $user->email = request()->email;
        $user->save();
        Session::flash('success','Enregistrement effectué avec succès!');
        return back();
    }


    public function getRbassins()
    {
        //
        $rbassins = User::orderBy('created_at','DESC')->where('role_id',7)->get();
        $regions = Region::all();
        return view('/Admin/Users/rbassins')->with(compact('rbassins','regions'));
    }


    public function getRbassin($token)
    {
        //
        $rbassin = User::where('token',$token)->first();
        $arrondissements = Arrondissement::where('departement_id',auth()->user()->departement_id)->get();
        return view('/Admin/Users/rbassin')->with(compact('rbassin','arrondissements'));
    }




    public function saveRbassin(Request $request)
    {
        $user = new User();
        $user->name = request()->name;
        $user->token = sha1(date('Yhmdsi'). auth()->user()->id);
        $user->password = bcrypt(request()->password);
        $user->role_id = 7;
        $user->email = request()->email;
        $user->departement_id = request()->departement_id;
        $user->region_id = request()->region_id;
        $user->save();
        Session::flash('success','Enregistrement effectué avec succès!');
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
        $data['name'] = request()->name;
        $data['token'] = sha1(date('Yhmdsi'). auth()->user()->id);
        $data['password'] = bcrypt(request()->password);
        $data['role_id'] = request()->role_id;
        $data['phone'] = request()->phone;
        $data['email'] = request()->email;
        User::create($data);
        return back();
    }

    public function  enable($token){
        $user = User::find($token);
        $user->active = 1;
        $user->save();
        return back();
    }

    public function  disable($token){
        $user = User::find($token);
        $user->active = 0;
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
		$zone = Zone::where('token',$token)->first();
		return view('/Admin/Zones/show')->with(compact('zone'));
	}


}
