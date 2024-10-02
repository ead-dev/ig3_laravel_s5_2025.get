<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends ExtendedController
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

    public function getProfile(){
        $user = User::find(auth()->user()->id);
        return view('profile',compact('user'));
    }

    public function storeProfile(){
        $user = User::where('token',request()->id)->first();
        if($user){
            $photo = request()->photo;
            if($photo){
                $user->photo_uri = $this->entityImgCreate($photo,'profil',$user->token);
            }
            $user->name = request()->name;
            $user->password = bcrypt(request()->password);
            $user->email = request()->email;
            $user->save();
            Session::flash('success','Mise à jour effectuée avec succès!');
        }
        return back();
    }
}
