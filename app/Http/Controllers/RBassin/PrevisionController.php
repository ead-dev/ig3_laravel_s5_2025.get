<?php

namespace App\Http\Controllers\RBassin;

use App\Http\Controllers\Controller;
use App\Models\CalendrierItem;
use App\Models\Prevision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $day = request()->day;
        if($day){
            $previsions = Prevision::where('departement_id',auth()->user()->departement_id)->where('day',$day)->get();
            return view('/RBassin/Previsions/index')->with(compact('previsions','day'));
        }
        $previsions = Prevision::orderBy('day','DESC')->where('departement_id',auth()->user()->departement_id)->get();

        return view('/RBassin/Previsions/index')->with(compact('previsions'));
    }

    public function getCalendarData(){
        $previsions = Prevision::orderBy('day','ASC')->where('departement_id',auth()->user()->departement_id)->where('saison_id',$this->_saison->id)->get();
        $items = $previsions->groupBy(function($item){
            return $item->day->format('Y-m-d');
        });
        return $items->map(function($v,$k){
            $qty = $v->reduce(function($c,$i){
                return $c + $i->quantity;
            });
            return [
                'day'=>$k,
                'qty'=>$qty,
            ];
        })->values();
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
       $item = CalendrierItem::find($request->item_id);

       $p = Prevision::create([
        'item_id'=>$item->id,
        'calendrier_id'=>$item->calendrier_id,
        'grd1_qty'=>$request->grd1_qty,
        'grd2_qty'=>$request->grd2_qty,
        'hs_qty'=>$request->hs_qty,
        'region_id'=>$item->region_id,
        'departement_id'=>$item->departement_id,
        'arrondissement_id'=>$item->arrondissement_id,
        'cooperative_id'=>$item->cooperative_id,
        'saison_id'=>$item->saison_id,
        'protocole_id'=>$item->calendrier->protocole_id,
        'user_id'=>auth()->user()->id,
        'day'=>$item->day,
        'lieu'=>$item->lieu,
        'name'=>time(),
        'token'=>sha1(time()),
       ]);
        Session::flash('success','Enregistrement effectué avec succès!');
        return back();
    }

    public function save(){
        $item = Prevision::find(request()->id);
        $item->grd1_qty = request()->grd1_qty;
        $item->grd2_qty = request()->grd2_qty;
        $item->hs_qty = request()->hs_qty;
        $item->save();
        Session::flash('success','Modification effectuée avec succès!');
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
		$prevision = Prevision::find($id);
		return view('/RBassin/Previsions/show')->with(compact('prevision'));
	}


}
