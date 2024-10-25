<?php

namespace App\Http\Middleware;

use App\Models\Departement;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RBassin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if($user->role_id!=7){
            return redirect('/login');
        }
        $bassin = Departement::find($user->departement_id);
        
        Session::put('bassin',$bassin);
        $path = request()->getPathInfo();
        $parts = explode('/',$path);
        $active = 1;
        if(in_array('previsions',$parts)){
            $active = 2;
        }
        if(in_array('cooperatives',$parts)){
            $active = 3;
        }
        if(in_array('members',$parts)){
            $active = 4;
        }
        if(in_array('contrats',$parts)){
            $active = 601;
        }
        if(in_array('protocoles',$parts)){
            $active = 602;
        }
        if(in_array('villages',$parts)){
            $active = 701;
        }
        if(in_array('arrondissements',$parts)){
            $active = 702;
        }
        Session::put('active',$active);
        return $next($request);
    }
}
