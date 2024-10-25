<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\ExtendedController;
use App\Models\Contrat;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Saison;
use App\Models\User;

class DashboardController extends ExtendedController
{

	

    public function index()
	{
        $user = User::find(auth()->user()->id);
		return view('Bank/dashboard',compact('user'));
	}

    public function getData()
    {
        $contrats = Contrat::where('saison_id',$this->_saison->id)->where('banque_id',auth()->user()->bank_id)->get();

        $orders = Order::where('saison_id',$this->_saison->id)->where('banque_id',auth()->user()->bank_id)->get();
        $items = [];

        $glvcs = $orders->groupBy(function($item){
            return $item->client->name;
        });


        $response = $glvcs->map(function($v,$i){
            $quantity = $v->reduce(function($c,$i){
                return $c + $i->quantity;
            });

            $total = $v->reduce(function($c,$i){
                return $c + $i->total;
            });

            $versement = $v->reduce(function($c,$i){
                return $c + $i->versement;
            });

            $reste = $v->reduce(function($c,$i){
                return $c + $i->reste;
            });

            return [
                'client'=>$i,
                'quantity'=>$quantity,
                'total'=>$total,
                'versement'=>$versement,
                'reste'=>$reste
            ];
        });
        return response()->json($response);

    }
}
