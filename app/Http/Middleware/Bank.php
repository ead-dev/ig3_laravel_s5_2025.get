<?php

namespace App\Http\Middleware;

use App\Models\Banque;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Bank
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $bank = Banque::find($user->bank_id);
        
        Session::put('banque',$bank);
        if($user->role_id!=3){
            return redirect('/login');
        }
        $path = request()->getPathInfo();
        $parts = explode('/',$path);
        $active = 1;
        if(in_array('paiements',$parts)){
            $active = 2;
        }
        if(in_array('invoices',$parts)){
            $active = 3;
        }
        if(in_array('contrats',$parts)){
            $active = 4;
        }
        Session::put('active',$active);
        return $next($request);
    }
}
