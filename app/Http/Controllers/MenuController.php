<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Repas;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $items = Repas::orderBy('name','ASC')->get();
        //dd($items);
        return view('Menu.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cats = Category::all();
        return view('Menu.create',compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       // dd($request->all());
        $item = new Repas();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->pu = $request->pu;
        $item->category_id = $request->category_id;
        $item->save();
        //return redirect()->back();
        return redirect('/menu');
        //dd($item);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $elt = Repas::find($id);
        if($elt){
            return view('Menu.show',compact('elt'));
        }
        else{
            return "Element inexistant!";
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        //dd($id);
        $cats = Category::all();
        $item = Repas::find($id);
        return view('Menu.edit',compact('cats','item'));
    }


    public function disable(string $id)
    {
        //
        //dd($id);

        $item = Repas::find($id);
        $item->active = 0;
        $item->save();
        return back();
    }


    public function enable(string $id)
    {
        //
        //dd($id);

        $item = Repas::find($id);
        $item->active = 1;
        $item->save();
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        //dd($request->all());
        Repas::updateOrCreate(['id'=>$id],$request->all());
        return redirect('/menu/'.$id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
