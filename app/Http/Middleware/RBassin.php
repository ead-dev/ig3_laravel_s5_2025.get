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
        if(in_array('protocole',$parts) || in_array('protocoles',$parts)){
            $active = 202;
        }
        if(in_array('contrat',$parts) || in_array('contrats',$parts)){
            $active = 201;
        }
        if(in_array('client',$parts) || in_array('clients',$parts)){
            $active = 302;
        }
        if(in_array('cooperative',$parts) || in_array('cooperatives',$parts)){
            $active = 303;
        }
        if(in_array('villages',$parts)){
            $active = 401;
        }
        if(in_array('arrondissements',$parts)){
            $active = 402;
        }
        if(in_array('a_transactions',$parts)){
            $active = 501;
        }
        if(in_array('livraisons',$parts)){
            $active = 2;
        }
        Session::put('active',$active);
        return $next($request);
    }
}
