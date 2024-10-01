<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\Pay;
use App\User;
use Illuminate\Http\Request;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pays = Pay::all();
        $continents = Continent::all();
        return view('/Admin/Pays/index')->with(compact('pays','continents'));
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
        $pay = Pay::create(
            [
                'name'=>$data['name'],
                'abb'=>$data['abb'],
                'continent_id'=>$data['continent_id'],
            ]
        );
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
		$pay = Pay::find($id);
		return view('/Admin/Pays/show')->with(compact('pay'));
	}


}
