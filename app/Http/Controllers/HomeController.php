<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
        $user = auth()->user();
       // dd(auth()->user());
        if($user){
            $role_id = $user->role_id;
           // dd($role_id);
           if($role_id == 1){
            //Auth::logout();
            return redirect('/admin/dashboard');
           }
           if($role_id == 222){
            return redirect('/sheduler/dashboard');
           }
           if($role_id == 3){
            return redirect('/bank/dashboard');
           }
           if($role_id == 4){
            return redirect('/cooperative/dashboard');
           }
           if($role_id == 5){
            return redirect('/client/dashboard');
           }

           if($role_id == 6){
            return redirect('/operateur/dashboard');
           }

           if($role_id == 7){
            return redirect('/rbassin/dashboard');
           }

           return redirect('/login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
