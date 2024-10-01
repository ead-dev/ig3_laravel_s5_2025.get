<?php

namespace App\Http\Controllers\Cooperative;

use App\Http\Controllers\Controller;
use App\Models\Secteur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

	

    public function index()
	{
		return view('Cooperative/dashboard');
	}
}
