<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contrat;
use App\Models\Protocole;
use App\Models\Saison;
use App\User;
use Illuminate\Http\Request;

class SaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $saisons = Saison::orderBy('year','DESC')->get();
        return view('/Admin/Saisons/index')->with(compact('saisons'));
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
        $saison = Saison::create(
            [
                'name'=>$data['name'],
                'year'=>$data['year'],
                'start'=>$data['start'],
                'end'=>$data['end'],
                'token'=>sha1(time()),
            ]
        );
        return back();
    }


    public function close($id){
        $saison = Saison::find($id);
        $saison->closed_at = new \DateTime();
        $saison->save();
        $saison->contrats->closed_at = new \DateTime();
        $saison->protocoles->closed_at = new \DateTime();
       // Contrat::updateOrCreate(['saison_id'=>$id],['closed_at'=>new \DateTime()]);
        //Protocole::updateOrCreate(['saison_id'=>$id],['closed_at'=>new \DateTime()]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($id)
	{
		$saison = Saison::find($id);
		return view('/Admin/Saisons/show')->with(compact('saison'));
	}


}
