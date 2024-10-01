<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Secteur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

	

    public function index()
	{
		return view('Bank/dashboard');
	}
}
