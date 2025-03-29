<?php

namespace App\Http\Controllers;

use App\Models\Repas;
use App\Models\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
       return view('home');
    }


}
