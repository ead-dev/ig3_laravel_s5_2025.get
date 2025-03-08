<?php

namespace App\Http\Controllers;

use App\Models\Repas;
use App\Models\Role;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index(){
       // echo "Hello tout le monde !";
       $roles = Role::all();
       //$repas = Repas::all();
       //dd($repas);
       return view('hello',['items'=>$roles]);
    }

    public function getRepas(){
        $repas = Repas::all();
        //dd($repas);
        return view('repas',['repas'=>$repas]);
     }


}
