<?php

namespace App\Http\Controllers\RBassin;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use App\Models\Departement;
use App\Models\Region;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTransactions()
    {
        //
        $livraisons = Livraison::where('departement_id',auth()->user()->departement_id)->whereNotNull('closed_at')->get();
        return view('/RBassin/Archives/transactions')->with(compact('livraisons'));
    }


}
